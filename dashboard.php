<?php
// TUGAS UTAMA SISWA:
// 1. Mulai session (session_start())
// 2. Buat pengecekan (if-else)
//    Jika TIDAK ADA session 'username' (atau 'user_id'),
//    maka redirect (paksa) pengguna kembali ke halaman index.php
//
// session_set_cookie_params([
//     'lifetime' => 0,
//     'path' => '/',
//     'domain' => '',
//     'secure' => false,
//     'httponly' => true,
//     'samesite' => 'Lax'
// ]);
// session_start();

// if (!isset($_SESSION['username'])) {
//     // Karena file ini berada di `front-end/`, redirect ke root index naik satu level
//     header("Location: ../index.php");
//     exit(); // Penting untuk menghentikan eksekusi script
// }
// Tambahkan header untuk mencegah caching oleh browser sehingga tombol back tidak menampilkan halaman cache
// header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
// header('Cache-Control: post-check=0, pre-check=0', false);
// header('Pragma: no-cache');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Manajemen Siswa</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <style>
        body {
            /* Mencegah scroll horizontal */
            overflow-x: hidden;
        }

        #sidebar {
            /* Sidebar menempel di kiri */
            position: fixed;
            top: 0;
            left: 0;
            width: 250px;
            /* Lebar sidebar */
            height: 100vh;
            /* Tinggi 100% viewport */
            z-index: 1000;
            padding: 20px;
            padding-top: 60px;
            /* Jarak untuk navbar 'palsu' di atas */
            background-color: #212529;
            /* Warna dark */
            color: white;
            /* Transisi untuk 'hide/show' (jika nanti ditambahkan) */
            transition: all 0.3s;
        }

        #main-content {
            /* Konten utama di sebelah kanan sidebar */
            margin-left: 250px;
            /* Sama dengan lebar sidebar */
            padding: 20px;
            padding-top: 70px;
            /* Jarak untuk navbar atas */
        }

        /* Navbar atas yang menempel */
        #top-navbar {
            position: fixed;
            top: 0;
            left: 250px;
            /* Mulai setelah sidebar */
            right: 0;
            z-index: 999;
            background-color: #f8f9fa;
            /* Warna light */
            padding: 1rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, .1);
        }
    </style>
</head>

