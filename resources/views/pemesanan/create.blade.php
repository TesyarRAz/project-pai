<form action="{{ route('pemesanan.store') }}" method="post" class="modal fade" id="createModal" tabindex="-1"
    role="dialog">
    @csrf

    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalScrollableTitle">Tambah Barang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('pemesanan.store')}}" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Barang</label>
                        <select name="brg" class="form-control" required width="100%">
                            <option value="">Pilih</option>
                            @foreach ($barang as $product)
                                <option value="{{ $product->kd_brg }}">{{ $product->kd_brg }} -
                                    {{ $product->nm_brg }} [{{ number_format($product->harga) }}]</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>QTY</label>
                        <input type="number" min="1" name="qty" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Tambah Barang</button>
                </div>
        </div>
    </div>
</form>
