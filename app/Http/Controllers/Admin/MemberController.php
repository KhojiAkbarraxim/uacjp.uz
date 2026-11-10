<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Concerns\HandlesImageUploads;
use App\Http\Controllers\Controller;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MemberController extends Controller
{
    use HandlesImageUploads;

    // The first three drive the public Members page sections; the rest are kept
    // so profiles created before the leadership rework stay editable.
    public const TYPES = ['Executive', 'Ambassador', 'Staff', 'Featured', 'General', 'Alumni'];

    public function index(Request $request)
    {
        $members = Member::query()
            ->when($request->filled('search'), function ($q) use ($request) {
                $term = '%'.$request->input('search').'%';
                $q->where(fn ($q) => $q->where('name', 'like', $term)->orWhere('affiliation_en', 'like', $term));
            })
            ->when(in_array($request->input('type'), self::TYPES, true), fn ($q) => $q->where('type', $request->input('type')))
            ->orderBy('sort_order')
            ->orderBy('name')
            ->paginate(20)
            ->withQueryString();

        return view('admin.members.index', compact('members'));
    }

    public function create()
    {
        return view('admin.members.create', ['member' => new Member(['type' => 'General'])]);
    }

    public function store(Request $request)
    {
        Member::create($this->validated($request));

        return redirect()->route('admin.members.index')
            ->with('success', 'Member created.');
    }

    public function edit(Member $member)
    {
        return view('admin.members.edit', compact('member'));
    }

    public function update(Request $request, Member $member)
    {
        $member->update($this->validated($request, $member));

        return redirect()->route('admin.members.index')
            ->with('success', 'Member updated.');
    }

    public function destroy(Member $member)
    {
        $this->deleteUploadedImage($member->photo);
        $member->delete();

        return redirect()->route('admin.members.index')
            ->with('success', 'Member deleted.');
    }

    private function validated(Request $request, ?Member $member = null): array
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'role_en' => ['nullable', 'string', 'max:255'],
            'role_uz' => ['nullable', 'string', 'max:255'],
            'role_ja' => ['nullable', 'string', 'max:255'],
            'affiliation_en' => ['nullable', 'string', 'max:255'],
            'affiliation_uz' => ['nullable', 'string', 'max:255'],
            'affiliation_ja' => ['nullable', 'string', 'max:255'],
            'bio_en' => ['nullable', 'string'],
            'bio_uz' => ['nullable', 'string'],
            'bio_ja' => ['nullable', 'string'],
            'field_en' => ['nullable', 'string', 'max:255'],
            'field_uz' => ['nullable', 'string', 'max:255'],
            'field_ja' => ['nullable', 'string', 'max:255'],
            'field_slug' => ['nullable', 'string', 'max:255'],
            'region_en' => ['nullable', 'string', 'max:255'],
            'region_uz' => ['nullable', 'string', 'max:255'],
            'region_ja' => ['nullable', 'string', 'max:255'],
            'region_slug' => ['nullable', 'string', 'max:255'],
            'type' => ['required', 'in:'.implode(',', self::TYPES)],
            'sort_order' => ['nullable', 'integer'],
            'photo_file' => $this->imageRules(),
        ]);

        unset($data['photo_file']);
        $data['photo'] = $this->storeImage($request, 'photo_file', 'members', $member?->photo);

        $data['field_slug'] = Str::slug(($data['field_slug'] ?? null) ?: ($data['field_en'] ?? '')) ?: null;
        $data['region_slug'] = Str::slug(($data['region_slug'] ?? null) ?: ($data['region_en'] ?? '')) ?: null;
        $data['sort_order'] = $data['sort_order'] ?? ($member?->sort_order ?? 0);

        return $data;
    }
}
