<?php

namespace App\Http\Controllers;

use App\Models\Criterion;
use App\Services\SawService;
use Illuminate\Http\Request;

class SawController extends Controller
{
    public function index(SawService $saw)
    {
        return view('saw.index', $saw->hitung());
    }

    public function kriteria()
    {
        return view('saw.kriteria', ['criteria' => Criterion::orderBy('kode')->get()]);
    }

    public function updateKriteria(Request $request)
    {
        $data = $request->validate([
            'bobot'   => 'required|array',
            'bobot.*' => 'required|numeric|min:0|max:1',
        ]);

        if (abs(array_sum($data['bobot']) - 1) > 0.001) {
            return back()->withErrors(['bobot' => 'Total bobot harus sama dengan 1.'])->withInput();
        }

        foreach ($data['bobot'] as $id => $bobot) {
            Criterion::whereKey($id)->update(['bobot' => $bobot]);
        }

        return redirect()->route('saw.index')->with('success', 'Bobot kriteria diperbarui.');
    }
}