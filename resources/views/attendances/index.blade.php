@extends('master')

@section('title', 'Daftar Absensi')
@section('page-title', 'Data Absensi')

@section('content')

    {{-- Tombol Tambah --}}
    <div style="margin-bottom: 1.5rem;">
        <a href="{{ route('attendances.create') }}" class="btn btn-primary">Tambah Absensi</a>
    </div>

    {{-- Tabel Data --}}
    <table class="data-table">
        <thead>
            <tr>
                <th>Nama Karyawan</th>
                <th>Tanggal</th>
                <th>Waktu Masuk</th>
                <th>Waktu Keluar</th>
                <th>Status</th>
                <th style="text-align: right;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($attendances as $att)
            <tr>
                <td>{{ $att->employee->nama_lengkap ?? 'Karyawan Dihapus' }}</td>
                <td>{{ \Carbon\Carbon::parse($att->tanggal)->format('d M Y') }}</td>
                <td>{{ $att->waktu_masuk ? \Carbon\Carbon::parse($att->waktu_masuk)->format('H:i') : '-' }}</td>
                <td>{{ $att->waktu_keluar ? \Carbon\Carbon::parse($att->waktu_keluar)->format('H:i') : '-' }}</td>
                <td style="text-transform: capitalize;">{{ $att->status_absensi }}</td>
                <td class="actions">
                    <a href="{{ route('attendances.show', $att->id) }}" class="action-link">Detail</a>
                    <a href="{{ route('attendances.edit', $att->id) }}" class="action-link">Edit</a>
                    <form action="{{ route('attendances.destroy', $att->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="delete-button" onclick="return confirm('Yakin ingin menghapus data ini?')">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" style="text-align: center;">Tidak ada data absensi.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

@endsection