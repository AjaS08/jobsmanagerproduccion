<?php

try
{
	//Open database connection
 $con = mysql_connect("localhost","root","");
	mysql_select_db("jobsmanagerproduccion", $con);
    
	/*$con = mysql_connect("localhost","antonioarana","marisma2016");
	mysql_select_db("antonioarana", $con);*/

	//Getting records (listAction)
	if($_GET["action"] == "list")
	{     
                    $funcionPro='';
                    $funcionCli='';
                    $funcionCod='';
                    $funcionFac='';
                    $funcionAlb='';
                    $proveedor=$_GET["proveedor"];
                    $cliente=$_GET["cliente"];
                    $codigo=$_GET["codigo"];
                    $nfactura=$_GET["nfactura"];
                    $nalbaran=$_GET["nalbaran"];
                    $jefe=$_GET["jefe"];
                    $rol=$_GET["rol"];
                    $mesMin=$_GET["mesMin"];
                    $yearMin=$_GET["anoMin"];
                    $mesMax=$_GET["mesMax"];
                    $yearMax=$_GET["anoMax"];
                    $numFilas=$_GET["numFilas"];
                
                    
            if($rol=="3"){
                
                      
                        if($proveedor!="0"){
                         $funcionPro=" AND Proveedor='".utf8_decode($proveedor)."' ";
                        
                        }
                        if($cliente!="0"){
                         
                         $funcionCli=" AND clientes.denominacion='".utf8_decode($cliente)."' ";
                         //mysql_query("SET NAMES utf8");
                        }
                        if($codigo!="0"){
                         $funcionCod=" AND proyectos.codigoProyecto='$codigo' ";
                        
                        }
                        if($nfactura!="0"){
                         $funcionFac=" AND NFactura='$nfactura' ";
                        
                        }
                        if($nalbaran!="0"){
                         $funcionAlb=" AND NAlbaran='$nalbaran' ";
                        
                        }
                
                       $result = mysql_query("SELECT COUNT(*) AS RecordCount FROM registroscompras INNER JOIN proyectos on proyectos.id=registroscompras.IDProyectos INNER JOIN clientes on clientes.id = proyectos.idCliente LEFT OUTER JOIN empleados on empleados.id=proyectos.jefeProyecto WHERE  (month(Fecha)>='$mesMin' AND month(Fecha)<='$mesMax') AND (year(Fecha)>='$yearMin' AND year(Fecha)<='$yearMax') ".$funcionPro.$funcionCli.$funcionCod.$funcionFac.$funcionAlb.";");
                    $row = mysql_fetch_array($result);
                    $recordCount = $row['RecordCount'];
                    
                    //Get records from database
                    $result = mysql_query("SELECT rc.ID,Persona,rc.IDProyectos, proyectos.codigoProyecto, proyectos.denominacion AS NombreProyecto, proyectos.CosteTotal, proyectos.VentaTotal, clientes.denominacion AS NombreCliente, rc.Proveedor,`BaseImponible`,`IVA`,`Importe`,`Fecha`,`CA`,`CC`,empleados.Abreviatura AS Jefe,`Concepto`,`NAlbaran`,`NFactura`,`OrdenCompra`,`Presupuesto` FROM registroscompras rc INNER JOIN proyectos on proyectos.id=rc.IDProyectos INNER JOIN clientes on clientes.id=proyectos.idCliente LEFT OUTER JOIN empleados on empleados.id=proyectos.jefeProyecto WHERE (month(Fecha)>='$mesMin' AND month(Fecha)<='$mesMax') AND (year(Fecha)>='$yearMin' AND year(Fecha)<='$yearMax') ".$funcionPro.$funcionCli.$funcionCod.$funcionFac.$funcionAlb." ORDER BY " .$_GET["jtSorting"]. " LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . ";");
                        $rows = array();
                    while($row = mysql_fetch_array($result))
                    {
                        $rows[] = array_map('htmlentities',array_map('utf8_encode',$row));
                    }

                    //Return result to jTable
                    $jTableResult = array();
                    $jTableResult['Result'] = "OK";
                    $jTableResult['TotalRecordCount'] = $recordCount;
                    $jTableResult['Records'] = $rows;
                    print json_encode($jTableResult);
             }else if($rol==2){
                     
                        if($proveedor!="0"){
                         $funcionPro=" AND Proveedor='".utf8_decode($proveedor)."' ";
                        
                        }
                        if($cliente!="0"){
                         
                         $funcionCli=" AND clientes.denominacion='".utf8_decode($cliente)."' ";
                         //mysql_query("SET NAMES utf8");
                        }
                        if($codigo!="0"){
                         $funcionCod=" AND proyectos.codigoProyecto='$codigo' ";
                        
                        }
                        if($nfactura!="0"){
                         $funcionFac=" AND NFactura='$nfactura' ";
                        
                        }
                        if($nalbaran!="0"){
                         $funcionAlb=" AND NAlbaran='$nalbaran' ";
                        
                        }
                  
                    $result = mysql_query("SELECT COUNT(*) AS RecordCount FROM registroscompras INNER JOIN proyectos on proyectos.id=registroscompras.IDProyectos INNER JOIN clientes on clientes.id = proyectos.idCliente LEFT OUTER JOIN empleados on empleados.id=proyectos.jefeProyecto  WHERE (Persona='$jefe' or empleados.Abreviatura='$jefe') and (month(Fecha)>='$mesMin' AND month(Fecha)<='$mesMax') AND (year(Fecha)>='$yearMin' AND year(Fecha)<='$yearMax') ".$funcionPro.$funcionCli.$funcionCod.$funcionFac.$funcionAlb."  ;");
                $row = mysql_fetch_array($result);
                $recordCount = $row['RecordCount'];
                   
                //Get records from database
                $result = mysql_query("SELECT rc.ID,Persona,rc.IDProyectos, proyectos.codigoProyecto, proyectos.denominacion AS NombreProyecto, proyectos.CosteTotal, proyectos.VentaTotal, clientes.denominacion AS NombreCliente, rc.Proveedor,`BaseImponible`,`IVA`,`Importe`,`Fecha`,`CA`,`CC`,empleados.Abreviatura AS Jefe,`Concepto`,`NAlbaran`,`NFactura`,`OrdenCompra`,`Presupuesto` FROM registroscompras rc INNER JOIN proyectos on proyectos.id=rc.IDProyectos INNER JOIN clientes on clientes.id=proyectos.idCliente LEFT OUTER JOIN empleados on empleados.id=proyectos.jefeProyecto WHERE (Persona='$jefe' or empleados.Abreviatura='$jefe') and (month(Fecha)>='$mesMin' AND month(Fecha)<='$mesMax') AND (year(Fecha)>='$yearMin' AND year(Fecha)<='$yearMax')".$funcionPro.$funcionCli.$funcionCod.$funcionFac.$funcionAlb." ORDER BY " . $_GET["jtSorting"] . " LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . ";");
                    $rows = array();
                while($row = mysql_fetch_array($result))
                {
                    $rows[] = array_map('htmlentities',array_map('utf8_encode',$row));
                }

                //Return result to jTable
                $jTableResult = array();
                $jTableResult['Result'] = "OK";
                $jTableResult['TotalRecordCount'] = $recordCount;
                $jTableResult['Records'] = $rows;
                print json_encode($jTableResult);
        }else{
                
                    
                        if($proveedor!="0"){
                         $funcionPro=" AND Proveedor='".utf8_decode($proveedor)."' ";
                        
                        }
                        if($cliente!="0"){
                         
                         $funcionCli=" AND clientes.denominacion='".utf8_decode($cliente)."' ";
                         //mysql_query("SET NAMES utf8");
                        }
                        if($codigo!="0"){
                         $funcionCod=" AND proyectos.codigoProyecto='$codigo' ";
                        
                        }
                        if($nfactura!="0"){
                         $funcionFac=" AND NFactura='$nfactura' ";
                        
                        }
                        if($nalbaran!="0"){
                         $funcionAlb=" AND NAlbaran='$nalbaran' ";
                        
                        }
                    $result = mysql_query("SSELECT COUNT(*) AS RecordCount FROM registroscompras INNER JOIN proyectos on proyectos.id=registroscompras.IDProyectos INNER JOIN clientes on clientes.id = proyectos.idCliente LEFT OUTER JOIN empleados on empleados.id=proyectos.jefeProyecto  WHERE (Persona='$jefe') and (month(Fecha)>='$mesMin' AND month(Fecha)<='$mesMax') AND (year(Fecha)>='$yearMin' AND year(Fecha)<='$yearMax') ".$funcionPro.$funcionCli.$funcionCod.$funcionFac.$funcionAlb.";");
                $row = mysql_fetch_array($result);
                $recordCount = $row['RecordCount'];

                //Get records from database
                $result = mysql_query("SELECT rc.ID,Persona,rc.IDProyectos, proyectos.codigoProyecto, proyectos.denominacion AS NombreProyecto, proyectos.CosteTotal, proyectos.VentaTotal, clientes.denominacion AS NombreCliente, rc.Proveedor,`BaseImponible`,`IVA`,`Importe`,`Fecha`,`CA`,`CC`,empleados.Abreviatura AS Jefe,`Concepto`,`NAlbaran`,`NFactura`,`OrdenCompra`,`Presupuesto` FROM registroscompras rc INNER JOIN proyectos on proyectos.id=rc.IDProyectos INNER JOIN clientes on clientes.id=proyectos.idCliente LEFT OUTER JOIN empleados on empleados.id=proyectos.jefeProyecto WHERE (Persona='$jefe') and (month(Fecha)>='$mesMin' AND month(Fecha)<='$mesMax') AND (year(Fecha)>='$yearMin' AND year(Fecha)<='$yearMax')".$funcionPro.$funcionCli.$funcionCod.$funcionFac.$funcionAlb."  ORDER BY " . $_GET["jtSorting"] . " LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . ";");
                    $rows = array();
                while($row = mysql_fetch_array($result))
                {
                    $rows[] = array_map('htmlentities',array_map('utf8_encode',$row));
                }

                //Return result to jTable
                $jTableResult = array();
                $jTableResult['Result'] = "OK";
                $jTableResult['TotalRecordCount'] = $recordCount;
                $jTableResult['Records'] = $rows;
                print json_encode($jTableResult);
                }
                //Get record count


                //Add all records to an array
		
	}
	//Updating a record (updateAction)
	else if($_GET["action"] == "update")
	{
            $idProyecto=$_POST["idProyecto"];
            $idRegistroCompra=$_POST["idRegistroCompra"];
            $proveedor = $_POST["Proveedor"];
            $baseImponible = $_POST["BaseImponible"];
            $IVA = $_POST["Iva"];
            $importe = $_POST["Importe"];
            $fecha = $_POST["fecha"];
            $CA = $_POST["Ca"];
            $CC = $_POST["Cc"];
            $Persona=$_POST["Persona"];
            $concepto = $_POST["Concepto"];
            $nAlbaran = $_POST["Albaran"];
            $nFactura = $_POST["Factura"];
            $ordenCompra = $_POST["OrdenCompra"];
            $presupuesto = $_POST["Presupuesto"];
		//Update record in database
		$result = mysql_query("UPDATE `registroscompras` SET `IDProyectos` = '$idProyecto', `Persona` = '$Persona', `Proveedor` = '$proveedor', `BaseImponible` = '$baseImponible', `IVA` = '$IVA', `Importe` = '$importe', `Fecha` = '$fecha', `CA` = '$CA', `CC` = '$CC', `Concepto` = '$concepto', `NAlbaran` = '$nAlbaran', `NFactura` = '$nFactura', `OrdenCompra` = '$ordenCompra', `Presupuesto` = '$presupuesto' WHERE `registroscompras`.`ID` = '$idRegistroCompra';");

		//Return result to jTable
		$jTableResult = array();
		$jTableResult['Result'] = "OK";
		print json_encode($jTableResult);
	}
	//Deleting a record (deleteAction)
	else if($_GET["action"] == "delete")
	{
		//Delete from database
		$result = mysql_query("DELETE FROM registroscompras WHERE ID = " . $_POST["ID"] . ";");

		//Return result to jTable
		$jTableResult = array();
		$jTableResult['Result'] = "OK";
		print json_encode($jTableResult);
	}

	//Close database connection
	mysql_close($con);

}
catch(Exception $ex)
{
    //Return error message
	$jTableResult = array();
	$jTableResult['Result'] = "ERROR";
	$jTableResult['Message'] = $ex->getMessage();
	print json_encode($jTableResult);
}
	
?>