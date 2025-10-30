<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Department;
use App\Models\Position;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule; // Import 'Rule' untuk validasi email yang canggih

class EmployeeController extends Controller
{
    /**
     * Menampilkan semua data pegawai (dengan pagination)
     */
    public function index()
    {
        // Ambil data terbaru, 5 per halaman
        $employees = Employee::latest()->paginate(5); 
        return view('employees.index', compact('employees'));
    }

    /**
     * Menampilkan form untuk menambah data baru
     */
    public function create()
    {
        // Ambil data departemen & jabatan untuk dropdown
        $departments = Department::all();
        $positions = Position::all();
        return view('employees.create', compact('departments', 'positions'));
    }

    /**
     * Menyimpan data baru ke database
     */
    public function store(Request $request)
    {
        // Validasi data yang masuk
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:employees', // Pastikan email unik
            'nomor_telepon' => 'nullable|string|max:20', // Dibuat opsional (nullable)
            'tanggal_lahir' => 'nullable|date', // Dibuat opsional
            'alamat' => 'nullable|string', // Dibuat opsional
            'tanggal_masuk' => 'required|date',
            'status' => 'required|in:aktif,nonaktif',
            'departemen_id' => 'required|exists:departments,id', // Pastikan departemen ada
            'jabatan_id' => 'required|exists:positions,id', // Pastikan jabatan ada
        ]);

        // Buat data baru
        Employee::create($request->all());

        // Redirect kembali ke halaman index
        return redirect()->route('employees.index');
    }

    /**
     * Menampilkan detail satu data pegawai
     */
    public function show(string $id)
    {
        // Ambil 1 data pegawai, DAN data relasinya (department & position)
        // 'with()' digunakan untuk Eager Loading, ini lebih efisien
        $employee = Employee::with(['department', 'position'])->findOrFail($id);
        
        return view('employees.show', compact('employee'));
    }

    /**
     * Menampilkan form untuk mengedit data
     */
    public function edit(string $id)
    {
        // ---- INI ADALAH PERBAIKAN UNTUK ERROR KAMU ----
        
        // 1. Ambil data pegawai yang akan diedit
        $employee = Employee::findOrFail($id);
        
        // 2. Ambil SEMUA data departemen & jabatan untuk dropdown
        $departments = Department::all();
        $positions = Position::all();

        // 3. Kirimkan SEMUA data ke view
        return view('employees.edit', compact('employee', 'departments', 'positions'));
    }

    /**
     * Memperbarui data di database
     */
    public function update(Request $request, string $id)
    {
        // 1. Ambil data pegawai yang ada
        $employee = Employee::findOrFail($id);

        // 2. Validasi data
        $request->validate([
            'nama_lengkap'  => 'required|string|max:255',
            // Gunakan Rule::unique untuk mengabaikan email milik pegawai ini sendiri
            'email'         => ['required', 'email', 'max:255', Rule::unique('employees')->ignore($employee->id)],
            'nomor_telepon' => 'nullable|string|max:20',
            'tanggal_lahir' => 'nullable|date',
            'alamat'        => 'nullable|string',
            'tanggal_masuk' => 'required|date',
            'status'        => 'required|in:aktif,nonaktif',
            'departemen_id' => 'required|exists:departments,id', // Tambahkan ini
            'jabatan_id'    => 'required|exists:positions,id', // Tambahkan ini
        ]);

        // 3. Update data pegawai
        $employee->update($request->all());

        // 4. Redirect kembali ke halaman index
        return redirect()->route('employees.index');
    }

    /**
     * Menghapus data dari database
     */
    public function destroy(string $id)
    {
        // Cari data atau gagal (error 404)
        $employee = Employee::findOrFail($id);
        $employee->delete();
        
        return redirect()->route('employees.index');
    }
}
