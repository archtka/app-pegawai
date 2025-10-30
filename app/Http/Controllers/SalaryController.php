<?php

namespace App\Http\Controllers;

use App\Models\Salary;
use App\Models\Employee;
use App\Models\Position; // <-- PERBAIKAN: Impor model Position
use Illuminate\Http\Request;

class SalaryController extends Controller
{
    public function index()
    {
        $salaries = Salary::with('employee')->latest()->paginate(10);
        return view('salaries.index', compact('salaries'));
    }

    public function create()
    {
        $employees = Employee::all();
        return view('salaries.create', compact('employees'));
    }

    public function store(Request $request)
    {
        // --- PERBAIKAN DI SINI ---
        // 1. Validasi HANYA input dari user
        $request->validate([
            'karyawan_id' => 'required|exists:employees,id',
            'bulan' => 'required|string|max:10',
            // Kita hanya validasi tunjangan & potongan. Gaji pokok & total akan dihitung.
            'tunjangan' => 'required|numeric|min:0|max:99999999.99', // Sesuaikan max dengan DECIMAL(10,2)
            'potongan' => 'required|numeric|min:0|max:99999999.99',
        ]);

        // 2. Ambil data Gaji Pokok dari Jabatan Karyawan
        $employee = Employee::with('position')->find($request->karyawan_id);
        if (!$employee || !$employee->position) {
            // Tangani jika karyawan/jabatannya tidak ada
            return back()->withErrors(['karyawan_id' => 'Karyawan atau jabatan tidak ditemukan.']);
        }
        
        $gaji_pokok = $employee->position->gaji_pokok; // [cite: 428, 1136]

        // 3. Ambil data Tunjangan & Potongan dari form
        $tunjangan = (float) $request->tunjangan;
        $potongan = (float) $request->potongan;

        // 4. Hitung Total Gaji di server (BUKAN DARI FORM)
        $total_gaji = ($gaji_pokok + $tunjangan) - $potongan;

        // 5. Simpan ke database
        Salary::create([
            'karyawan_id' => $request->karyawan_id,
            'bulan' => $request->bulan,
            'gaji_pokok' => $gaji_pokok, // <-- Nilai dari server
            'tunjangan' => $tunjangan,
            'potongan' => $potongan,
            'total_gaji' => $total_gaji, // <-- Nilai yang sudah dihitung
        ]);

        return redirect()->route('salaries.index');
    }

    public function show(Salary $salary)
    {
        $salary->load('employee.position'); // Ambil relasi employee & position
        return view('salaries.show', compact('salary'));
    }

    public function edit(Salary $salary)
    {
        $employees = Employee::all();
        return view('salaries.edit', compact('salary', 'employees'));
    }

    public function update(Request $request, Salary $salary)
    {
        // --- PERBAIKAN DI SINI (LOGIKA SAMA DENGAN STORE) ---
        // 1. Validasi
        $request->validate([
            'karyawan_id' => 'required|exists:employees,id',
            'bulan' => 'required|string|max:10',
            'tunjangan' => 'required|numeric|min:0|max:99999999.99',
            'potongan' => 'required|numeric|min:0|max:99999999.99',
        ]);

        // 2. Ambil Gaji Pokok baru (jika karyawan berubah)
        $employee = Employee::with('position')->find($request->karyawan_id);
        if (!$employee || !$employee->position) {
            return back()->withErrors(['karyawan_id' => 'Karyawan atau jabatan tidak ditemukan.']);
        }

        $gaji_pokok = $employee->position->gaji_pokok;

        // 3. Ambil data Tunjangan & Potongan
        $tunjangan = (float) $request->tunjangan;
        $potongan = (float) $request->potongan;

        // 4. Hitung Total Gaji
        $total_gaji = ($gaji_pokok + $tunjangan) - $potongan;

        // 5. Update data
        $salary->update([
            'karyawan_id' => $request->karyawan_id,
            'bulan' => $request->bulan,
            'gaji_pokok' => $gaji_pokok, // <-- Nilai baru
            'tunjangan' => $tunjangan,
            'potongan' => $potongan,
            'total_gaji' => $total_gaji, // <-- Nilai baru
        ]);

        return redirect()->route('salaries.index');
    }

    public function destroy(Salary $salary)
    {
        $salary->delete();
        return redirect()->route('salaries.index');
    }
}