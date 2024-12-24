@extends('app')

@section('konten')
<div class="d-flex">
    <div>
        <form action="{{ route('visitors.index') }}" method="GET" class="d-flex">
            <input type="text" name="search" class="form-control me-2" placeholder="Cari pengunjung..." value="{{ request('search') }}">
            <button type="submit" class="btn btn-primary">Cari</button>
        </form>
    </div>
    <div class="ms-auto">
        <a href="{{ route('visitors.create') }}" class="btn btn-success mb-3">Tambah Pengunjung</a>
    </div>
</div>

<div class="users-table table-wrapper">
<table class="posts-table">
    <thead>
        <tr class="users-table-info">
            <th>No</th>
            <th>Nama</th>
            <th>Umur</th>
            <th>Jenis Kelamin</th>
            <th>Asal</th>
            <th>Tanggal Kunjungan</th>
            <th>Notes</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody id="visitor-data">
        @foreach ($visitors as $index => $visitor)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $visitor->name }}</td>
            <td>{{ $visitor->age }}</td>
            <td>{{ $visitor->gender }}</td>
            <td>{{ $visitor->origin }}</td>
            <td>{{ $visitor->visit_date }}</td>
            <td>{{ $visitor->notes }}</td>

            <td>
                <a href="{{ route('visitors.edit', $visitor->id) }}" class="btn btn-warning btn-sm">Edit</a>
                <form action="{{ route('visitors.destroy', $visitor->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
</div>

{{-- search --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        $('#search').on('keyup', function () {
            let query = $(this).val();

            $.ajax({
                url: "{{ route('visitors.search') }}", // Rute untuk pencarian
                type: "GET",
                data: { search: query },
                success: function (data) {
                    $('#visitor-data').html(data);
                },
                error: function (xhr) {
                    console.error("Error during AJAX request:", xhr.responseText);
                }
            });
        });
    });
</script>

{{-- store data statistik --}}
<script>
    document.getElementById('loadVisitors').addEventListener('click', function() {
        fetch('/api/visitors')
            .then(response => response.json())
            .then(data => {
                const tableBody = document.querySelector('#visitorTable tbody');
                tableBody.innerHTML = ''; // Kosongkan tabel sebelum memuat ulang
                data.forEach((visitor, index) => {
                    const row = `
                        <tr>
                            <td>${index + 1}</td>
                            <td>${visitor.name}</td>
                            <td>${visitor.age}</td>
                            <td>${visitor.gender}</td>
                            <td>${visitor.origin}</td>
                            <td>${visitor.visit_date}</td>
                            <td>
                                <button class="btn btn-warning btn-sm" onclick="editVisitor(${visitor.id})">Edit</button>
                                <button class="btn btn-danger btn-sm" onclick="deleteVisitor(${visitor.id})">Hapus</button>
                            </td>
                        </tr>
                    `;
                    tableBody.innerHTML += row;
                });
            })
            .catch(error => console.error('Error:', error));
    });

    function deleteVisitor(id) {
        if (confirm('Yakin ingin menghapus pengunjung ini?')) {
            fetch(`/api/visitors/${id}`, {
                method: 'DELETE',
                headers: { 'Content-Type': 'application/json' }
            })
            .then(response => {
                if (response.ok) {
                    alert('Pengunjung berhasil dihapus');
                    document.getElementById('loadVisitors').click(); // Muat ulang data
                } else {
                    alert('Gagal menghapus pengunjung');
                }
            })
            .catch(error => console.error('Error:', error));
        }
    }

    function editVisitor(id) {
        // Anda bisa redirect ke halaman edit dengan id
        window.location.href = `/visitors/${id}/edit`;
    }
</script>
@endsection
