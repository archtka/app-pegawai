@extends('master')

@section('title', 'Daftar Jabatan')
@section('page-title', 'Data Jabatan')

@section('content')

    {{-- Tabel data --}}
    <table class="data-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Jabatan</th>
                <th>Gaji Pokok</th>
                <th style="text-align: right;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($positions as $pos)
            <tr>
                <td>{{ $pos->id }}</td>
                <td>{{ $pos->nama_jabatan }}</td>
                <td>Rp {{ number_format($pos->gaji_pokok, 2, ',', '.') }}</td>
                
                <td class="actions"> 
                    <a href="{{ route('positions.show', $pos->id) }}" class="action-link">Detail</a>
                    <a href="{{ route('positions.edit', $pos->id) }}" class="action-link">Edit</a>
                    
                    <form action="{{ route('positions.destroy', $pos->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="delete-button" onclick="return confirm('Yakin ingin menghapus? Menghapus jabatan akan mempengaruhi data gaji karyawan.')">
                            Delete
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" style="text-align: center; padding: 1.5rem;">
                    Belum ada data jabatan.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    {{-- Tombol "Tambah" di kanan bawah --}}
    <div class="table-footer">
        <a href="{{ route('positions.create') }}" class="btn btn-primary">
            + Tambah Jabatan
        </a>
    </div>
    
@endsection