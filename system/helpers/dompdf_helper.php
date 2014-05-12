<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
function pdf_create($html, $filename='', $stream=TRUE,$set_paper) 
{
    require_once("dompdf/dompdf_config.inc.php");
	
    $dompdf = new DOMPDF();
    if($set_paper==1){
    $dompdf->set_paper('letter','landscape');
    $dompdf->set_paper('legal','landscape');
}
    $dompdf->load_html($html);
    ini_set("memory_limit", "32M");
    $dompdf->render();

    if ($stream) {
        $dompdf->stream($filename.".pdf");
    } else {
        return $dompdf->output();
    }

}
?>