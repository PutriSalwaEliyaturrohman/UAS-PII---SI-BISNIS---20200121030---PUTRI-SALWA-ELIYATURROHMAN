@extends('../template/main')

@section('title', 'List Jadwal')
@section('pagetitle', 'Jadwal')

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

    <h1 class="mb-3">List Mata Kuliah</h1>

    <!-- Button trigger modal -->
    <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#tambahData">
        Tambah Jadwal
    </button>

    <div class="table-responsive">
        <table class="table table-striped table-hover">

            <div class="position-relative mb-5">
                <div class="position-absolute top-0 end-0">{{ $jadwal->links() }} </div>
            </div>
            <thead>
                
                <th>Jadwal</th>
                <th>Mahasiswa</th>
                <th>Mata Kuliah </th>
                <th>action</th>
            </thead>
            @php($no = 1)
            @foreach ($jadwal as $mhs)
                <tr>


                    <td>{{ $mhs-> jadwal }}</td>
                    <td>{{ $mhs-> matakuliah->nama_matakuliah }}</td>
                    <td>{{ $mhs->matakuliah-> sks }}</td>
                    <td>
                        {{-- inline div --}}
                        <div class="btn-group" role="group">
                            <a href="/kontrakmatakuliah/{{ $mhs->id }}/edit" class="btn btn-outline-warning btn-sm text-dark">Edit</a>
                            {{-- create small space between button --}}
                            &nbsp; | &nbsp;
                            <form action="/kontrakmatakuliah/{{ $mhs->id }}" method="post">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('Apakah Yakin Menghapus Data {{ $mhs->nama_mhs }}')">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
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
        <form action="" method="post">
        <label for="">Nama mahasiswa :</label>
        <input type="text" placeholder="Nama Mahasiswa" name="nama_mahasiswa"><br>
        <label for=""> Email :</label>
        <input type="text" placeholder="Email" name="email"><br>
        <label for="">No Telephone :</label>
        <input type="text" placeholder="No Telephone" name="no_telp">


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"> Batal </button>
                <button type="submit" class="btn btn-primary"> Submit</button>
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