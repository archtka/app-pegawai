@extends('master')

@section('title', 'Daftar Gaji')
@section('page-title', 'Data Gaji Karyawan')

@section('content')

    {{-- Tabel data --}}
    <table class="data-table">
        <thead>
            <tr>
                <th>Nama Karyawan</th>
                <th>Bulan</th>
                <th>Gaji Pokok</th>
                <th>Tunjangan</th>
                <th>Potongan</th>
                <th>Total Gaji</th>
                <th style="text-align: right;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($salaries as $salary)
            <tr>
                {{-- Gunakan '??' untuk menangani jika karyawan sudah dihapus --}}
                <td>{{ $salary->employee->nama_lengkap ?? 'Karyawan N/A' }}</td>
                <td>{{ $salary->bulan }}</td>
                {{-- Format angka menjadi Rupiah (tanpa koma) --}}
                <td>Rp {{ number_format($salary->gaji_pokok, 0, ',', '.') }}</td>
                <td>Rp {{ number_format($salary->tunjangan, 0, ',', '.') }}</td>
                <td>Rp {{ number_format($salary->potongan, 0, ',', '.') }}</td>
                <td style="font-weight: 600;">Rp {{ number_format($salary->total_gaji, 0, ',', '.') }}</td>
                
                <td class="actions"> 
                    <a href="{{ route('salaries.show', $salary->id) }}" class="action-link">Detail</a>
                    <a href="{{ route('salaries.edit', $salary->id) }}" class="action-link">Edit</a>
                    
                    <form action="{{ route('salaries.destroy', $salary->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="delete-button" onclick="return confirm('Yakin ingin menghapus data gaji ini?')">
                            Delete
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            {{-- Tampilkan ini jika tabel gajinya kosong --}}
            <tr>
                <td colspan="7" style="text-align: center; padding: 1.5rem;">
                    Belum ada data gaji yang tercatat.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    {{-- Tombol "Tambah" di kanan bawah --}}
    <div class="table-footer">
        <a href="{{ route('salaries.create') }}" class="btn btn-primary">
            + Tambah Data Gaji
        </a>
    </div>
    
@endsection