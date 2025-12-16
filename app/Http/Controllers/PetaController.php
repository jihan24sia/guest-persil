<?php

namespace App\Http\Controllers;

use App\Models\Peta;
use App\Models\Media;
use App\Models\Persil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Builder; // Import untuk Builder

class PetaController extends Controller
{
    public function index(Request $request) // Menerima Request untuk filter/search
    {
        $filterableColumns = ['panjang_m'];
        $searchableColumns = ['lebar_m'];

        $peta = Peta::with(['persil', 'media'])
            ->filter($request, $filterableColumns)
            ->search($request, $searchableColumns)
            ->latest()
            ->paginate(9)
            ->withQueryString();

        return view('pages.peta.index', compact('peta'));
    }

    public function create()
    {
        $persil = Persil::all();
        return view('pages.peta.create', compact('persil'));
    }

    public function store(Request $request)
    {
        // PENTING: Validasi diseragamkan dan lebih lengkap
        $validated = $request->validate([
            'persil_id' => 'required|exists:persil,persil_id',
            'geojson' => 'required|string',
            'panjang_m' => 'required|numeric|min:0.01',
            'lebar_m' => 'required|numeric|min:0.01',
            'media_files.*' => 'nullable|file|mimes:jpg,jpeg,png|max:30720',
        ]);

        // Peta dibuat dari data yang sudah divalidasi
        $peta = Peta::create($validated);

        if ($request->hasFile('media_files')) {
            foreach ($request->file('media_files') as $i => $file) {
                // Gunakan fungsi time() dan uniqid() untuk nama file yang unik
                $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

                // Simpan file ke disk 'public'
                $file->storeAs('uploads/peta', $filename, 'public');

                Media::create([
                    'ref_table' => 'peta',
                    'ref_id' => $peta->peta_id,
                    'file_name' => $filename,
                    'mime_type' => $file->getMimeType(),
                    'sort_order' => $i,
                ]);
            }
        }

        return redirect()->route('peta.index')->with('success', 'Peta persil berhasil disimpan!');
    }

    public function edit($id)
    {
        $peta = Peta::with('media')->findOrFail($id);
        $persil = Persil::all();
        return view('pages.peta.edit', compact('peta', 'persil'));
    }

    public function update(Request $request, $id)
    {
        $peta = Peta::findOrFail($id);

        // PENTING: Validasi diseragamkan dan lebih lengkap
        $validated = $request->validate([
            'persil_id' => 'required|exists:persil,persil_id',
            'geojson' => 'required|string',
            'panjang_m' => 'required|numeric|min:0.01',
            'lebar_m' => 'required|numeric|min:0.01',
            'media_files.*' => 'nullable|file|mimes:jpg,jpeg,png|max:5120',
        ]);

        // Update data non-media dari data yang divalidasi
        $peta->update($validated);

        // Logika upload media BARU (Menambahkan ke yang sudah ada)
        if ($request->hasFile('media_files')) {

            // Ambil urutan terakhir dari media yang sudah ada
            $lastSort = Media::where('ref_table', 'peta')
                ->where('ref_id', $peta->peta_id)
                ->max('sort_order') ?? 0;

            foreach ($request->file('media_files') as $i => $file) {
                // Gunakan fungsi time() dan uniqid() untuk nama file yang unik
                $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

                // Simpan file ke disk 'public'
                $file->storeAs('uploads/peta', $filename, 'public');

                Media::create([
                    'ref_table' => 'peta',
                    'ref_id' => $peta->peta_id,
                    'file_name' => $filename,
                    'mime_type' => $file->getMimeType(),
                    // Urutan dimulai dari $lastSort + $i + 1
                    'sort_order' => $lastSort + $i + 1,
                ]);
            }
        }

        return redirect()->route('peta.index')->with('success', 'Peta persil berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $peta = Peta::with('media')->findOrFail($id);

        // Hapus media dan file fisik
        foreach ($peta->media as $m) {
            Storage::delete('public/uploads/peta/' . $m->file_name);
            $m->delete();
        }

        $peta->delete();

        return back()->with('success', 'Peta persil berhasil dihapus!');
    }

    public function deleteMedia($media_id)
    {
        $media = Media::findOrFail($media_id);

        // Hapus file fisik
        $filePath = 'public/uploads/peta/' . $media->file_name;
        if (Storage::exists($filePath)) {
            Storage::delete($filePath);
        }
        // Hapus entri dari database
        $media->delete();

        return back()->with('success', 'Foto peta berhasil dihapus.');
    }

    public function showDetail($id) // Mengubah dari Peta $peta menjadi $id
    {
        try {
            // Temukan peta, muat relasi persil (untuk RT/RW) dan media
            $peta = Peta::with('persil.warga', 'media')->findOrFail($id);

            // Menambahkan data RT/RW dari relasi Persil
            $peta->rt = $peta->persil->rt ?? null;
            $peta->rw = $peta->persil->rw ?? null;

            // Mengembalikan data sebagai respons JSON
            return response()->json($peta);
        } catch (\Exception $e) {
            Log::error("Gagal mengambil detail peta ID: " . $id . " | Error: " . $e->getMessage());

            // Kembalikan respons error
            return response()->json(['message' => 'Gagal memproses data peta.', 'error' => $e->getMessage()], 500);
        }
    }
}
