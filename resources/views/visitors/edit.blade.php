@extends('app')

@section('konten')
    <h4 class="main-title">Edit Pengunjung</h4>

    <form action="{{ route('visitors.update', $visitor->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label class="main_label">Nama</label>
        <input type="text" value="{{ $visitor->name }}" name="name" class="form-control mb-3" required>

        <label class="main_label">Usia</label>
        <input type="number" value="{{ $visitor->age }}" name="age" class="form-control mb-3" required>

        <label class="main_label">Jenis Kelamin</label>
        <select name="gender" class="form-control mb-3" required>
            <option value="Male" {{ $visitor->gender == 'Male' ? 'selected' : '' }}>Laki-Laki</option>
            <option value="Female" {{ $visitor->gender == 'Female' ? 'selected' : '' }}>Perempuan</option>
        </select>

        <label class="main_label">Asal</label>
        <input type="text" value="{{ $visitor->origin }}" name="origin" class="form-control mb-3" required>

        <label class="main_label">Tanggal Kunjungan</label>
        <input type="datetime-local" value="{{ \Carbon\Carbon::parse($visitor->visit_date)->format('Y-m-d\TH:i') }}" name="visit_date" class="form-control mb-3" required>

        <label class="main_label">Catatan</label>
        <textarea name="notes" class="form-control mb-3">{{ $visitor->notes }}</textarea>

        <button class="btn btn-primary">Edit</button>
    </form>
@endsection
