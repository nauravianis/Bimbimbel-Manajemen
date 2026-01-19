<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class GuruController extends Controller
{
    public function index(Request $request)
    {
        $query = Guru::query();

        if ($request->has('search')) {
            $search = $request->search;
            $query->where('nama', 'like', "%{$search}%")
                ->orWhere('created_at', 'like', "%{$search}%")
                ->orWhere('jenis_kelamin', 'like', "%{$search}%")
                ->orWhere('alamat', 'like', "%{$search}%");

        }

        $guru = $query->latest()->get();
        return view('guru.index', compact('guru'));
    }

    public function create()
    {
        return view('guru.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:guru,email',
            'nomor_telp' => 'required|string|max:20',
            'tanggal_lahir' => 'nullable|date',
            'jenis_kelamin' => 'nullable|in:Laki-laki,Perempuan',
            'alamat' => 'nullable|string',
        ]);

        Guru::create($validated);

        return redirect()->route('guru.index')
            ->with('success', 'Data guru berhasil ditambahkan');
    }

    public function edit($id)
    {
        $guru = Guru::findOrFail($id);
        return view('guru.edit', compact('guru'));
    }

    public function update(Request $request, $id)
    {
        $guru = Guru::findOrFail($id);

        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:guru,email,' . $guru->id,
            'nomor_telp' => 'required|string|max:20',
            'tanggal_lahir' => 'nullable|date',
            'jenis_kelamin' => 'nullable|in:Laki-laki,Perempuan',
            'alamat' => 'nullable|string',
        ]);

        $guru->update($validated);

        return redirect()->route('guru.index')
            ->with('success', 'Data guru berhasil diperbarui');
    }


public function destroy($id)
{
    try {
        $guru = Guru::findOrFail($id);
        $guru->delete();

        return redirect()
            ->route('guru.index')
            ->with('success', 'Guru berhasil dihapus.');

    } catch (QueryException $e) {
        if ($e->getCode() == 23000) {
            return redirect()
                ->route('guru.index');
                        }
        return redirect()
            ->route('guru.index');
                }
}
public function updateTarif(Request $request, $id)
{
    $request->validate([
        'tarif_per_jam' => 'required|numeric|min:0',
    ]);

    Guru::findOrFail($id)->update([
        'tarif_per_jam' => $request->tarif_per_jam
    ]);

    return back()->with('success', 'Tarif per jam berhasil diperbarui');
}
}