@extends('app')

@section('konten')

<div class="users-table table-wrapper">
<table class="posts-table">
    <thead>
        <tr class="users-table-info">
            <th>No</th>
            <th>Tanggal Kunjungan</th>
            <th>Jumlah Pengunjung</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($visitorStat as $index => $visitor)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $visitor->date }}</td>
            <td>{{ $visitor->visitor_count }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
</div>

@endsection