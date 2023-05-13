<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/dist/css/adminlte.min.css">
</head>

<body style="background-image: url('<?php echo base_url() ?>assets/image/background.bmp');background-repeat: no-repeat;
  background-attachment: fixed;
  background-size: cover;">
    <nav class="navbar navbar-expand navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item dropdown">
                <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Transaksi</a>
                <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                    <li><a href="<?php echo base_url('index.php/Posting_controller') ?>" class="dropdown-item">Pembelian </a></li>
                    <li><a href="<?php echo base_url('index.php/Posting_controller') ?>" class="dropdown-item">Penjualan </a></li>
                    <li><a href="<?php echo base_url('index.php/Posting_controller') ?>" class="dropdown-item">Pembayaran </a></li>
                </ul>
            </li>
        </ul>
        <ul class="navbar-nav">
            <li class="nav-item dropdown">
                <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Register</a>
                <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                    <li><a href="<?php echo base_url('index.php/Posting_controller') ?>" class="dropdown-item">Posting </a></li>
                    <!-- End Level two -->
                </ul>
            </li>
        </ul>
        <ul class="navbar-nav">
            <li class="nav-item dropdown">
                <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Master</a>
                <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                    <li><a href="<?php echo base_url('index.php/Posting_controller') ?>" class="dropdown-item">Posting </a></li>
                    <!-- End Level two -->
                </ul>
            </li>
        </ul>
        <ul class="navbar-nav">
            <li class="nav-item dropdown">
                <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Laporan</a>
                <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                    <li><a href="<?php echo base_url('index.php/Posting_controller') ?>" class="dropdown-item">Posting </a></li>
                    <!-- End Level two -->
                </ul>
            </li>
        </ul>
        <ul class="navbar-nav">
            <li class="nav-item dropdown">
                <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Proses</a>
                <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                    <li><a href="<?php echo base_url('index.php/Posting_controller') ?>" class="dropdown-item">Posting </a></li>
                    <!-- End Level two -->
                </ul>
            </li>
        </ul>
        <ul class="navbar-nav">
            <li class="nav-item dropdown">
                <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Utility</a>
                <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                    <li><a href="<?php echo base_url('index.php/Posting_controller') ?>" class="dropdown-item">Posting </a></li>
                    <!-- End Level two -->
                </ul>
            </li>
        </ul>
        <ul class="navbar-nav">
            <li class="nav-item dropdown">
                <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Exit</a>
            </li>
        </ul>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">

        </ul>
    </nav>
    <div class="container overflow-auto d-flex align-items-center justify-content-center" style="height: 100vh;">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body ">
                        <form action="<?= base_url('index.php/posting_controller/piutang') ?>" method="POST">

                            <!-- <div class="form-group">
                                <label for="exampleInputEmail1">Bulan</label>
                                <input type="month" class="form-control" id="bulan">
                            </div> -->
                            <div class="row">
                                <div class="col">
                                    <div class="card">
                                        <div class="card-header">
                                            Posting
                                        </div>
                                        <div class="card-body">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="piutang" id="posting" name="posting">
                                                <label class="form-check-label" for="defaultCheck1">
                                                    Piutang
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Bulan</label>
                                        <input type="number" class="form-control" id="bulan" name="bulan" min="1" max="12">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Tahun</label>
                                        <input type="number" class="form-control" id="tahun" min="1" max="<?= date('Y') ?>" name="tahun">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <button type="submit" class="btn btn-primary btn-block">Posting</button>
                                </div>
                            </div>

                            <!-- Bulan:
                            <input type="number" id="bulan" min="1" max="12" name="bulan">
                            Tahun:
                            <input type="number" id="tahun" min="1" max="<?= date('Y') ?>" name="tahun">
                            <button type="submit">posting</button> -->
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="<?php echo base_url() ?>assets/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="<?php echo base_url() ?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo base_url() ?>assets/dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <!-- <script src="<?php echo base_url() ?>assets/dist/js/demo.js"></script> -->
</body>

</html>