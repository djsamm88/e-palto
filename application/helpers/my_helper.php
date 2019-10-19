<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function offset($page,$limit){
    if($page<=0){
        $offset=0;
    }
    else{
        $offset=($page-1) * $limit;
    }
    return $offset;
}

function refresh($page){
    echo "<p style='text-align:center'><img style='padding:20px;' src='".config_item('asset_url')."assets/apps/dist/gif/loading-xxlg.gif'></p>";
    print"<html><head><meta http-equiv='refresh' content='0;URL=$page'></meta></head></html>";
}

function refresh2($page){
    print"<html><head><meta http-equiv='refresh' content='0;URL=$page'></meta></head></html>";
}

function datalog($aksi_akses,$keterangan){
    $userID = @$_SESSION['arrayLogin']['userID'];
    $userName = @$_SESSION['arrayLogin']['userName'];
    $ur = $_SERVER['REQUEST_URI'];
    $uri = explode('apps', $ur);
    $data = array(
        'userName' => $userID."_".$userName,
        'accessIP' => getenv("REMOTE_ADDR"),
        'accessTime' => time(),
        'accessUrl' => $uri[1],
        'accessAction' => $aksi_akses,
        'accessDescription' => $keterangan
    );
    return $data;
}

function message_access($url){
    $message="Anda tidak memiliki hak akses untuk menjalankan perintah ini !<br>";
    $message.="<a href='".base_url().$url."'>Lanjut</a>";
    return $message;
}

function message_cek_data($url,$status){
    $message=$status;
    $message.="<a href='".base_url().$url."'>Lanjut</a>";
    return $message;
}

function message_access2($url){
    $message="Anda tidak memiliki hak akses untuk menjalankan perintah ini !<br>";
    return $message;
}

function data_breadcrumb($data_breadcrumb){
    $data='<span class="glyphicon glyphicon-dashboard"></span>';
    $x = explode('|', $data_breadcrumb);
    $i=0;       
    $jlh = count($x);
    foreach ($x as $y) {
        $z = explode(',', $x[$i]);
        if($i==$jlh-1){
            $data.=$z[1];
        }
        else{
            $data.="<a href='".base_url().$z[0]."' style='color:#fff'>&nbsp;&nbsp;".$z[1]."</a>";
            $data.='&nbsp;&nbsp;<i class="glyphicon glyphicon-chevron-right"></i>&nbsp;&nbsp;';
        }
        $i++;
    }
    return $data;
}

function sord_arrow($sord){
    if($sord=="asc"){
        $data="<span class='glyphicon glyphicon-arrow-up'></span>";
    }
    else if($sord=="desc"){
        $data="<span class='glyphicon glyphicon-arrow-down'></span>";
    }
    else{
        $data="";
    }
    return $data;
}

function timetostr($str){
    $str = date("d-m-Y H:i:s",$str);
    return $str;
}


function cek_select_option($val1,$val2){
    if($val1==$val2){
        return "selected";
    }
    else{
        return "";
    }
}

function cek_checked($val1,$val2){
    if($val1==$val2){
        return "checked";
    }
    else{
        return "";
    }
}

function dmyTime($str){
    $str = date("d-m-Y H:i",$str);
    return $str;
}

function ymd1($tgl){
    if(!empty($tgl)){
        $tgl1 = explode("-",$tgl);
        $tgl = @$tgl1[2]."-".@$tgl1[1]."-".@$tgl1[0];
    }
    return $tgl;
}

function dmy1($tgl){
    if(!empty($tgl)){
        $tgl1 = explode("-",$tgl);
        $tgl = @$tgl1[2]."-".@$tgl1[1]."-".@$tgl1[0];
    }
    return $tgl;
}

function dmyY($tgl){
    if(!empty($tgl)){
        $tgl1 = explode("-",$tgl);
        $tgl = @$tgl1[2];
    }
    return $tgl;
}

function ymd2($tgl){
    $tgl2 = explode(" ",$tgl);
    $tgl20 = explode("-",$tgl2[0]);
    $tgl = $tgl20[2]."-".$tgl20[1]."-".$tgl20[0]." ".$tgl2[1];
    return $tgl;
}

function dmy2($tgl){
    $tgl2 = explode(" ",$tgl);
    $tgl20 = explode("-",$tgl2[0]);
    $tgl = @$tgl20[2]."-".@$tgl20[1]."-".@$tgl20[0]." ".@$tgl2[1];
    return $tgl;
}

