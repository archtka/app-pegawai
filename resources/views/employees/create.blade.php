@extends('master')

@section('title', 'Tambah Pegawai')
@section('page-title', 'Form Tambah Pegawai')

@section('content')
<form action="{{ route('employees.store') }}" method="POST">
    @csrf
    
    {{-- Kita gunakan CSS Grid, bukan tabel --}}
    <div class="form-grid">
        
        <div class="form-group">
            <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
            <input type="text" id="nama_lengkap" name="nama_lengkap" class="form-control" value="{{ old('nama_lengkap') }}" required>
        </div>

        <div class="form-group">
            <label for="email" class="form-label">Email</label>
            <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}" required>
        </div>

        <div class="form-group">
            <label for="nomor_telepon" class="form-label">Nomor Telepon</label>
            <input type="text" id="nomor_telepon" name="nomor_telepon" class="form-control" value="{{ old('nomor_telepon') }}">
        </div>

        <div class="form-group">
            <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
            <input type="date" id="tanggal_lahir" name="tanggal_lahir" class="form-control" value="{{ old('tanggal_lahir') }}">
        </div>

        <div class="form-group">
            <label for="tanggal_masuk" class="form-label">Tanggal Masuk</label>
            <input type="date" id="tanggal_masuk" name="tanggal_masuk" class="form-control" value="{{ old('tanggal_masuk') }}" required>
        </div>

        <div class="form-group">
            <label for="status" class="form-label">Status</label>
            <select id="status" name="status" class="form-control">
                <option value="aktif" {{ old('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                <option value="nonaktif" {{ old('status') == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
            </select>
        </div>

        <div class="form-group">
            <label for="departemen_id" class="form-label">Departemen</label>
            <select id="departemen_id" name="departemen_id" class="form-control" required>
                <option value="">Pilih Departemen</option>
                @foreach($departments as $dept)
                    <option value="{{ $dept->id }}" {{ old('departemen_id') == $dept->id ? 'selected' : '' }}>
                        {{ $dept->nama_departemen }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="jabatan_id" class="form-label">Jabatan</label>
            <select id="jabatan_id" name="jabatan_id" class="form-control" required>
                <option value="">Pilih Jabatan</option>
                @foreach($positions as $pos)
                    <option value="{{ $pos->id }}" {{ old('jabatan_id') == $pos->id ? 'selected' : '' }}>
                        {{ $pos->nama_jabatan }}
                    </option>
                @endforeach
            </select>
        </div>
        
        <div class="form-group form-group-full">
            <label for="alamat" class="form-label">Alamat</label>
            <textarea id="alamat" name="alamat" class="form-control" rows="3">{{ old('alamat') }}</textarea>
        </div>

    </div>

    {{-- Bagian Tombol --}}
    <div class="form-actions">
        <a href="{{ route('employees.index') }}" class="btn btn-secondary">Batal</a>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </div>

</form>
@endsection