<?php
require_once 'koneksi.php';

$ambildatainspeksi = mysqli_query($conn, "SELECT * FROM record_inspeksi rec INNER JOIN akun ak ON rec.id_akun_inspektor = ak.id_akun INNER JOIN rule r ON ak.id_rule = r.id_rule INNER JOIN mesin m ON rec.id_mesin = m.id_mesin INNER JOIN tipe_mesin tm ON m.id_tipe_mesin = tm.id_tipe_mesin INNER JOIN status_mesin sm ON m.id_status = sm.id_status WHERE rec.status_record_inspeksi = 'Bermasalah' AND m.id_status = '2' AND rec.id_record_inspeksi NOT IN (SELECT id_record_inspeksi FROM record_maintenance) ORDER BY rec.id_record_inspeksi ASC");
$ambildatamaintenanceRPN = mysqli_query($conn, "SELECT * FROM data_maintenance dm, record_maintenance recm, record_inspeksi reci, sparepart sp, sparepart_rpn spr, akun ak, mesin m, tipe_mesin tm, status_mesin sm WHERE dm.status_data_maintenance = 'Belum' AND dm.id_record_maintenance = recm.id_record_maintenance AND dm.id_sparepart_rpn = spr.id_sparepart_rpn AND recm.id_record_inspeksi = reci.id_record_inspeksi AND spr.id_sparepart = sp.id_sparepart AND recm.id_akun_teknisi = ak.id_akun AND reci.id_mesin = m.id_mesin AND m.id_tipe_mesin = tm.id_tipe_mesin AND m.id_status = sm.id_status ORDER BY spr.nilai_rpn DESC");

// Untuk halaman all-maintenance
$ambilallMaintenance = mysqli_query($conn, "SELECT * FROM record_maintenance recm, record_inspeksi reci, akun ak, mesin m, tipe_mesin tm WHERE recm.id_record_inspeksi = reci.id_record_inspeksi AND recm.id_akun_teknisi = ak.id_akun AND reci.id_mesin = m.id_mesin AND m.id_tipe_mesin = tm.id_tipe_mesin");
$ambilallPreventive = mysqli_query($conn, "SELECT * FROM record_preventive recp, akun ak, sparepart sp, sparepart_tm spt WHERE recp.id_akun_teknisi = ak.id_akun AND recp.id_sparepart_tm = spt.id_sparepart_tm AND spt.id_sparepart = sp.id_sparepart ORDER BY recp.tanggal_preventive ASC");
$ambildataMesin = mysqli_query($conn, "SELECT * FROM mesin m, tipe_mesin tm WHERE m.id_tipe_mesin = tm.id_tipe_mesin");
