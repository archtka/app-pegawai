@extends('master')

@section('title', 'Detail Departemen')
@section('page-title', 'Detail Departemen')

@section('content')

    {{-- Menggunakan layout grid modern, bukan tabel --}}
    <div class="detail-grid">

        <div class="detail-item">
            <span class="detail-label">ID Departemen</span>
            <span class="detail-value">{{ $department->id }}</span>
        </div>

        <div class="detail-item">
            <span class="detail-label">Nama Departemen</span>
            <span class="detail-value">{{ $department->nama_departemen }}</span>
        </div>

        <div class="detail-item">
            <span class="detail-label">Dibuat Pada</span>
            <span class="detail-value">{{ $department->created_at->format('d F Y H:i:s') }}</span>
        </div>

        <div class="detail-item">
            <span class="detail-label">Diperbarui Pada</span>
            <span class="detail-value">{{ $department->updated_at->format('d F Y H:i:s') }}</span>
        </div>

    </div>

    {{-- Bagian Tombol --}}
    <div class="form-actions">
        <a href="{{ route('departments.index') }}" class="btn btn-secondary">Kembali</a>
        <a href="{{ route('departments.edit', $department->id) }}" class="btn btn-primary">Edit</a>
    </div>

@endsection