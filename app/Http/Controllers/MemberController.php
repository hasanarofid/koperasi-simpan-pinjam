<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $members = \App\Models\Member::latest()->paginate(10);
        return view('members.index', compact('members'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $groups = \App\Models\MemberGroup::all();
        return view('members.create', compact('groups'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(\Illuminate\Http\Request $request)
    {
        $validated = $request->validate([
            'member_number' => 'required|string|unique:members,member_number',
            'nik' => 'required|string|size:16|unique:members,nik',
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'phone' => 'required|string|max:20',
            'birth_date' => 'required|date',
            'registration_date' => 'required|date',
            'member_group_id' => 'nullable|exists:member_groups,id',
            'status' => 'required|in:active,inactive',
        ]);

        \App\Models\Member::create($validated);

        return redirect()->route('members.index')->with('success', 'Anggota berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(\App\Models\Member $member)
    {
        $member->load(['savingAccounts.savingType', 'loans.loanScheme']);
        return view('members.show', compact('member'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(\App\Models\Member $member)
    {
        return view('members.edit', compact('member'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(\Illuminate\Http\Request $request, \App\Models\Member $member)
    {
        $validated = $request->validate([
            'member_number' => 'required|string|unique:members,member_number,' . $member->id,
            'nik' => 'required|string|size:16|unique:members,nik,' . $member->id,
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'phone' => 'required|string|max:20',
            'birth_date' => 'required|date',
            'registration_date' => 'required|date',
            'member_group_id' => 'nullable|exists:member_groups,id',
            'status' => 'required|in:active,inactive',
        ]);

        $member->update($validated);

        return redirect()->route('members.index')->with('success', 'Data anggota berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(\App\Models\Member $member)
    {
        $member->delete();
        return redirect()->route('members.index')->with('success', 'Anggota berhasil dihapus.');
    }
}