function buang_titik($str){
    $str = str_replace('.', '',$str);
    return $str;
}

function pasang_titik($str){
    if($str!=""){
        $str = number_format($str,0,',','.');
    }else{
        $str=0;    
    }
    return $str;
}

function buang_tag_html($content) {
   $content = strip_tags($content); 
   return $content;  
}

function buangDesimal($str){
    $str = explode(".",$str);
    $str = $str[0];
    return $str;
}

function hitung_hari($s,$e){
    $s = strtotime($s);
    $e = strtotime($e);
    $hari = ($e - $s)/ (24 *3600);
        //if($hari<1){
        //    $hari=1;
        //}
    return $hari;
}

function hitung_umur($tanggal){ 
    list($tahun,$bulan,$hari) = explode("-",$tanggal); 
    $format_tahun = date("Y") - $tahun; 
    $format_bulan = date("m") - $bulan; 
    $format_hari = date("d") - $hari;
    if ($format_hari < 0 || $format_bulan < 0){
        $format_tahun--; 
    }
    return $format_tahun; 
}

function hitung_tahun_bulan_hari($tanggal_awal,$tanggal_akhir){
    $tahun_bulan_hari=0;
    list($tahun_awal,$bulan_awal,$hari_awal) = explode("-",$tanggal_awal); 
    list($tahun_akhir,$bulan_akhir,$hari_akhir) = explode("-",$tanggal_akhir); 

    $format_tahun = $tahun_akhir- $tahun_awal; 
    $format_bulan = $bulan_akhir- $bulan_awal; 
    $format_hari = $hari_akhir- $hari_awal;

    if ($format_tahun < 0){
        $format_tahun=0; 
    }
    if ($format_bulan < 0 ){
        $format_bulan=0; 
    }
    if ($format_hari < 0){
        $format_hari=0; 
    }
    $tahun_bulan_hari = $format_tahun." Tahun ".$format_bulan." Bulan ".$format_hari." Hari";
    return $tahun_bulan_hari; 
}


function compareDates($date1, $date2){
    if (!is_numeric($date1)) {
        $date1 = strtotime($date1);
    }
    if (!is_numeric($date2)) {
        $date2 = strtotime($date2);
    }
    if ($date1 < $date2) {
        return -1;
    } else if ($date1 > $date2) {
        return 1;
    } else {
        return 0;
    }
}

function formatAkun($str,$level){
    $akun_kode1 = substr($str,0,1);
    $akun_kode2 = substr($str,1,1);
    $akun_kode3 = substr($str,2,3);
    $akun_kode4 = substr($str,5,2);
    if($level==1){
        $akun_kode = $akun_kode1;
    }
    else if($level==2){
        $akun_kode = $akun_kode1.".".$akun_kode2;
    }
    else if($level==3){
        $akun_kode = $akun_kode1.".".$akun_kode2.".".$akun_kode3;
    }
    else if($level==4){
        $akun_kode = $akun_kode1.".".$akun_kode2.".".$akun_kode3.".".$akun_kode4;
    }
        //$akun_kode = substr($akun_kode,4,12);
    return $akun_kode;
}

function BulanPeriode($tgl_awal,$op,$bulan){
    $newdate = strtotime ($op.$bulan.' month +0 day',strtotime($tgl_awal));
    return date('Y-m', $newdate); 
}
function ym($tgl){
    $tgl20 = explode("-",$tgl);
    $tgl = $tgl20[1]."-".$tgl20[0];
    return $tgl;
}
function my($tgl){
    $tgl20 = explode("-",$tgl);
    $tgl = $tgl20[1]."-".$tgl20[0];
    return $tgl;
}

function buangbr($str){
    $str = str_replace('<br />', '',$str);
    return $str;
}

function re_table($str){
    $find_table = array(         
        "/<table(.*)>/","/<td(.*)>/","/<th(.*)>/"
    );                   

    $replace_table = array( 
        "<table class='table table-condensed'>","<td>","<th>" 
    ); 
    $result = preg_replace($find_table,$replace_table,$str); 
    $result = preg_replace('/(<[^>]+) style=".*?"/i', '$1', $result);
    $result = str_replace("<span>","",$result);
    $result = str_replace("</span>","",$result);
    return $str;
}


