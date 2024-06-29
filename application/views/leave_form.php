<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir Permintaan Cuti</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script>
        window.onload = function() {
            getLocation();
        };

        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition, showError);
            } else {
                alert("Geolocation tidak didukung oleh browser ini.");
            }
        }

        function showPosition(position) {
            var latitude = position.coords.latitude;
            var longitude = position.coords.longitude;
            var url = "https://www.google.com/maps/search/?api=1&query=" + latitude + "," + longitude;
            document.getElementById('location').value = url;
        }

        function showError(error) {
            switch(error.code) {
                case error.PERMISSION_DENIED:
                    alert("Pengguna menolak permintaan geolocation.");
                    break;
                case error.POSITION_UNAVAILABLE:
                    alert("Informasi lokasi tidak tersedia.");
                    break;
                case error.TIMEOUT:
                    alert("Permintaan untuk mendapatkan lokasi pengguna habis waktu.");
                    break;
                case error.UNKNOWN_ERROR:
                    alert("Terjadi kesalahan yang tidak diketahui.");
                    break;
            }
        }
    </script>
</head>
<body>
    <header class="bg-primary text-white p-3 mb-3">
        <div class="container">
            <h1 class="h3">Formulir Permintaan Cuti</h1>
            <nav class="navbar navbar-expand-lg navbar-dark">
                <a class="navbar-brand" href="#">Sistem Cuti</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url('/welcome/listCuti'); ?>">List Cuti</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url("/"); ?>">Form Permintaan CUti</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </header>
    <div class="container mt-5">
        <h1 class="mb-4">Formulir Permintaan Cuti</h1>
        <?= $this->session->flashdata('message'); ?>
        <form action="<?= base_url('welcome/submit_leave_request') ?>" method="post">
            <div class="form-group">
                <label for="employee_id">Pilih Karyawan:</label>
                <select class="form-control" id="employee_id" name="employee_id" required>
                    <option value="" disabled selected>Pilih Karyawan</option>
                    <?php foreach ($employees as $employee): ?>
                        <option value="<?= $employee->id ?>"><?= $employee->first_name . ' ' . $employee->last_name ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="start_date">Tanggal Mulai:</label>
                <input type="date" class="form-control" id="start_date" name="start_date" required>
            </div>
            <div class="form-group">
                <label for="end_date">Tanggal Akhir:</label>
                <input type="date" class="form-control" id="end_date" name="end_date" required>
            </div>
            <div class="form-group">
                <label for="location">Lokasi:</label>
                <input type="text" class="form-control" id="location" name="location">
            </div>
            <button type="submit" class="btn btn-primary">Kirim</button>
        </form>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
