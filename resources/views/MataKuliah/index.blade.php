@extends('../template/main')

@section('title', 'List Mata Kuliah')
@section('pagetitle', 'Mata Kuliah')

@section('container')
<h1 class="mb-3">List Mata Kuliah</h1>

<!-- Button trigger modal -->
<button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
    Tambah sks
</button>

<div class="table-responsive">
    <table class="table table-striped table-hover">

        <div class="position-relative mb-5">
            <div class="position-absolute top-0 end-0">{{ $matakuliah->links() }} </div>
        </div>
        <thead>
            <th>Mata Kuliah</th>
            <th>Sks </th>
            <th>action</th>
        </thead>
        @php($no = 1)
        @foreach ($matakuliah as $mhs)
        <tr>


            <td>{{ $mhs-> nama_matakuliah }}</td>
            <td>{{ $mhs->sks }}</td>
            <td>
                {{-- inline div --}}
                <div class="btn-group" role="group">
                <button data-bs-toggle="modal" data-bs-target="#exampleModaledit{{$mhs->id}}" class="btn btn-outline-warning btn-sm text-dark">Edit</button>
                    
                    {{-- create small space between button --}}
                    &nbsp; | &nbsp;
                    <form action="/matakuliah/{{ $mhs->id }}" method="post">
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
                        <form action="/matakuliah/{{$mhs->id}} " method="post">
                            @csrf
                            @method('PUT')

                            <label for="">Mata Kuliah :</label>
                            <input type="text" value="{{$mhs->nama_matakuliah}}" name="nama_matakuliah"><br>
                            <label for=""> Sks :</label>
                            <input type="text" value="{{$mhs->sks}}" name="sks"><br>
                           
                    </div>
                    <div class="modal-footer">
                        
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"> Batal </button>
                        <button type="submit" class="btn btn-primary"> Submit</button>
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
                    <form action="/matakuliah" method="post">
                        @csrf
                        @method('POST')
                        <label for="">Nama Mata Kuliah :</label>
                        <input type="text" placeholder="nama matakuliah" name="nama_matakuliah"><br>
                        <label for=""> Sks :</label>
                        <input type="text" placeholder="sks" name="sks"><br>
                        
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