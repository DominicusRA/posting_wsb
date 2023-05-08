<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="<?= base_url('index.php/posting_controller/piutang') ?>" method="POST">
        Bulan:
        <input type="number" id="bulan" min="1" max="12" name="bulan">
        Tahun:
        <input type="number" id="tahun" min="1" max="<?= date('Y') ?>" name="tahun">
        <button type="submit">posting</button>
    </form>
</body>

</html>