<form action="{{ route('akun.store') }}" method="post" class="modal fade" id="createModal" tabindex="-1"
    role="dialog">
    @csrf

    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Tambah Akun</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Kode Akun</label>
                    <input type="text" name="no_akun" class="form-control">
                </div>
                <div class="form-group">
                    <label>Nama Akun</label>
                    <input type="text" name="nm_akun" class="form-control">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </div>
</form>
