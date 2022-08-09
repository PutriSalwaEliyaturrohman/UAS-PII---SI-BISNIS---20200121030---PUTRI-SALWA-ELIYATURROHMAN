@extends('../template/main')

@section('title', 'Data Mahasiswa')
@section('pagetitle', 'Mahasiswa')

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

<h1 class="mb-3">Data Mahasiswa</h1>

<!-- Button trigger modal -->
<button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
    Tambah Data Mahasiswa
</button>
<button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#exampleModaledit">
    Edit Data Mahasiswa
</button>

<div class="table-responsive">
    <table class="table table-striped table-hover">

        <div class="position-relative mb-5">
            <div class="position-absolute top-0 end-0">{{ $mahasiswas->links() }} </div>
        </div>
        <thead>
            <th>Nama Mahasiswa</th>
            <th>Email</th>
            <th>Alamat</th>
            <th>No Telephone</th>
            <th>action</th>
        </thead>
        @php($no = 1)
        @foreach ($mahasiswas as $mhs)
        <tr>


            <td>{{ $mhs->nama_mahasiswa }}</td>
            <td>{{ $mhs->email }}</td>
            <td>{{ $mhs->alamat }}</td>
            <td>{{ $mhs->no_telp }}</td>
            <td>
                {{-- inline div --}}
                <div class="btn-group" role="group">
                    <button data-bs-toggle="modal" data-bs-target="#exampleModaledit{{$mhs->id}}" class="btn btn-outline-warning btn-sm text-dark">Edit</button>
                    {{-- create small space between button --}}
                    &nbsp; | &nbsp;
                    <form action="/mahasiswa/{{ $mhs->id }}" method="post">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('Apakah Yakin Menghapus Data {{ $mhs->nama_mhs }}')">Delete</button>
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
                        <form action="/mahasiswa/{{$mhs->id}} " method="post">
                            @csrf
                            @method('PUT')

                            <label for="">Nama mahasiswa :</label>
                            <input type="text" value="{{$mhs->nama_mahasiswa}}" name="nama_mahasiswa"><br>
                            <label for=""> Email :</label>
                            <input type="text" value="{{$mhs->email}}" name="email"><br>
                            <label for="">No Telephone :</label>
                            <input type="text" value="{{$mhs->no_telp}}" name="no_telp"> <br>
                            <label for="">Alamat :</label> <br>
                            <input type="text" value="{{$mhs->alamat}}" name="alamat">
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
                    <form action="/mahasiswa" method="post">
                        @csrf
                        @method('POST')
                        <label for="">Nama mahasiswa :</label>
                        <input type="text" placeholder="Nama Mahasiswa" name="nama_mahasiswa"><br>
                        <label for=""> Email :</label>
                        <input type="text" placeholder="Email" name="email"><br>
                        <label for="">No Telephone :</label>
                        <input type="text" placeholder="No Telephone" name="no_telp">
                        <label for="">Alamat :</label>
                        <input type="text" placeholder="Alamat" name="alamat">
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