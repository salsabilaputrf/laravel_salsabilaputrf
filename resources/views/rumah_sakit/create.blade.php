<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Rumah Sakit</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="d-flex justify-content-center align-items-center" style="height: 100vh;">
        <div class="card mb-4" style="width: 500px;">
            <div class="card-header text-center">
                <h3 class="card-title">Tambah Rumah Sakit</h3>
            </div>
            <div class="card-body">
                <form id="tambahRumahSakitForm" method="POST" action="{{ route('rumah_sakit.store') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Rumah Sakit</label>
                        <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan nama rumah sakit" required>
                    </div>
                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <textarea class="form-control" id="alamat" name="alamat" rows="3" placeholder="Masukkan alamat rumah sakit" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="telepon" class="form-label">No Telepon</label>
                        <input type="text" class="form-control" id="telepon" name="telepon" value="{{ old('telepon', $pasien->telepon) }}" placeholder="Masukkan nomor telepon rumah sakit" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan email rumah sakit" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
