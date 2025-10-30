@extends('master')

@section('title', 'Detail Pegawai')
@section('page-title', 'Detail Pegawai: ' . $employee->nama_lengkap)

@section('content')

    {{-- Layout baru untuk menampilkan detail --}}
    <div class="detail-grid">

        <div class="detail-item">
            <span class="detail-label">Nama Lengkap</span>
            <span class="detail-value">{{ $employee->nama_lengkap }}</span>
        </div>

        <div class="detail-item">
            <span class="detail-label">Email</span>
            <span class="detail-value">{{ $employee->email }}</span>
        </div>

        <div class="detail-item">
            <span class="detail-label">Nomor Telepon</span>
            <span class="detail-value">{{ $employee->nomor_telepon ?? '-' }}</span>
        </div>

        <div class="detail-item">
            <span class="detail-label">Tanggal Lahir</span>
            <span class="detail-value">{{ $employee->tanggal_lahir ? \Carbon\Carbon::parse($employee->tanggal_lahir)->format('d F Y') : '-' }}</span>
        </div>
        
        <div class="detail-item">
            <span class="detail-label">Tanggal Masuk</span>
            <span class="detail-value">{{ $employee->tanggal_masuk ? \Carbon\Carbon::parse($employee->tanggal_masuk)->format('d F Y') : '-' }}</span>
        </div>

        <div class="detail-item">
            <span class="detail-label">Status</span>
            <span class="detail-value" style="text-transform: capitalize;">{{ $employee->status }}</span>
        </div>

        <div class="detail-item">
            <span class="detail-label">Departemen</span>
            {{-- Pastikan relasi 'department' ada di model Employee --}}
            <span class="detail-value">{{ $employee->department->nama_departemen ?? 'N/A' }}</span>
        </div>

        <div class="detail-item">
            <span class="detail-label">Jabatan</span>
            {{-- Pastikan relasi 'position' ada di model Employee --}}
            <span class="detail-value">{{ $employee->position->nama_jabatan ?? 'N/A' }}</span>
        </div>

        <div class="detail-item" style="grid-column: 1 / -1;">
            <span class="detail-label">Alamat</span>
            <span class="detail-value">{{ $employee->alamat ?? '-' }}</span>
        </div>

    </div>

    {{-- Bagian Tombol --}}
    <div class="form-actions">
        <a href="{{ route('employees.index') }}" class="btn btn-secondary">Kembali</a>
        <a href="{{ route('employees.edit', $employee->id) }}" class="btn btn-primary">Edit Data</a>
    </div>

@endsection