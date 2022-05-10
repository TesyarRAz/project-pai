@extends('layouts.app')

@section('content')
<div class="d-sm-flex align-items-center mb-4">
    <a class="btn btn-primary mr-2" href="{{ route('akun.index') }}">
        <i class="fas fa-arrow-left"></i>
    </a>
    <h5 class="my-auto">Edit Akun</h5>
</div>

<form action="{{ route('akun.update', [$akun->no_akun]) }}" method="post" class="card">
    @csrf
    @method('PUT')
    
    <div class="card-body">
        <div class="form-group form-row">
            <div class="col-md-5">
                <label>Kode Akun</label>
                <input type="text" name="no_akun" class="form-control" value="{{ $akun->no_akun }}">
            </div>
            <div class="col-md-5">
                <label>Nama Akun</label>
                <input type="text" name="nm_akun" class="form-control" value="{{ $akun->nm_akun }}">
            </div>
        </div>
    </div>
    <div class="card-footer d-flex justify-content-end">
        <button type="submit" class="btn btn-success">
            <i class="fas fa-fw fa-save"></i>
            Simpan
        </button>
    </div>
</form>
@endsection