@extends('../template/main')

@section('title', 'Kontrak Mata Kuliah')
@section('pagetitle', 'Mata Kuliah')

@section('container')

    {{-- jika message berhasil --}}
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Jika message gagal --}}
    @if (session()->has('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Show error from validation --}}
    @if (count($errors) > 0)
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <h1 class="mb-3">Kontrak Mata Kuliah</h1>

    <!-- Button trigger modal -->
<button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
    Tambah Kontrak 
</button>


<div class="table-responsive">
    <table class="table table-striped table-hover">

        <div class="position-relative mb-5">
            <div class="position-absolute top-0 end-0"> </div>
        </div>
        <thead>
            <th>Mahasiswa</th>
            <th>Semester</th>
           
            <th>action</th>
        </thead>
        @php($no = 1)
        @foreach ($kontrakmatakuliah as $mhs)
        <tr>


            <td>{{ $mhs->mahasiswa_id }}</td>
            <td>{{ $mhs->semester_id }}</td>
            <td>
                {{-- inline div --}}
                <div class="btn-group" role="group">
                    <button data-bs-toggle="modal" data-bs-target="#exampleModaledit{{$mhs->id}}" class="btn btn-outline-warning btn-sm text-dark">Edit</button>
                    {{-- create small space between button --}}
                    &nbsp; | &nbsp;
                    <form action="/kontrakmatakuliah/{{ $mhs->id }}" method="post">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('Apakah Yakin Menghapus Data {{ $mhs->kontrakmatakuliah }}')">Delete</button>
                    </form>
                </div>
            </td>
        </tr>

        <div class="modal" tabindex="-1" id="exampleModaledit{{$mhs->id}}">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Modal title</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="/kontrakmatakuliah/{{$mhs->id}} " method="post">
                            @csrf
                            @method('PUT')

                            <label for=""> Mahasiswa :</label>
                            <input type="text" value=" " name="mahaiswa_id"><br>
                            <label for=""> Semester :</label>
                            <input type="text" value="" name="semester_id"><br>
        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"> Batal </button>
                        <button type="submit" class="btn btn-primary"> Simpan </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        @endforeach
    </table>

    <div class="modal" tabindex="-1" id="exampleModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/kontrakmatakuliah" method="post">
                        @csrf
                        @method('POST')
                        <label for="">Mahasiswa :</label>
                        <input type="text" placeholder=" Mahasiswa" name="mahasiswa_id"><br>
                        <label for=""> Semester :</label>
                        <input type="text" placeholder="Semester" name="semester_id"><br>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"> Batal </button>
                    <button type="submit" class="btn btn-primary"> Simpan </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>


{{-- @error('nama')
          <div class="alert alert-danger">{{ $message }}</div>
@enderror --}}
@endsection