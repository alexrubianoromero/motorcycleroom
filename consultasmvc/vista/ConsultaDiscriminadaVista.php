<?php
namespace vista;

class ConsultaDiscriminadaVista
{
        public function __construct(){

        }

        public function vistaPrincipal()
        {
            ?>
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Document</title>
            </head>
            <body>
                <div id="div_consultadiscriminada" align="center">
                   <p>
                       CONSULTAS DISCRIMINADAS
                   </p> 
                   <div id="div_botones_consultas">
                        <input type="date" id="fechain">
                        <input type="date" id="fechafin">
                        <select id="selectCodigo">
                            <option value="0">Seleccione un codigo</option>
                            <option value="01">01</option>
                            <option value="MO">MO</option>
                            <option value="TE">TE</option>
                            <option value="TI">TI</option>
                        </select>
                        
                        <button id="consultar" onclick="consultar();">CONSULTAR</button>
        
                   </div>
                   <div id="div_resultados_consultas"></div>
                </div>
                <script src="js/consultas.js"></script>
            </body>
            </html>
            <?php
        }

        function mostrarResultados($valores)
        {
            ?>
            <br><br>
            <table border = "1" >
                <thead>
                    <th>ORDEN</th>
                    <th>PLACA</th>
                    <th>CODIGO</th>
                    <th>DESCRIPCION</th>
                    <th>VALOR_UNIT</th>
                    <th>CANTIDAD</th>
                    <th>TOTAL_ITEM</th>
                    <th>FECHA</th>
                </thead>
                <tbody>
                  <?php
                    $suma = 0;
                    foreach($valores as $item )
                    {
                        if($item['codigo'] !=''){
                            echo '<tr>';
                            echo '<td>'.$item['orden'].'</td>';
                            echo '<td>'.$item['placa'].'</td>';
                            echo '<td>'.$item['codigo'].'</td>';
                            echo '<td>'.$item['descripcion'].'</td>';
                            echo '<td align="right">'.number_format(intval($item['vrunit']), 0, ',', '.').'</td>';
                            echo '<td align="right">'.number_format(intval($item['cantidad']), 0, ',', '.').'</td>';
                            echo '<td align="right">'.number_format(intval($item['total_item']), 0, ',', '.').'</td>';
                            echo '<td align="right">'.$item['fecha'].'</td>';
                            echo '</tr>';
                            $suma = $suma + intval($item['total_item']);
                        }
                    }
                    echo '<tr>'; 
                    echo '<td></td>';
                    echo '<td></td>';
                    echo '<td></td>';
                    echo '<td></td>';
                    echo '<td></td>';
                    echo '<td></td>';
                    echo '<td align="right">'.number_format($suma, 0, ',', '.').'</td>';
                    echo '</tr>';
                  ?>  
                </tbody>
            </table>
            <?php
        
        //  echo '<br>valores<pre>'; 
        //  print_r($valores);
        //  echo '</pre>';
        }
}



?>