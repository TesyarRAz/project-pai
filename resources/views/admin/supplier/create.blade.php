<form action="{{ route('supplier.store') }}" method="post" class="modal fade" id="createModal" tabindex="-1"
    role="dialog">
    @csrf

    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Tambah Supplier</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Kode Supplier</label>
                    <input type="text" name="kd_supp" class="form-control" maxlegth="5">
                </div>
                <div class="form-group">
                    <label>Nama Supplier</label>
                    <input type="text" name="nm_supp" class="form-control">
                </div>
                <div class="form-group">
                    <label>Alamat</label>
                    <input type="text" name="alamat" class="form-control">
                </div>
                <div class="form-group">
                    <label>Telepon</label>
                    <input type="number" name="telepon" class="form-control">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </div>
</form>
