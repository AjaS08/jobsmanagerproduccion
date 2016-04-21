  
<?php

 
//Inicio sesion
if(!isset($_SESSION)){
	session_start();
}
//Compruebo que este logueado
if (!isset($_SESSION['nombre']))
{
	header('Location: index.php');
}
$dondeEstoy='Crear Registro de Compra';
//Cargo la cabecera
include ("cabecera.php");
//Cargo el menu principal
include ("menupal.php");

include("menuproduccion.php");
//Conecto con la BD
include ("sistema/dbconfig.php");
include ("sistema/conversionUtils.php");



$idProyecto="";
$Proyecto ="";
$Proveedor="";
$BaseImponible="";
$IVA=21;
$Importe="";
$Fecha ='';
$Concepto="";
$NAlbaran="";
$NFactura="";
$OrdenCompra="";
$Presupuesto="";
$persona = "";
$rol = $_SESSION["rol"];
$jefeProyecto = $_SESSION["abreviatura"];
$persona = $_SESSION["abreviatura"];



//Compruebo si hay que realizar alguna accion
  






?>

<div class="contenedor">
<fieldset>

<legend id="legRegis">Nuevo registro de compra</legend>

<form id = "cargarProyecto" method = "post">
<div>
Proyecto
<br />
<?php 
        $idEmpleado = $_SESSION["idEmpleado"];
        
        //cargo proyectos en funcion del rol, jefe de unidad o jefe de area
        
        if($rol == 3){
           $query="SELECT id,codigoProyecto,denominacion FROM Proyectos WHERE codigoActividad >= 400 and codigoActividad <500  order by codigoProyecto";
       
        }
        else if($rol <=2){
            $query="SELECT p.id,codigoProyecto,denominacion FROM Proyectos p inner join EmpleadosProyectos ep on p.id = ep.idProyecto inner join Empleados e on ep.idEmpleado = e.id where e.id = '$idEmpleado' and p.codigoActividad >= 400 and p.codigoActividad <500  order by p.codigoProyecto";
        }
        $result = $GLOBALS["link"] -> query($query);?>
<select id = "Proyectos" name="Proyectos"  >
        <option value="">Elegir proyecto</option>
        <?php
        while ($rProyecto = $result -> fetch_assoc()) {
            $codProyecto = $rProyecto['codigoProyecto'];
            $nombre = $rProyecto['denominacion'];
            $idProyecto = $rProyecto['id'];
            ?>
            <option value="<?php echo $idProyecto; ?>"
            <?php
            if($idProyecto == $_POST['Proyecto'])
            {
                echo "selected";
            }
            ?>
            ><?php echo $codProyecto.",".$nombre?></option>
        <?php } ?>
        </select>
    </form>
       <div id="borr2"></div>
    
        <?php
        $idProyecto=$_POST['Proyecto'];
        
        if(isset($_POST["Guardar"])){
             $idProyecto=$_POST["idProyec"];
            
            $proveedor = $_POST["Proveedor"];
            $baseImponible = $_POST["tbBaseImponible"];
            $IVA = $_POST["tbIVA"];
            $importe = $_POST["tbImporte"];
            $fecha = dateToMyDate($_POST["tbFecha"]);
            $CA = $_POST["tbCA"];
            $CC = $_POST["tbCC"];
            $Persona=$_POST["tbPersona"];
            $concepto = $_POST["tbConcepto"];
            $nAlbaran = $_POST["tbNAlbaran"];
            $nFactura = $_POST["tbNFactura"];
            $ordenCompra = $_POST["tbOrdenCompra"];
            $presupuesto = $_POST["tbPresupuesto"];
            //compruebo si viene de editar para actualizar bd en vez de insertar
            
                $qInsertarRegistroCompra ="INSERT INTO registroscompras (IDProyectos,Persona,Proveedor,BaseImponible,IVA,Importe,Fecha,CA,CC,Concepto,NAlbaran,NFactura,OrdenCompra,Presupuesto) VALUES ('$idProyecto','$Persona','$proveedor','$baseImponible','$IVA','$importe','$fecha','$CA','$CC','$concepto','$nAlbaran','$nFactura','$ordenCompra','$presupuesto')";        
                $guardarRegistroCompra = $GLOBALS["link"]->query($qInsertarRegistroCompra);    
          
            
           
            
                   
        }
        
    
   
    
?>

</div>
</fieldset>

<fieldset >
  <legend>Registros de compras</legend>
      
  Desde: 
  <input id="tbMes1" class="tbMes" name="tbMes" type='text'  value = "<?php echo isset($_POST['tbMes']) ? $_POST['tbMes'] : ''; ?>" readonly />
   Hasta: <input id="tbMes2" class="tbMes" name="tbMes" type='text'  value = "<?php echo isset($_POST['tbMes']) ? $_POST['tbMes'] : ''; ?>" readonly />
  <input id="generarRegisInf" class="boton" type="button" value="Generar informe"  />
  <br />
  <br />
      <div id="scroAncho">
