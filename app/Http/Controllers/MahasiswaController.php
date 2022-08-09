<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mhs = Mahasiswa::orderBy('id', 'desc')->paginate(5);
        return view('Mahasiswa.index', ['mahasiswas' => $mhs]);
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
        

        // Validate Data Mahasiswa
        $request->validate([
            'nama_mahasiswa' => 'required|unique:mahasiswas|',
            'email' => 'required|unique:mahasiswas|',
            'no_telp' => 'required|required|',
            'alamat' => 'required'
        ]);


            $mhs = new Mahasiswa;
            $mhs->nama_mahasiswa = $request->nama_mahasiswa;
            $mhs->email = $request->email;
            $mhs->no_telp = $request->no_telp;
            $mhs->alamat = $request->alamat;
            $mhs->save();
      
        //    Redirect to Index
        return redirect('mahasiswa');
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
        // Validate Data Mahasiswa
        $request->validate([
            'nama_mahasiswa' => 'nullable|',
            'email' => 'nullable|',
            'no_telp' => 'nullable|',
            'alamat' => 'nullable',
        ]);

        // Update Data Mahasiswa
            $mhs = Mahasiswa::find($id)->update([
            'nama_mahasiswa' => $request->nama_mahasiswa,
            'email' => $request->email,
            'no_telp' => $request->no_telp,
            'alamat' => $request->alamat,
            ]);

            // return error
            return redirect('/mahasiswa');
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
            $mhs = Mahasiswa::findOrFail($id);
            $mhs->delete();
        } catch (\Throwable $th) {
            // return error
            return redirect('/mahasiswa')->with('error', $th->getMessage());
        }
      
        //    Redirect to Index
        return redirect('/mahasiswa')->with('success', 'Data Mahasiswa ' . $mhs->nama_mhs . ' Berhasil Dihapus');
    }
}
