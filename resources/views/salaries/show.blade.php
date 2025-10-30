@extends('master')

@section('title', 'Detail Gaji')
@section('page-title', 'Detail Gaji Karyawan')

@section('content')

    {{-- Menggunakan layout grid modern, bukan tabel --}}
    <div class="detail-grid">

        <div class="detail-item">
            <span class="detail-label">Nama Karyawan</span>
            <span class="detail-value">{{ $salary->employee->nama_lengkap ?? 'Karyawan N/A' }}</span>
        </div>

        <div class="detail-item">
            <span class="detail-label">Jabatan (saat gajian)</span>
            <span class="detail-value">{{ $salary->employee->position->nama_jabatan ?? 'N/A' }}</span>
        </div>

        <div class="detail-item">
            <span class="detail-label">Bulan</span>
            <span class="detail-value">{{ $salary->bulan }}</span>
        </div>

        <div class="detail-item">
            <span class="detail-label">Status (saat gajian)</span>
            <span class="detail-value" style="text-transform: capitalize;">{{ $salary->employee->status ?? 'N/A' }}</span>
        </div>

        <div class="detail-item">
            <span class="detail-label">Gaji Pokok</span>
            <span class="detail-value">Rp {{ number_format($salary->gaji_pokok, 0, ',', '.') }}</span>
        </div>

        <div class="detail-item">
            <span class="detail-label">Tunjangan</span>
            <span class="detail-value">Rp {{ number_format($salary->tunjangan, 0, ',', '.') }}</span>
        </div>

        <div class="detail-item">
            <span class="detail-label">Potongan</span>
            <span class="detail-value">Rp {{ number_format($salary->potongan, 0, ',', '.') }}</span>
        </div>

        <div class="detail-item">
            <span class="detail-label">Total Gaji Diterima</span>
            <span class="detail-value" style="font-weight: 600; font-size: 1.1rem; color: #0C2B4E;">
                Rp {{ number_format($salary->total_gaji, 0, ',', '.') }}
            </span>
        </div>

    </div>

    {{-- Bagian Tombol --}}
    <div class="form-actions">
        <a href="{{ route('salaries.index') }}" class="btn btn-secondary">Kembali</a>
        <a href="{{ route('salaries.edit', $salary->id) }}" class="btn btn-primary">Edit Data Ini</a>
    </div>

@endsection