@extends('master')

@section('title', 'Edit Gaji Karyawan')
@section('page-title', 'Form Edit Gaji')

@section('content')
<form action="{{ route('salaries.update', $salary->id) }}" method="POST">
    @csrf
    @method('PUT')
    
    <div class="form-grid">
        
        <div class="form-group">
            <label for="karyawan_id" class="form-label">Karyawan</label>
            <select id="karyawan_id" name="karyawan_id" class="form-control" required>
                <option value="">Pilih Karyawan</option>
                @foreach($employees as $employee)
                    {{-- Menandai karyawan yang sedang diedit gajinya --}}
                    <option value="{{ $employee->id }}" {{ (old('karyawan_id', $salary->karyawan_id) == $employee->id) ? 'selected' : '' }}>
                        {{ $employee->nama_lengkap }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="bulan" class="form-label">Bulan (Contoh: 2025-10)</label>
            <input type="text" id="bulan" name="bulan" class="form-control" value="{{ old('bulan', $salary->bulan) }}" required>
        </div>

        {{-- INI ADALAH BAGIAN PENTING --}}
        
        <div class="form-group">
            <label for="tunjangan" class="form-label">Tunjangan</label>
            <input type="number" id="tunjangan" name="tunjangan" class="form-control" value="{{ old('tunjangan', $salary->tunjangan) }}" required step="0.01" min="0">
        </div>

        <div class="form-group">
            <label for="potongan" class="form-label">Potongan</label>
            <input type="number" id="potongan" name="potongan" class="form-control" value="{{ old('potongan', $salary->potongan) }}" required step="0.01" min="0">
        </div>

        {{-- 
          FIELD UNTUK GAJI POKOK & TOTAL GAJI SUDAH DIHAPUS.
          Controller akan menghitungnya secara otomatis.
        --}}

    </div>

    {{-- Bagian Tombol --}}
    <div class="form-actions">
        <a href="{{ route('salaries.index') }}" class="btn btn-secondary">Batal</a>
        <button type="submit" class="btn btn-primary">Update Gaji</button>
    </div>

</form>
@endsection