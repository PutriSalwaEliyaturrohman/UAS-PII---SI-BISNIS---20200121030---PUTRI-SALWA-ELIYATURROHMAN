@extends('../template/main')

@section('title', 'List Mata Kuliah')
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

<h1 class="mb-3">Absensi</h1>

<!-- Button trigger modal -->
<button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
Absensi
</button>


<div class="table-responsive">
    <table class="table table-striped table-hover">

        <div class="position-relative mb-5">
            <div class="position-absolute top-0 end-0">{{ $absen->links() }} </div>
        </div>
        <thead>
            <th>Waktu Absen</th>
            <th>Mahasiswa</th>
            <th>Mata Kuliah</th>
            <th> Keterangan </th>
        </thead>
        @php($no = 1)
        @foreach ($absen as $mhs)
        <tr>


            <td>{{ $mhs->waktu_absen }}</td>
            <td>{{ $mhs->mahasiswa_id }}</td>
            <td>{{ $mhs->matakuliah_id }}</td>
            <td>{{ $mhs->keterangan }}</td>
            <td>
                {{-- inline div --}}
                <div class="btn-group" role="group">
                    
                    {{-- create small space between button --}}
                    &nbsp;  &nbsp;
                    <form action="/absen/{{ $mhs->id }}" method="post">
                        @method('DELETE')
                        @csrf
                        
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
                        <form action="/absen/{{$mhs->id}} " method="post">
                            @csrf
                            @method('PUT')

                            <label for=""> Waktu Absen :</label>
                            <input type="text" value=" " name="waktu_absen"><br>
                            <label for=""> Mahasiswa :</label>
                            <input type="text" value="{{$mhs->email}}" name="mahasiswa_id"><br>
                            <label for="">Mata Kuliah :</label>
                            <input type="text" value=" " name="matakuliah_id"> <br>
                            <label for="">Keterangan :</label> <br>
                            <input type="text" value="" name="keterangan">
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
                    <form action="/absen" method="post">
                        @csrf
                        @method('POST')
                        <label for=""> Waktu Absen :</label>
                        <input type="text" placeholder="Waktu Absen" name="waktu_absen"><br>
                        <label for=""> Mahasiswa :</label>
                        <input type="text" placeholder="Mahasiswa" name="mahasiswa_id"><br>
                        <label for="">Mata Kuliah :</label>
                        <input type="text" placeholder="Keterangan" name="matakuliah_id">
                        <label for="">Keterangan :</label>
                        <input type="text" placeholder="Keterangan" name="keterangan">
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