<div class="logo">
    <img src="img/Logo.png" width="50px" />
    &nbsp;
    <p>INSPEKSI</p>
</div>
<div class="menu">
    <?php if ($levelRule == 1) { ?>
        <p>Selamat datang, <?= $nama; ?>!</p>
    <?php } else { ?>
        <ul>
            <li>
                <a href="dashboard">
                    <img src="img/Icon Dashboard.png" style='width: 17px; padding-top: 10px; margin-right: 5px;' />
                    Dashboard
                </a>
            </li>
        <?php } ?>

        <?php if ($levelRule == 1) { ?>
            <ul>
                <li style="margin-top: 100px;"></li>
                <span style="font-size: 16px; color: #40513b; padding: 0px 40px"> - Status Mesin - </span>
                <br>
                <br>
                <?php
                while ($dataStatus = mysqli_fetch_array($ambildataStatus)) {
                    $idStatus = $dataStatus['id_status'];
                    $ketStatus = $dataStatus['keterangan_status'];
                    $cekdataStatus = mysqli_query($conn, "SELECT * FROM mesin WHERE id_status = '$idStatus'");
                    $hitungStatus = mysqli_num_rows($cekdataStatus);
                ?>
                    <span style="font-size: 14px; color: #40513b;">> <?= $ketStatus; ?></span>
                    <br>
                    <span style="font-size: 18px; color: #40513b; margin-left: 14px;"><?= $hitungStatus; ?> Mesin</span>
                    <li style="margin-bottom: 10px;"></li>
                <?php }
            }
            if ($levelRule == 7 || $levelRule == 8) { ?>
                <li style="margin-top: 30px;"></li>
                <li>
                    <a href="data-akun">
                        <img src="img/Icon User.svg" style='width: 17px; padding-top: 10px; margin-right: 5px;' />
                        Data Akun
                    </a>
                </li>
            <?php } ?>
            <li style="margin-top: 30px;"></li>
            <?php if ($levelRule == 2 || $levelRule == 3) { ?>
                <li>
                    <a href="data-inspeksi">
                        <img src="img/Icon Inspeksi.png" style='width: 17px; padding-top: 10px; margin-right: 5px;' />
                        Data Inspeksi
                    </a>
                </li>
            <?php }
            if ($levelRule == 2 || $levelRule == 3 || $levelRule == 4 || $levelRule == 5) { ?>
                <li>
                    <a href="data-maintenance">
                        <img src="img/Icon Validasi.png" style='width: 17px; padding-top: 10px; margin-right: 5px;' />
                        Data Maintenance
                    </a>
                </li>
            <?php }
            if ($levelRule == 2 || $levelRule == 8) { ?>
                <li>
                    <a href="all-inspeksi">
                        <img src="img/Icon Validasi.png" style='width: 17px; padding-top: 10px; margin-right: 5px;' />
                        `Report Inspeksi
                    </a>
                </li>
            <?php }
            if ($levelRule == 2 || $levelRule == 4 || $levelRule == 8) { ?>
                <li>
                    <a href="all-maintenance">
                        <img src="img/Icon Validasi.png" style='width: 17px; padding-top: 10px; margin-right: 5px;' />
                        `Report Maintenance
                    </a>
                </li>
            <?php } ?>

            <li style="margin-top: 30px;"></li>

            <?php
            if ($levelRule == 2 || $levelRule == 3 || $levelRule == 4 || $levelRule == 5 || $levelRule == 6 || $levelRule == 8) { ?>
                <li>
                    <a href="data-mesin">
                        <img src="img/Icon Mesin.png" style='width: 17px; padding-top: 10px; margin-right: 5px;' />
                        Data Mesin
                    </a>
                </li>
                <?php if ($levelRule == 2 || $levelRule == 4 || $levelRule == 5 || $levelRule == 6) { ?>
                    <li>
                        <a href="data-suku-cadang">
                            <img src="img/Icon Stok.png" style='width: 17px; padding-top: 10px; margin-right: 5px;' />
                            Data Suku Cadang
                        </a>
                    </li>
                <?php }
                if ($levelRule == 2 || $levelRule == 4 || $levelRule == 8) { ?>
                    <li>
                        <a href="all-suku-cadang">
                            <img src="img/Icon Stok.png" style='width: 17px; padding-top: 10px; margin-right: 5px;' />
                            `Report SukuCadang
                        </a>
                    </li>
                <?php }
                if ($levelRule == 2 || $levelRule == 8) { ?>
                    <li style="margin-top: 30px;"></li>
                    <li>
                        <a href="item-inspeksi">
                            <img src="img/Icon Detail.svg" style='width: 17px; padding-top: 10px; margin-right: 5px;' />
                            `Daftar Item Inspeksi
                        </a>
                    </li>
                <?php } ?>
            </ul>
        <?php } ?>
</div>