<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mhs = Jadwal::orderBy('id', 'desc')->paginate(5);
        return view('Jadwal.index', ['jadwal' => $mhs]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // return view('Jadwal.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        return redirect('/Jadwal')->with('success', 'Data Jadwal ' . $request->nama_mhs . ' Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       return view('Jadwal.show', ['Jadwal' => Jadwal::findOrFail($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $Jadwal = Jadwal::findOrFail($id);
        return view('Jadwal.edit', ['Jadwal' => $Jadwal]);
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
        // Validate Data Jadwal
        $request->validate([
            'nama_mhs' => 'required|max:100|min:3',
            'email' => 'required|max:100|min:3',
            'alamat' => 'required'
        ]);

        // Update Data Jadwal
        try {
            $mhs = Jadwal::findOrFail($id);
            $mhs->nama_mhs = $request->nama_mhs;
            $mhs->email = $request->email;
            $mhs->umur = $request->umur;
            $mhs->alamat = $request->alamat;
            $mhs->save();
        } catch (\Throwable $th) {
            // return error
            return redirect('/Jadwal/edit/'.$request->id)->with('error', $th->getMessage());
        }
      
        //    Redirect to Index
        return redirect('/Jadwal')->with('success', 'Data Jadwal ' . $request->nama_mhs . ' Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Delete Data Jadwal
        try {
            $mhs = Jadwal::findOrFail($id);
            $mhs->delete();
        } catch (\Throwable $th) {
            // return error
            return redirect('/Jadwal')->with('error', $th->getMessage());
        }
      
        //    Redirect to Index
        return redirect('/Jadwal')->with('success', 'Data Jadwal ' . $mhs->nama_mhs . ' Berhasil Dihapus');
    }
}
