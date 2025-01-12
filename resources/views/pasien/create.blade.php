<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="d-flex justify-content-center align-items-center" style="height: 100vh;">
    <div class="card mb-4" style="width: 500px;">
    <div class="card-header text-center">
        <h3 class="card-title">Tambah Pasien</h3>
    </div>
    <div class="card-body">
        <form id="tambahPasienForm" method="POST" action="{{ route('pasien.store') }}">
            @csrf
            <div class="mb-3">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan nama pasien" required>
            </div>
            <div class="mb-3">
                <label for="alamat" class="form-label">Alamat</label>
                <textarea class="form-control" id="alamat" name="alamat" rows="3" placeholder="Masukkan alamat pasien" required></textarea>
            </div>
            <div class="mb-3">
                <label for="no_telepon" class="form-label">No Telepon</label>
                <input type="text" class="form-control" id="no_telepon" name="no_telepon" placeholder="Masukkan nomor telepon pasien" required>
            </div>
            <div class="mb-3">
                <label for="rumah_sakit_id" class="form-label">Rumah Sakit</label>
                <select class="form-select" id="rumah_sakit_id" name="rumah_sakit_id" required>
                    <option value="">Pilih Rumah Sakit</option>
                    @foreach ($rumahSakits as $rumahSakit)
                        <option value="{{ $rumahSakit->id }}">{{ $rumahSakit->nama }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
</div>

    </div>



</body>
</html>
