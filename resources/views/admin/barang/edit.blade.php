@extends('layouts.app')

@section('content')
<div class="d-sm-flex align-items-center mb-4">
    <a class="btn btn-primary mr-2" href="{{ route('barang.index') }}">
        <i class="fas fa-arrow-left"></i>
    </a>
    <h5 class="my-auto">Edit Barang</h5>
</div>

<form action="{{ route('barang.update', [$barang->kd_brg]) }}" method="post" class="card">
    @csrf
    @method('PUT')
    
    <div class="card-body">
        <div class="form-group form-row">
            <div class="col-md-5">
                <label>Kode Barang</label>
                <input class="form-control" type="text" name="kd_brg" value="{{ $barang->kd_brg }}" readonly>
            </div>
            <div class="col-md-5">
                <label>Nama Barang</label>
                <input type="text" name="nm_brg" class="form-control" value="{{ $barang->nm_brg }}">
            </div>
        </div>
        <div class="form-group form-row">
            <div class="col-md-5">
                <label>Harga</label>
                <input type="text" name="harga" class="form-control" value="{{ $barang->harga }}">
            </div>
            <div class="col-md-5">
                <label>Stok</label>
                <input type="text" name="stok" class="form-control" value="{{ $barang->stok }}">
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