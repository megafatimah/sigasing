<?php include_once "partials/cssdatatables.php"  ?>
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <?php
            if (isset($_SESSION['hasil'])) {
                if ($_SESSION['hasil']) {
            ?>

                    <div class="alert alert-success alert-dismissible">
                        <button class="close" type="button" data-dismiss="alert" aria-hidden="true">x</button>
                        <h5><i class="icon fas fa-check"></i> Berhasil </h5>
                        <?= $_SESSION['pesan'] ?>
                    </div>

                <?php
                } else {
                ?>
                    <div class="alert alert-danger alert-dismissible">
                        <button class="close" type="button" data-dismiss="alert" aria-hidden="true">x</button>
                        <h5><i class="icon fas fa-check"></i> Gagal </h5>
                        <?= $_SESSION['pesan'] ?>
                    </div>
            <?php
                }
                unset($_SESSION['hasil']);
                unset($_SESSION['pesan']);
            }

            ?>
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Karyawan</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Karyawan</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Data Karyawan</h3>
                <a href="?page=karyawancreate" class="btn btn-success btn-sm float-right">
                    <i class="fa fa-plus-circle"></i> Tambah Data
                </a>
            </div>

            <div class="card-body">
                <table id="mytable" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>NO.</th>
                            <th>NIK</th>
                            <th>Nama Karyawan</th>
                            <th>Bagian</th>
                            <th>Jabatan</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>NO.</th>
                            <th>NIK</th>
                            <th>Nama Karyawan</th>
                            <th>Bagian</th>
                            <th>Jabatan</th>
                            <th>Opsi</th>
                        </tr>
                    </tfoot>
                    <tbody>

                        <!-- script php here -->
                        <?php
                        $database = new Database;
                        $db = $database->getConnection();

                        $selectSql = "SELECT K.*,
                            (
                            SELECT J.nama_jabatan FROM jabatan_karyawan AS JK
                            JOIN jabatan AS J ON JK.jabatan_id = J.id
                            WHERE JK.karyawan_id = K.id ORDER BY JK.tanggal_mulai DESC LIMIT 1
                            ) AS jabatan_terkini,	
                            (
                            SELECT B.nama_bagian FROM bagian_karyawan AS BK
                            JOIN bagian AS B ON BK.bagian_id = b.id
                            WHERE BK.karyawan_id = K.id ORDER BY BK.tanggal_mulai DESC LIMIT 1
                            ) AS bagian_terkini
                            
                            FROM karyawan AS K";

                        $stmt = $db->prepare($selectSql);
                        $stmt->execute();

                        $no = 1;
                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

                        ?>
                            <tr>
                                <td><?= $no++ ?> </td>
                                <td><?= $row['nik'] ?></td>
                                <td><?= $row['nama_lengkap'] ?></td>
                                <td><?= $row['bagian_terkini'] ?></td>
                                <td><?= $row['jabatan_terkini'] ?></td>
                                <td>
                                    <a href="?page=lokasiupdate&id=<?= $row['id'] ?>" class="btn btn-primary btn-sm mr-1">
                                        <i class="fa fa-edit"></i> Ubah
                                    </a>

                                    <a href="?page=lokasidelete&id=<?= $row['id'] ?>" class="btn btn-danger btn-sm mr-1" onclick="javascript: return confirm('Konfirmasi data akan dihapus ?');">
                                        <i class="fa fa-trash"></i> Hapus
                                    </a>
                                </td>
                            </tr>
                        <?php } ?>

                        <!-- end script php -->

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- /.content -->
    <?php include_once "partials/scripts.php" ?>
    <?php include_once "partials/scriptsdatatables.php" ?>
    <script>
        $(function() {
            $('#mytable').DataTable()
        });
    </script>