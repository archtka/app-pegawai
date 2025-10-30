<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    /**
     * Menampilkan semua data departemen
     */
    public function index()
    {
        // --- PERBAIKAN DI SINI ---
        // Mengurutkan berdasarkan ID dari kecil ke besar (1, 2, 3)
        $departments = Department::orderBy('id', 'asc')->paginate(10);
        
        return view('departments.index', compact('departments'));
    }

    /**
     * Menampilkan form untuk menambah data baru
     */
    public function create()
    {
        return view('departments.create');
    }

    /**
     * Menyimpan data baru ke database
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_departemen' => 'required|string|max:255|unique:departments',
        ]);

        Department::create($request->all());

        return redirect()->route('departments.index');
    }

    /**
     * Menampilkan detail satu data departemen
     */
    public function show(Department $department)
    {
        // $department sudah otomatis diambil oleh Laravel (Route Model Binding)
        return view('departments.show', compact('department'));
    }

    /**
     * Menampilkan form untuk mengedit data
     */
    public function edit(Department $department)
    {
        return view('departments.edit', compact('department'));
    }

    /**
     * Memperbarui data di database
     */
    public function update(Request $request, Department $department)
    {
        $request->validate([
            'nama_departemen' => 'required|string|max:255|unique:departments,nama_departemen,' . $department->id,
        ]);

        $department->update($request->all());

        return redirect()->route('departments.index');
    }

    /**
     * Menghapus data dari database
     */
    public function destroy(Department $department)
    {
        $department->delete();
        return redirect()->route('departments.index');
    }
}