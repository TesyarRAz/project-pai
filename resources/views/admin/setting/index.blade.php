@extends('layouts.app')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Setting</h1>
    </div>

    <form action="{{ route('setting.store') }}" method="POST">
        @csrf
        @foreach ($setting as $stg)
            <div class="row col-sm-6">
                <div class="col-sm mb-3">
                    <input type="hidden" name="kode[]" value="{{ $stg->id_setting }}">
                    <label>Transaksi {{ $stg->nama_transaksi }} </label>
                </div>
                <div class="col-sm">
                    <label>{{ $stg->no_akun }}</label>
                </div>
                <div class="col-sm">
                    <select name="akun[]" class="form-control" required width="100%">
                        <option value="" selected disabled>Pilih Akun</option>
                        @foreach ($akun as $akn)
                            <option value="{{ $akn->no_akun }}">{{ $akn->no_akun }} - {{ $akn->nm_akun }} </option>
                        @endforeach
                    </select>
                </div>
            </div>
        @endforeach
    </form>
@endsection
