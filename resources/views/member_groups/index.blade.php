@extends('layouts.app')

@section('title', 'Kelompok Anggota')

@section('content')
<div class="space-y-8 pb-12">
    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-3xl font-bold text-slate-900 tracking-tight">Kelompok Anggota</h1>
            <p class="text-slate-500 mt-1">Kelola grup atau kelompok anggota untuk memudahkan koordinasi.</p>
        </div>
        <div class="flex items-center gap-3">
            <button onclick="document.getElementById('modal-add-group').showModal()" class="inline-flex items-center px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold rounded-2xl shadow-lg shadow-indigo-100 transition-all active:scale-95">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                Tambah Kelompok
            </button>
        </div>
    </div>

    <!-- Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($groups as $group)
        <div class="bg-white p-6 rounded-3xl border border-slate-200 shadow-sm hover:shadow-md transition-shadow relative group">
            <div class="flex items-start justify-between">
                <div class="p-3 bg-indigo-50 rounded-2xl text-indigo-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                </div>
                <div class="flex items-center gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                    <button onclick="editGroup({{ $group->id }}, '{{ $group->name }}', '{{ $group->description }}')" class="p-2 text-slate-400 hover:text-indigo-600 hover:bg-indigo-50 rounded-xl transition-all">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                    </button>
                    <form action="{{ route('member-groups.destroy', $group) }}" method="POST" onsubmit="return confirm('Hapus kelompok ini?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="p-2 text-slate-400 hover:text-rose-600 hover:bg-rose-50 rounded-xl transition-all">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                        </button>
                    </form>
                </div>
            </div>
            <div class="mt-4">
                <h3 class="text-xl font-bold text-slate-900">{{ $group->name }}</h3>
                <p class="text-slate-500 text-sm mt-1 line-clamp-2">{{ $group->description ?: 'Tidak ada deskripsi.' }}</p>
            </div>
            <div class="mt-6 flex items-center justify-between">
                <div class="flex -space-x-2">
                    <div class="w-8 h-8 rounded-full border-2 border-white bg-slate-100 flex items-center justify-center text-[10px] font-bold text-slate-500">
                        {{ $group->members_count }}
                    </div>
                </div>
                <span class="text-[10px] font-black uppercase tracking-wider text-slate-400">Total Anggota</span>
            </div>
        </div>
        @empty
        <div class="col-span-full py-20 text-center">
            <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mx-auto text-slate-300 mb-4">
                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
            </div>
            <h3 class="text-lg font-bold text-slate-900">Belum ada kelompok</h3>
            <p class="text-slate-500">Mulai buat kelompok untuk mengorganisir anggota Anda.</p>
        </div>
        @endforelse
    </div>
</div>

<!-- Add Modal -->
<dialog id="modal-add-group" class="modal p-0 rounded-3xl shadow-2xl border border-slate-200 w-full max-w-md backdrop:backdrop-blur-sm">
    <div class="p-8">
        <h3 class="text-2xl font-bold text-slate-900 mb-6 font-primary uppercase italic -skew-x-12 tracking-tighter">Tambah Kelompok</h3>
        <form action="{{ route('member-groups.store') }}" method="POST" class="space-y-5">
            @csrf
            <div>
                <label class="block text-[10px] font-black uppercase tracking-wider text-slate-400 mb-2">Nama Kelompok</label>
                <input type="text" name="name" required class="w-full px-4 py-3 rounded-2xl border border-slate-200 focus:outline-none focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all text-sm" placeholder="Misal: Kelompok Tani Makmur">
            </div>
            <div>
                <label class="block text-[10px] font-black uppercase tracking-wider text-slate-400 mb-2">Deskripsi</label>
                <textarea name="description" rows="3" class="w-full px-4 py-3 rounded-2xl border border-slate-200 focus:outline-none focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all text-sm" placeholder="Keterangan singkat kelompok..."></textarea>
            </div>
            <div class="flex gap-3 pt-4">
                <button type="button" onclick="this.closest('dialog').close()" class="flex-1 px-5 py-3 rounded-2xl border border-slate-200 text-slate-600 font-bold text-sm hover:bg-slate-50 transition-all active:scale-95">Batal</button>
                <button type="submit" class="flex-1 px-5 py-3 rounded-2xl bg-indigo-600 text-white font-bold text-sm hover:bg-indigo-700 shadow-lg shadow-indigo-100 transition-all active:scale-95">Simpan</button>
            </div>
        </form>
    </div>
</dialog>

<!-- Edit Modal -->
<dialog id="modal-edit-group" class="modal p-0 rounded-3xl shadow-2xl border border-slate-200 w-full max-w-md backdrop:backdrop-blur-sm">
    <div class="p-8">
        <h3 class="text-2xl font-bold text-slate-900 mb-6 font-primary uppercase italic -skew-x-12 tracking-tighter">Edit Kelompok</h3>
        <form id="form-edit-group" method="POST" class="space-y-5">
            @csrf @method('PUT')
            <div>
                <label class="block text-[10px] font-black uppercase tracking-wider text-slate-400 mb-2">Nama Kelompok</label>
                <input type="text" name="name" id="edit-name" required class="w-full px-4 py-3 rounded-2xl border border-slate-200 focus:outline-none focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all text-sm">
            </div>
            <div>
                <label class="block text-[10px] font-black uppercase tracking-wider text-slate-400 mb-2">Deskripsi</label>
                <textarea name="description" id="edit-description" rows="3" class="w-full px-4 py-3 rounded-2xl border border-slate-200 focus:outline-none focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all text-sm"></textarea>
            </div>
            <div class="flex gap-3 pt-4">
                <button type="button" onclick="this.closest('dialog').close()" class="flex-1 px-5 py-3 rounded-2xl border border-slate-200 text-slate-600 font-bold text-sm hover:bg-slate-50 transition-all active:scale-95">Batal</button>
                <button type="submit" class="flex-1 px-5 py-3 rounded-2xl bg-indigo-600 text-white font-bold text-sm hover:bg-indigo-700 shadow-lg shadow-indigo-100 transition-all active:scale-95">Update</button>
            </div>
        </form>
    </div>
</dialog>

<script>
    function editGroup(id, name, description) {
        const modal = document.getElementById('modal-edit-group');
        const form = document.getElementById('form-edit-group');
        form.action = `/member-groups/${id}`;
        document.getElementById('edit-name').value = name;
        document.getElementById('edit-description').value = description;
        modal.showModal();
    }
</script>
@endsection
