<?php

namespace App\Http\Controllers;

use App\Models\Matakuliah;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class MataKuliahController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mhs = Matakuliah::orderBy('id', 'desc')->paginate(5);
        return view('Matakuliah.index', ['matakuliah' => $mhs]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // return view('Mahasiswa.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'nama_matakuliah' => 'required|',
            'sks' => 'required|',

        ]);

        $matkul = new Matakuliah();

        $matkul->nama_matakuliah = $request->nama_matakuliah;
        $matkul->sks = $request->sks;

        $matkul->save();

        return redirect('/matakuliah');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('Mahasiswa.show', ['mahasiswa' => Matakuliah::findOrFail($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_matakuliah' => 'nullable|',
            'sks' => 'nullable|',
        ]);

        Matakuliah::find($id)->update([
            'nama_matakuliah' => $request->nama_matakuliah,
            'sks' => $request->sks,

        ]);


        return redirect('/matakuliah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Delete Data Mahasiswa
        try {
            $mhs = Matakuliah::findOrFail($id);
            $mhs->delete();
        } catch (\Throwable $th) {
            // return error
            return redirect('/mahasiswa')->with('error', $th->getMessage());
        }

        //    Redirect to Index
        return redirect('/mahasiswa')->with('success', 'Data Mahasiswa ' . $mhs->nama_mhs . ' Berhasil Dihapus');
    }
}
