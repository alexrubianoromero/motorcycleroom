<?php
namespace controllers;
   $path = $_SERVER['DOCUMENT_ROOT']; 
   $ruta = $path.'/fpdf/fpdf.php';
   require_once($ruta);
  $pdf = new FPDF();
class OrdenTrabajoPdfController  {

    private $id_orden;
    private $pdf;
    
    public function __construct($id){
        
        $this->id_orden = $id;
        echo 'buenas Orden trabajo controller'. $this->id_orden;
        // echo '<pre>'; print_r($_SERVER); echo '</pre>';


    }
}
?>