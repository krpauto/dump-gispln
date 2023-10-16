<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    </div>
    <div id="map" style="width: 100%; height: 400px;"></div>
    <script type="text/javascript">
        var data = [
            <?php
            foreach ($bencana as $key => $r) { ?> {
                    "lokasi": [<?= $r->latitudeBencana ?>, <?= $r->longitudeBencana ?>],
                    "kecamatan": "<?= $r->kecamatanBencana ?>",
                    "keterangan": "<?= $r->keteranganBencana ?>",
                    "tempat": "<?= $r->lokasiBencana ?>",
                    "kategori": "<?= $r->kategoriBencana ?>"
                },
            <?php } ?>
        ];

        var map = new L.Map('mapid', {
            zoom: 10,
            center: new L.latLng(-7.8518553, 113.0054501)
        });
        map.addLayer(new L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoicHVzaW5nYWFhIiwiYSI6ImNsaTV6MDdxbjEzZ2ozZW1sazJjaXg3YzAifQ.nztQfmRkQAXxD1Xj9SP_1g', {
            attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
                '<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
                'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
            id: 'mapbox/streets-v11'
        }));

        var markersLayer = new L.LayerGroup();
        map.addLayer(markersLayer);

        var controlSearch = new L.Control.Search({
            position: 'topleft',
            layer: markersLayer,
            initial: false,
            zoom: 25,
            marker: false
        });

        map.addControl(new L.Control.Search({

            layer: markersLayer,
            initial: false,
            collapsed: true,
        }));

        var angin = L.icon({
            iconUrl: '<?= base_url('public/icon/angin.png') ?>',
            iconSize: [30, 30]
        });

        var banjir = L.icon({
            iconUrl: '<?= base_url('public/icon/banjir.png') ?>',
            iconSize: [30, 30]
        });

        var gempabumi = L.icon({
            iconUrl: '<?= base_url('public/icon/gempabumi.png') ?>',
            iconSize: [30, 30]
        });

        var kebakaran = L.icon({
            iconUrl: '<?= base_url('public/icon/kebakaran.png') ?>',
            iconSize: [30, 30]
        });

        var kecelakaan = L.icon({
            iconUrl: '<?= base_url('public/icon/kecelakaan.png') ?>',
            iconSize: [30, 30]
        });

        var longsor = L.icon({
            iconUrl: '<?= base_url('public/icon/longsor.png') ?>',
            iconSize: [30, 30]
        });

        var pohontumbang = L.icon({
            iconUrl: '<?= base_url('public/icon/pohontumbang.png') ?>',
            iconSize: [30, 30]
        });

        var tsunami = L.icon({
            iconUrl: '<?= base_url('public/icon/tsunami.png') ?>',
            iconSize: [30, 30]
        });

        var icons = "";
        for (i in data) {
            var kecamatan = data[i].kecamatan;
            var lokasi = data[i].lokasi;
            var tempat = data[i].tempat;
            var keterangan = data[i].keterangan;
            var kategori = data[i].kategori;

            if (kategori == "banjir") {
                icons = banjir;
            } else if (kategori == "angin") {
                icons = angin;
            } else if (kategori == "tsunami") {
                icons = tsunami;

            } else if (kategori == "gempabumi") {
                icons = gempabumi;

            } else if (kategori == "kebakaran") {
                icons = kebakaran;

            } else if (kategori == "kecelakaan") {
                icons = kecelakaan;
            } else if (kategori == "longsor") {
                icons = longsor;
            } else if (kategori == "pohontumbang") {
                icons = pohontumbang;
            }

            var marker = new L.Marker(new L.latLng(lokasi), {
                title: kecamatan,
                icon: icons
            });
            marker.bindPopup('<b>Nama ODP: ' + kecamatan + ' <br> Lokasi: ' + tempat + '<br> Keterangan: ' + keterangan + '</b>');
            markersLayer.addLayer(marker);
        }
    </script>


    <div class="row">
    </div>

    <div class="col-xl-3 col-md-6 mb-4" id="user">
        <div class="card border-left-secondary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total ODP
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jmlOdp ?> Data</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-user-friends fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4" id="user">
        <div class="card border-left-secondary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total User
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jmlUser ?> Data</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-user-friends fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>

</div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->


<!-- Page level plugins -->
<script src="https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoicHVzaW5nYWFhIiwiYSI6ImNsaTV6MDdxbjEzZ2ozZW1sazJjaXg3YzAifQ.nztQfmRkQAXxD1Xj9SP_1g" async defer></script>
<script src="<?= base_url(); ?>assets/js/jquery.min.js"></script>
<script src="<?= base_url(); ?>assets/sbadmin/vendor/chart.js/Chart.min.js"></script>
<!-- Page level custom scripts -->
<script src="<?= base_url(); ?>assets/js/chart/chart-area.js"></script>
<script src="<?= base_url(); ?>assets/js/chart/pie-chart.js"></script>

<script src="<?= base_url(); ?>assets/sweetalert2/dist/sweetalert2.all.min.js"></script>
<script src="<?= base_url(); ?>assets/js/dashboard.js"></script>

<?php if ($this->session->flashdata('Pesan')) : ?>

<?php else : ?>
    <script>
        $(document).ready(function() {
            let timerInterval
            Swal.fire({
                title: 'Memuat...',
                timer: 1000,
                onBeforeOpen: () => {
                    Swal.showLoading()
                },
                onClose: () => {
                    clearInterval(timerInterval)
                }
            }).then((result) => {
                $("#barang").addClass("bounceIn");
                $("#odp").addClass("bounceIn");
                $("#stok").addClass("bounceIn");
                $("#user").addClass("bounceIn");
                $("#grafik").addClass("bounceIn");
                $("#grafikpie").addClass("bounceIn");
                $("#bmterakhir").addClass("bounceIn");
                $("#bkterakhir").addClass("bounceIn");
            })
        });
    </script>
<?php endif; ?>