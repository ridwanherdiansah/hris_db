<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Daftar Cuti</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
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
                        <a class="nav-link" href="<?= base_url("/"); ?>">Form Permintaan Cuti</a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</header>
<div class="container">
    <?= $this->session->flashdata('message'); ?>
    <h2 class="mb-4">Daftar Cuti</h2>
    <a href="<?= base_url("/"); ?>" class="btn btn-primary mb-3">Input Cuti</a>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Employee ID</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Location</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($cuti as $row): ?>
                <tr>
                    <td><?= $row->id ?></td>
                    <td><?= $row->employee_id ?></td>
                    <td><?= $row->start_date ?></td>
                    <td><?= $row->end_date ?></td>
                    <td><?= $row->location ?></td>
                    <td><?= $row->status ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
