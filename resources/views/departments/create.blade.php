@extends('master')

@section('title', 'Tambah Departemen')
@section('page-title', 'Form Tambah Departemen')

@section('content')
<form action="{{ route('departments.store') }}" method="POST">
    @csrf
    
    {{-- Karena hanya 1 field, kita pakai 'form-group-full' --}}
    <div class="form-grid">
        <div class="form-group form-group-full">
            <label for="nama_departemen" class="form-label">Nama Departemen</label>
            <input type="text" id="nama_departemen" name="nama_departemen" class="form-control" value="{{ old('nama_departemen') }}" required>
        </div>
    </div>

    {{-- Bagian Tombol --}}
    <div class="form-actions">
        <a href="{{ route('departments.index') }}" class="btn btn-secondary">Batal</a>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </div>

</form>
@endsection