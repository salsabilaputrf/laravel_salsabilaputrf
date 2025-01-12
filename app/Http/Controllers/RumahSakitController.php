<?php

namespace App\Http\Controllers;

use App\Models\RumahSakit;
use Illuminate\Http\Request;

class RumahSakitController extends Controller
{
    public function index()
    {
        $rumahSakits = RumahSakit::all();
        return response()->json([
            'rumahSakits' => $rumahSakits
        ]);
    }

    public function create()
    {
        return view('rumah_sakit.create');
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'nama' => 'required|string|max:255|unique:rumah_sakit,nama',
                'alamat' => 'required|string',
                'email' => 'required|email',
                'telepon' => 'required|string|numeric',
            ]);

            $rumah_sakit = new RumahSakit();
            $rumah_sakit->nama = $validated['nama'];
            $rumah_sakit->alamat = $validated['alamat'];
            $rumah_sakit->email = $validated['email'];
            $rumah_sakit->telepon = $validated['telepon'];
            $rumah_sakit->save();

            return redirect('/dashboard')->with('success', 'Rumah sakit berhasil ditambahkan!');
        } catch (\Exception $e) {
            $errorMessage = $this->handleExceptionMessage($e->getMessage());
            return redirect('/dashboard')->with('error', $errorMessage);
        }
    }


   public function edit($id)
   {
       $rumahSakit = RumahSakit::findOrFail($id);
       return view('rumah_sakit.edit', compact('rumahSakit'));
   }

   public function update(Request $request, $id)
   {
    try {
       $validated = $request->validate([
        'nama' => 'required|string|max:255|unique:rumah_sakit,nama,' . $id,
        'alamat' => 'required|string',
        'email' => 'required|email',
        'telepon' => 'required|string|numeric',
    ]);

    $rumahSakit = RumahSakit::findOrFail($id);

    if (!$rumahSakit) {
        return redirect('/dashboard')->with('error', 'Data rumah sakit tidak ditemukan!');
    }

    $rumahSakit->nama = $validated['nama'];
    $rumahSakit->alamat = $validated['alamat'];
    $rumahSakit->email = $validated['email'];
    $rumahSakit->telepon = $validated['telepon'];
    $rumahSakit->save();

    return redirect('/dashboard')->with('success', 'Data Rumah Sakit ' . $rumahSakit->nama .  'berhasil diperbarui!');
} catch (\Exception $e) {
    $errorMessage = $this->handleExceptionMessage($e->getMessage());
    return redirect('/dashboard')->with('error', $errorMessage);
}

   }

    // Menghapus rumah sakit
    public function destroy($id)
    {
        $rumahSakit = RumahSakit::findOrFail($id);
        $rumahSakit->delete();

        return response()->json([
            'message' => 'Rumah Sakit berhasil dihapus'
        ]);
    }

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
