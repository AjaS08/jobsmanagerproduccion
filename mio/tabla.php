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
                    $jefe=$_GET["jefe"];
                    $rol=$_GET["rol"];
                    $mes=$_GET["mes"];
                    $year=$_GET["ano"];
                    if($rol=="3"){
                        $result = mysql_query("SELECT COUNT(*) AS RecordCount FROM produccion where month(Fecha)='$mes' and year(Fecha)='$year';");
                    $row = mysql_fetch_array($result);
                    $recordCount = $row['RecordCount'];

                    //Get records from database
                    $result = mysql_query("SELECT produccion.ID, proyectos.codigoProyecto, clientes.denominacion AS Cliente, proyectos.denominacion AS Proyecto, produccion.CostesPeriodo, produccion.CosteTotal, produccion.PorcentajeCompras, produccion.VentasPeriodo, produccion.VentaTotal, produccion.PorcentajeVentas, produccion.PorcentajeBalance, produccion.JefeProyecto, produccion.Fecha, produccion.IDProyectos FROM clientes INNER JOIN proyectos INNER JOIN produccion WHERE month(Fecha)='$mes' and YEAR(Fecha)='$year' AND clientes.id=proyectos.idCliente AND proyectos.id=produccion.IDProyectos  ORDER BY " . $_GET["jtSorting"] . " LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . ";");
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
            
                    $result = mysql_query("SELECT COUNT(*) AS RecordCount FROM produccion WHERE JefeProyecto = '$jefe' and month(Fecha)='$mes' and year(Fecha)='$year';");
                $row = mysql_fetch_array($result);
                $recordCount = $row['RecordCount'];

                //Get records from database
                $result = mysql_query("SELECT produccion.ID, proyectos.codigoProyecto, clientes.denominacion AS Cliente, proyectos.denominacion AS Proyecto, produccion.CostesPeriodo, produccion.CosteTotal, produccion.PorcentajeCompras, produccion.VentasPeriodo, produccion.VentaTotal, produccion.PorcentajeVentas, produccion.PorcentajeBalance, produccion.JefeProyecto, produccion.Fecha, produccion.IDProyectos FROM clientes INNER JOIN proyectos INNER JOIN produccion WHERE produccion.JefeProyecto = '$jefe' and month(Fecha)='$mes' and YEAR(Fecha)='$year' AND clientes.id=proyectos.idCliente AND proyectos.id=produccion.IDProyectos  ORDER BY " . $_GET["jtSorting"] . " LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . ";");
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
            $idProduccion= $_POST['idProduccion'];
            $idProyecto= $_POST['idProyecto'];
            $costePeriodo = $_POST['CostePeriodo'];
            $costeTotal = $_POST['CosteTotal'];
            $porcentajeCompras=$_POST['cientoCompras'];
            $ventasPeriodo=$_POST['VentasPeriodo'];
            $ventaTotal=$_POST['VentasTotal'];
            $porcentajeVentas=$_POST['cientoVentas'];
            $porcentajeBalance=$_POST['cientoBalance'];
            $jefeProyecto = $_POST['jefeProyecto'];
             $Fecha = $_POST["fecha"];
		//Update record in database
		$result = mysql_query("UPDATE `produccion` SET `CostesPeriodo` = '$costePeriodo', `CosteTotal` = '$costeTotal', `PorcentajeCompras` = '$porcentajeCompras', `VentasPeriodo` = '$ventasPeriodo', `VentaTotal` = '$ventaTotal', `PorcentajeVentas` = '$porcentajeVentas', `PorcentajeBalance` = '$porcentajeBalance', `JefeProyecto` = '$jefeProyecto', `Fecha` = '$Fecha', `IDProyectos` = '$idProyecto' WHERE `produccion`.`ID` = '$idProduccion';");

		//Return result to jTable
		$jTableResult = array();
		$jTableResult['Result'] = "OK";
		print json_encode($jTableResult);
	}
	//Deleting a record (deleteAction)
	else if($_GET["action"] == "delete")
	{
		//Delete from database
		$result = mysql_query("DELETE FROM produccion WHERE ID = " . $_POST["ID"] . ";");

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