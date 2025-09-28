<?php

namespace App\Http\Controllers;
use App\Models\Employee; 


use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees = Employee::latest()->paginate(5); // Ambil 5 data terbaru per halaman
        return view('employees.index', compact('employees')); // Kirim ke view employees.index
    }

    /**
     * Show the form for creating a new resource.
     */
    // Menampilkan form untuk menambah data baru
    public function create()
    {
        return view('employees.create');
    }

    // Menyimpan data baru
    public function store(Request $request)
    {
        // 1. Validasi Data
        $request->validate([
            'nama_lengkap'  => 'required|string|max:255',
            'email'         => 'required|email|max:255',
            'nomor_telepon' => 'required|string|max:20',
            'tanggal_lahir' => 'required|date',
            'alamat'        => 'required|string|max:255',
            'tanggal_masuk' => 'required|date',
            'status'        => 'required|string|max:50',
        ]);

        // 2. Simpan Data ke Database menggunakan Eloquent
        Employee::create($request->all());

        // 3. Redirect kembali ke halaman index
        return redirect()->route('employees.index');
    }

    // Menampilkan detail data pegawai
    public function show(string $id)
    {
        $employee = Employee::find($id);
        return view('employees.show', compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    // Menampilkan form edit data pegawai
    public function edit(string $id)
    {
        $employee = Employee::find($id);
        return view('employees.edit', compact('employee'));
    }

    // Memperbarui data pegawai
    public function update(Request $request, string $id)
    {
        // 1. Validasi Data
        $request->validate([
            'nama_lengkap'  => 'required|string|max:255',
            'email'         => 'required|email|max:255',
            'nomor_telepon' => 'required|string|max:20',
            'tanggal_lahir' => 'required|date',
            'alamat'        => 'required|string|max:255',
            'tanggal_masuk' => 'required|date',
            'status'        => 'required|string|max:50',
        ]);

        // 2. Cari data dan Update
        $employee = Employee::findOrFail($id);
        $employee->update($request->only([
            'nama_lengkap',
            'email',
            'nomor_telepon',
            'tanggal_lahir',
            'alamat',
            'tanggal_masuk',
            'status',
        ]));

        // 3. Redirect kembali ke halaman index
        return redirect()->route('employees.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    // Menghapus data pegawai
    public function destroy(string $id)
    {
        $employee = Employee::find($id);
        $employee->delete();
        return redirect()->route('employees.index');
    }
}

