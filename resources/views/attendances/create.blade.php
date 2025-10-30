@extends('master')

@section('title', 'Tambah Absensi')
@section('page-title', 'Form Tambah Absensi')

@section('content')

<form action="{{ route('attendances.store') }}" method="POST">
    @csrf

    @if ($errors->any())
        <div style="background-color: #f8d7da; border: 1px solid #f5c6cb; color: #721c24; padding: 1rem; border-radius: 8px; margin-bottom: 1.5rem;">
            <strong>Terjadi kesalahan saat menyimpan data:</strong>
            <ul style="margin-left: 1.5rem; margin-top: 0.5rem; margin-bottom: 0;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

 

    <div class="form-grid">
        
        {{-- Nama Karyawan --}}
        <div class="form-group">
            <label for="karyawan_id" class="form-label">Nama Karyawan</label>
            <select id="karyawan_id" name="karyawan_id" class="form-control" required>
                <option value="">Pilih Karyawan</option>
                @foreach($employees as $employee)
                    <option value="{{ $employee->id }}" {{ old('karyawan_id') == $employee->id ? 'selected' : '' }}>
                        {{ $employee->nama_lengkap }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Tanggal --}}
        <div class="form-group">
            <label for="tanggal" class="form-label">Tanggal</label>
            <input type="date" id="tanggal" name="tanggal" class="form-control" value="{{ old('tanggal') }}" required>
        </div>

        {{-- Waktu Masuk --}}
        <div class="form-group">
            <label for="waktu_masuk" class="form-label">Waktu Masuk</label>
            <input type="time" id="waktu_masuk" name="waktu_masuk" class="form-control" value="{{ old('waktu_masuk') }}">
        </div>

        {{-- Waktu Keluar --}}
        <div class="form-group">
            <label for="waktu_keluar" class="form-label">Waktu Keluar</label>
            <input type="time" id="waktu_keluar" name="waktu_keluar" class="form-control" value="{{ old('waktu_keluar') }}">
        </div>

        {{-- Status Absensi --}}
        <div class="form-group form-group-full">
            <label for="status_absensi" class="form-label">Status Absensi</label>
            <select id="status_absensi" name="status_absensi" class="form-control" required>
                <option value="hadir" {{ old('status_absensi') == 'hadir' ? 'selected' : '' }}>Hadir</option>
                <option value="izin" {{ old('status_absensi') == 'izin' ? 'selected' : '' }}>Izin</option>
                <option value="sakit" {{ old('status_absensi') == 'sakit' ? 'selected' : '' }}>Sakit</option>
                <option value="alpha" {{ old('status_absensi') == 'alpha' ? 'selected' : '' }}>Alpha</option>
            </select>
        </div>

    </div>

    {{-- Tombol Aksi --}}
    <div class="form-actions">
        <a href="{{ route('attendances.index') }}" class="btn btn-secondary">Kembali</a>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </div>

</form>

@endsection