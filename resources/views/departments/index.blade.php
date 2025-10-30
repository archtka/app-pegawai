@extends('master')

@section('title', 'Daftar Departemen')
@section('page-title', 'Data Departemen')

@section('content')

    {{-- Tabel data --}}
    <table class="data-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Departemen</th>
                <th style="text-align: right;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($departments as $dept)
            <tr>
                <td>{{ $dept->id }}</td>
                <td>{{ $dept->nama_departemen }}</td>
                
                <td class="actions"> 
                    
                    {{-- --- PERBAIKAN DI SINI --- --}}
                    {{-- Link "Detail" yang hilang sudah ditambahkan kembali --}}
                    <a href="{{ route('departments.show', $dept->id) }}" class="action-link">Detail</a>

                    <a href="{{ route('departments.edit', $dept->id) }}" class="action-link">Edit</a>
                    
                    <form action="{{ route('departments.destroy', $dept->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="delete-button" onclick="return confirm('Yakin ingin menghapus? Menghapus departemen akan menghapus semua karyawan terkait.')">
                            Delete
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="3" style="text-align: center; padding: 1.5rem;">
                    Belum ada data departemen.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    {{-- Tombol "Tambah" di kanan bawah --}}
    <div class="table-footer">
        <a href="{{ route('departments.create') }}" class="btn btn-primary">
            + Tambah Departemen
        </a>
    </div>
    
@endsection