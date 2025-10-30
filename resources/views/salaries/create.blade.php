@extends('master')

@section('title', 'Tambah Gaji')
@section('page-title', 'Form Tambah Gaji')

@section('content')
<form action="{{ route('salaries.store') }}" method="POST">
    @csrf
    
    {{-- Menggunakan layout grid modern, bukan tabel --}}
    <div class="form-grid">
        
        {{-- Dibuat 1 baris penuh agar mudah dipilih --}}
        <div class="form-group form-group-full">
            <label for="karyawan_id" class="form-label">Nama Karyawan</label>
            <select id="karyawan_id" name="karyawan_id" class="form-control" required>
                <option value="">Pilih Karyawan</option>
                @foreach($employees as $employee)
                    <option value="{{ $employee->id }}" {{ old('karyawan_id') == $employee->id ? 'selected' : '' }}>
                        {{ $employee->nama_lengkap }} (Jabatan: {{ $employee->position->nama_jabatan ?? 'N/A' }})
                    </option>
                @endforeach
            </select>
            @error('karyawan_id')
                <div style="color: red; font-size: 0.8rem; margin-top: 0.25rem;">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="bulan" class="form-label">Bulan (Contoh: 2025-10)</label>
            <input type="text" id="bulan" name="bulan" class="form-control" value="{{ old('bulan') }}" required placeholder="YYYY-MM">
        </div>

        <div class="form-group">
            <label for="tunjangan" class="form-label">Tunjangan</label>
            <input type="number" id="tunjangan" name="tunjangan" class="form-control" value="{{ old('tunjangan', 0) }}" required step="1" min="0">
        </div>

        <div class="form-group">
            <label for="potongan" class="form-label">Potongan</label>
            <input type="number" id="potongan" name="potongan" class="form-control" value="{{ old('potongan', 0) }}" required step="1" min="0">
        </div>

        {{-- 
          FIELD UNTUK GAJI POKOK & TOTAL GAJI SUDAH DIHAPUS.
          Controller akan mengambil dan menghitungnya secara otomatis.
          Inilah yang memperbaiki error 'Out of range' kamu.
        --}}

    </div>

    {{-- Bagian Tombol --}}
    <div class="form-actions">
        <a href="{{ route('salaries.index') }}" class="btn btn-secondary">Batal</a>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </div>

</form>
@endsection