@extends('master')

@section('title', 'Tambah Jabatan')
@section('page-title', 'Form Tambah Jabatan')

@section('content')
<form action="{{ route('positions.store') }}" method="POST">
    @csrf
    
    <div class="form-grid">
        
        <div class="form-group">
            <label for="nama_jabatan" class="form-label">Nama Jabatan</label>
            <input type="text" id="nama_jabatan" name="nama_jabatan" class="form-control" value="{{ old('nama_jabatan') }}" required>
        </div>

        <div class="form-group">
            <label for="gaji_pokok" class="form-label">Gaji Pokok</label>
            <input type="number" id="gaji_pokok" name="gaji_pokok" class="form-control" value="{{ old('gaji_pokok') }}" required step="0.01" min="0">
        </div>

    </div>

    {{-- Bagian Tombol --}}
    <div class="form-actions">
        <a href="{{ route('positions.index') }}" class="btn btn-secondary">Batal</a>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </div>

</form>
@endsection