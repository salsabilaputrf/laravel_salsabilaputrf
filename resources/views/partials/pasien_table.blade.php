@foreach ($pasiens as $pasien)
    <tr>
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
