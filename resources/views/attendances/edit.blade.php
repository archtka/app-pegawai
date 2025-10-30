@extends('master')

@section('title', 'Edit Absensi')
@section('page-title', 'Form Edit Absensi')

@section('content')

<form action="{{ route('attendances.update', $attendance->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="form-grid">
        
        {{-- Nama Karyawan --}}
        <div class="form-group">
            <label for="karyawan_id" class="form-label">Nama Karyawan</label>
            <select id="karyawan_id" name="karyawan_id" class="form-control" required>
                <option value="">Pilih Karyawan</option>
                @foreach($employees as $employee)
                    <option value="{{ $employee->id }}" {{ old('karyawan_id', $attendance->karyawan_id) == $employee->id ? 'selected' : '' }}>
                        {{ $employee->nama_lengkap }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Tanggal --}}
        <div class="form-group">
            <label for="tanggal" class="form-label">Tanggal</label>
            <input type="date" id="tanggal" name="tanggal" class="form-control" value="{{ old('tanggal', $attendance->tanggal) }}" required>
        </div>

        {{-- Waktu Masuk --}}
        <div class="form-group">
            <label for="waktu_masuk" class="form-label">Waktu Masuk</label>
            <input type="time" id="waktu_masuk" name="waktu_masuk" class="form-control" value="{{ old('waktu_masuk', $attendance->waktu_masuk) }}">
        </div>

        {{-- Waktu Keluar --}}
        <div class="form-group">
            <label for="waktu_keluar" class="form-label">Waktu Keluar</label>
            <input type="time" id="waktu_keluar" name="waktu_keluar" class="form-control" value="{{ old('waktu_keluar', $attendance->waktu_keluar) }}">
        </div>

        {{-- Status Absensi --}}
        <div class="form-group form-group-full">
            <label for="status_absensi" class="form-label">Status Absensi</label>
            <select id="status_absensi" name="status_absensi" class="form-control" required>
                <option value="hadir" {{ old('status_absensi', $attendance->status_absensi) == 'hadir' ? 'selected' : '' }}>Hadir</option>
                <option value="izin" {{ old('status_absensi', $attendance->status_absensi) == 'izin' ? 'selected' : '' }}>Izin</option>
                <option value="sakit" {{ old('status_absensi', $attendance->status_absensi) == 'sakit' ? 'selected' : '' }}>Sakit</option>
                <option value="alpha" {{ old('status_absensi', $attendance->status_absensi) == 'alpha' ? 'selected' : '' }}>Alpha</option>
            </select>
        </div>

    </div>

    {{-- Tombol Aksi --}}
    <div class="form-actions">
        <a href="{{ route('attendances.index') }}" class="btn btn-secondary">Kembali</a>
        <button type="submit" class="btn btn-primary">Update</button>
    </div>

</form>

@endsection