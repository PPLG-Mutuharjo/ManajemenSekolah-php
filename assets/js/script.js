/* assets/js/script.js */

// Pastikan DOM sudah dimuat sepenuhnya sebelum menjalankan script
document.addEventListener("DOMContentLoaded", (event) => {
  // Event listener untuk modal update
  const modalUpdateSiswa = document.getElementById("modalUpdateSiswa");
  if (modalUpdateSiswa) {
    modalUpdateSiswa.addEventListener("show.bs.modal", (event) => {
      // Tombol yang memicu modal
      const button = event.relatedTarget;

      // Ekstrak data dari atribut data-*
      const id = button.getAttribute("data-id");
      const nama = button.getAttribute("data-nama");
      const nis = button.getAttribute("data-nis");
      const kelas = button.getAttribute("data-kelas");
      const jurusan = button.getAttribute("data-jurusan");

      // Masukkan data ke dalam form di modal
      const modalBody = modalUpdateSiswa.querySelector(".modal-body");
      modalBody.querySelector("#update-id").value = id;
      modalBody.querySelector("#update-nama").value = nama;
      modalBody.querySelector("#update-nis").value = nis;
      modalBody.querySelector("#update-kelas").value = kelas;
      modalBody.querySelector("#update-jurusan").value = jurusan;
    });
  }

  // Event listener untuk modal delete
  const modalDeleteSiswa = document.getElementById("modalDeleteSiswa");
  if (modalDeleteSiswa) {
    modalDeleteSiswa.addEventListener("show.bs.modal", (event) => {
      const button = event.relatedTarget;

      const id = button.getAttribute("data-id");
      const nama = button.getAttribute("data-nama");

      // Masukkan data ke dalam modal
      const modalBody = modalDeleteSiswa.querySelector(".modal-body");
      modalBody.querySelector("#delete-nama").textContent = nama; // Tampilkan nama

      const modalFooter = modalDeleteSiswa.querySelector(".modal-footer");
      modalFooter.querySelector("#delete-id").value = id; // Isi hidden input ID
    });
  }
});