function getField($str){
    $str2="";
    $t = explode("@@",$str);
    for ($i=1; $i <count($t) ; $i++) { 
        $t2 = explode("@",$t[$i]);
        $str2[]=$t2[0];
    }
    $str2 = array_unique($str2);
    $j=0;
    foreach ($str2 as $key => $value) {
        $j++;
        if($value=="pem_Kecamatan"){
            $str3[0]=$value;
        }else if($value=="pem_Desa"){
            $str3[1]=$value;
        }else if($value=="pem_Dusun"){
            $str3[2]=$value;
        }else{
            $k=$j+2;
            $str3[$k]=$value;
        }
    }
    ksort($str3);
    return $str3;
}

function jenis_kelamin(){
    return array(
        'L'=>'Laki-laki',
        'P'=>'Perempuan'
    );
}

function agama(){
    return array(
        1=>'Islam',
        2=>'Kristen',
        3=>'Katholik',
        4=>'Hindu',
        5=>'Budha',
        6=>'Khonghucu',
        7=>'Penghayal kepercayaan',
        8=>'Lainnya'
    );
}


function getkecamatan(){
    $data = array();
    $q = " SELECT * FROM tbl_kecamatan ";
    $q .= " WHERE desa_id='000' ORDER BY kecamatan_id ";
    $sql = mysql_query($q);
    while ($obj1 = mysql_fetch_object($sql)) {
        $kode = $obj1->kecamatan_id;
        $data[$kode]['kecamatan_id'] = $obj1->kecamatan_id;
        $data[$kode]['desa_id'] = $obj1->desa_id;
        $data[$kode]['nama'] = $obj1->nama;
    }
    return $data;
}


function getdesa($kecamatan_id){
    $data = array();
    $q = " SELECT * FROM tbl_kecamatan ";
    $q .= " WHERE kecamatan_id='$kecamatan_id' AND desa_id!='000' ORDER BY kecamatan_id ";
  // print_r($q);
    $sql = mysql_query($q);
    while ($obj1 = mysql_fetch_object($sql)) {
        $kode = $obj1->desa_id;
        $data[$kode]['kecamatan_id'] = $obj1->kecamatan_id;
        $data[$kode]['desa_id'] = $obj1->desa_id;
        $data[$kode]['nama'] = $obj1->nama;
    }
    return $data;
}


function setField($value){
    if($value=="pem_Kecamatan"){
        ?>
        <select name="getField[<?php echo $value;?>]"  class="form-control" id="pem_Kecamatan" onchange="loadDesa2()">
            <option value=""></option>
            <?php
            foreach (getkecamatan() as $valkecamatan) {
                ?><option <?php echo cek_select_option($valkecamatan['kecamatan_id'],$pem_Kecamatan); ?> value="<?php echo $valkecamatan['kecamatan_id']; ?>"><?php echo "[".$valkecamatan['kecamatan_id']."] - ".$valkecamatan['nama']; ?></option><?php
            }
            ?>
        </select>
        <?php
    }else if($value=="pem_Desa"){
        ?>
        <select name="getField[<?php echo $value;?>]"  class="form-control" id="pem_Desa">
            <option value=""></option>
        </select>
        <?php
    }else if($value=="pem_Jenis_Kelamin"){
        ?>
        <select name="getField[<?php echo $value;?>]"  class="form-control" id="pem_Desa">
            <option value=""></option>
            <?php
            foreach (jenis_kelamin() as $key => $val) {
                ?><option <?php echo cek_select_option($key,$desa_id); ?> value="<?php echo $key; ?>"><?php echo "[".$key."] - ".$val; ?></option><?php
            }
            ?>
        </select>
        <?php
    }else{
        ?>
        <input type="text" name="getField[<?php echo $value;?>]" value="" class="form-control">
        <?php
    }

}

function changeFieldValue($value,$field){
    if($field=="pem_Kecamatan"){
        $ket = getkecamatan();
        $value = strtolower($ket[$value]['nama']);
        $value = ucwords($value);
    }
    if($field=="pem_Desa"){
        $g = explode("|",$value);
        $ket = getdesa($g[0]);
        $value = strtolower($ket[$g[1]]['nama']);
        $value = ucwords($value);
    }
    return $value;
}

function jenis_penumpang(){
   return array(
    'penum.orang'=>'Orang',
    'penum.kendaraan'=>'Kendaraan',
    'penum.paket'=>'Paket'
);
}

function selengkapnya($str){
    if(strlen($str)>30){
        $str = substr($str,0,30)." [...]";
    }
    return $str;
}

function selengkapnya_md($str){
    if(strlen($str)>50){
        $str = substr($str,0,50)." [...]";
    }
    return $str;
}

?>