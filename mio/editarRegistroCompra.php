<?php
 echo "<script type='text/javascript' src='javascript/jq.js'></script>";
include ("sistema/dbconfig.php");
            $idProyecto= $_POST['var1'];
            
           $codProyecto= $_POST['var2'];
           
            $NomProyecto= $_POST['var3'];
            $CosteTotal = $_POST['var4'];
            $VentasTotal = $_POST['var5'];
            $Cliente = $_POST['var6'];
            $Proveedor = $_POST['var7'];
            $fecha=$_POST['var8'];
            $BaseImponible=$_POST['var9'];
            $Iva=$_POST['var10'];
            $Importe=$_POST['var11'];
            $Ca=$_POST['var12'];
            $Cc = $_POST['var13'];
             $Persona = $_POST["var14"];
              $Concepto=$_POST['var15'];
            $Albaran=$_POST['var16'];
            $Factura=$_POST['var17'];
            $OrdenCompra = $_POST['var18'];
            $Presupuesto = $_POST['var19'];
           $IdRegistroCompra = $_POST['var20']; 
            
            echo"<input id='idProyec' name='idProyec' type='hidden' value='$idProyecto' readonly />";

              echo"<input id='idRegis' name='idRegis' type='hidden' value='$IdRegistroCompra' readonly />";
           echo"<input id='pantEdit' name='pantEdit' type='hidden' value='edit' readonly />";
           echo "<br />";
           echo "<br />";
           echo "C&oacutedigo de proyecto: ";
           echo"<input id='tbCodigoProyecto' name='tbCodigoProyecto' type='text' size = 10 value= '$codProyecto' readonly />";
           echo "Nombre: ";
           echo"<input id='tbNombre' name='tbNombre' type='text' size = '120' value= '$NomProyecto' readonly />";
           echo "<br />";
           echo "<br />";
            echo"<input id='idProyec' name='idProyec' type='hidden' value='$idProyecto' readonly />";
           echo "Coste total: ";
           echo"<input id='tbCoste' name='tbCosteTotal' type='text' value= '$CosteTotal' readonly />";
           echo "Venta total: ";
           echo"<input id='tbVenta' name='tbVentaTotal' type='text' value= '$VentasTotal' readonly />"; 
           echo "<br />";
           echo "<br />";
           echo "Cliente: ";
           echo"<input id='tbCliente' name='tbCliente' type='text' size = '100' value= '$Cliente' readonly />"; 
           echo "<br />";
           echo "<br />";
           echo "Proveedor:";
           $query="SELECT CIF,Denominacion FROM Proveedores";
           $result = $GLOBALS["link"] -> query($query);?>
           <select id = "Proveedor" name="Proveedor" >
           <?php
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
        <?php
           echo "Fecha: ";
           
           echo"<input id='tbFecha'class='tbFecha' name='tbFecha' type='text' value = '$fecha' readonly />";
           echo "<br />";
           echo "<br />";
           echo "Base imponible (€): ";
           echo"<input id='tbBaseImponible' name='tbBaseImponible' type='text' value ='$BaseImponible'  />";
           echo "IVA: ";
           echo"<input id='tbIVA' name='tbIVA' type='text' value= '$Iva' '/>";
           echo "Importe: ";
           echo"<input id='tbImporte' name='tbImporte' type='text' value = '$Importe' readonly />"; 
           echo "<br />";
           echo "<br />";
           echo "CA: ";
           echo"<input id='tbCA' name='tbCA' type='text' value= '$Ca' readonly />";
           echo "CC: ";
           echo"<input id='tbCC' name='tbCC' type='text' value='$Cc' />";
           echo "Persona: ";
           echo"<input id='tbPersona' name='tbPersona' type='text' value= '$Persona' readonly />";
           echo "Concepto: ";
           echo"<input id='tbConcepto' name='tbConcepto' type='text' value = '$Concepto' />";
           echo "<br />";
           echo "<br />";
           echo "Nº Albaran: ";
           echo"<input id='tbNAlbaran' name='tbNAlbaran' type='text' value = '$Albaran' />";
           echo "Nº Factura: ";
           echo"<input id='tbNFactura' name='tbNFactura' type='text' value = '$Factura' />";
           echo "Orden de compra: ";
           echo"<input id='tbOrdenCompra' name='tbOrdenCompra' type='text' value = '$OrdenCompra' />";
           echo "Presupuesto: ";
           echo"<input id='tbPresupuesto' name='tbPresupuesto' type='text' value = '$Presupuesto' />";
           echo "<br />";
           echo "<br />";
           echo"<center>";
           echo"<input type ='button' class='boton' id='EditarRC' name = 'Editar' type='button' value='Guardar Edicion'/>     ";
                echo"<input type ='button' class='boton' id='CancelaPro' name = 'CancelaPro'  value='Cancelar'/>";
           echo"</center>";
         ?>