<?php
  //Inicio sesion
  session_start();
  
  
  /*if (!isset($_SESSION['sConsulta']))
  {
    header('Location: index.php');
  }*/
  
  include ("sistema/dbconfig.php");
  include ("sistema/conversionUtils.php");
  
  //$sConsulta=$_SESSION['sConsulta'];
 $rol = $_SESSION["rol"];
  //$sConsulta=$_SESSION['sConsulta'];
  $jefe= $_SESSION["abreviatura"];
  $mes = $_GET["mes"];
  $year = $_GET["year"];
    if($rol==3){
           $sConsulta = "SELECT proyectos.codigoProyecto, proyectos.denominacion AS NombreProyecto, proyectos.CosteTotal, proyectos.VentaTotal, clientes.denominacion AS NombreCliente, rc.Proveedor, `BaseImponible`,`IVA`,`Importe`,`Fecha`,`CA`,`CC`,Persona, `Concepto`,`NAlbaran`,`NFactura`,`OrdenCompra`,`Presupuesto` FROM registroscompras rc INNER JOIN proyectos on proyectos.id=rc.IDProyectos INNER JOIN clientes on clientes.id=proyectos.idCliente LEFT OUTER JOIN empleados on empleados.id=proyectos.jefeProyecto WHERE month(Fecha)='$mes' and YEAR(Fecha)='$year'  ORDER BY NombreProyecto";
    }else if($rol==2){
        $sConsulta = "SELECT proyectos.codigoProyecto, proyectos.denominacion AS NombreProyecto, proyectos.CosteTotal, proyectos.VentaTotal, clientes.denominacion AS NombreCliente, rc.Proveedor, `BaseImponible`,`IVA`,`Importe`,`Fecha`,`CA`,`CC`,Persona, `Concepto`,`NAlbaran`,`NFactura`,`OrdenCompra`,`Presupuesto` FROM registroscompras rc INNER JOIN proyectos on proyectos.id=rc.IDProyectos INNER JOIN clientes on clientes.id=proyectos.idCliente LEFT OUTER JOIN empleados on empleados.id=proyectos.jefeProyecto WHERE (Persona='$jefe' or empleados.Abreviatura='$jefe') and month(Fecha)='$mes' and YEAR(Fecha)='$year' ORDER BY NombreProyecto";
    }else{
        $sConsulta = "SELECT proyectos.codigoProyecto, proyectos.denominacion AS NombreProyecto, proyectos.CosteTotal, proyectos.VentaTotal, clientes.denominacion AS NombreCliente, rc.Proveedor, `BaseImponible`,`IVA`,`Importe`,`Fecha`,`CA`,`CC`,Persona, `Concepto`,`NAlbaran`,`NFactura`,`OrdenCompra`,`Presupuesto` FROM registroscompras rc INNER JOIN proyectos on proyectos.id=rc.IDProyectos INNER JOIN clientes on clientes.id=proyectos.idCliente LEFT OUTER JOIN empleados on empleados.id=proyectos.jefeProyecto WHERE (Persona='$jefe') and month(Fecha)='$mes' and YEAR(Fecha)='$year'   ORDER BY NombreProyecto";
    }
    
  //$sConsulta="SELECT * FROM registroscompras";
  $qConsulta=$GLOBALS["link"]->query($sConsulta);

  /** Error reporting */
  error_reporting(E_ALL);
  ini_set('display_errors', TRUE);
  ini_set('display_startup_errors', TRUE);
  date_default_timezone_set('Europe/Madrid');
  
  if (PHP_SAPI == 'cli')
    die('This example should only be run from a Web Browser');
  
  /** Include PHPExcel */
  require_once(dirname(__FILE__)."/sistema/PHPExcel.php");
    
  // Create new PHPExcel object
  $objPHPExcel = new PHPExcel();
  
  // Set document properties
  $objPHPExcel->getProperties()->setCreator("Jobs Manager")
                 ->setLastModifiedBy("Jobs Manager")
                 ->setTitle("Informe de registros de compra")
                 ->setSubject("Informe de registros de compra")
                 ->setDescription("Informe de registros de compra generado con Jobs Manager.")
                 ->setKeywords("")
                 ->setCategory("");
  
	  //Añado la cabecera
	  $objPHPExcel->setActiveSheetIndex(0)
	  			  ->setCellValue('A1', 'Código de proyecto')
	              ->setCellValue('B1', 'Nombre de proyecto')
	              ->setCellValue('C1', 'Coste')
	              ->setCellValue('D1', 'Venta')
	              ->setCellValue('E1', 'Cliente')
	              ->setCellValue('F1', 'Proveedor')
                      ->setCellValue('G1', 'Base imponible')
                  ->setCellValue('H1', 'IVA')
                  ->setCellValue('I1', 'Importe')
                  ->setCellValue('J1', 'Fecha')
                  ->setCellValue('K1', 'CA')
                  ->setCellValue('L1', 'CC')
                  ->setCellValue('M1', 'Persona')
                  ->setCellValue('N1', 'Concepto')
                  ->setCellValue('O1', 'Nº de albaran')
                  ->setCellValue('P1', 'Nº de factura')
                  ->setCellValue('Q1', 'Orden de compra')
	              ->setCellValue('R1', 'Presupuesto');
	              
	  //Añado los datos
	  $ultimaFila=1;
	    
	  //Cargo la tabla 
	  while ($rRegistro = $qConsulta->fetch_assoc())
	  {
	    $ultimaFila=$ultimaFila+1;
	    
	    $objPHPExcel->setActiveSheetIndex(0)
				  ->setCellValue('A'.$ultimaFila, $rRegistro['codigoProyecto'])
	              ->setCellValue('B'.$ultimaFila, $rRegistro['NombreProyecto'])
	              ->setCellValue('C'.$ultimaFila, $rRegistro['CosteTotal'])
	              ->setCellValue('D'.$ultimaFila, $rRegistro['VentaTotal'])
	              ->setCellValue('E'.$ultimaFila, $rRegistro['NombreCliente'])
	              ->setCellValue('F'.$ultimaFila, $rRegistro['Proveedor'])
	              ->setCellValue('G'.$ultimaFila, $rRegistro['BaseImponible'])
                  ->setCellValue('H'.$ultimaFila, $rRegistro['IVA'])
                  ->setCellValue('I'.$ultimaFila, $rRegistro['Importe'])
                  ->setCellValue('J'.$ultimaFila, $rRegistro['Fecha'])
                  ->setCellValue('K'.$ultimaFila, $rRegistro['CA'])
                  ->setCellValue('L'.$ultimaFila, $rRegistro['CC'])
                  ->setCellValue('M'.$ultimaFila, $rRegistro['Persona'])
                  ->setCellValue('N'.$ultimaFila, $rRegistro['Concepto'])
                  ->setCellValue('O'.$ultimaFila, $rRegistro['NAlbaran'])
                  ->setCellValue('P'.$ultimaFila, $rRegistro['NFactura'])
                  ->setCellValue('Q'.$ultimaFila, $rRegistro['OrdenCompra'])
                  ->setCellValue('R'.$ultimaFila, $rRegistro['Presupuesto']);
                  
	  }    
	   
	              
	  foreach(range('A','R') as $columnID)
	  {
	    $objPHPExcel->getActiveSheet()->getColumnDimension($columnID)
	        ->setAutoSize(true);
	  }
             
  //Pongo el nombre de la hoja
  $objPHPExcel->getActiveSheet()->setTitle('RegistrosCompras');
    
  //Set active sheet index to the first sheet, so Excel opens this as the first sheet
  $objPHPExcel->setActiveSheetIndex(0);
  
  //Redirect output to a client’s web browser (Excel5)
  header('Content-Type: application/vnd.ms-excel');
  header('Content-Disposition: attachment;filename=informeRegistrosCompras_'.date('Y-m-d').'.xls');
  header('Cache-Control: max-age=0');
  // If you're serving to IE 9, then the following may be needed
  header('Cache-Control: max-age=1');
  
  // If you're serving to IE over SSL, then the following may be needed
  header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
  header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
  header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
  header ('Pragma: public'); // HTTP/1.0
  
  $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
  $objWriter->save('php://output');
  exit;
?>