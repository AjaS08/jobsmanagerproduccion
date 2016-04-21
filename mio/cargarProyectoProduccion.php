

<?php
echo "<script type='text/javascript' src='javascript/jq.js'></script>";
     echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';       


            include ("sistema/dbconfig.php");
            $codigoProyecto = "";
            $nombreProyecto = "";
            $cliente = "";
            $costesPeriodo = "";
            $costeTotal = "";
            $porcentajeCompras="";
            $ventasPeriodo="";
            $ventaTotal="";
            $porcentajeVentas="";
            $porcentajeBalance="";
            $jefeProyecto = "";
        //cargo resto de datos si se ha elegido un proyecto
            $idProyecto= $_POST['var1'];
            $edit= $_POST['var2'];
            $mesPro=$_POST['var4'];
            $anoPro=$_POST['var5'];
            $rProyecto = $GLOBALS["link"]->query("SELECT p.denominacion as nombreProyecto,codigoProyecto,codigoActividad,CosteTotal,VentaTotal, c.denominacion as nombreCliente,jefeProyecto FROM proyectos p inner join clientes c on p.idCliente = c.id where p.id = '$idProyecto'")->fetch_assoc();
            $codigoProyecto = $rProyecto['codigoProyecto'];
            $codigoActividad = $rProyecto['codigoActividad'];
            $nombre = $rProyecto['nombreProyecto'];
            $costeTotal = $rProyecto['CosteTotal'];
            $ventaTotal = $rProyecto['VentaTotal'];
            $cliente = $rProyecto['nombreCliente'];
            
            $jefeProyecto = $rProyecto['jefeProyecto'];
            $rPersona = $GLOBALS["link"]->query("SELECT Abreviatura FROM empleados WHERE id = '$jefeProyecto'") -> fetch_assoc();
            $persona = $rPersona["Abreviatura"];
            echo "<br />";
            echo "<br />";
            echo "C&oacutedigo de proyecto: ";
            echo"<input id='tbCodigoProyecto' name='tbCodigoProyecto' type='text' size = 10 value= '$codigoProyecto' readonly />";
            echo "Cliente: ";
            echo"<input id='tbCliente' name='tbCliente' type='text' size = '100' value= '$cliente' readonly />"; 
            echo "<br />";
            echo "<br />";
            echo "Nombre: ";
            echo"<input id='tbNombre' name='tbNombre' type='text' size = '120' value= '$nombre' readonly />";
            echo "<br />";
            echo "<br />";
            echo "Fecha: ";
           if($edit=="0"){
              echo"<input id='tbFechaProduccion' name='tbFechaProduccion' class='tbFechaProduccion' type='text' value = ".$mesPro."/".$anoPro."  readonly />";  
           }else{
               $Fecha = $_POST["var6"];
               echo"<input id='tbFechaProduccion' name='tbFechaProduccion' class='tbFechaProduccion' type='text' value = ".$Fecha."  readonly />";
           }
           
            echo "<br />";
            echo "<br />";   
            $rCostesPeriodo =$GLOBALS["link"]->query("SELECT sum(BaseImponible) as CostesPeriodo FROM registroscompras INNER JOIN proyectos on proyectos.id= registroscompras.IDProyectos  WHERE `IDProyectos`='$idProyecto'  and Month(Fecha) = '$mesPro' and Year(Fecha)='$anoPro'")->fetch_assoc();
            $costesPeriodo = $rCostesPeriodo["CostesPeriodo"];
            if($costesPeriodo==""){
                $costesPeriodo=0;
            }
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
            echo"<input id='idProyec' name='idProyec' type='hidden' value='$idProyecto' readonly />";
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
            echo"<input id='tbJefeProyecto' name='tbJefeProyecto' type='text' value= '$persona' readonly />";
            if($edit=="0"){
                 echo"<center>";
            
            echo"<input type ='button' class='boton' id='btnGuardar' name = 'Guardar' type='button' value='Guardar'/>     ";
                 echo"<input type ='button' class='boton' id='CancelaPro' name = 'CancelaPro'  value='Cancelar'/>";
            echo"</center>";
            }
            if($edit=="1"){
               $idProduccion= $_POST['var3'];
                echo"<input id='idProduccion' name='idProduccion' type='hidden' value='$idProduccion' readonly />";
            echo"<input id='pantEdit' name='pantEdit' type='hidden' value='edit' readonly />";
                 echo"<center>";
            
             echo"<input type ='button' class='boton' id='Editar' name = 'Editar' type='button' value='Guardar Edicion'/>     ";
                echo"<input type ='button' class='boton' id='CancelaPro' name = 'CancelaPro'  value='Cancelar'/>";
            echo"</center>";
            }
           
?>
