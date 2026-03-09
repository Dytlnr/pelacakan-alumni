<?php

namespace App\Http\Controllers;

use App\Models\Alumni;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AlumniController extends Controller
{
    public function index(): View
    {
        $search = request('q');

        $query = Alumni::query();

        if ($search) {
            $query->where(function ($subQuery) use ($search) {
                $subQuery->where('nama', 'like', "%{$search}%")
                    ->orWhere('prodi', 'like', "%{$search}%")
                    ->orWhere('tahun_lulus', 'like', "%{$search}%");
            });
        }

        $alumni = $query->latest()->paginate(10)->withQueryString();

        $stats = [
            'total' => Alumni::count(),
            'teridentifikasi' => Alumni::whereIn('status', ['Ditemukan', 'Terverifikasi', 'Terdeteksi'])->count(),
            'perlu_verifikasi' => Alumni::where('status', 'Perlu Verifikasi')->count(),
            'belum_dilacak' => Alumni::where('status', 'Belum Dilacak')->count(),
        ];

        return view('alumni.index', compact('alumni', 'stats', 'search'));
    }

    public function create(): View
    {
        return view('alumni.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'prodi' => 'required|string|max:255',
            'tahun_lulus' => 'required|string|max:4',
            'kota' => 'nullable|string|max:255',
            'bidang' => 'nullable|string|max:255',
        ]);

        Alumni::create($validated);

        return redirect()->route('alumni.index')
            ->with('success', 'Data alumni berhasil ditambahkan.');
    }

    public function show(Alumni $alumni): View
    {
        $alumni->load(['profilPencarian', 'hasilPelacakan']);

        return view('alumni.show', compact('alumni'));
    }

    public function edit(Alumni $alumni): View
    {
        return view('alumni.edit', compact('alumni'));
    }

    public function update(Request $request, Alumni $alumni): RedirectResponse
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'prodi' => 'required|string|max:255',
            'tahun_lulus' => 'required|string|max:4',
            'kota' => 'nullable|string|max:255',
            'bidang' => 'nullable|string|max:255',
            'status' => 'nullable|string|max:255',
        ]);

        $alumni->update($validated);

        return redirect()->route('alumni.index')
            ->with('success', 'Data alumni berhasil diperbarui.');
    }

    public function destroy(Alumni $alumni): RedirectResponse
    {
        $alumni->delete();

        return redirect()->route('alumni.index')
            ->with('success', 'Data alumni berhasil dihapus.');
    }
}
