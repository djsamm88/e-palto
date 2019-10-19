<?php
function generateKreditAngsuran($norek_kredit){
	$arrayKredit = detail_kredit($norek_kredit);

	$norek_kredit = $arrayKredit['norek_kredit'];
	$jumlah_kredit = $arrayKredit['jumlah_kredit'];
	$tingkat_bunga = $arrayKredit['tingkat_bunga'];
	$jangka_waktu = $arrayKredit['jangka_waktu'];
	$tipe_angsuran = $arrayKredit['tipe_angsuran'];
	$tgl_persetujuan = $arrayKredit['tgl_persetujuan'];

	$parameterArr1 = getParameterArray(21, "transaksi_kredit");
	$akun_id1_arr = explode("|", $parameterArr1['notes']);
	$akun_kode_kredit = $akun_id1_arr[1];

	$parameterArr1 = getParameterArray(22, "transaksi_kredit");
	$akun_id1_arr = explode("|", $parameterArr1['notes']);
	$akun_kode_bunga = $akun_id1_arr[1];

	$parameterArr1 = getParameterArray(23, "transaksi_kredit");
	$akun_id1_arr = explode("|", $parameterArr1['notes']);
	$akun_kode_denda = $akun_id1_arr[1];

	$tglArr1 = explode("-", $tgl_persetujuan);
	$tglArr2 = explode("-", date("Y-m-d", time()));
	$tgl_persetujuan_int = mktime(0, 0, 0, $tglArr1[1], $tglArr1[2], $tglArr1[0]);
	$tgl_sekarang_int = mktime(0, 0, 0, $tglArr2[1], $tglArr2[2], $tglArr2[0]);


	$kredit_angsuran = array();

	if ($tipe_angsuran == "Bunga Efektif")
	{
		$faktor = (1 / $tingkat_bunga) - (1 / ($tingkat_bunga * (pow(1 + $tingkat_bunga, $jangka_waktu))));

		$angsuran = round($jumlah_kredit / $faktor);
		if ($pembulatan_nominal=="Ya"){
			$temp = substr($angsuran, -2) + 0;
			$angsuran = substr($angsuran, 0, -2)."00" + 0;
//$angsuran = $angsuran + 100;
			if ($temp > 0 && $temp <= 25) {$angsuran = $angsuran + 25;}
			else if ($temp > 25 && $temp <= 50) {$angsuran = $angsuran + 50;}
			else if ($temp > 50 && $temp <= 75) {$angsuran = $angsuran + 75;}
			else if ($temp > 75 && $temp < 100) {$angsuran = $angsuran + 100;}
		}
		$saldo_angsuran = $jumlah_kredit;

		$sisa_pokok = getSaldoBayarTgl($akun_kode_kredit, $norek_kredit, date("Y-m-d", time()), $tgl_persetujuan);
		$sisa_bunga = getSaldoBayarTgl($akun_kode_bunga, $norek_kredit, date("Y-m-d", time()), $tgl_persetujuan);

		for ($n=1; $n <= $jangka_waktu; $n++) {

			$bunga = round($tingkat_bunga * $saldo_angsuran);
			if ($pembulatan_nominal=="Ya"){
				$temp = substr($bunga, -2) + 0;
				$bunga = substr($bunga, 0, -2)."00" + 0;
//$bunga = $bunga + 100;
				if ($temp > 0 && $temp <= 25) {$bunga = $bunga + 25;}
				else if ($temp > 25 && $temp <= 50) {$bunga = $bunga + 50;}
				else if ($temp > 50 && $temp <= 75) {$bunga = $bunga + 75;}
				else if ($temp > 75 && $temp < 100) {$bunga = $bunga + 100;}
			}
			$saldo_angsuran = $saldo_angsuran - ($angsuran - $bunga);

			$pokok = $n<>$jangka_waktu ? $angsuran-$bunga : $angsuran-$bunga+$saldo_angsuran;
			$jumlah = $pokok+$bunga;
			$saldo = $n<>$jangka_waktu ? $saldo_angsuran : 0;

			$tgl_jt = generateTglAkhirBulan($tglArr1[1]+$n, $tglArr1[2], $tglArr1[0]);
			$tgl_jt_k = generateTglAkhirBulan($tglArr1[1]+$n-1, $tglArr1[2], $tglArr1[0]);

			$pokok_bayar = $sisa_pokok >= $pokok ? $pokok : $sisa_pokok;
			$bunga_bayar = $sisa_bunga >= $bunga ? $bunga : $sisa_bunga;
			$denda_bayar = getSaldoBayarTgl($akun_kode_denda, $norek_kredit, $tgl_jt, $tgl_jt_k);
			$jumlah_bayar = $pokok_bayar + $bunga_bayar + $denda_bayar;
			$sisa_pokok = $sisa_pokok - $pokok > 0 ? $sisa_pokok - $pokok : 0;
			$sisa_bunga = $sisa_bunga - $bunga > 0 ? $sisa_bunga - $bunga : 0;

			$tgl_bayar = $tgl_sekarang_int <= mktime(0, 0, 0, $tglArr1[1]+$n, $tglArr1[2], $tglArr1[0]) ? "0000-00-00" : $tgl_jt;

			$total_pokok_skema += $pokok;
			$total_pokok_bayar += $pokok_bayar;
			$total_bunga_skema += $bunga;
			$total_bunga_bayar += $bunga_bayar;
			$status_bayar = $total_pokok_bayar>=$total_pokok_skema && $total_bunga_bayar>=$total_bunga_skema ? 1 : 0;

			$tglArr = explode("-", $tgl_jt);
			if ($status_bayar) {
				$status_terlambat = "Lunas";
			} else {
				$status_terlambat = mktime(0, 0, 0, $tglArr[1]+1, $tglArr[2], $tglArr[0]) < mktime(0, 0, 0, $tglArr2[1], $tglArr2[2], $tglArr2[0]) ? "Terlambat" : "Belum Terlambat";
			}

			$kreAngsuranObj['norek_kredit'] 	= $norek_kredit;
			$kreAngsuranObj['nomor'] 			= $n;
			$kreAngsuranObj['tgl_deadline'] 	= $tgl_jt;
			$kreAngsuranObj['saldo_pokok']	= $saldo+$pokok;
			$kreAngsuranObj['pokok']			= $pokok;
			$kreAngsuranObj['bunga']			= $bunga;
			$kreAngsuranObj['jumlah']			= $jumlah;
			$kreAngsuranObj['saldo']			= $saldo;
			$kreAngsuranObj['pokok_bayar']	= $pokok_bayar;
			$kreAngsuranObj['bunga_bayar']    = $bunga_bayar;
			$kreAngsuranObj['denda_bayar']    = $denda_bayar;
			$kreAngsuranObj['jumlah_bayar']   = $jumlah_bayar;
			$kreAngsuranObj['tgl_bayar']		= $tgl_bayar;
			$kreAngsuranObj['status_bayar']	= $status_bayar;
			$kreAngsuranObj['status_terlambat']= $status_terlambat;
			$kreAngsuranObj['dt_created'] 	= time();
			$kreAngsuranObj['created_by']		= $_SESSION["userID"];

			$kredit_angsuran[] = $kreAngsuranObj;
		}

	}
	else if ($tipe_angsuran == "Bunga Menurun")
	{
		$angsuran = round($jumlah_kredit / $jangka_waktu);
		if ($pembulatan_nominal=="Ya"){
			$temp = substr($angsuran, -2) + 0;
			$angsuran = substr($angsuran, 0, -2)."00" + 0;
//angsuran = angsuran + 100
			if ($temp > 0 && $temp <= 25) {$angsuran = $angsuran + 25;}
			else if ($temp > 25 && $temp <= 50) {$angsuran = $angsuran + 50;}
			else if ($temp > 50 && $temp <= 75) {$angsuran = $angsuran + 75;}
			else if ($temp > 75 && $temp < 100) {$angsuran = $angsuran + 100;}
		}
		$saldo_angsuran = $jumlah_kredit;

		$sisa_pokok = getSaldoBayarTgl($akun_kode_kredit, $norek_kredit, date("Y-m-d", time()), $tgl_persetujuan);
		$sisa_bunga = getSaldoBayarTgl($akun_kode_bunga, $norek_kredit, date("Y-m-d", time()), $tgl_persetujuan);

		for ($n=1; $n <= $jangka_waktu; $n++) {

			$bunga = round($tingkat_bunga * $saldo_angsuran);
			if ($pembulatan_nominal=="Ya"){
				$temp = substr($bunga, -2) + 0;
				$bunga = substr($bunga, 0, -2)."00";
//$bunga = $bunga + 100
				if ($temp > 0 && $temp <= 25) {$bunga = $bunga + 25;}
				else if ($temp > 25 && $temp <= 50) {$bunga = $bunga + 50;}
				else if ($temp > 50 && $temp <= 75) {$bunga = $bunga + 75;}
				else if ($temp > 75 && $temp < 100) {$bunga = $bunga + 100;}
			}
			$saldo_angsuran = $saldo_angsuran - ($angsuran);

			$pokok = $n<>$jangka_waktu ? $angsuran : $angsuran+$saldo_angsuran;
			$jumlah = $pokok+$bunga;
			$saldo = $n<>$jangka_waktu ? $saldo_angsuran : 0;

			$tgl_jt = generateTglAkhirBulan($tglArr1[1]+$n, $tglArr1[2], $tglArr1[0]);
			$tgl_jt_k = generateTglAkhirBulan($tglArr1[1]+$n-1, $tglArr1[2], $tglArr1[0]);

			$pokok_bayar = $sisa_pokok >= $pokok ? $pokok : $sisa_pokok;
			$bunga_bayar = $sisa_bunga >= $bunga ? $bunga : $sisa_bunga;
			$denda_bayar = getSaldoBayarTgl($akun_kode_denda, $norek_kredit, $tgl_jt, $tgl_jt_k);
			$jumlah_bayar = $pokok_bayar + $bunga_bayar + $denda_bayar;
			$sisa_pokok = $sisa_pokok - $pokok > 0 ? $sisa_pokok - $pokok : 0;
			$sisa_bunga = $sisa_bunga - $bunga > 0 ? $sisa_bunga - $bunga : 0;

			$tgl_bayar = $tgl_sekarang_int <= mktime(0, 0, 0, $tglArr1[1]+$n, $tglArr1[2], $tglArr1[0]) ? "0000-00-00" : $tgl_jt;

			$total_pokok_skema += $pokok;
			$total_pokok_bayar += $pokok_bayar;
			$total_bunga_skema += $bunga;
			$total_bunga_bayar += $bunga_bayar;
			$status_bayar = $total_pokok_bayar>=$total_pokok_skema && $total_bunga_bayar>=$total_bunga_skema ? 1 : 0;

			$tglArr = explode("-", $tgl_jt);
			if ($status_bayar) {
				$status_terlambat = "Lunas";
			} else {
				$status_terlambat = mktime(0, 0, 0, $tglArr[1]+1, $tglArr[2], $tglArr[0]) < mktime(0, 0, 0, $tglArr2[1], $tglArr2[2], $tglArr2[0]) ? "Terlambat" : "Belum Terlambat";
			}

			$kreAngsuranObj['norek_kredit'] 	= $norek_kredit;
			$kreAngsuranObj['nomor'] 			= $n;
			$kreAngsuranObj['tgl_deadline'] 	= $tgl_jt;
			$kreAngsuranObj['saldo_pokok']	= $saldo+$pokok;
			$kreAngsuranObj['pokok']			= $pokok;
			$kreAngsuranObj['bunga']			= $bunga;
			$kreAngsuranObj['jumlah']			= $jumlah;
			$kreAngsuranObj['saldo']			= $saldo;
			$kreAngsuranObj['pokok_bayar']	= $pokok_bayar;
			$kreAngsuranObj['bunga_bayar']    = $bunga_bayar;
			$kreAngsuranObj['denda_bayar']    = $denda_bayar;
			$kreAngsuranObj['jumlah_bayar']   = $jumlah_bayar;
			$kreAngsuranObj['tgl_bayar']		= $tgl_bayar;
			$kreAngsuranObj['status_bayar']	= $status_bayar;
			$kreAngsuranObj['status_terlambat']= $status_terlambat;
			$kreAngsuranObj['dt_created'] 	= time();
			$kreAngsuranObj['created_by']		= $_SESSION["userID"];

			$kredit_angsuran[] = $kreAngsuranObj;
		}

	}
	else if ($tipe_angsuran == "Bunga Tetap")
	{
		$angsuran = round($jumlah_kredit / $jangka_waktu);
		if ($pembulatan_nominal=="Ya"){
			$temp = substr($angsuran, -2) + 0;
			$angsuran = substr($angsuran, 0, -2)."00" + 0;
//angsuran = angsuran + 100
			if ($temp > 0 && $temp <= 25) {$angsuran = $angsuran + 25;}
			else if ($temp > 25 && $temp <= 50) {$angsuran = $angsuran + 50;}
			else if ($temp > 50 && $temp <= 75) {$angsuran = $angsuran + 75;}
			else if ($temp > 75 && $temp < 100) {$angsuran = $angsuran + 100;}
		}

		$bunga = round($jumlah_kredit * $tingkat_bunga);
		if ($pembulatan_nominal=="Ya"){
			$temp = substr($bunga, -2) + 0;
			$bunga = substr($bunga, 0, -2)."00";
//$bunga = $bunga + 100
			if ($temp > 0 && $temp <= 25) {$bunga = $bunga + 25;}
			else if ($temp > 25 && $temp <= 50) {$bunga = $bunga + 50;}
			else if ($temp > 50 && $temp <= 75) {$bunga = $bunga + 75;}
			else if ($temp > 75 && $temp < 100) {$bunga = $bunga + 100;}
		}
		$saldo_angsuran = $jumlah_kredit;

		$sisa_pokok = getSaldoBayarTgl($akun_kode_kredit, $norek_kredit, date("Y-m-d", time()), $tgl_persetujuan);
		$sisa_bunga = getSaldoBayarTgl($akun_kode_bunga, $norek_kredit, date("Y-m-d", time()), $tgl_persetujuan);

		for ($n=1; $n <= $jangka_waktu; $n++) {

			$saldo_angsuran = $saldo_angsuran - $angsuran;

			$pokok = $n<>$jangka_waktu ? $angsuran : $angsuran+$saldo_angsuran;
			$jumlah = $pokok+$bunga;
			$saldo = $n<>$jangka_waktu ? $saldo_angsuran : 0;

			$tgl_jt = generateTglAkhirBulan($tglArr1[1]+$n, $tglArr1[2], $tglArr1[0]);
			$tgl_jt_k = generateTglAkhirBulan($tglArr1[1]+$n-1, $tglArr1[2], $tglArr1[0]);

			$pokok_bayar = $sisa_pokok >= $pokok ? $pokok : $sisa_pokok;
			$bunga_bayar = $sisa_bunga >= $bunga ? $bunga : $sisa_bunga;
			$denda_bayar = getSaldoBayarTgl($akun_kode_denda, $norek_kredit, $tgl_jt, $tgl_jt_k);
			$jumlah_bayar = $pokok_bayar + $bunga_bayar + $denda_bayar;
			$sisa_pokok = $sisa_pokok - $pokok > 0 ? $sisa_pokok - $pokok : 0;
			$sisa_bunga = $sisa_bunga - $bunga > 0 ? $sisa_bunga - $bunga : 0;

			$tgl_bayar = $tgl_sekarang_int <= mktime(0, 0, 0, $tglArr1[1]+$n, $tglArr1[2], $tglArr1[0]) ? "0000-00-00" : $tgl_jt;

			$total_pokok_skema += $pokok;
			$total_pokok_bayar += $pokok_bayar;
			$total_bunga_skema += $bunga;
			$total_bunga_bayar += $bunga_bayar;
			$status_bayar = $total_pokok_bayar>=$total_pokok_skema && $total_bunga_bayar>=$total_bunga_skema ? 1 : 0;

			$tglArr = explode("-", $tgl_jt);
			if ($status_bayar) {
				$status_terlambat = "Lunas";
			} else {
				$status_terlambat = mktime(0, 0, 0, $tglArr[1]+1, $tglArr[2], $tglArr[0]) < mktime(0, 0, 0, $tglArr2[1], $tglArr2[2], $tglArr2[0]) ? "Terlambat" : "Belum Terlambat";
			}

			$kreAngsuranObj['norek_kredit'] 	= $norek_kredit;
			$kreAngsuranObj['nomor'] 			= $n;
			$kreAngsuranObj['tgl_deadline'] 	= $tgl_jt;
			$kreAngsuranObj['saldo_pokok']	= $saldo+$pokok;
			$kreAngsuranObj['pokok']			= $pokok;
			$kreAngsuranObj['bunga']			= $bunga;
			$kreAngsuranObj['jumlah']			= $jumlah;
			$kreAngsuranObj['saldo']			= $saldo;
			$kreAngsuranObj['pokok_bayar']	= $pokok_bayar;
			$kreAngsuranObj['bunga_bayar']    = $bunga_bayar;
			$kreAngsuranObj['denda_bayar']    = $denda_bayar;
			$kreAngsuranObj['jumlah_bayar']   = $jumlah_bayar;
			$kreAngsuranObj['tgl_bayar']		= $tgl_bayar;
			$kreAngsuranObj['status_bayar']	= $status_bayar;
			$kreAngsuranObj['status_terlambat']= $status_terlambat;
			$kreAngsuranObj['dt_created'] 	= time();
			$kreAngsuranObj['created_by']		= $_SESSION["userID"];

			$kredit_angsuran[] = $kreAngsuranObj;
		}

	}

	else if($tipe_angsuran == "Tanpa Skema Bunga Menurun"){
		$tglArr1 = explode("-", $tgl_persetujuan);
		$tglArr2 = explode("-", date("Y-m-d", time()));
		$tgl_persetujuan_int = mktime(0, 0, 0, $tglArr1[1], $tglArr1[2], $tglArr1[0]);
		$tgl_sekarang_int = mktime(0, 0, 0, $tglArr2[1], $tglArr2[2], $tglArr2[0]);

		if($tgl_sekarang_int <= mktime(0, 0, 0, $tglArr2[1], $tglArr1[2], $tglArr2[0])){
			$selisih_bulan = selisihBulan(date("Ym", mktime(0, 0, 0, $tglArr2[1]-1, $tglArr2[2], $tglArr2[0])), date("Ym", $tgl_persetujuan_int));
		}else{
			$selisih_bulan = selisihBulan(date("Ym", mktime(0, 0, 0, $tglArr2[1]-0, $tglArr2[2], $tglArr2[0])), date("Ym", $tgl_persetujuan_int));
		}

		$saldo_angsuran = $jumlah_kredit;
		for ($n=1; $n <= $selisih_bulan+1; $n++) {
			$tgl_jt = generateTglAkhirBulan($tglArr1[1]+$n, $tglArr1[2], $tglArr1[0]);
			$tgl_jt_k = generateTglAkhirBulan($tglArr1[1]+$n-1, $tglArr1[2], $tglArr1[0]);

			$saldo_pokok = -getSaldoBayarTgl($akun_kode_kredit, $norek_kredit, $tgl_jt_k, '0000-00-00');
			$pokok = $jumlah_kredit / $jangka_waktu;
			$bunga = round($saldo_pokok * $tingkat_bunga);
			$jumlah = $pokok + $bunga;
			$saldo_angsuran = $saldo_pokok - $pokok;
			$pokok_bayar = getSaldoBayarTgl($akun_kode_kredit, $norek_kredit, $tgl_jt, $tgl_jt_k);
			$bunga_bayar = getSaldoBayarTgl($akun_kode_bunga, $norek_kredit, $tgl_jt, $tgl_jt_k);
			$denda_bayar = getSaldoBayarTgl($akun_kode_denda, $norek_kredit, $tgl_jt, $tgl_jt_k);
			$jumlah_bayar = $pokok_bayar + $bunga_bayar + $denda_bayar;
			$tgl_bayar = $tgl_sekarang_int <= mktime(0, 0, 0, $tglArr1[1]+$n, $tglArr1[2], $tglArr1[0]) ? "0000-00-00" : $tgl_jt;

			$total_pokok_skema += $pokok;
			$total_pokok_bayar += $pokok_bayar;
			$total_bunga_skema += $bunga;
			$total_bunga_bayar += $bunga_bayar;
			$status_bayar = $total_bunga_bayar>=$total_bunga_skema ? 1 : 0;
			$tglArr = explode("-", $tgl_jt);
			if ($status_bayar) {
				$status_terlambat = "Lunas";
			} else {
				$status_terlambat = mktime(0, 0, 0, $tglArr[1], $tglArr[2], $tglArr[0]) < mktime(0, 0, 0, $tglArr2[1], $tglArr2[2], $tglArr2[0]) ? "Terlambat" : "Belum Terlambat";
			}

			$kreAngsuranObj['norek_kredit'] 	= $norek_kredit;
			$kreAngsuranObj['nomor'] 			= $n;
			$kreAngsuranObj['tgl_deadline'] 	= $tgl_jt;
			$kreAngsuranObj['saldo_pokok']	= $saldo_pokok;
			$kreAngsuranObj['pokok']			= $pokok;
			$kreAngsuranObj['bunga']			= $bunga;
			$kreAngsuranObj['jumlah']			= $jumlah;
			$kreAngsuranObj['saldo']			= $saldo_angsuran;
			$kreAngsuranObj['pokok_bayar']		= $pokok_bayar;
			$kreAngsuranObj['bunga_bayar']    = $bunga_bayar;
			$kreAngsuranObj['denda_bayar']    = $denda_bayar;
			$kreAngsuranObj['jumlah_bayar']   = $jumlah_bayar;
			$kreAngsuranObj['tgl_bayar']		= $tgl_bayar;
			$kreAngsuranObj['status_bayar']	= $status_bayar;
			$kreAngsuranObj['status_terlambat']= $status_terlambat;
			$kreAngsuranObj['dt_created'] 	= time();
			$kreAngsuranObj['created_by']		= $_SESSION["userID"];

			$kredit_angsuran[] = $kreAngsuranObj;
		}
	}

	else if($tipe_angsuran == "Bunga Bayar Dimuka"){

	}
	return $kredit_angsuran;
}


