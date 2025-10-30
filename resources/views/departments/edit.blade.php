@extends('master')

@section('title', 'Edit Departemen')
@section('page-title', 'Form Edit Departemen')

@section('content')
<form action="{{ route('departments.update', $department->id) }}" method="POST">
    @csrf
    @method('PUT')
    
    <div class="form-grid">
        <div class="form-group form-group-full">
            <label for="nama_departemen" class="form-label">Nama Departemen</label>
            <input type="text" id="nama_departemen" name="nama_departemen" class="form-control" 
                   value="{{ old('nama_departemen', $department->nama_departemen) }}" required>
        </div>
    </div>

    {{-- Bagian Tombol --}}
    <div class="form-actions">
        <a href="{{ route('departments.index') }}" class="btn btn-secondary">Batal</a>
        <button type="submit" class="btn btn-primary">Update</button>
    </div>

</form>
@endsection