<body class="bg-light">

    <div id="sidebar" class="d-flex flex-column p-3">
        <a href="dashboard.php" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
            <i class="bi bi-box-seam-fill me-2" style="font-size: 2rem;"></i>
            <span class="fs-4">AdminSiswa</span>
        </a>
        <hr>
        <ul class="nav nav-pills flex-column mb-auto">
            <li class="nav-item">
                <a href="dashboard.php" class="nav-link active" aria-current="page">
                    <i class="bi bi-people-fill me-2"></i>
                    Data Siswa
                </a>
            </li>
            <li>
                <a href="#" class="nav-link text-white">
                    <i class="bi bi-person-badge-fill me-2"></i>
                    Data Guru (Contoh)
                </a>
            </li>
            <li>
                <a href="#" class="nav-link text-white">
                    <i class="bi bi-journals me-2"></i>
                    Data Mata Pelajaran
                </a>
            </li>
        </ul>
        <hr>
        <div class="dropdown">
            <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="bi bi-person-circle me-2" style="font-size: 2rem;"></i>
                <strong>
                    <?php
                    // TUGAS SISWA (Bagian 2: Personalisasi)
                    // Tampilkan nama pengguna dari SESSION
                    //echo htmlspecialchars($_SESSION['nama_lengkap'] ?? 'Pengguna');
                    echo "Nama Pengguna"; // Placeholder
                    ?>
                </strong>
            </a>
            <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
                <li><a class="dropdown-item" href="#">Profile</a></li>
                <li><a class="dropdown-item" href="#">Settings</a></li>
                <li>
                    <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item" href="../back-end/logout.php">Sign out</a></li>
            </ul>
        </div>
    </div>

    <nav id="top-navbar" class="navbar navbar-light">
        <div class="container-fluid">
            <span class="navbar-brand mb-0 h1">Manajemen Data Siswa</span>
        </div>
    </nav>

    <div id="main-content">
        <div class="container-fluid">

            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <div class="row g-3 align-items-center">
                        <div class="col-md-6">
                            <form action="dashboard.php" method="GET">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Cari nama atau NIS siswa..." name="search" value="<?php // TUGAS SISWA: echo $_GET['search'] ?? ''; 
                                                                                                                                            ?>">
                                    <button class="btn btn-primary" type="submit">
                                        <i class="bi bi-search"></i> Cari
                                    </button>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-6 text-md-end">
                            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalTambahSiswa">
                                <i class="bi bi-plus-circle-fill me-2"></i>
                                Tambah Data Siswa
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card shadow-sm">
                <div class="card-header">
                    <h5 class="mb-0">Daftar Siswa</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover align-middle">
                            <thead class="table-dark">
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Nama Lengkap</th>
                                    <th scope="col">NIS</th>
                                    <th scope="col">Kelas</th>
                                    <th scope="col">Jurusan</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // TUGAS SISWA (Bagian 3: Menampilkan Data)
                                // 1. Buat koneksi ke database (include config.php)
                                // 2. Buat query SQL untuk SELECT data siswa (DENGAN pagination dan search)
                                //    Contoh: "SELECT * FROM siswa WHERE nama LIKE ? LIMIT ? OFFSET ?"
                                // 3. Lakukan looping (while) untuk menampilkan data:
                                //
                                // $no = 1; // Untuk nomor urut
                                // while($data = mysqli_fetch_assoc($result)) {
                                //     echo "<tr>";
                                //     echo "<td>" . $no++ . "</td>";
                                //     echo "<td>" . htmlspecialchars($data['nama']) . "</td>";
                                //     echo "<td>" . htmlspecialchars($data['nis']) . "</td>";
                                //     echo "<td>" . htmlspecialchars($data['kelas']) . "</td>";
                                //     echo "<td>" . htmlspecialchars($data['jurusan']) . "</td>";
                                //     echo "<td> ... (Tombol Update & Delete) ... </td>";
                                //     echo "</tr>";
                                // }
                                ?>

                                <tr>
                                    <td>1</td>
                                    <td>Agus Setiawan</td>
                                    <td>10203001</td>
                                    <td>XI</td>
                                    <td>PPLG 1</td>
                                    <td>
                                        <button class="btn btn-warning btn-sm"
                                            data-bs-toggle="modal"
                                            data-bs-target="#modalUpdateSiswa"
                                            data-id="1"
                                            data-nama="Agus Setiawan"
                                            data-nis="10203001"
                                            data-kelas="XI"
                                            data-jurusan="PPLG 1">
                                            <i class="bi bi-pencil-square"></i> Update
                                        </button>
                                        <button class="btn btn-danger btn-sm"
                                            data-bs-toggle="modal"
                                            data-bs-target="#modalDeleteSiswa"
                                            data-id="1"
                                            data-nama="Agus Setiawan">
                                            <i class="bi bi-trash-fill"></i> Delete
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Budi Hartono</td>
                                    <td>10203002</td>
                                    <td>XII</td>
                                    <td>TJKT 2</td>
                                    <td>
                                        <button class="btn btn-warning btn-sm"
                                            data-bs-toggle="modal"
                                            data-bs-target="#modalUpdateSiswa"
                                            data-id="2"
                                            data-nama="Budi Hartono"
                                            data-nis="10203002"
                                            data-kelas="XII"
                                            data-jurusan="TJKT 2">
                                            <i class="bi bi-pencil-square"></i> Update
                                        </button>
                                        <button class="btn btn-danger btn-sm"
                                            data-bs-toggle="modal"
                                            data-bs-target="#modalDeleteSiswa"
                                            data-id="2"
                                            data-nama="Budi Hartono">
                                            <i class="bi bi-trash-fill"></i> Delete
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination justify-content-center mb-0">
                            <li class="page-item disabled"><a class="page-link" href="#">Previous</a></li>
                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link" href="#">Next</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalTambahSiswa" tabindex="-1" aria-labelledby="labelModalTambah" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="labelModalTambah">Tambah Data Siswa</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="proses_tambah_siswa.php" method="POST">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" id="nama" name="nama" required>
                        </div>
                        <div class="mb-3">
                            <label for="nis" class="form-label">NIS</label>
                            <input type="text" class="form-control" id="nis" name="nis" required>
                        </div>
                        <div class="mb-3">
                            <label for="kelas" class="form-label">Kelas</label>
                            <input type="text" class="form-control" id="kelas" name="kelas" placeholder="Contoh: XI" required>
                        </div>
                        <div class="mb-3">
                            <label for="jurusan" class="form-label">Jurusan</label>
                            <select class="form-select" id="jurusan" name="jurusan" required>
                                <option value="">-- Pilih Jurusan --</option>
                                <option value="PPLG 1">Pengembangan Perangkat Lunak dan Gim 1</option>
                                <option value="PPLG 2">Pengembangan Perangkat Lunak dan Gim 2</option>
                                <option value="TJKT 1">Teknik Jaringan Komputer dan Telekomunikasi 1</option>
                                <option value="TJKT 2">Teknik Jaringan Komputer dan Telekomunikasi 2</option>
                                <option value="DKV">Desain Komunikasi Visual</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-success">Simpan Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalUpdateSiswa" tabindex="-1" aria-labelledby="labelModalUpdate" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="labelModalUpdate">Update Data Siswa</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="proses_update_siswa.php" method="POST">
                    <input type="hidden" name="id" id="update-id">

                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="update-nama" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" id="update-nama" name="nama" required>
                        </div>
                        <div class="mb-3">
                            <label for="update-nis" class="form-label">NIS</label>
                            <input type="text" class="form-control" id="update-nis" name="nis" required>
                        </div>
                        <div class="mb-3">
                            <label for="update-kelas" class="form-label">Kelas</label>
                            <input type="text" class="form-control" id="update-kelas" name="kelas" required>
                        </div>
                        <div class="mb-3">
                            <label for="update-jurusan" class="form-label">Jurusan</label>
                            <select class="form-select" id="update-jurusan" name="jurusan" required>
                                <option value="">-- Pilih Jurusan --</option>
                                <option value="PPLG 1">Pengembangan Perangkat Lunak dan Gim 1</option>
                                <option value="PPLG 2">Pengembangan Perangkat Lunak dan Gim 2</option>
                                <option value="TJKT 1">Teknik Jaringan Komputer dan Telekomunikasi 1</option>
                                <option value="TJKT 2">Teknik Jaringan Komputer dan Telekomunikasi 2</option>
                                <option value="DKV">Desain Komunikasi Visual</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Update Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalDeleteSiswa" tabindex="-1" aria-labelledby="labelModalDelete" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h1 class="modal-title fs-5" id="labelModalDelete">Konfirmasi Hapus Data</h1>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Anda yakin ingin menghapus data siswa:
                    <strong id="delete-nama"></strong>?
                    <p class="text-danger small mt-2">Tindakan ini tidak dapat dibatalkan!</p>
                </div>
                <div class="modal-footer">
                    <form action="proses_delete_siswa.php" method="POST">
                        <input type="hidden" name="id" id="delete-id">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger">Ya, Hapus Data</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Event listener untuk modal update
        const modalUpdateSiswa = document.getElementById('modalUpdateSiswa');
        modalUpdateSiswa.addEventListener('show.bs.modal', event => {
            // Tombol yang memicu modal
            const button = event.relatedTarget;

            // Ekstrak data dari atribut data-*
            const id = button.getAttribute('data-id');
            const nama = button.getAttribute('data-nama');
            const nis = button.getAttribute('data-nis');
            const kelas = button.getAttribute('data-kelas');
            const jurusan = button.getAttribute('data-jurusan');

            // Masukkan data ke dalam form di modal
            const modalBody = modalUpdateSiswa.querySelector('.modal-body');
            modalBody.querySelector('#update-id').value = id;
            modalBody.querySelector('#update-nama').value = nama;
            modalBody.querySelector('#update-nis').value = nis;
            modalBody.querySelector('#update-kelas').value = kelas;
            modalBody.querySelector('#update-jurusan').value = jurusan;
        });

        // Event listener untuk modal delete
        const modalDeleteSiswa = document.getElementById('modalDeleteSiswa');
        modalDeleteSiswa.addEventListener('show.bs.modal', event => {
            const button = event.relatedTarget;

            const id = button.getAttribute('data-id');
            const nama = button.getAttribute('data-nama');

            // Masukkan data ke dalam modal
            const modalBody = modalDeleteSiswa.querySelector('.modal-body');
            modalBody.querySelector('#delete-nama').textContent = nama; // Tampilkan nama

            const modalFooter = modalDeleteSiswa.querySelector('.modal-footer');
            modalFooter.querySelector('#delete-id').value = id; // Isi hidden input ID
        });
    </script>
</body>

</html>