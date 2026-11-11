<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Concerns\HandlesImageUploads;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\MemberRequest;
use App\Models\Member;
use App\Support\Locales;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MemberController extends Controller
{
    use HandlesImageUploads;

    // These are exactly the sections the public Members page renders. Nothing
    // else may be offered here: a member saved under a type the page does not
    // group would simply never appear on the site. The legacy Featured, General
    // and Alumni types were folded into Staff by the 2026_11_11 migration.
    public const TYPES = ['Executive', 'Ambassador', 'Staff'];

    public function index(Request $request)
    {
        $members = Member::query()
            ->when($request->filled('search'), function ($q) use ($request) {
                $term = '%'.$request->input('search').'%';
                $q->where(function ($q) use ($term) {
                    $q->where('name', 'like', $term);

                    foreach (Locales::ORDER as $locale) {
                        $q->orWhere("affiliation_{$locale}", 'like', $term);
                    }
                });
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
        return view('admin.members.create', ['member' => new Member(['type' => 'Staff'])]);
    }

    public function store(MemberRequest $request)
    {
        Member::create($this->payload($request));

        return redirect()->route('admin.members.index')
            ->with('success', 'Member created.');
    }

    public function edit(Member $member)
    {
        return view('admin.members.edit', compact('member'));
    }

    public function update(MemberRequest $request, Member $member)
    {
        $member->update($this->payload($request, $member));

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

    private function payload(MemberRequest $request, ?Member $member = null): array
    {
        $data = $request->validated();

        unset($data['photo_file']);
        $data['photo'] = $this->storeImage($request, 'photo_file', 'members', $member?->photo);

        $source = Locales::SOURCE;
        $data['field_slug'] = Str::slug(($data['field_slug'] ?? null) ?: ($data["field_{$source}"] ?? '')) ?: null;
        $data['region_slug'] = Str::slug(($data['region_slug'] ?? null) ?: ($data["region_{$source}"] ?? '')) ?: null;
        $data['sort_order'] = $data['sort_order'] ?? ($member?->sort_order ?? 0);

        return $data;
    }
}
