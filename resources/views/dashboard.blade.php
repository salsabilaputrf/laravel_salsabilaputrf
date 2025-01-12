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
    <div class="container mt-5 mb-5" style="max-width: 1600px; width: 90%;">
        @include('layouts.navigation')

        <div class="mb-3">
            <label for="rumah_sakit_filter" class="form-label">Filter Pasien by Rumah Sakit</label>
            <select id="rumah_sakit_filter" class="form-select">
                <option value="">Select Rumah Sakit</option>
                @foreach (collect($rumahSakits)->unique('nama') as $rumahSakit)
                    <option value="{{ $rumahSakit->id }}">{{ $rumahSakit->nama }}</option>
                @endforeach
            </select>
        </div>

        @if(session('success'))
            <div class="alert alert-success" id="success-alert">
                {{ session('success') }}
            </div>

            <script>
                setTimeout(function() {
                    document.getElementById('success-alert').style.display = 'none';
                }, 3000);
            </script>
        @endif

        @if(session('error'))
            <div class="alert alert-danger" id="error-alert">
                {{ session('error') }}
            </div>
            <script>
                setTimeout(function() {
                    document.getElementById('error-alert').style.display = 'none';
                }, 5000);
            </script>
        @endif

        <!-- Data Pasien -->
        <h5>Data Pasien</h5>
        @include('pasien.index')

        <hr class="my-4" style="border-top: 2px solid #000;">

        <!-- Data Rumah Sakit -->
        <h5>Data Rumah Sakit</h5>
        @include('rumah_sakit.index')

    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).ready(function () {
        $('#rumah_sakit_filter').change(function () {
            var rumahSakitId = $(this).val();

            if (rumahSakitId) {
                $.ajax({
                    url: '/pasien/filter/' + rumahSakitId,
                    type: 'GET',
                    success: function(response) {
                        $('#pasien-table-body').html(response.pasiensHtml);
                    },
                    error: function(xhr, status, error) {
                        alert('Gagal memuat data pasien');
                        console.error('Error: ', xhr.responseText);
                    }
                });
            }
        });
    });


    // Load list of Pasien
    function loadPasienList() {
        $.ajax({
            url: '/pasien/data',
            type: 'GET',
            success: function(response) {
                let pasienHtml = '';
                response.pasiens.forEach(function(pasien) {
                    pasienHtml += `
                        <tr id="pasien_${pasien.id}">
                            <td>${pasien.nama}</td>
                            <td>${pasien.alamat}</td>
                            <td>${pasien.no_telepon}</td>
                            <td>${pasien.rumah_sakit.nama}</td>
                            <td>
                                <a href="/pasien/${pasien.id}/edit" class="btn btn-warning btn-sm">Edit</a>
                                <button class="btn btn-danger btn-sm delete-pasien" data-id="${pasien.id}">Hapus</button>
                            </td>
                        </tr>
                    `;
                });
                $('#pasien-table-body').html(pasienHtml);
            },
            error: function(xhr, status, error) {
                alert('Gagal memuat data pasien');
            }
        });
    }

    // Delete Pasien
    $(document).on('click', '.delete-pasien', function() {
        var id = $(this).data('id');
        if (confirm('Apakah Anda yakin ingin menghapus Pasien ini?')) {
            $.ajax({
                url: '/pasien/' + id,
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}',
                },
                success: function(response) {
                    $('#pasien_' + id).remove();
                    alert('Pasien berhasil dihapus');
                },
                error: function(xhr, status, error) {
                    alert('Gagal menghapus Pasien');
                }
            });
        }
    });



    // Load list of Rumah Sakit
    function loadRumahSakitList() {
        $.ajax({
            url: '/rumah_sakit',
            type: 'GET',
            success: function(response) {
                let rumahSakitHtml = '';
                response.rumahSakits.forEach(function(rumahSakit) {
                    rumahSakitHtml += `
                        <tr id="rumah_sakit_${rumahSakit.id}">
                            <td>${rumahSakit.nama}</td>
                            <td>${rumahSakit.alamat}</td>
                            <td>${rumahSakit.email}</td>
                            <td>${rumahSakit.telepon}</td>
                            <td>
                                <a href="/rumah_sakit/${rumahSakit.id}/edit" class="btn btn-warning btn-sm">Edit</a>
                                <button class="btn btn-danger btn-sm delete-rumah-sakit" data-id="${rumahSakit.id}">Hapus</button>
                            </td>
                        </tr>
                    `;
                });
                $('#rumah-sakit-table-body').html(rumahSakitHtml);
            },
            error: function(xhr, status, error) {
                alert('Gagal memuat data Rumah Sakit');
            }
        });
    }

    // Delete Rumah Sakit
    $(document).on('click', '.delete-rumah-sakit', function() {
        var id = $(this).data('id');
        if (confirm('Apakah Anda yakin ingin menghapus Rumah Sakit ini?')) {
            $.ajax({
                url: '/rumah_sakit/' + id, 
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}',
                },
                success: function(response) {
                    $('#rumah_sakit_' + id).remove();
                    alert('Rumah Sakit berhasil dihapus');
                },
                error: function(xhr, status, error) {
                    alert('Gagal menghapus Rumah Sakit');
                }
            });
        }
    });
    </script>

</body>
</html>
