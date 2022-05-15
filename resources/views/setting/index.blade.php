@extends('layouts.app')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Setting</h1>
    </div>

    <form action="{{ route('setting.store') }}" method="POST">
        @csrf
        @foreach ($setting as $stg)
            <div class="row">
                <div class="col-sm-6 col-lg-2 mb-2">
                    <input type="hidden" name="kode[]" value="{{ $stg->id_setting }}">
                    <label>Transaksi {{ $stg->nama_transaksi }} </label>
                </div>
                <div class="col-sm-6 col-lg-2 mb-2">
                    <label>{{ $stg->no_akun }}</label>
                </div>
                <div class="col-sm-12 col-lg-2 mb-3">
                    <select name="akun[]" class="form-control" required>
                        <option value="" selected disabled>Pilih Akun</option>
                        @foreach ($akun as $akn)
                            <option value="{{ $akn->no_akun }}">{{ $akn->no_akun }} - {{ $akn->nm_akun }} </option>
                        @endforeach
                    </select>
                </div>
            </div>
        @endforeach
        <div class="row">
            <div class="col">
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </form>
@endsection
