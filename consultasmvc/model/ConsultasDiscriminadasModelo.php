<?php
    namespace model;
    use \PDO;
    use conexion\Conexion;
    class ConsultasDiscriminadasModelo extends Conexion
    {
        public function __construct(){
			$this->conexion = new Conexion();
			$this->conexion = $this->conexion->connect();
		}


        public function consultarItemsOrden($fechain,$fechafin,$selectCodigo){
            $sql = "
                    SELECT o.orden,o.placa,i.codigo,i.descripcion,i.valor_unitario as vrunit,i.cantidad,i.total_item
                    ,i.fecha
                    FROM item_orden i
                    inner join ordenes o on o.id = i.no_factura 
                    where 1= 1
                    
                    ";
            if($fechain != ''){
                $sql .= ' and i.fecha >= "'.$fechain.'" ';
            } 
            if($fechafin != ''){
                $sql .= ' and i.fecha >= "'.$fechafin.'" ';
            } 
             
            if($selectCodigo <> '0'){
                $sql .= ' and i.codigo = "'.$selectCodigo.'" ';
            }       


             $sql .=   "   order by id_item desc 
                    ";
                    
                    // INNER JOIN  carros c ON c.placa = o.placa

            // $sql = "SELECT o.placa,c.tipo,o.orden,i.codigo,i.descripcion,i.cantidad,i.total_item 
            //         FROM item_orden i
            //         INNER JOIN ordenes o ON o.id = i.no_factura
            //         INNER JOIN carros c  ON c.placa = o.placa
            //         INNER JOIN cliente0 cli ON cli.idcliente = c.propietario
            //         WHERE o.anulado = 0
            //         AND i.anulado = 0
            //         AND o.placa <> ''
            //         AND i.codigo <> ''
            //         LIMIT 10  
            //         ";
                    //  echo '<br>'.$sql.'<br>';
                    // die();
             $execute = $this->conexion->query($sql);
             $request = $execute->fetchall(PDO::FETCH_ASSOC);
             return $request;       

        }
    }



?>