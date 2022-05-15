@extends('layouts.app')
@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">

        <h1 class="h3 mb-0 text-gray-800">Pembelian </h1>
    </div>
    <hr>
    <form action="{{ route('pembelian.store') }}" method="POST">
        @csrf

        <div class="form-group col-sm-4">
            <label>No Pembelian</label>
            @foreach ($kas as $ks)
                <input type="hidden" name="akun" value="{{ $ks->no_akun }}" class="form-control">
            @endforeach
            @foreach ($pembelian as $bli)
                <input type="hidden" name="pembelian" value="{{ $bli->no_akun }}" class="form-control">
            @endforeach
            <input type="hidden" name="no_jurnal" value="{{ $formatj }}" class="form-control">
            <input type="text" name="no_faktur" value="{{ $format }}" class="form-control">
        </div>
        @foreach ($pemesanan as $psn)
            <div class="form-group col-sm-4">
                <label>No Pemesanan</label>
                <input type="text" name="no_pesan" value="{{ $psn->no_pesan }}" class="form-control">
            </div>

            <div class="form-group col-sm-4">
                <label>Tanggal Pemesanan</label>
                <input type="text" min="1" name="tgl" value="{{ $psn->tgl_pesan }}" class="form-control" require>
            </div>
        @endforeach

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
                                <th>Aksi</th>
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
                                            value="{{ $temp->sub_total }}" readonly>{{ $temp->sub_total }}
                                    </td>
                                    <td>
                                        <a href="{{ route('pemesanan.destroy', $temp->kd_brg) }}"
                                            onclick="return confirm('Yakin Ingin menghapus data?')"
                                            class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm">
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
