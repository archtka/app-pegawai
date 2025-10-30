@extends('master')

@section('title', 'Detail Jabatan')
@section('page-title', 'Detail Jabatan')

@section('content')

    <div class="detail-grid">

        <div class="detail-item">
            <span class="detail-label">ID Jabatan</span>
            <span class="detail-value">{{ $position->id }}</span>
        </div>

        <div class="detail-item">
            <span class="detail-label">Nama Jabatan</span>
            <span class="detail-value">{{ $position->nama_jabatan }}</span>
        </div>

        <div class="detail-item">
            <span class="detail-label">Gaji Pokok</span>
            <span class="detail-value">Rp {{ number_format($position->gaji_pokok, 2, ',', '.') }}</span>
        </div>

        <div class="detail-item">
            <span class="detail-label">Dibuat Pada</span>
            <span class="detail-value">{{ $position->created_at->format('d F Y H:i:s') }}</span>
        </div>

        <div class="detail-item" style="grid-column: 1 / -1;">
            <span class="detail-label">Diperbarui Pada</span>
            <span class="detail-value">{{ $position->updated_at->format('d F Y H:i:s') }}</span>
        </div>

    </div>

    {{-- Bagian Tombol --}}
    <div class="form-actions">
        <a href="{{ route('positions.index') }}" class="btn btn-secondary">Kembali</a>
        <a href="{{ route('positions.edit', $position->id) }}" class="btn btn-primary">Edit</a>
    </div>

@endsection