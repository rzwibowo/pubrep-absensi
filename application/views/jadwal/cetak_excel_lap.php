<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Kehadiran</title>

    <?php
    header("Content-type: application/vnd-ms-excel");
    header("Content-disposition: attachment; filename=Laporan Kehadiran " . $tahun . "_" . $bulan . "_" . $unit . ".xls");
    ?>

    <style>
        h3 {
            text-align: center;
        }

        table {
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid black;
            padding: 3px;
        }

        td:last-child {
            text-align: right;
        }

        .text-center {
            text-align: center;
        }

        .text-danger {
            color: red;
        }
    </style>
</head>

<body>
    <h3>Laporan Kehadiran <?php echo $unit ?> Bulan <?php echo $bulan ?> <?php echo $tahun ?> </h3>

    <table>
        <?php echo $jadwal ?>
    </table>

    <h5>Total Potongan</h5>
    <table>
        <?php echo $keterangan ?>
    </table>
</body>

</html>