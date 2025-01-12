<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pasien</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="d-flex justify-content-center align-items-center" style="height: 100vh;">
        <div class="card mb-4" style="width: 500px;">
            <div class="card-header text-center">
                <h3 class="card-title">Edit Data Pasien</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('pasien.update', $pasien->id) }}" method="POST">
                    @csrf
                    @method('PUT') 
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Pasien</label>
                        <input type="text" class="form-control" id="nama" name="nama" value="{{ old('nama', $pasien->nama) }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <textarea class="form-control" id="alamat" name="alamat" rows="3" required>{{ old('alamat', $pasien->alamat) }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="no_telepon" class="form-label">No Telepon</label>
                        <input
                            type="text"
                            id="no_telepon"
                            name="no_telepon"
                            class="form-control"
                            value="{{ old('no_telepon', $pasien->no_telepon) }}"
                            required>
                    </div>

                    <div class="mb-3">
                        <label for="rumah_sakit_id" class="form-label">Rumah Sakit</label>
                        <select class="form-select" id="rumah_sakit_id" name="rumah_sakit_id" required>
                            <option value="">Pilih Rumah Sakit</option>
                            @foreach ($rumahSakits as $rumahSakit)
                                <option value="{{ $rumahSakit->id }}"{{ old('rumah_sakit_id', $pasien->rumah_sakit_id) == $rumahSakit->id ? 'selected' : '' }}>
                                    {{ $rumahSakit->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Perbarui</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
