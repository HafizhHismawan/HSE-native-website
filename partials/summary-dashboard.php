<h2 style="font-weight: lighter; margin-bottom: 20px"><img src="img/Icon Summary.png" style="width: 17px;"> Summary Pegawai</h2>
<table id="example" class="row-border" style="width:100%">
    <thead>
        <tr>
            <td>Nama</td>
            <td>Posisi</td>
            <td style="text-align: center;">Inspeksi</td>
            <td style="text-align: center;">Maintenance</td>
            <td style="text-align: center;">Gudang</td>
        </tr>
    </thead>
    <tbody>
        <?php
        while ($data = mysqli_fetch_array($ambildataPegawai)) {
            $idPegawai = $data['id_akun'];
            $namaPegawai = $data['nama_lengkap'];
            $posisiPegawai = $data['nama_rule'];
            $cekInspeksi = mysqli_query($conn, "SELECT * FROM record_inspeksi WHERE id_akun_inspektor = '$idPegawai'");
            $hitungInspeksi = mysqli_num_rows($cekInspeksi);
            $cekMaintenance = mysqli_query($conn, "SELECT * FROM record_inspeksi reci, record_maintenance recm WHERE reci.id_record_inspeksi = recm.id_record_inspeksi AND recm.id_akun_teknisi = '$idPegawai'");
            $hitungMaintenance = mysqli_num_rows($cekMaintenance);
            $cekGudang = mysqli_query($conn, "SELECT * FROM record_sparepart WHERE id_akun_gudang = '$idPegawai'");
            $hitungGudang = mysqli_num_rows($cekGudang);
        ?>
            <tr>
                <td><?= $namaPegawai; ?></td>
                <td><?= $posisiPegawai; ?></td>
                <td style="text-align: center;"><?= ($hitungInspeksi > 0) ? $hitungInspeksi . " kali" : ""; ?></td>
                <td style="text-align: center;"><?= ($hitungMaintenance > 0) ? $hitungMaintenance . " kali" : ""; ?></td>
                <td style="text-align: center;"><?= ($hitungGudang > 0) ? $hitungGudang . " kali" : ""; ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>
<br>
<h2 style="font-weight: lighter; margin-bottom: 20px"><img src="img/Icon Summary.png" style="width: 17px;"> Summary Mesin</h2>
<table id="example" class="row-border" style="width:100%">
    <thead>
        <tr>
            <td>Tipe Mesin</td>
            <td>Nomer Mesin</td>
            <td style="text-align: center;">Inspeksi</td>
            <td style="text-align: center;">Maintenance</td>
            <td style="text-align: center;">Perbaikan Komponen</td>
        </tr>
    </thead>
    <tbody>
        <?php
        while ($data = mysqli_fetch_array($ambildataMesin)) {
            $idMesin = $data['id_mesin'];
            $tipeMesin = $data['nama_mesin'];
            $noMesin = $data['no_mesin'];
            $cekInspeksi = mysqli_query($conn, "SELECT * FROM record_inspeksi WHERE id_mesin = '$idMesin'");
            $hitungInspeksi = mysqli_num_rows($cekInspeksi);
            $cekMaintenance = mysqli_query($conn, "SELECT * FROM record_inspeksi reci, record_maintenance recm WHERE reci.id_record_inspeksi = recm.id_record_inspeksi AND reci.id_mesin = '$idMesin'");
            $hitungMaintenance = mysqli_num_rows($cekMaintenance);
            $cekDataMaintenance = mysqli_query($conn, "SELECT * FROM record_inspeksi reci, record_maintenance recm, data_maintenance dm WHERE reci.id_record_inspeksi = recm.id_record_inspeksi AND recm.id_record_maintenance = dm.id_record_maintenance AND dm.status_data_maintenance = 'Sudah' AND reci.id_mesin = '$idMesin'");
            $hitungDataMaintenance = mysqli_num_rows($cekDataMaintenance);
        ?>
            <tr>
                <td><?= $tipeMesin; ?></td>
                <td><?= $noMesin; ?></td>
                <td style="text-align: center;"><?= $hitungInspeksi; ?> kali</td>
                <td style="text-align: center;"><?= $hitungMaintenance; ?> kali</td>
                <td style="text-align: center;"><?= $hitungDataMaintenance; ?> kali</td>
            </tr>

        <?php } ?>
    </tbody>
</table>
<br>
<h2 style="font-weight: lighter; margin-bottom: 20px"><img src="img/Icon Summary.png" style="width: 17px;"> Summary Suku Cadang</h2>
<table id="example" class="row-border" style="width:100%">
    <thead>
        <tr>
            <td>Tipe Mesin</td>
            <td>Suku Cadang Mesin</td>
            <td style="text-align: center;">Data Keluar</td>
            <td style="text-align: center;">Data Masuk</td>
        </tr>
    </thead>
    <tbody>
        <?php
        while ($data = mysqli_fetch_array($ambildataSparepart)) {
            $idSparepart = $data['id_sparepart'];
            $tipeMesin = $data['nama_mesin'];
            $namaSparepart = $data['nama_sparepart'];
            $cekOutput = mysqli_query($conn, "SELECT * FROM record_sparepart WHERE tindakan = 'Gunakan' AND id_sparepart = '$idSparepart'");
            $hitungOutput = mysqli_num_rows($cekOutput);
            $cekInput = mysqli_query($conn, "SELECT * FROM record_sparepart WHERE tindakan = 'Tambah' AND id_sparepart = '$idSparepart'");
            $hitungInput = mysqli_num_rows($cekInput);
        ?>
            <tr>
                <td><?= $tipeMesin; ?></td>
                <td><?= $namaSparepart; ?></td>
                <td style="text-align: center;"><?= $hitungOutput; ?> catatan</td>
                <td style="text-align: center;"><?= $hitungInput; ?> catatan</td>
            </tr>

        <?php } ?>
    </tbody>
</table>