function generateTglAkhirBulan($bln, $tgl, $thn)
{
	$thn_proses = date("Y", mktime(0, 0, 0, $bln, 1, $thn));
	$bln_proses = date("m", mktime(0, 0, 0, $bln, 1, $thn));
	if($bln_proses=="02" && ($tgl=="29" || $tgl=="30" || $tgl=="31")){
		if($thn_proses%4!=0){
			$tgl_2="28";
		} else{
			$tgl_2="29";
		}
	} else if(($bln_proses=="04" || $bln_proses=="06" || $bln_proses=="09" || $bln_proses=="11") && $tgl=="31"){
		$tgl_2 = "30";
	} else{
		$tgl_2=$tgl;
	}
	return date("Y-m-d", mktime(0, 0, 0, $bln, $tgl_2, $thn));
}

function selisihBulan($bulan1, $bulan2)
{
	$selisihBulan = 0;
	$q = "select period_diff($bulan1, $bulan2) as selisihBulan ";

	$sql = mysql_query($q);

	if ($row = mysql_fetch_array($sql)) {
		$selisihBulan = $row["selisihBulan"];
	}
	return $selisihBulan;
}


function getSaldoBayarTgl($akun_id, $norek_kredit, $tgl_jt, $tgl_jt_k){
	$q = " SELECT *, ";
	$q .= " IFNULL(sum((c.akun_id_kredit='$akun_id')*c.nominal_kredit), 0)- ";
	$q .= " IFNULL(sum((c.akun_id_debet='$akun_id')*c.nominal_debet), 0) as saldo ";
	$q .= " FROM tbl_transaksi c ";
	$q .= " WHERE c.trx_noref='$norek_kredit' ";
	$q .= " AND c.trx_tgl<='$tgl_jt' ";
	$q .= " AND c.trx_tgl>'$tgl_jt_k' ";

	$sql = mysql_query($q);

	if ($row = mysql_fetch_array($sql)) {
		$saldo = $row["saldo"];
	}
	return $saldo;
}

