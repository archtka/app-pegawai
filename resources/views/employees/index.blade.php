@extends('master')

@section('title', 'Daftar Pegawai')

@section('page-title', 'Daftar Pegawai')

@section('content')

    <table class="data-table">
        <thead>
            <tr>
                <th>Nama Lengkap</th>
                <th>Email</th>
                <th>Nomor Telepon</th>
                <th>Tanggal Masuk</th>
                <th>Status</th>
                <th style="text-align: right;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($employees as $employee)
            <tr>
                <td>{{ $employee->nama_lengkap }}</td>
                <td>{{ $employee->email }}</td>
                <td>{{ $employee->nomor_telepon }}</td>
                <td>{{ $employee->tanggal_masuk }}</td>
                <td>{{ $employee->status }}</td>
                <td class="actions"> 
                    <a href="{{ route('employees.show', $employee->id) }}" class="action-link">Detail</a>
                    <a href="{{ route('employees.edit', $employee->id) }}" class="action-link">Edit</a>
                    
                    <form action="{{ route('employees.destroy', $employee->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="delete-button" onclick="return confirm('Yakin ingin menghapus?')">
                            Delete
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="table-footer">
        <a href="{{ route('employees.create') }}" class="btn btn-primary">
            + Tambah Pegawai
        </a>
    </div>
    
@endsection