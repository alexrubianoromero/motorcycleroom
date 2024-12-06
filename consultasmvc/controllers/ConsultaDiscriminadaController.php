<?php
namespace controllers;
use vista\ConsultaDiscriminadaVista;
use model\ConsultasDiscriminadasModelo;

Class ConsultaDiscriminadaController
{
   protected $vista;

   public function __construct(){

      // echo '<pre>'; 
      // print_r($_REQUEST);
      // echo '</pre>';
      $this->vista = new ConsultaDiscriminadaVista();
      if(!isset($_REQUEST['opcion'])){
         $this->vista->vistaPrincipal();
      }
      if(isset($_REQUEST['opcion']) && $_REQUEST['opcion'] == 'consultar'){
         $this->consultar();
      }
   }

   public function consultar()
   {
         $modeloConsulta = new ConsultasDiscriminadasModelo();
         $valores = $modeloConsulta->consultarItemsOrden($_REQUEST['fechain'],$_REQUEST['fechain'],$_REQUEST['selectCodigo']);
         // echo '<pre>'; 
         // print_r($valores);
         // echo '</pre>';
         // die();
         $mostrar = $this->vista->mostrarResultados($valores);
       
         
   }

}

?>