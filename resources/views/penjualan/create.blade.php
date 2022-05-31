@extends('layouts.app')

@section('content')
    @include('penjualan.modal-create')

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Transaksi Penjualan</h1>
    </div>

    <form action="{{ route('detail-jual.store') }}" method="POST" class="card">
        @csrf

        <input type="hidden" name="no_jurnal" value="{{ $formatj }}">

        <div class="card-body">
            <div class="d-flex flex-column no-gutters">
                <div class="col-md-12">
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label>No Faktur</label>

                            <input type="text" name="no_jual" value="{{ $formatnya }}" class="form-control">
                        </div>
                        <div class="form-group col-md-4">
                            <label>Akun Penjualan</label>
                            <select name="no_akun" class="form-control" required>
                                <option value="" selected disabled>Pilih</option>
                                @foreach ($akun as $a)
                                    <option value="{{ $a->no_akun }}">{{ $a->no_akun }} - {{ $a->nm_akun }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="row">
                        <div class="form-group col-md-4">
                            <div class="form-group">
                                <label>Tanggal Transaksi</label>
                                <input type="date" min="{{ now()->format('Y-m-d') }}" value="{{ now()->format('Y-m-d') }}"
                                    name="tgl_jual" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Akun Pembelian</label>
                            <select name="no_pembelian" class="form-control" required>
                                <option value="" selected disabled>Pilih</option>
                                @foreach ($akun as $a)
                                    <option value="{{ $a->no_akun }}">{{ $a->no_akun }} - {{ $a->nm_akun }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="py-3">
                <button type="button" class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm" data-toggle="modal"
                    data-target="#createModal">
                    <i class="fas fa-plus fa-sm text-white-50"></i>
                    Tambah Barang
                </button>
            </div>
            <div class="mb-2">
                <table class="table table-bordered table-striped" width="100%" cellspacing="0">
                    <thead class="thead-dark">
                        <tr>
                            <th>Kode Barang</th>
                            <th>Nama Barang</th>
                            <th>Quantity</th>
                            <th>Sub Total</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php($total = 0)
                        @foreach ($temp_penjualan as $temp)
                            <tr>
                                <td>
                                    <input name="kd_brg[]" class="form-control" type="hidden"
                                        value="{{ $temp->kd_brg }}" readonly>
                                    {{ $temp->kd_brg }}
                                </td>
                                <td>
                                    <input name="nama" class="form-control" type="hidden" value="{{ $temp->nm_brg }}"
                                        readonly>
                                    {{ $temp->nm_brg }}
                                </td>
                                <td>
                                    <input name="qty_jual[]" class="form-control" type="hidden"
                                        value="{{ $temp->qty_jual }}" readonly>{{ $temp->qty_jual }}
                                </td>
                                <td>
                                    <input name="sub_total[]" class="form-control" type="hidden"
                                        value="{{ $temp->sub_total }}" readonly>{{ number_format($temp->sub_total) }}
                                </td>
                                <td>
                                    <a href="{{ route('pemesanan.destroy', $temp->kd_brg) }}"
                                        class="btn btn-sm btn-danger shadow-sm">
                                        <i class="fas fa-trash-alt fa-sm text-white-50"></i>
                                        Hapus
                                    </a>
                                </td>
                            </tr>
                            @php($total += $temp->sub_total)
                        @endforeach
                        <tr>
                            <td colspan="3"></td>
                            <td>
                                <input name="total" class="form-control" type="hidden" value="{{ $total }}">Total
                                {{ number_format($total) }}
                            </td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
                <button type="submit" class="btn btn-primary">Buat Penjualan</button>
            </div>
        </div>
    </form>
@endsection
