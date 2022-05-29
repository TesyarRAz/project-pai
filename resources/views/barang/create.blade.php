<form action="{{ route('barang.store') }}" method="post" class="modal fade" id="createModal" tabindex="-1"
    role="dialog">
    @csrf

    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Barang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Kode Barang</label>
                    <input type="text" name="kd_brg" class="form-control" maxlegth="5">
                </div>
                <div class="form-group">
                    <label>Nama Barang</label>
                    <input type="text" name="nm_brg"g" class="form-control">
                </div>
                <div class="form-group">
                    <label>Harga Barang</label>
                    <input type="number" name="harga"" class="form-control">
                </div>
                <div class="form-group">
                    <label>Stok Awal</label>
                    <input type="number" name="stok_awal" class="form-control">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </div>
</form>
