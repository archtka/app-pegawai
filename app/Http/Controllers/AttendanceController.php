<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Employee;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    /**
     * Menampilkan daftar absensi.
     */
    public function index()
    {
        $attendances = Attendance::with('employee')->latest()->paginate(10);
        return view('attendances.index', compact('attendances'));
    }

    /**
     * Menampilkan form untuk membuat absensi baru.
     */
    public function create()
    {
        $employees = Employee::all();
        return view('attendances.create', compact('employees'));
    }

    /**
     * Menyimpan absensi baru ke database.
     */
    public function store(Request $request)
    {
        // <-- PERBAIKAN DI SINI
        // Mengubah string kosong "" menjadi null agar lolos validasi 'nullable'
        if (empty($request->waktu_masuk)) {
            $request->merge(['waktu_masuk' => null]);
        }
        if (empty($request->waktu_keluar)) {
            $request->merge(['waktu_keluar' => null]);
        }
        // <-- BATAS PERBAIKAN

        $request->validate([
            'karyawan_id' => 'required|exists:employees,id',
            'tanggal' => 'required|date',
            'waktu_masuk' => 'nullable|date_format:H:i',
            'waktu_keluar' => 'nullable|date_format:H:i|after_or_equal:waktu_masuk',
            'status_absensi' => 'required|in:hadir,izin,sakit,alpha',
        ]);

        Attendance::create($request->all());

        // Ditambahkan pesan sukses
        return redirect()->route('attendances.index')
            ->with('success', 'Data absensi berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail satu absensi.
     */
    public function show(Attendance $attendance)
    {
        $attendance->load('employee');
        return view('attendances.show', compact('attendance'));
    }

    /**
     * Menampilkan form untuk mengedit absensi.
     */
    public function edit(Attendance $attendance)
    {
        $employees = Employee::all();
        return view('attendances.edit', compact('attendance', 'employees'));
    }

    /**
     * Mengupdate absensi di database.
     */
    public function update(Request $request, Attendance $attendance)
    {
        // <-- PERBAIKAN DI SINI
        // Mengubah string kosong "" menjadi null agar lolos validasi 'nullable'
        if (empty($request->waktu_masuk)) {
            $request->merge(['waktu_masuk' => null]);
        }
        if (empty($request->waktu_keluar)) {
            $request->merge(['waktu_keluar' => null]);
        }
        // <-- BATAS PERBAIKAN

        $request->validate([
            'karyawan_id' => 'required|exists:employees,id',
            'tanggal' => 'required|date',
            'waktu_masuk' => 'nullable|date_format:H:i',
            'waktu_keluar' => 'nullable|date_format:H:i|after_or_equal:waktu_masuk',
            'status_absensi' => 'required|in:hadir,izin,sakit,alpha',
        ]);

        $attendance->update($request->all());

        // Ditambahkan pesan sukses
        return redirect()->route('attendances.index')
            ->with('success', 'Data absensi berhasil diperbarui.');
    }

    /**
     * Menghapus absensi dari database.
     */
    public function destroy(Attendance $attendance)
    {
        $attendance->delete();

        // Ditambahkan pesan sukses
        return redirect()->route('attendances.index')
            ->with('success', 'Data absensi berhasil dihapus.');
    }
}