function getParameterArray($id,$name){
	$q = " SELECT * FROM tbl_parameter ";
	$q .= " WHERE id='$id' AND name='$name' ";
	$sql = mysql_query($q);
	if ($row = mysql_fetch_array($sql)) {
		$data = array(
			'nama' => $row['name'],
			'description' => $row['description'],
			'notes' => $row['notes']
		);
	}
	return $data;

}

function detail_kredit($norek_kredit){
	$q = " SELECT * ";
	$q .= " FROM tbl_nasabah_kredit ";
	$q .= " WHERE norek_kredit='$norek_kredit' ";
	$sql = mysql_query($q);
	if ($row = mysql_fetch_array($sql)) {
		$data = array(
			'norek_kredit' => $row['norek_kredit'],
			'nomor_kredit' => $row['nomor_kredit'],
			'id_anggota' => $row['id_anggota'],
			'saldo_kredit' => $row['saldo_kredit'],
			'tgl_pendaftaran' => $row['tgl_pendaftaran'],
			'tgl_persetujuan' => $row['tgl_persetujuan'],
			'jumlah_kredit' => $row['jumlah_kredit'],
			'jumlah_setoran' => $row['jumlah_setoran'],
			'tingkat_bunga' => $row['tingkat_bunga'],
			'jangka_waktu' => $row['jangka_waktu'],
			'kategori_kredit' => $row['kategori_kredit'],
			'tipe_angsuran' => $row['tipe_angsuran'],
			'agunan' => $row['agunan'],
			'nilai_agunan' => $row['nilai_agunan'],
			'bunga_bulanan' => $row['bunga_bulanan'],
			'bunga_total' => $row['bunga_total'],
			'status_kredit' => $row['status_kredit'],
			'keterangan' => $row['keterangan'],
			'pilihan_jatuh_tempo' => $row['pilihan_jatuh_tempo'],
			'pilihan_bunga' => $row['pilihan_bunga'],
			'norek_tabungan' => $row['norek_tabungan'],
			'jenis_kredit' => $row['jenis_kredit'],
			'deleted' => $row['deleted'],
			'dt_created' => $row['dt_created'],
			'created_by' => $row['created_by'],
			'dt_updated' => $row['dt_updated'],
			'updated_by' => $row['updated_by']
		);
	}
	return $data;
}

function minDateTrx(){
	$parameterArr1 = getParameterArray(1, "batas_tanggal_transaksi");
	return $parameterArr1['description'];
}

function maxDateTrx(){
	$parameterArr1 = getParameterArray(2, "batas_tanggal_transaksi");
	return $parameterArr1['description'];
}
