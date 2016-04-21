<?php
//Inicio sesion
if (!isset($_SESSION)) {
    session_start();
}
//Compruebo que este logueado
if (!isset($_SESSION['nombre'])) {
    header('Location: index.php');
}
  
$dondeEstoy = 'Calcular Producción';
//Cargo la cabecera
include ("cabecera.php");
//Cargo el menu principal

include ("menupal.php");

include("menuproduccion.php");
//Conecto con la BD
include ("sistema/dbconfig.php");
include ("sistema/conversionUtils.php");

$idProyecto="";
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
$rol = $_SESSION["rol"];

            $jefeProyecto = $_SESSION["abreviatura"];


//Compruebo si hay que realizar alguna accion
  



?>

<div class="contenedor">
    <?php
    $idEmpleado = $_SESSION["idEmpleado"];
    //cargo proyectos en funcion del rol, jefe de unidad o jefe de area
    if($rol == 3){
        $query = "SELECT id,codigoProyecto,denominacion FROM Proyectos WHERE codigoActividad >= 400 and codigoActividad <500  order by codigoProyecto"; 
    }
    else if($rol ==2){       
        $query = "SELECT p.id,codigoProyecto,denominacion FROM Proyectos p  where p.jefeProyecto = '$idEmpleado' order by codigoProyecto";
    }
    $result = $GLOBALS["link"] -> query($query);
    ?>
    <fieldset >
        
        <legend>Datos de producción</legend>  
        <form id = "cargarProyecto" method = "post">
        <select id = "Proyecto" name="Proyecto"  >
            <option value="">Elegir proyecto</option>
            <?php
            while ($rProyecto = $result->fetch_assoc()) {
                $codProyecto = $rProyecto['codigoProyecto'];
                $nombre = $rProyecto['denominacion'];
                $idProyecto = $rProyecto['id'];
                ?>
                <option value="<?php echo $idProyecto; ?>"
                <?php
                if ($idProyecto == $_POST['Proyecto']) {
                    
                    echo "selected";
                }
                ?>
                        ><?php echo $codProyecto . "," . $nombre ?></option>
                    <?php } ?>
        </select>
            <input id="tbMesPro" class="tbMes" name="tbMes" type='text'  readonly />
        <input type="button" id="cargar" class="boton" value="Cargar"/>
        <div id="borr2"></div>
        <?php
            $idProyecto=$_POST['Proyecto'];
        
        //guardo los datos de produccion
        if(isset($_POST["Guardar"])){
           
            $codigoProyecto = $_POST["tbCodigoProyecto"];
            $nombreProyecto = $_POST["tbNombre"];
            $cliente = $_POST["tbCliente"];
            $costesPeriodo = $_POST["tbCostesPeriodo"];
            $costeTotal = $_POST["tbCosteTotal"];
            $porcentajeCompras=$_POST["tbPorcentajeCompras"];
            $ventasPeriodo=$_POST["tbVentasPeriodo"];
            $ventaTotal=$_POST["tbVentaTotal"];
            $porcentajeVentas=$_POST["tbPorcentajeVentas"];
            $porcentajeBalance=$_POST["tbPorcentajeBalance"];
            $idProyecto=$_POST["idProyec"];
            $fecha = $_POST["tbFechaProduccion"];           
            $jefePro=$_POST["tbJefeProyecto"];
           list($mes, $year) = split('[/.-]', $fecha);
            $fechaIntro=$year."/".$mes."/01";
            $qBorrar="DELETE FROM `produccion`WHERE month(Fecha)='$mes'AND year(Fecha)='$year'";
             $borrarProduccion = $GLOBALS["link"]->query($qBorrar);
            $qInsertarProduccion ="INSERT INTO produccion (CostesPeriodo,CosteTotal,PorcentajeCompras,VentasPeriodo,VentaTotal,PorcentajeVentas,PorcentajeBalance,JefeProyecto,Fecha,IDProyectos) VALUES ('$costesPeriodo','$costeTotal','$porcentajeCompras','$ventasPeriodo','$ventaTotal','$porcentajeVentas','$porcentajeBalance','$jefePro','$fechaIntro','$idProyecto')";           
            $guardarProduccion = $GLOBALS["link"]->query($qInsertarProduccion);    
           
        }
        
        
        
        ?>
        </form>
        </fieldset>
    <?php

if ($errorBorrado)
    {
  ?>
    <div class="avisoError">Error al eliminar la producci&oacuten.</div>
  <?php      
    }
  ?>
  <!-- preparo tabla para mostrar produccion-->
  <fieldset  >
  <legend >Producci&oacuten</legend>
  Desde
  <input id="tbMes" class="tbMes" name="tbMes" type='text'  readonly />
  <input id="generarPro" class="boton" type="button" value="Generar informe" />
  <br />
  <br />
  <div id="tbProduc"></div>
  </fieldset>
    
    </div>

<script type="text/javascript">



    
        
    
    
    
   function validaCambioProyecto(){
    var proyecto = document.getElementById('Proyecto');
    var fCargarProyecto = document.getElementById('cargarProyecto');

    if (proyecto.options[proyecto.selectedIndex].value !== "")
    {
        fCargarProyecto.submit();
    }
    fCargarProyecto.submit();
  } 
    
    
    function validaGuardarProduccion(){
   
    var baseImponible = document.getElementById("tbBaseImponible");
    var IVA = document.getElementById("tbIVA");
    var importe = document.getElementById("tbImporte");
    
    if (!parseFloat(baseImponible.value))
    {
        alert("Indique un valor correcto para base imponible");
        baseImponible.focus();
        return 0;
    }

    if (!parseFloat(IVA.value))
    {
        alert("Indique un valor correcto para el IVA");
        IVA.focus();
        return 0;
    }

    if (!parseFloat(importe.value))
    {
        alert("Indique un valor correcto para el importe");
        importe.focus();
        return 0;
    }
    
}

function calcularPorcentajeVentas(){
    var ventasPeriodo = parseFloat(document.getElementById('tbVentasPeriodo').value);
    var ventaTotal = parseFloat(document.getElementById('tbVentaTotal').value);
    if(!isNaN(ventasPeriodo) && !isNaN(ventaTotal)){
         var porcentaje; 
         if(ventaTotal == 0){
             porcentaje = 0;
        }else{
            porcentaje = parseFloat(((ventasPeriodo / ventaTotal)*100));
        }
        document.getElementById('tbPorcentajeVentas').value = porcentaje;
    }
     else{
        document.getElementById('tbPorcentajeVentas').value = "";
    }
}
    
    
   
  
</script>


    <?php
    include ("pie.php");
include ("linkJQuery.php");
    ?>          