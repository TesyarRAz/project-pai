@extends('layouts.app')
@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">

        <h1 class="h3 mb-0 text-gray-800">Pembelian </h1>
    </div>
    <hr>
    <form action="{{ route('pembelian.store') }}" method="POST">
        @csrf

        <input type="hidden" name="akun" value="{{ $pemesanan->akun->no_akun }}" class="form-control">
        <input type="hidden" name="no_jurnal" value="{{ $formatj }}" class="form-control">

        <div class="form-group col-sm-4">
            <label>No Pembelian</label>
            <input type="text" name="no_faktur" value="{{ $format }}" class="form-control" readonly>
        </div>
        <div class="form-group col-sm-4">
            <label>No Pemesanan</label>
            <input type="text" name="no_pesan" value="{{ $pemesanan->no_pesan }}" class="form-control" readonly>
        </div>
        <div class="form-group col-sm-4">
            <label>Tanggal Pemesanan</label>
            <input type="text" name="tgl" value="{{ $pemesanan->tgl_pesan }}" class="form-control" readonly>
        </div>
        <div class="form-group col-sm-4">
            <label>Akun Pembelian</label>
            <select name="pembelian" class="form-control" required>
                <option value="" selected disabled>Pilih</option>
                @foreach ($akun as $a)
                    <option value="{{ $a->no_akun }}">{{ $a->no_akun }} - {{ $a->nm_akun }}</option>
                @endforeach
            </select>
        </div>

        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                        <thead class="thead-dark">
                            <tr>
                                <th>Kode Barang</th>
                                <th>Nama Barang</th>
                                <th>Quantity</th>
                                <th>Sub Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php($total = 0)
                            @foreach ($detail as $temp)
                                <tr>
                                    <td>
                                        <input name="no_beli[]" class="form-control" type="hidden"
                                            value="{{ $temp->no_pesan }}" readonly>
                                        <input name="kd_brg[]" class="form-control" type="hidden"
                                            value="{{ $temp->kd_brg }}" readonly>{{ $temp->kd_brg }}
                                    </td>
                                    <td>{{ $temp->nm_brg }}</td>
                                    <td>
                                        <input name="qty_beli[]" class="form-control" type="hidden"
                                            value="{{ $temp->qty_pesan }}" readonly>{{ $temp->qty_pesan }}
                                    </td>
                                    <td>
                                        <input name="sub_beli[]" class="form-control" type="hidden"
                                            value="{{ $temp->sub_total }}" readonly>{{ number_format($temp->sub_total) }}
                                    </td>
                                </tr>
                                @php($total += $temp->sub_total)
                            @endforeach
                            <tr>
                                <td colspan="3"></td>
                                <td>
                                    <input name="total" class="form-control" type="hidden"
                                        value="{{ $total }}">Total {{ number_format($total) }}
                                </td>
                                <td></td>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <button type="submit" class="btn btn-primary">Simpan Pembelian</button>
            </div>
        </div>
    </form>
@endsection
