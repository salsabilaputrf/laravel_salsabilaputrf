<table class="table table-bordered">
    <thead>
        <tr>
            <th>Nama Rumah Sakit</th>
            <th>Alamat</th>
            <th>No Telepon</th>
            <th>Email</th>
            <th>Actions</th> 
        </tr>
    </thead>
    <tbody id="rumah-sakit-table-body">
        @foreach($rumahSakits as $rumahSakit)
            <tr id="rumah_sakit_{{ $rumahSakit->id }}">
                <td>{{ $rumahSakit->nama }}</td>
                <td>{{ $rumahSakit->alamat }}</td>
                <td>{{ $rumahSakit->telepon }}</td>
                <td>{{ $rumahSakit->email }}</td>
                <td>
                    <a href="{{ route('rumah_sakit.edit', $rumahSakit->id) }}" class="btn btn-warning btn-sm">Edit</a>

                    <button class="btn btn-danger btn-sm delete-rumah-sakit" data-id="{{ $rumahSakit->id }}">Hapus</button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<a href="{{ route('rumah_sakit.create') }}" class="btn btn-primary">Tambah Rumah Sakit</a>
