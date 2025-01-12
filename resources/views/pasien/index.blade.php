<table class="table table-bordered">
    <thead>
        <tr>
            <th>Nama</th>
            <th>Alamat</th>
            <th>No Telepon</th>
            <th>Rumah Sakit</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody id="pasien-table-body">
        @foreach($pasiens as $pasien)
            <tr id="pasien_{{ $pasien->id }}">
                <td>{{ $pasien->nama }}</td>
                <td>{{ $pasien->alamat }}</td>
                <td>{{ $pasien->no_telepon }}</td>
                <td>{{ $pasien->rumah_sakit->nama }}</td>
                <td>
                    <a href="{{ route('pasien.edit', $pasien->id) }}" class="btn btn-warning btn-sm">Edit</a>

                   <button class="btn btn-danger btn-sm delete-pasien" data-id="{{ $pasien->id }}">Hapus</button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<a href="{{ route('pasien.create') }}" class="btn btn-primary">Tambah Pasien</a>
