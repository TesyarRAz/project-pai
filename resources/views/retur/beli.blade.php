@extends('layouts.app')
@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">

        <h1 class="h3 mb-0 text-gray-800">Pembelian </h1>
    </div>
    <hr>
    <form action="{{ route('retur.store') }}" method="POST">
        @csrf

        <div class="form-group col-sm-4">
            <label>No Retur</label>
            @foreach ($kas as $ks)
                <input type="hidden" name="kas" value="{{ $ks->no_akun }}" class="form-control">
            @endforeach
            @foreach ($retur as $rtr)
                <input type="hidden" name="retur" value="{{ $rtr->no_akun }}" class="form-control">
            @endforeach
            <input type="hidden" name="no_jurnal" value="{{ $formatj }}" class="form-control">
            <input type="text" name="no_retur" value="{{ $format }}" class="form-control" readonly>
        </div>
        <div class="form-group col-sm-4">
            <label>Tanggal Retur</label>
            <input type="date" min="1" name="tgl" class="form-control" require>
        </div>
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" width="100%" cellspacing="0">
                        <thead class="thead-dark">
                            <tr>
                                <th>Kode Barang</th>
                                <th>Nama Barang</th>
                                <th align="center">Jumlah Barang Dibeli</th>
                                <th width=10%>Jumlah Retur</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php($total = 0)
                            @foreach ($beli as $bli)
                                <tr>
                                    <td>
                                        <input name="kd_brg[]" class="form-control" type="hidden"
                                            value="{{ $bli->kd_brg }}" readonly>{{ $bli->kd_brg }}
                                    </td>
                                    <td>{{ $bli->nm_brg }}</td>
                                    <td align="center">
                                        <input name="qty_beli[]" class="form-control" type="hidden"
                                            value="{{ $bli->qty_beli }}" readonly>
                                        <input name="harga[]" class="form-control" type="hidden"
                                            value="{{ $bli->harga }}" readonly>
                                        {{ $bli->qty_beli }}
                                    </td>
                                    <td width=10%>
                                        <input name="jml_retur[]" class="form-control" type="number" value="0">
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <button type="submit" class="btn btn-primary">Simpan Retur</button>
            </div>
        </div>
    </form>
@endsection
