@extends('layouts.app')
@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Transaksi Penjualan </h1>
    </div>
    <div class="card mb-4">
        <div class="card-header py-3">
            <div class="clearfix">
                <a class="btn btn-primary float-right btn-shadow btn-sm" href="{{ route('penjualan.create') }}">
                    <i class="fas fa-plus fa-sm text-white-50"></i>
                    Tambah
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead class="thead-dark">
                        <tr>
                            <th width="15%">No Penjualan</th>
                            <th>Tanggal Jual</th>
                            <th>Nama Pembeli</th>
                            <th width="30%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($penjualan as $jual)
                            <tr>
                                <td width="15%">{{ $jual->no_jual }}</td>
                                <td>{{ $jual->tgl_jual }}</td>
                                <td>{{ $jual->nama_pembeli }}</td>
                                <td width="30%">
                                    <a href="{{ route('penjualan.pdf', Crypt::encryptString($jual->no_jual)) }}"
                                        target="_blank" class="d-none d-sm-inline-block btn btn-sm btn-warning shadow-sm">
                                        <i class="fas fa-print fa-sm text-white-50"></i>
                                        Cetak Invoice
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
