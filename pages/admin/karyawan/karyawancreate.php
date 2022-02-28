<?php
    if(isset($_POST['button_create'])){
        
        $database = new Database;
        $db = $database->getConnection();

        // ini untuk validasi input
        $validasi = "SELECT * FROM karyawan WHERE nik = ?";
        $stmt = $db->prepare($validasi);
        $stmt->bindParam(1, $_POST['nik']);
        $stmt->execute();

        if($stmt->rowCount() > 0 ){
        ?>
            <div class="alert alert-danger alert-dismissible">
                <button class="close" type="button" data-dismiss="alert" aria-hidden="true">x</button>
                <h5><i class="icon fas fa-check"></i> Gagal </h5>
                Nama Karyawan Sama sudah ada.
            </div>
        
        <?php
        }else{
            $validasiUsername = "SELECT * FROM karyawan WHERE username = ?";
            $stmt = $db->prepare($validasiUsername);
            $stmt->bindParam(1, $_POST['username']);
            $stmt->execute();

            if($stmt->rowCount() > 0 ){
            ?>
                <div class="alert alert-danger alert-dismissible">
                    <button class="close" type="button" data-dismiss="alert" aria-hidden="true">x</button>
                    <h5><i class="icon fas fa-check"></i> Gagal </h5>
                    Username Karyawan Sama sudah ada.
                </div>
            
            <?php
            } else{

            $md5Pass = md5($_POST['password']);
            $insertSQL = "INSERT INTO pengguna VALUES (NULL, ?, ?, ?, NULL)";
            $stmt = $db->prepare($insertSQL);  
            $stmt->bindParam(1, $_POST['username']);
            $stmt->bindParam(2, $md5Pass);
            $stmt->bindParam(3, $_POST['peran']);
            
            if($stmt->execute()){
                $pengguna_id = $db->lastInsertId();

                $insertKaryawanSql = "INSERT INTO karyawan VALUES (NULL, ?, ?, ?, ?, ?, ?)";
                $stmKry = $db->prepare($insertKaryawanSql);
                $stmtKaryawan->bindParam(1, $_POST['nik']);
                $stmtKaryawan->bindParam(2, $_POST['nama_lengkap']);
                $stmtKaryawan->bindParam(3, $_POST['handphone']);
                $stmtKaryawan->bindParam(4, $_POST['email']);
                $stmtKaryawan->bindParam(5, $_POST['tanggal_masuk']);
                $stmtKaryawan->bindParam(6, $_pengguna_id);

                if($stmtKaryawan->execute()){
                $_SESSION['hasil'] = true;
                $_SESSION['pesan'] = "Berhasil Simpan Data";
            }else{
                $_SESSION['hasil'] = false;
                $_SESSION['pesan'] = "Gagal Simpan Data";
            }
            echo "<meta http-equiv='refresh' content='0;url=?page=karyawanread'>";
        }
    }
?>

<!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Lokasi</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item">Lokasi</li>
              <li class="breadcrumb-item active">Tambah Lokasi</li>
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
                <h3 class="card-title">Tambah Lokasi</h3>
                <a href="?page=lokasiread" class="btn btn-danger btn-sm float-right">
                Kembali
                </a>
            </div>

            <div class="card-body">
                <form action="" method="post">
                    <div class="form-group">
                        <label for="nik">NIK</label>
                        <input type="text" name="nik" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="nama_lengkap">Nama Lengkap</label>
                        <input type="text" name="nama_lengkap" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="hp">Handphone</label>
                        <input type="text" name="hp" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="tgl_masuk">Tanggal Masuk</label>
                        <input type="date" name="tgl_masuk" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" name="username" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="password">Ulangi Password</label>
                        <input type="password" name="ulang_password" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="peran">Peran</label>
                        <select name="peran" class="form-control">
                            <option value="" selected>--Pilih Peran --</option>
                            <option value="ADMIN">ADMIN</option>
                            <option value="USER">USER</option>
                        </select>
                    </div>
                    <a href="?page=lokasiread" class="btn btn-danger btn-sm float-right">
                        <i class="fa fa-times"></i> Batal
                    </a> 
                    <button type="submit" name="button_create" class="btn btn-success btn-sm float-right">
                        <i class="fa fa-save"></i> Simpan
                    </button>
                </form>
            </div>
        </div>
    </div>
    <!-- /.content -->
<?php include_once "partials/scripts.php" ?>