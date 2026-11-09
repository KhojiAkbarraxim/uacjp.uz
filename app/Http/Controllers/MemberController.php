<?php

namespace App\Http\Controllers;

use App\Support\Content;

class MemberController extends Controller
{
    public function index()
    {
        $members = collect(Content::members());

        $byType = fn (string $type) => $members
            ->filter(fn (array $member) => ($member['type'] ?? null) === $type)
            ->values()
            ->all();

        return view('pages.members.index', [
            'pageTitle' => ui('pages.members_index.title'),
            'metaDescription' => ui('pages.members_index.meta'),
            'executives' => $byType('Executive'),
            'ambassadors' => $byType('Ambassador'),
            'staff' => $byType('Staff'),
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
