<?php
$url = $_SERVER['REQUEST_URI'];
$path = parse_url($url, PHP_URL_PATH);
?>
<div class="box-inspeksi box">
    <div class="flex flex-center" style="margin: 35px;">
        <img src="img/Logo.png" width="50px">
        &nbsp;
        <p style="font-size: 22px; color: white;">INSPEKSI</p>
    </div>
    <div style="margin: 35px;">
        <div>
            <?php if ($path == '/hse/form-inspeksi' || $path == '/hse/preview-inspeksi') { ?>
                <table style="width: 250px; margin-bottom: 20px; padding: 5px;">
                    <tr>
                        <th colspan="2" style="text-align: left;">
                            <p style="border-bottom: 1px solid;">Inspektor</p>
                        </th>
                    </tr>
                    <tr>
                        <td width="40px"><img src="img/Icon Inspektor.png"></td>
                        <td>
                            <h2 style="font-size: 22px; font-weight: 600;">
                                <?= ($path == '/hse/preview-inspeksi') ? $namaInspektor : $nama; ?>
                            </h2>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><?= ($path == '/hse/preview-inspeksi') ? $ruleInspektor : $namaRule; ?></td>
                    </tr>
                </table>
                <table style="width: 250px; margin-bottom: 20px;">
                    <tr>
                        <th colspan="2" style="text-align: left;">
                            <p style="border-bottom: 1px solid;">Tanggal Inspeksi</p>
                        </th>
                    </tr>
                    <tr>
                        <td width="40px"><img src="img/Icon Tanggal.png"></td>
                        <td>
                            <h2 style="font-size: 24px; font-weight: 500;">
                                <?= ($path == '/hse/preview-inspeksi') ? $tanggalInspeksi : $tanggalHariIni; ?>
                            </h2>
                        </td>
                    </tr>
                </table>
            <?php } else if ($path == '/hse/form-maintenance' || $path == '/hse/maintenance-progress') { ?>
                <table style="width: 250px; margin-bottom: 20px; padding: 5px;">
                    <tr>
                        <th colspan="2" style="text-align: left;">
                            <p style="border-bottom: 1px solid;">Inspektor</p>
                        </th>
                    </tr>
                    <tr>
                        <td width="40px"><img src="img/Icon Inspektor.png"></td>
                        <td>
                            <h2 style="font-size: 22px; font-weight: 600;"><?= $namaInspektor; ?></h2>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><?= $ruleInspektor; ?></td>
                    </tr>
                </table>
                <table style="width: 250px; margin-bottom: 20px;">
                    <tr>
                        <th colspan="2" style="text-align: left;">
                            <p style="border-bottom: 1px solid;">Tanggal Inspeksi</p>
                        </th>
                    </tr>
                    <tr>
                        <td width="40px"><img src="img/Icon Tanggal.png"></td>
                        <td>
                            <h2 style="font-size: 24px; font-weight: 500;"><?= $tanggalInspeksi; ?></h2>
                        </td>
                    </tr>
                </table>
                <br>
                <table style="width: 250px; margin-bottom: 20px; padding: 5px;">
                    <tr>
                        <th colspan="2" style="text-align: left;">
                            <p style="border-bottom: 1px solid;">Teknisi</p>
                        </th>
                    </tr>
                    <tr>
                        <td width="40px"><img src="img/Icon Inspektor.png"></td>
                        <td>
                            <h2 style="font-size: 22px; font-weight: 600;"><?= $nama; ?></h2>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><?= $namaRule; ?></td>
                    </tr>
                </table>
                <?php if ($path == '/hse/form-maintenance') { ?>
                    <table style="width: 250px; margin-bottom: 20px;">
                        <tr>
                            <th colspan="2" style="text-align: left;">
                                <p style="border-bottom: 1px solid;">Tanggal Maintenance</p>
                            </th>
                        </tr>
                        <tr>
                            <td width="40px"><img src="img/Icon Tanggal.png"></td>
                            <td>
                                <h2 style="font-size: 24px; font-weight: 500;"><?= $tanggalHariIni; ?></h2>
                            </td>
                        </tr>
                    </table>
                <?php } else if ($path == '/hse/maintenance-progress') { ?>
                    <table style="width: 250px; margin-bottom: 20px;">
                        <tr>
                            <th colspan="2" style="text-align: left;">
                                <p style="border-bottom: 1px solid;">Mulai Maintenance</p>
                            </th>
                        </tr>
                        <tr>
                            <td width="40px"><img src="img/Icon Tanggal.png"></td>
                            <td>
                                <h2 style="font-size: 24px; font-weight: 500;"><?= $tanggalMaintenance; ?></h2>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">Sekarang, <?= $tanggalHariIni; ?></td>
                        </tr>
                    </table>
            <?php }
            } ?>
        </div>
    </div>
</div>