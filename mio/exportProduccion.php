<?php
  //Inicio sesion
  session_start();
  
  
  /*if (!isset($_SESSION['sConsulta']))
  {
    header('Location: index.php');
  }*/
  
  include ("sistema/dbconfig.php");
  include ("sistema/conversionUtils.php");
  $rol = $_SESSION["rol"];
  //$sConsulta=$_SESSION['sConsulta'];
  $jefe= $_SESSION["abreviatura"];
  $mes = $_GET["mes"];
  $year = $_GET["year"];
    if($rol==3){
           $sConsulta = "SELECT proyectos.codigoProyecto, clientes.denominacion AS Cliente, proyectos.denominacion AS Proyecto, produccion.CostesPeriodo, produccion.CosteTotal, produccion.PorcentajeCompras, produccion.VentasPeriodo, produccion.VentaTotal, produccion.PorcentajeVentas, produccion.PorcentajeBalance, produccion.JefeProyecto, produccion.Fecha FROM clientes INNER JOIN proyectos INNER JOIN produccion WHERE Month(Fecha) = '$mes' and Year(Fecha) = '$year' AND clientes.id=proyectos.idCliente AND proyectos.id=produccion.IDProyectos ORDER BY Proyecto";
    }else{
        $sConsulta = "SELECT proyectos.codigoProyecto, clientes.denominacion AS Cliente, proyectos.denominacion AS Proyecto, produccion.CostesPeriodo, produccion.CosteTotal, produccion.PorcentajeCompras, produccion.VentasPeriodo, produccion.VentaTotal, produccion.PorcentajeVentas, produccion.PorcentajeBalance, produccion.JefeProyecto, produccion.Fecha  FROM clientes INNER JOIN proyectos INNER JOIN produccion WHERE produccion.JefeProyecto = '$jefe' and month(Fecha)='$mes' and YEAR(Fecha)='$year' AND clientes.id=proyectos.idCliente AND proyectos.id=produccion.IDProyectos  ORDER BY Proyecto";
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
                 ->setTitle("Informe de producción")
                 ->setSubject("Informe de producción")
                 ->setDescription("Informe de producción generado con Jobs Manager.")
                 ->setKeywords("")
                 ->setCategory("");
  
	  //Añado la cabecera
	  $objPHPExcel->setActiveSheetIndex(0)
	  			  ->setCellValue('A1', 'Nº de proyecto')
	              ->setCellValue('B1', 'Cliente')
	              ->setCellValue('C1', 'Proyecto')
	              ->setCellValue('D1', 'Costes del periodo')
	              ->setCellValue('E1', 'Coste total')
	              ->setCellValue('F1', '% Compras')
                      ->setCellValue('G1', 'Ventas del periodo')
                  ->setCellValue('H1', 'Ventas totales')
                  ->setCellValue('I1', '% Ventas')
                  ->setCellValue('J1', '% Balance')
                  ->setCellValue('K1', 'Jefe de proyecto')
                  ->setCellValue('L1', 'Fecha');
	              
	  //Añado los datos
	  $ultimaFila=1;
	    
	  //Cargo la tabla 
	  while ($rRegistro = $qConsulta->fetch_assoc())
	  {
	    $ultimaFila=$ultimaFila+1;
	    
	    $objPHPExcel->setActiveSheetIndex(0)
				  ->setCellValue('A'.$ultimaFila, $rRegistro['codigoProyecto'])
	              ->setCellValue('B'.$ultimaFila, $rRegistro['Cliente'])
	              ->setCellValue('C'.$ultimaFila, $rRegistro['Proyecto'])
	              ->setCellValue('D'.$ultimaFila, $rRegistro['CostesPeriodo'])
	              ->setCellValue('E'.$ultimaFila, $rRegistro['CosteTotal'])
	              ->setCellValue('F'.$ultimaFila, $rRegistro['PorcentajeCompras'])
	              ->setCellValue('G'.$ultimaFila, $rRegistro['VentasPeriodo'])
                  ->setCellValue('H'.$ultimaFila, $rRegistro['VentaTotal'])
                  ->setCellValue('I'.$ultimaFila, $rRegistro['PorcentajeVentas'])
                  ->setCellValue('J'.$ultimaFila, $rRegistro['PorcentajeBalance'])
                  ->setCellValue('K'.$ultimaFila, $rRegistro['JefeProyecto'])
                  ->setCellValue('L'.$ultimaFila, $rRegistro['Fecha']);
                  
	  }    
	   
	              
	  foreach(range('A','L') as $columnID)
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
  header('Content-Disposition: attachment;filename=informeProduccion_'.date('Y-m-d').'.xls');
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