@extends('layouts.app')

@section('content')
<div class="d-sm-flex align-items-center mb-4">
    <a class="btn btn-primary mr-2" href="{{ route('supplier.index') }}">
        <i class="fas fa-arrow-left"></i>
    </a>
    <h5 class="my-auto">Edit Supplier</h5>
</div>

<form action="{{ route('supplier.update', [$supplier->kd_supp]) }}" method="post" class="card">
    @csrf
    @method('PUT')
    
    <div class="card-body">
        <div class="form-group form-row">
            <div class="col-md-5">
                <label>Kode Supplier</label>
                <input class="form-control" type="text" name="kd_supp" value="{{ $supplier->kd_supp }}" readonly>
            </div>
            <div class="col-md-5">
                <label>Nama Supplier</label>
                <input type="text" name="nm_supp" class="form-control" value="{{ $supplier->nm_supp }}" >
            </div>
        </div>
        <div class="form-group form-row">
            <div class="col-md-5">
                <label>Alamat</label>
                <input type="text" name="alamat" class="form-control" value="{{ $supplier->alamat }}">
            </div>
            <div class="col-md-5">
                <label>Telepon</label>
                <input type="text" name="telepon" class="form-control" value="{{ $supplier->telepon }}">
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