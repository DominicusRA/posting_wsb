<!DOCTYPE html>
<html lang="en">
<?php
$this->load->view('addition/head.php');
?>


<body class="hold-transition layout-top-nav">

    <div class="wrapper">


        <?php
        $this->load->view('addition/navbar.php');
        ?>



        <div class="content-wrapper bg-primary" style="background-image: url('<?php echo base_url() ?>assets/image/background.png'); height: 100vh;">

            <div class="content-header">
                <div class="container my-4">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0"> Selamat Datang, Raka</h1>
                            <p class="font-weight-light">Jangan lupa berdoa dan bersyukur ya</p>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <!-- <li class="breadcrumb-item"><a href="<?php echo base_url('index.php/dashboard_controller') ?>">Dashboard</a></li> -->
                                <!-- <li class="breadcrumb-item"><a href="#">Layout</a></li>
                                <li class="breadcrumb-item active">Top Navigation</li> -->
                            </ol>
                        </div>
                    </div>
                </div>
            </div>



            <div class="content">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-2 d-flex justify-content-around justify-content-start">
                            <button type="button" class="btn btn-light rounded-pill" data-toggle="modal" data-target="#posting">Posting</button>
                        </div>
                        <div class="col"></div>
                    </div>
                    <div class="row my-5">
                        <div class="col">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <canvas id="donutChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card">
                                <div class="card-body">

                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card">
                                <div class="card-body">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>



        <aside class="control-sidebar control-sidebar-dark">

        </aside>
        <?php
        $this->load->view('addition/footer.php');
        ?>

    </div>

    <div class="modal fade" id="posting" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <!-- <form action="<?= base_url('index.php/posting_controller/piutang') ?>" method="POST"> -->
                    <div class="row">
                        <div class="col">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="piutang" id="jenis_posting[]" name="jenis_posting[]" disabled>
                                                <label class="form-check-label" for="jenis_posting">
                                                    Semua
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="piutang" id="jenis_posting[]" name="jenis_posting[]">
                                                <label class="form-check-label" for="jenis_posting">
                                                    Piutang
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="hutang" id="jenis_posting[]" name="jenis_posting[]" disabled>
                                                <label class="form-check-label" for="jenis_posting">
                                                    Hutang
                                                </label>
                                            </div>
                                        </div>
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
                            <button type="submit" onclick="posting()" class="btn btn-primary btn-block">Posting</button>
                        </div>
                    </div>

                    <!-- Bulan:
                            <input type="number" id="bulan" min="1" max="12" name="bulan">
                            Tahun:
                            <input type="number" id="tahun" min="1" max="<?= date('Y') ?>" name="tahun">
                            <button type="submit">posting</button> -->
                    <!-- </form> -->
                </div>
                <!-- <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div> -->
            </div>
        </div>
    </div>
    <div class="modal fade" id="proses" data-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">Proses Posting</div>
                <div class="modal-body">
                    <div class="progress">
                        <div class="progress-bar progress-bar-striped progress-bar-animated" id="progressBar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%"></div>
                    </div>
                    <div class="row my-2">
                        <div class="col d-flex justify-content-center h5">
                            100 % Selesai

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>





    <!-- ChartJS -->
    <script src="<?php echo base_url() ?>assets/plugins/chart.js/Chart.min.js"></script>
    <script src="<?php echo base_url() ?>assets/plugins/jquery/jquery.min.js"></script>

    <script src="<?php echo base_url() ?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script src="<?php echo base_url() ?>assets/dist/js/adminlte.min.js"></script>
    <script>
        //-------------
        //- DONUT CHART -
        //-------------
        // Get context with jQuery - using jQuery's .get() method.
        var donutChartCanvas = $('#donutChart').get(0).getContext('2d')
        var donutData = {
            labels: [
                'Chrome',
                'IE',
                'FireFox',
                'Safari',
                'Opera',
                'Navigator',
            ],
            datasets: [{
                data: [700, 500, 400, 600, 300, 100],
                backgroundColor: ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
            }]
        }
        var donutOptions = {
            maintainAspectRatio: false,
            responsive: true,
        }
        new Chart(donutChartCanvas, {
            type: 'doughnut',
            data: donutData,
            options: donutOptions
        })
    </script>
    <script>
        function posting() {
            const jenis = []
            var bulan = $('#bulan').val();
            var tahun = $('#tahun').val();
            var jenis_posting = document.getElementsByName('jenis_posting[]');
            for (i = 0; i < jenis_posting.length; i++) {
                if (jenis_posting[i].checked) {
                    jenis.push(jenis_posting[i].value)
                }
            }
            $('#posting').modal('hide');
            $('#proses').modal('show');
            $.ajax({
                type: "POST",
                url: "<?= base_url('index.php/posting_controller/piutang') ?>",
                dataType: "JSON",
                data: {
                    bulan: bulan,
                    tahun: tahun,
                    jenis: jenis
                },
                xhr: function() {
                    var xhr = new window.XMLHttpRequest();
                    // Memonitor kemajuan permintaan AJAX
                    xhr.upload.addEventListener("progress", function(evt) {
                        if (evt.lengthComputable) {
                            var percentComplete = (evt.loaded / evt.total) * 100;
                            // Ubah nliai progres bar
                            console.log(percentComplete)
                            // $('#progressBar').val(percentComplete);
                            $('#progressBar').css('width', percentComplete + '%').attr('aria-valuenow', percentComplete);
                        }
                    }, false);
                    return xhr;
                },
                success: function(data) {
                    console.log(data)
                },
                error: function(error) {
                    console.log(error)
                }

            });
            console.log("ini jalan kan ?")
        }
    </script>

</body>

</html>