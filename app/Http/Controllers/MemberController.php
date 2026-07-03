<?php

namespace App\Http\Controllers;

class MemberController extends Controller
{
    public function index()
    {
        $members = config('uac.members');

        $regions = collect($members)
            ->unique('region_slug')
            ->map(fn (array $member) => ['slug' => $member['region_slug'], 'label' => $member['region']])
            ->values()
            ->all();

        $fields = collect($members)
            ->unique('field_slug')
            ->map(fn (array $member) => ['slug' => $member['field_slug'], 'label' => $member['field']])
            ->values()
            ->all();

        return view('pages.members.index', [
            'pageTitle' => ui('pages.members_index.title'),
            'metaDescription' => ui('pages.members_index.meta'),
            'members' => $members,
            'featuredMembers' => array_values(array_filter($members, fn (array $member) => $member['type'] === 'Featured')),
            'alumniMembers' => array_values(array_filter($members, fn (array $member) => $member['type'] === 'Alumni')),
            'regions' => $regions,
            'fields' => $fields,
        ]);
    }

    public function secretary()
    {
        return view('pages.members.secretary', [
            'pageTitle' => ui('pages.members_secretary.title'),
            'metaDescription' => ui('pages.members_secretary.meta'),
            'leaders' => config('uac.secretary_members'),
        ]);
    }
}
