<?php
if ($levelRule == 4 || $levelRule == 5) { ?>
    <h2 style="font-weight: lighter; margin-bottom: 20px"><img src="img/Icon Reminder.png" style="width: 17px;"> Reminder Preventive Maintenance!</h2>
    <table class="row-border" style="width:100%">
        <thead>
            <tr>
                <td>Tipe Mesin</td>
                <td>Komponen</td>
                <td>TM</td>
                <td>Selesai</td>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($data = mysqli_fetch_array($ambildataSparepartTM)) {
                $idTM = $data['id_sparepart_tm'];
                $namaTipe = $data['nama_mesin'];
                $namaSparepart = $data['nama_sparepart'];
                $tanggalTM = $data['tanggal_tm'];
                $selisihHari = strtotime($tanggalTM) - strtotime($tanggalHariIni);
                $selisihHari = $selisihHari / 86400;
                $nilaiTM = $data['nilai_tm'];
                $updateTM = date('Y-m-d', strtotime($tanggalTM . ' + ' . $nilaiTM . ' days'));
                if ($selisihHari <= 3) {
                    $hitungReminder = $hitungReminder + 1;
                }
                if ($selisihHari <= 7) { ?>
                    <tr>
                        <td><?= $namaTipe; ?></td>
                        <td><?= $namaSparepart; ?></td>
                        <td style="text-align: center;">H - <?= $selisihHari; ?></td>
                        <td style="text-align: center;">
                            <a href="#" onclick="openModalFinish('Sudahkah Anda yakin keseluruhan preventive maintenance dari [ <?= $namaSparepart; ?> ] selesai?', '<?= $idTM; ?>', '<?= $updateTM; ?>')"><img src="img/Icon Fix.svg" style="width: 17px;"></a>
                        </td>
                    </tr>
                <?php } ?>
            <?php }
            ($statNotify == false) ? $_SESSION['statNotify'] = true : $hitungReminder = 0; ?>
        </tbody>
    </table>
<?php } ?>