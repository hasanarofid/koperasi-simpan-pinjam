<?php

namespace App\Http\Controllers;

use App\Models\MemberGroup;
use Illuminate\Http\Request;

class MemberGroupController extends Controller
{
    public function index()
    {
        $groups = MemberGroup::withCount('members')->get();
        return view('member_groups.index', compact('groups'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        MemberGroup::create($request->all());
        return redirect()->back()->with('success', 'Kelompok berhasil ditambahkan');
    }

    public function update(Request $request, MemberGroup $memberGroup)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $memberGroup->update($request->all());
        return redirect()->back()->with('success', 'Kelompok berhasil diperbarui');
    }

    public function destroy(MemberGroup $memberGroup)
    {
        $memberGroup->delete();
        return redirect()->back()->with('success', 'Kelompok berhasil dihapus');
    }
}
