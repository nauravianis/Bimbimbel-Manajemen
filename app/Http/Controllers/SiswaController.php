<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function index(Request $request)
    {
        $query = Siswa::query();

        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                    ->orWhere('sekolah', 'like', value: "%{$search}%")
                    ->orWhere('jk', 'like', value: "%{$search}%");

            });
        }

        $siswa = $query->get();

        return view('siswa.index', compact('siswa'));
    }

    public function create()
    {
        return view('siswa.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'no_telp_ortu' => 'required',
        ]);

        Siswa::create([
            'nama' => $request->nama,
            'sekolah' => $request->sekolah,
            'no_telp_ortu' => $request->no_telp_ortu,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jk' => $request->jk,
            'alamat' => $request->alamat,
            'status' => 'Nonaktif',
        ]);

        return redirect()->route('siswa.index')
            ->with('success', 'Siswa berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $siswa = Siswa::findOrFail($id);
        return view('siswa.edit', compact('siswa'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'no_telp_ortu' => 'required',
        ]);

        $siswa = Siswa::findOrFail($id);
        $siswa->update($request->all());

        return redirect()->route('siswa.index')
            ->with('success', 'Data siswa berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $siswa = Siswa::withCount(['paketSiswa'])->findOrFail($id);

        if ($siswa->status === 'Aktif' || $siswa->paket_siswa_count > 0) {
            return back()->with(
                'error',
                'Siswa tidak bisa dihapus karena masih memiliki paket aktif / riwayat.'
            );
        }

        $siswa->delete();

        return back()->with('success', 'Data siswa berhasil dihapus.');
    }
}