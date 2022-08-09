<?php

namespace App\Http\Controllers;

use App\Models\KontrakMataKuliah;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KontrakMataKuliahController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mhs = KontrakMataKuliah::orderBy('id', 'desc')->paginate(5);
        return view('KontrakMataKuliah.index', ['kontrakmatakuliah' => $mhs]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // return view('KontrakMataKuliah.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        

        // Validate Data Mahasiswa
        $request->validate([
            'mahasiswa_id' => 'required|',
            'semester_id' => 'required|',
            
        ]);


            $mhs = new KontrakMataKuliah;
            $mhs->mahaiswa_id = $request->mahaiswa_id;
            $mhs->semester_id = $request->semester_id;
            $mhs->save();
      
        //    Redirect to Index
        return redirect('kontrakmatakuliah');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

//
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
//
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
        // Validate Data Kontrak Mata Kuliah
        $request->validate([
            'mahasiswa_id' => 'nullable|',
            'semester_id' => 'nullable|',
        ]);

        // Update Data Mahasiswa
            $mhs = KontrakMataKuliah::find($id)->update([
            'mahasiswa_id' => $request->mahasiswa_id,
            'semester_id' => $request->semester_id,
            ]);

            // return error
            return redirect('/kontrakmatakuliah');
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
            $mhs = KontrakMataKuliah::findOrFail($id);
            $mhs->delete();
        } catch (\Throwable $th) {
            // return error
            return redirect('/kontrakmatakuliah')->with('error', $th->getMessage());
        }
      
        //    Redirect to Index
        return redirect('/mahasiswa')->with('success', 'Data Mahasiswa ' . $mhs->nama_mhs . ' Berhasil Dihapus');
    }
}

