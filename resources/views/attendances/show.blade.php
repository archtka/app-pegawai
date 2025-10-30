@extends('master')

@section('title', 'Detail Absensi')
@section('page-title', 'Detail Absensi')

@section('content')

    <div class="detail-grid">
        
        <div class="detail-item">
            <span class="detail-label">ID Absensi</span>
            <span class="detail-value">{{ $attendance->id }}</span>
        </div>
        
        <div class="detail-item">
            <span class="detail-label">Nama Karyawan</span>
            <span class="detail-value">{{ $attendance->employee->nama_lengkap ?? 'Karyawan Dihapus' }}</span>
        </div>

        <div class="detail-item">
            <span class="detail-label">Tanggal</span>
            <span class="detail-value">{{ \Carbon\Carbon::parse($attendance->tanggal)->format('d F Y') }}</span>
        </div>

        <div class="detail-item">
            <span class="detail-label">Status Absensi</span>
            <span class="detail-value" style="text-transform: capitalize;">{{ $attendance->status_absensi }}</span>
        </div>

        <div class="detail-item">
            <span class="detail-label">Waktu Masuk</span>
            <span class="detail-value">{{ $attendance->waktu_masuk ? \Carbon\Carbon::parse($attendance->waktu_masuk)->format('H:i:s') : '-' }}</span>
        </div>

        <div class="detail-item">
            <span class="detail-label">Waktu Keluar</span>
            <span class="detail-value">{{ $attendance->waktu_keluar ? \Carbon\Carbon::parse($attendance->waktu_keluar)->format('H:i:s') : '-' }}</span>
        </div>

        <div class="detail-item">
            <span class="detail-label">Dibuat Pada</span>
            <span class="detail-value">{{ $attendance->created_at->format('d M Y, H:i:s') }}</span>
        </div>

        <div class="detail-item">
            <span class="detail-label">Diperbarui Pada</span>
            <span class="detail-value">{{ $attendance->updated_at->format('d M Y, H:i:s') }}</span>
        </div>

    </div>

    {{-- Tombol Aksi --}}
    <div class="form-actions" style="justify-content: flex-start;">
        <a href="{{ route('attendances.index') }}" class="btn btn-secondary">Kembali ke Daftar</a>
    </div>

@endsection