<?php
        echo "<script type='text/javascript' src='javascript/jq.js'></script>";
        include ("sistema/dbconfig.php");
          $idProyecto= $_POST['var1'];

           $rProyecto=$GLOBALS["link"]->query("SELECT p.denominacion as nombreProyecto,codigoProyecto,codigoActividad,CosteTotal,VentaTotal, c.denominacion as nombreCliente, jefeProyecto FROM proyectos p inner join clientes c on p.idCliente = c.id where p.id = '$idProyecto'")->fetch_assoc();
           $codigoProyecto = $rProyecto['codigoProyecto'];
           $codigoActividad = $rProyecto['codigoActividad'];
           $nombre = $rProyecto['nombreProyecto'];
           $jefeProyecto = $rProyecto['jefeProyecto'];
          // $rPersona = $GLOBALS["link"]->query("SELECT Abreviatura FROM empleados WHERE id = '$jefeProyecto'") -> fetch_assoc();
           $persona = $_POST['var3'];
           $edit= $_POST['var2'];
           $costeTotal = $rProyecto['CosteTotal'];
           $ventaTotal = $rProyecto['VentaTotal'];
           $cliente = $rProyecto['nombreCliente'];
            $Fecha = $_POST["tbFecha"];
           echo "<br />";
           echo "<br />";
           echo "C&oacutedigo de proyecto: ";
           echo"<input id='tbCodigoProyecto' name='tbCodigoProyecto' type='text' size = 10 value= '$codigoProyecto' readonly />";
           echo "Nombre: ";
           echo"<input id='tbNombre' name='tbNombre' type='text' size = '120' value= '$nombre' readonly />";
           echo "<br />";
           echo "<br />";
            echo"<input id='idProyec' name='idProyec' type='hidden' value='$idProyecto' readonly />";
           echo "Coste total: ";
           echo"<input id='tbCoste' name='tbCosteTotal' type='text' value= '$costeTotal' readonly />";
           echo "Venta total: ";
           echo"<input id='tbVenta' name='tbVentaTotal' type='text' value= '$ventaTotal' readonly />"; 
           echo "<br />";
           echo "<br />";
           echo "Cliente: ";
           echo"<input id='tbCliente' name='tbCliente' type='text' size = '100' value= '$cliente' readonly />"; 
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
              if($nombre == $_POST['Proveedor'])
              {
                  echo "selected";
              }
              ?>
              ><?php echo $nombre?></option>
              <?php } ?>
           </select>         
        <?php
           echo "Fecha: ";
           if($Fecha != ""){
               //$Fecha = myDateToDate($Fecha);
            }
            else{
                $Fecha = date("d/m/Y");
            }
           echo"<input id='tbFecha'class='tbFecha' name='tbFecha' type='text' value = '$Fecha' readonly />";
           echo "<br />";
           echo "<br />";
           echo "Base imponible (€): ";
           echo"<input id='tbBaseImponible' class='tbBaseImponible' name='tbBaseImponible' type='text' value ='$BaseImponible'  />";
           echo "IVA: ";
           echo"<input id='tbIVA' class='tbIVA' name='tbIVA' type='text' value= '$IVA' '/>";
           echo "Importe: ";
           echo"<input id='tbImporte' class='tbImporte' name='tbImporte' type='text' value = '$Importe' readonly />"; 
           echo "<br />";
           echo "<br />";
           echo "CA: ";
           echo"<input id='tbCA' name='tbCA' type='text' value= '$codigoActividad' readonly />";
           echo "CC: ";
           echo"<input id='tbCC' name='tbCC' type='text' value='$CC' />";
           echo "Persona: ";
           echo"<input id='tbPersona' name='tbPersona' type='text' value= '$persona' readonly />";
           echo "Concepto: ";
           echo"<input id='tbConcepto' name='tbConcepto' type='text' value = '$Concepto' />";
           echo "<br />";
           echo "<br />";
           echo "Nº Albaran: ";
           echo"<input id='tbNAlbaran' name='tbNAlbaran' type='text' value = '$NAlbaran' />";
           echo "Nº Factura: ";
           echo"<input id='tbNFactura' name='tbNFactura' type='text' value = '$NFactura' />";
           echo "Orden de compra: ";
           echo"<input id='tbOrdenCompra' name='tbOrdenCompra' type='text' value = '$OrdenCompra' />";
           echo "Presupuesto: ";
           echo"<input id='tbPresupuesto' name='tbPresupuesto' type='text' value = '$Presupuesto' />";
           echo "<br />";
           echo "<br />";
                if($edit=="0"){
                 echo"<center>";
            
            echo"<input type = submit class='boton' id='btnGuardar' name = 'Guardar' type='button' value='Guardar'/>     ";
                 echo"<input type ='button' class='boton' id='CancelaPro' name = 'CancelaPro'  value='Cancelar'/>";
            echo"</center>";
            }
            if($edit=="1"){
               $IdRegistroCompra= $_POST['var4'];
                echo 'aqui'.$IdRegistroCompra;
                echo"<input id='idRegis' name='idRegis' type='hidden' value='$IdRegistroCompra' readonly />";
            echo"<input id='pantEdit' name='pantEdit' type='hidden' value='edit' readonly />";
                 echo"<center>";
            
             echo"<input type ='button' class='boton' id='EditarRC' name = 'Editar' type='button' value='Guardar Edicion'/>     ";
                echo"<input type ='button' class='boton' id='CancelaPro' name = 'CancelaPro'  value='Cancelar'/>";
            echo"</center>";
            }
         ?>