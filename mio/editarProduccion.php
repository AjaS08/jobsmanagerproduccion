
<?php
echo "<script type='text/javascript' src='javascript/jq.js'></script>";
            


            include ("sistema/dbconfig.php");
           
        //cargo resto de datos si se ha elegido un proyecto
            $idProduccion= $_POST['var1'];
            $codigoProyecto= $_POST['var2'];
            $nombreProyecto = $_POST['var4'];
            $cliente = $_POST['var3'];
            $costesPeriodo = $_POST['var5'];
            $costeTotal = $_POST['var6'];
            $porcentajeCompras=$_POST['var7'];
            $ventasPeriodo=$_POST['var8'];
            $ventaTotal=$_POST['var9'];
            $porcentajeVentas=$_POST['var10'];
            $porcentajeBalance=$_POST['var11'];
            $jefeProyecto = $_POST['var12'];
             $Fecha = $_POST["var13"];
            
          
            echo "<br />";
            echo "<br />";
            echo "C&oacutedigo de proyecto: ";
            echo"<input id='tbCodigoProyecto' name='tbCodigoProyecto' type='text' size = 10 value= '$codigoProyecto' readonly />";
            echo "Cliente: ";
            echo"<input id='tbCliente' name='tbCliente' type='text' size = '100' value= '$cliente' readonly />"; 
            echo "<br />";
            echo "<br />";
            echo "Nombre: ";
            echo"<input id='tbNombre' name='tbNombre' type='text' size = '120' value= '$nombreProyecto' readonly />";
            echo "<br />";
            echo "<br />";
            echo "Fecha: ";
            if($Fecha != ""){
               //$Fecha = myDateToDate($Fecha);
            }
            else{
                $Fecha = date("d/m/Y");
            }
            $datesplit = explode("/", $Fecha);
            $mes = $datesplit[1];
            $año = $datesplit[2];
            echo"<input id='tbFecha' name='tbFecha' class='tbFecha' type='text' value = '$Fecha'  readonly />";
            echo "<br />";
            echo "<br />";   
             echo"<input id='idProduccion' name='idProduccion' type='hidden' value='$idProduccion' readonly />";
            echo"<input id='pantEdit' name='pantEdit' type='hidden' value='edit' readonly />";
            echo "Costes periodo: ";
            echo"<input id='tbCostesPeriodo' name='tbCostesPeriodo' type='text' value= '$costesPeriodo' readonly />";
            echo "Coste total: ";
            echo"<input id='tbCosteTotal' name='tbCosteTotal' type='text' value= '$costeTotal' readonly />";
            echo "% Compras: ";
            if($costeTotal == 0){
                $porcentajeCompras = 0;
            }else{ 
                $porcentajeCompras=($costesPeriodo/$costeTotal)*100;
            }
            echo"<input id='tbPorcentajeCompras' name='tbPorcentajeCompras' type='text' value= '$porcentajeCompras'readonly />";
            echo "<br />";
            echo "<br />";
            echo "Ventas periodo: ";
            if($ventasPeriodo == ""){
                $ventasPeriodo = ($porcentajeCompras * $ventaTotal) /100;
            }
            echo"<input id='tbVentasPeriodo' name='tbVentasPeriodo' type='text' value= '$ventasPeriodo' />";
            echo "Venta total: ";
            echo"<input id='tbVentaTotal' name='tbVentaTotal' type='text' value= '$ventaTotal' readonly />";
            echo "% Ventas: ";
            if($ventaTotal == 0){
                $porcentajeVentas = 0;
            }else{ 
                $porcentajeVentas=($ventasPeriodo/$ventaTotal)*100;
            }
            echo"<input id='tbPorcentajeVentas' name='tbPorcentajeVentas' type='text' value= '$porcentajeVentas' readonly />";
            echo "<br />";
            echo "<br />";
            echo "% Balance: ";
            
            if($ventasPeriodo == 0){
                
                $porcentajeBalance = 0;
            }else{ 
               
                $porcentajeBalance=(($ventasPeriodo-$costesPeriodo)/$ventasPeriodo)*100;
            }
            echo"<input id='tbPorcentajeBalance' name='tbPorcentajeBalance' type='text' value= '$porcentajeBalance' readonly />";
            echo "Jefe de proyecto: ";
            echo"<input id='tbJefeProyecto' name='tbJefeProyecto' type='text' value= '$jefeProyecto' readonly />";
            echo"<center>";
           echo"<input type ='button' class='boton' id='Editar' name = 'Editar' type='button' value='Guardar Edicion'/>     ";
                echo"<input type ='button' class='boton' id='CancelaPro' name = 'CancelaPro'  value='Cancelar'/>";
            echo"</center>";
?>

        
