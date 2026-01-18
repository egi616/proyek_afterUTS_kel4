<!-- kode untuk pengisian form peminjaman buku -->
<div class="modal fade" id="pinjamModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Form Peminjaman Buku</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form id="formPinjam" method="POST">

                <div class="modal-body">

                    <input type="hidden" name="book_id" id="book_id">

                    <div class="mb-3">
                        <label class="form-label">Judul Buku</label>
                        <input type="text" id="judul" class="form-control" readonly>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Nama Peminjam</label>
                        <input type="text" name="nama" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Tanggal Pinjam</label>
                        <input type="date" name="tgl_pinjam" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Tanggal Kembali</label>
                        <input type="date" name="tgl_kembali" class="form-control" required>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Pinjam</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Batal
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>
