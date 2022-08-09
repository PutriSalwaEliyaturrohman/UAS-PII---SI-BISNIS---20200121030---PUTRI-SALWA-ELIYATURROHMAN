<?php

namespace App\Http\Controllers;

use App\Models\Absen;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AbsenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mhs = Absen::orderBy('id', 'desc')->paginate(5);
        return view('Absen.index', ['absen' => $mhs]);
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
        // Validate Absen
        $request->validate([
            'waktu_absen' => 'required|',
            'mahasiswa_id' => 'required|',
            'matakuliah_id' => 'required|required|',
            'keterangan' => 'required|'
        ]);


            $mhs = new Absen;
            $mhs->waktu_absen = $request->waktu_absen;
            $mhs->mahasiswa_id = $request->mahasiswa_id;
            $mhs->matakuliah_id = $request->matakuliah_id;
            $mhs->keterangan = $request->keterangan;
            $mhs->save();
      
        //    Redirect to Index
        return redirect('absen');
      
        //    Redirect to Index
        return redirect('/absen')->with('success', 'Data Absen ' . $request->absen . ' Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       return view('Absen.show', ['Absen' => Absen::findOrFail($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $absen = Absen::findOrFail($id);
        return view('Absen.edit', ['mahasiswa' => $absen]);
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
        // Validate Data Absen
        $request->validate([
            'waktu_absen' => 'required|',
            'mahasiswa_id' => 'required|',
            'matakuliah_id' => 'required|required|',
            'keterangan' => 'required|'
        ]);

        // Update Data Absen
        try {
            $mhs = Absen::findOrFail($id);
            $mhs->waktu_absen = $request->waktu_absen;
            $mhs->mahasiswa_id = $request->mahasiswa_id;
            $mhs->matakuliah_id = $request->matakuliah_id;
            $mhs->keterangan = $request->keterangan;
            $mhs->save();
        } catch (\Throwable $th) {
            // return error
            return redirect('/absen/edit/'.$request->id)->with('error', $th->getMessage());
        }
      
        //    Redirect to Index
        return redirect('/asben')->with('success', 'Data Absen ' . $request->absen . ' Berhasil Diubah');
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
            $mhs = Absen::findOrFail($id);
            $mhs->delete();
        } catch (\Throwable $th) {
            // return error
            return redirect('/mahasiswa')->with('error', $th->getMessage());
        }
      
        //    Redirect to Index
        return redirect('/mahasiswa')->with('success', 'Data Mahasiswa ' . $mhs->nama_mhs . ' Berhasil Dihapus');
    }
}
