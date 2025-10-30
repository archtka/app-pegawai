<?php

namespace App\Http\Controllers;

use App\Models\Position;
use Illuminate\Http\Request;

class PositionController extends Controller
{
    /**
     * Menampilkan semua data jabatan
     */
    public function index()
    {
        // --- PERBAIKAN DI SINI ---
        // 'latest()' diganti dengan 'orderBy('id', 'asc')'
        // Ini akan mengurutkan dari 1, 2, 3, dst.
        $positions = Position::orderBy('id', 'asc')->paginate(10);
        
        return view('positions.index', compact('positions'));
    }

    /**
     * Menampilkan form untuk menambah data baru
     */
    public function create()
    {
        return view('positions.create');
    }

    /**
     * Menyimpan data baru ke database
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_jabatan' => 'required|string|max:100|unique:positions',
            'gaji_pokok' => 'required|numeric|min:0|max:99999999.99', // Sesuai DB DECIMAL(10,2)
        ]);

        Position::create($request->all());

        return redirect()->route('positions.index');
    }

    /**
     * Menampilkan detail satu data jabatan
     */
    public function show(Position $position)
    {
        return view('positions.show', compact('position'));
    }

    /**
     * Menampilkan form untuk mengedit data
     */
    public function edit(Position $position)
    {
        return view('positions.edit', compact('position'));
    }

    /**
     * Memperbarui data di database
     */
    public function update(Request $request, Position $position)
    {
        $request->validate([
            'nama_jabatan' => 'required|string|max:100|unique:positions,nama_jabatan,' . $position->id,
            'gaji_pokok' => 'required|numeric|min:0|max:99999999.99',
        ]);

        $position->update($request->all());

        return redirect()->route('positions.index');
    }
    
    /**
     * Menghapus data dari database
     */
    public function destroy(Position $position)
    {
        $position->delete();
        return redirect()->route('positions.index');
    }
}