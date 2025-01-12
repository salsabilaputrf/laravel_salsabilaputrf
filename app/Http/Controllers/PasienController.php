<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use App\Models\Pasien;
use App\Models\RumahSakit;
use Illuminate\Http\Request;

class PasienController extends Controller
{
    // Menampilkan daftar pasien beserta rumah sakit
    public function index()
    {
        $pasiens = Pasien::with('rumah_sakit')->get();
        return response()->json([
            'pasiens' => $pasiens
        ]);
    }

    // Filter pasien berdasarkan rumah sakit
    public function filter($rumah_sakit_id)
    {
        $pasiens = Pasien::where('rumah_sakit_id', $rumah_sakit_id)->get();

        if ($pasiens->isEmpty()) {
            return response()->json([
                'pasiensHtml' => '<tr><td colspan="5">Tidak ada pasien untuk rumah sakit ini.</td></tr>'
            ]);
        }

        $pasiensHtml = view('partials.pasien_table', compact('pasiens'))->render();
        return response()->json(['pasiensHtml' => $pasiensHtml]);
    }

    // Menampilkan form untuk menambah pasien
    public function create()
    {
        $rumahSakits = RumahSakit::all();
        return view('pasien.create', compact('rumahSakits'));
    }

    // Menyimpan data pasien baru
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'nama' => 'required|string|max:255',
                'alamat' => 'required|string',
                'no_telepon' => 'required|string|numeric',
                'rumah_sakit_id' => 'required|exists:rumah_sakit,id',
            ]);

            $pasien = new Pasien();
            $pasien->nama = $validated['nama'];
            $pasien->alamat = $validated['alamat'];
            $pasien->no_telepon = $validated['no_telepon'];
            $pasien->rumah_sakit_id = $validated['rumah_sakit_id'];
            $pasien->save();

            return redirect('/dashboard')->with('success', 'Pasien berhasil ditambahkan!');
        } catch (\Exception $e) {
            $errorMessage = $this->handleExceptionMessage($e->getMessage());
            return redirect('/dashboard')->with('error', $errorMessage);
        }
    }

    // Menampilkan form untuk mengedit pasien
    public function edit(Pasien $pasien)
    {
        $rumahSakits = RumahSakit::all();
        return view('pasien.edit', compact('pasien', 'rumahSakits'));
    }

    // Memperbarui data pasien
    public function update(Request $request, $id)
    {
        try {
            $validated = $request->validate([
                'nama' => 'required|string|max:255',
                'alamat' => 'required|string',
                'no_telepon' => 'required|string|numeric',
                'rumah_sakit_id' => 'required|exists:rumah_sakit,id',
            ]);

            $pasien = Pasien::findOrFail($id);

            $pasien->nama = $validated['nama'];
            $pasien->alamat = $validated['alamat'];
            $pasien->no_telepon = $validated['no_telepon'];
            $pasien->rumah_sakit_id = $validated['rumah_sakit_id'];
            $pasien->save();

            return redirect('/dashboard')->with('success', 'Data Pasien ' . $pasien->nama . ' berhasil diperbarui!');
        } catch (\Exception $e) {
            $errorMessage = $this->handleExceptionMessage($e->getMessage());
            return redirect('/dashboard')->with('error', $errorMessage);
        }
    }

    // Menghapus data pasien
    public function destroy($id)
    {
        $pasien = Pasien::findOrFail($id);
        $pasien->delete();

        return response()->json([
            'message' => 'Pasien berhasil dihapus'
        ]);
    }

    // Helper untuk menangani pesan error
    private function handleExceptionMessage($message)
    {
        if (str_contains($message, 'nama')) {
            return "Gagal memproses data. Mohon periksa kembali kolom \"nama\".";
        } elseif (str_contains($message, 'telepon')) {
            return "Gagal memproses data. Mohon periksa kembali kolom \"No Telepon\".";
        }

        return "Terjadi kesalahan, mohon coba lagi.";
    }
}
