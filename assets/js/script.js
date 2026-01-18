
// script untuk menyembunnyikan sinopsis buku sebagian
function toggleSinopsis(id, el) {
    var shortText = document.getElementById("short-" + id);
    var fullText  = document.getElementById("full-" + id);

    if (fullText.style.display === "none") {
        fullText.style.display = "inline";
        shortText.style.display = "none";
        el.innerText = "Hide";
    } else {
        fullText.style.display = "none";
        shortText.style.display = "inline";
        el.innerText = "See all";
    }
}


//script untuk peminjaman buku
function isiFormPinjam(id, judul) {
    document.getElementById('book_id').value = id;
    document.getElementById('judul').value = judul;
}

$(document).ready(function() {
    $('#formPinjam').submit(function(e) {
        e.preventDefault(); // cegah submit biasa

        $.ajax({
            url: 'modules/pinjam/proses_pinjam.php',
            type: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                // Tutup modal
                $('#pinjamModal').modal('hide');

                // Tampilkan alert
                alert('Buku berhasil dipinjam!');

                // (Opsional) reset form
                $('#formPinjam')[0].reset();

                // (Opsional) update stock buku di halaman
                // Misal: $('#stock-'+book_id).text(newStock)
            },
            error: function(xhr) {
                alert('Terjadi kesalahan: ' + xhr.responseText);
            }
        });
    });
});