<?php

namespace App\Http\Controllers;

use App\Models\Semester;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SemesterController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mhs = Semester::orderBy('id', 'desc')->paginate(5);
        return view('Semester.index', ['semester' => $mhs]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // return view('Semester.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate Data Semester
        $request->validate([
            'semester' => 'required|unique:semesters|',
        ]);


            $mhs = new Semester;
            $mhs->semester = $request->semester;
            
      
        //    Redirect to Index
        return redirect('semester');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       return view('Semester.show', ['semester' => Semester::findOrFail($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $mhs = Semester::findOrFail($id);
        return view('semester.edit', ['semester' => $mhs]);
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
        // Validate Data Semester
        $request->validate([
            'Semester' => 'nullable|unique:semesters|',
           
        ]);

        // Update Data Semester
            $mhs = Semester::find($id)->update([
            'Semester' => $request->semester,
            ]); 

            // return error
            return redirect('/semester');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Delete Data Semester
        try {
            $mhs = Semester::findOrFail($id);
            $mhs->delete();
        } catch (\Throwable $th) {
            // return error
            return redirect('/mahasiswa')->with('error', $th->getMessage());
        }
      
        //    Redirect to Index
        return redirect('/mahasiswa')->with('success', 'Data Semester ' . $mhs->nama_mhs . ' Berhasil Dihapus');
    }
}