<div class="filtering">
    <form>
        Codigo Proyecto: 
        <?php
        if($rol == 3){
           $query="SELECT codigoProyecto,denominacion FROM Proyectos WHERE codigoActividad >= 400 and codigoActividad <500  order by codigoProyecto";
       
        }
        else if($rol <=2){
            $query="SELECT codigoProyecto,denominacion FROM Proyectos p inner join EmpleadosProyectos ep on p.id = ep.idProyecto inner join Empleados e on ep.idEmpleado = e.id where e.id = '$idEmpleado' and p.codigoActividad >= 400 and p.codigoActividad <500  order by p.codigoProyecto";
        }
        $result = $GLOBALS["link"] -> query($query);?>
        <select id = "Proyee" name="Proyee" style="width: 125px;" >
        <option selected="selected" value="0">Todos los proyectos</option>
        <?php
        while ($rProyecto = $result -> fetch_assoc()) {
            $codProyecto = $rProyecto['codigoProyecto'];
            $nombre= $rProyecto['denominacion'];
            ?>
            <option value="<?php echo $codProyecto ?>">
                <?php echo $codProyecto.",".$nombre?></option>
        <?php } ?>
        </select>
        Proveedor:
        <select id="Provee" name="Provee" style="width: 125px;">
            <option selected="selected" value="0">Todos los Proveedores</option>
         <?php
        $query="SELECT CIF,Denominacion FROM Proveedores";
           $result = $GLOBALS["link"] -> query($query);
        
           while ($rProveedor = $result -> fetch_assoc()) {
              $CIF = $rProveedor['CIF'];
              $nombre = $rProveedor['Denominacion'];
              ?>
              <option value="<?php echo $nombre; ?>"
              <?php
              if($Proveedor == $nombre)
              {
                  echo "selected";
              }
              ?>
              ><?php echo $nombre?></option>
              <?php } ?>
           </select> 
             Cliente:
        <select id="Clien" name="Clien" style="width: 125px;">
            <option selected="selected" value="0">Todos los Clientes</option>
         <?php
        $query="SELECT denominacion FROM clientes ORDER BY denominacion";
           $result = $GLOBALS["link"] -> query($query);
        
           while ($rClientes = $result -> fetch_assoc()) {
              
              $nombre = $rClientes['denominacion'];
              ?>
              <option value="<?php echo $nombre; ?>"><?php echo $nombre?></option>
              <?php } ?>
           </select> 
            NºFactura: 
        <?php
        if($rol == 3){
           $query="SELECT NFactura FROM registroscompras ORDER BY NFactura";
       
        }
        else if($rol ==2){
            $query="SELECT NFactura FROM registroscompras INNER JOIN proyectos on proyectos.id=registroscompras.IDProyectos LEFT OUTER JOIN empleados on empleados.id=proyectos.jefeProyecto WHERE (Persona='$jefeProyecto' or empleados.Abreviatura='$jefeProyecto') ORDER BY NFactura";
        }else if($rol <2){
            $query="SELECT NFactura FROM registroscompras INNER JOIN proyectos on proyectos.id=registroscompras.IDProyectos LEFT OUTER JOIN empleados on empleados.id=proyectos.jefeProyecto WHERE (Persona='$jefeProyecto') ORDER BY NFactura";
        }
        $result = $GLOBALS["link"] -> query($query);?>
        <select id = "Factu" name="Factu" style="width: 125px;" >
        <option selected="selected" value="0">NºFacturas</option>
        <?php
        while ($rFactura = $result -> fetch_assoc()) {
            $Facturas = $rFactura['NFactura'];
            
            ?>
            <option value="<?php echo $Facturas ?>">
                <?php  echo $Facturas ?></option>
        <?php } ?>
        </select>
          NºAlbaran: 
        <?php
        if($rol == 3){
           $query="SELECT NAlbaran FROM registroscompras ORDER BY NAlbaran";
       
        }
        else if($rol ==2){
            $query="SELECT NAlbaran FROM registroscompras INNER JOIN proyectos on proyectos.id=registroscompras.IDProyectos LEFT OUTER JOIN empleados on empleados.id=proyectos.jefeProyecto WHERE (Persona='$jefeProyecto' or empleados.Abreviatura='$jefeProyecto') ORDER BY NAlbaran ";
        }else if($rol <2){
            $query="SELECT NAlbaran FROM registroscompras INNER JOIN proyectos on proyectos.id=registroscompras.IDProyectos LEFT OUTER JOIN empleados on empleados.id=proyectos.jefeProyecto WHERE (Persona='$jefeProyecto') ORDER BY NAlbaran";
        }
        $result = $GLOBALS["link"] -> query($query);?>
        <select id = "Alba" name="Alba" style="width: 125px;" >
        <option selected="selected" value="0">NºAlbaran</option>
        <?php
        while ($rAlbaran = $result -> fetch_assoc()) {
            $Albaran = $rAlbaran['NAlbaran'];
            
            ?>
            <option value="<?php echo $Albaran ?>">
                <?php  echo $Albaran ?></option>
        <?php } ?>
        </select>
        <button type="submit" id="LoadRecordsButton">Filtar</button>
    </form>
</div>
   <div  class="table-responsive">      
 <div id="tbRegisComp" class="table"></div>
</div>
    </div>
  </fieldset>
  


</div>


<?php
include ("pie.php");

include ("linkJQuery.php");
?>