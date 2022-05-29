@extends('layouts.app')
@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Transaksi Pembelian </h1>
    </div>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                    <thead class="thead-dark">
                        <tr>
                            <th width="15%">No Pemesanan</th>
                            <th>Tanggal Pesan</th>
                            <th width="30%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pemesanan as $pesan)
                            <tr>
                                <td width="15%">{{ $pesan->no_pesan }}</td>
                                <td>{{ $pesan->tgl_pesan }}</td>
                                <td width="30%">
                                    <a href="{{ route('pembelian.show', Crypt::encryptString($pesan->no_pesan)) }}"
                                        class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm">
                                        <i class="fas fa-edit fa-sm text-white-50"></i>
                                        Beli
                                    </a>
                                    <a href="{{ route('pembelian.pdf', Crypt::encryptString($pesan->no_pesan)) }}"
                                        target="_blank" class="d-none d-sm-inline-block btn btn-sm btn-warning shadow-sm">
                                        <i class="fas fa-print fa-sm text-white-50"></i>
                                        Cetak Invoice</a>
                                    <form class="d-inline-block" method="post" action="{{ route('detail.destroy', Crypt::encryptString($pesan->no_pesan)) }}" onsubmit="return confirm('Yakin Ingin menghapus data?')">
                                        @csrf
                                        @method('delete')

                                        <button type="submit" class="btn btn-sm btn-danger shadow-sm">
                                            <i class="fas fa-trash-alt fa-sm text-white-50"></i>
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
