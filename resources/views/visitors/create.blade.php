@extends('app')

@section('konten')
    <h4 class="main-title">Tambah Pengunjung</h4>
    
    <form action="{{ route('visitors.store') }}" method="POST">
        @csrf
        
        <label class="main_label">Nama</label>
        <input type="text" name="name" class="form-control mb-3" required>

        <label class="main_label">Usia</label>
        <input type="number" name="age" class="form-control mb-3" required>

        <label class="main_label">Jenis Kelamin</label>
        <select name="gender" class="form-control mb-3" required>
            <option value="Male">Laki-Laki</option>
            <option value="Female">Perempuan</option>
        </select>

        <label class="main_label">Asal</label>
        <input type="text" name="origin" class="form-control mb-3" required>

        <label class="main_label">Tanggal Kunjungan</label>
        <input type="datetime-local" name="visit_date" class="form-control mb-3" required>

        <label class="main_label">Catatan (opsional)</label>
        <textarea name="notes" class="form-control mb-3"></textarea>

        <button class="btn btn-primary fw-bold">Submit</button>
    </form>
@endsection
