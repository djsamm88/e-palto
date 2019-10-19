<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
function pdf_create($html, $filename='', $stream=TRUE,$paper="a3",$set_p="potrait") 
{
    require_once("assets/apps/dompdf/dompdf_config.inc.php");

    $dompdf_lan = new DOMPDF();
    $dompdf_lan->load_html($html);
    $dompdf_lan->set_paper($paper,$set_p);
    $dompdf_lan->render();
    if ($stream) {
        $dompdf_lan->stream($filename.".pdf");
    } else {
        return $dompdf_lan->output();
    }
}
?>