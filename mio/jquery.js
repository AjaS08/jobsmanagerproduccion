$(function() { 
    var numFilas=5;
   var IdRegistroCompra;
   var anoMax;
    var anoMin;
    var mesMax;
    var mesMin;
  var NomProyecto;
  var CosteTotal;
   var VentasTotal;
   var Cliente;
   var Proveedor;
 var presupuesto;
  var  BaseImponible;
  var Iva;
  var  Importe;
   var Ca;
  var  Cc;
  var  Persona;
   var Concepto;
 var   Albaran;
   var Factura;
   var OrdenCompra;
    var idProyectoActualizar;
    var idProduccion;
    var nombre=$(".headerInfo").attr("id");
    var rol;
    var perfil=0;
    var abreviatura;
    var resultado;
    var id="";
    var numCar; //numero de caracteres que tiene el string de datos a modificar
    var f = new Date();
    var idProyecto;
    var codProyecto;
    var cliente;
    var NomProyecto;
    var CostePeriodo;
    var CosteTotal;
    var cientoCompras;
    var VentasPeriodo;
    var VentasTotal;
    var cientoVentas;
    var cientoBalance;
    var jefeProyecto;
    var fecha;
var anoCompleto= f.toLocaleDateString();
var mes=anoCompleto.split("/")[1];
   if (mes<10){
       mes="0"+mes;
   }
var ano=anoCompleto.split("/")[2];
$('.tbMes').val(mes+"/"+ano)
    
   mesMin=mes;
    mesMax=mes;
    anoMax=ano;
    anoMin=ano;
    
    $.post("datosEmpleados.php", {nombre: nombre}, function(result){
         resultado=result.split("-");
        
        rol=resultado[1];
        perfil==resultado[2];
        abreviatura=resultado[3];
        id=resultado[0];
        
       
     setTimeout(function(){ tablaProdu() }, 1000);
        
    });
    
     
   

    
     
   
   $('.tbFecha').datepicker({
        dateFormat : 'dd/mm/yy',
        changeMonth : true,
        changeYear : true,
        regional : "es",
        showButtonPanel : true,
        autoSize : true,
        showWeek : true
    });
   


  $("#cargar").click(function(){//cargo formulario en la pag produccion al cambiar 
//     alert( $("#Proyecto option:selected").html())
 
      var idProyecto=$("#Proyecto").val();
      
         if( idProyecto==""){
             $("#borr2").html("")
             
         }else{
             if($("#pantEdit").val()!="edit"){
                 $("#borr2").load("cargarProyectoProduccion.php",{
                    'var1':idProyecto,
                     'var2':'0',
                     'var4':mes,
                     'var5':ano
                    });  
             }else{
                  $("#borr2").load("cargarProyectoProduccion.php",{
                        'var3':idProduccion,
                      'var1':idProyecto,
                     'var2':'1',
                     'var4':mes,
                     'var5':ano
                    });  
             }
            
            
         }
  
   })
  
  $("#Proyectos").change(function(){//cargo formulario en la pag crearRegistroCompra al cambiar 
//     alert( $("#Proyecto option:selected").html())
 
      var idProyecto=$("#Proyectos").val();
      
         if( idProyecto==""){
             $("#borr2").html("")
             
         }else{
             if($("#pantEdit").val()!="edit"){
                 $("#borr2").load("formuGuardarRegisCompra.php",{
                    'var1':idProyecto,
                     'var3':abreviatura,
                     'var2':'0'
                    });  
             }else{
                 //var abreEdit=$("#tbPersona").val(); si se mantiene el que creo el registro
                 
                  $("#borr2").load("formuGuardarRegisCompra.php",{
                        'var4':IdRegistroCompra,
                      'var1':idProyecto,
                     'var2':'1',
                      'var3':abreviatura
                    });  
             }
            
            
         }
  
   })

    
$('.tbMes').datepicker({
        dateFormat : 'mm/yy',
        changeMonth : true,
        changeYear : true,
        regional : "es",
        showButtonPanel : true,
        autoSize : true,
        showWeek : false,
        currentText: "Mes actual",
        beforeShow: function (input, inst) {
         var offset = $(input).offset();
         var height = $(input).height();
         window.setTimeout(function () {
             inst.dpDiv.css({ top: (offset.top + height + 4) + 'px', left: offset.left + 'px' })
         }, 1);
        },
        currentText: "Mes actual",
        onClose: function(dateText, inst) { 
            
            if($(this).attr("id")=="tbMes1"){
               
                $("#tbMes1").datepicker('setDate', new Date(inst.selectedYear, inst.selectedMonth, 1));
             
            }else if($(this).attr("id")=="tbMes2"){
               
                $("#tbMes2").datepicker('setDate', new Date(inst.selectedYear, inst.selectedMonth, 1));
               
            }else{
                $(this).datepicker('setDate', new Date(inst.selectedYear, inst.selectedMonth, 1));
            }
            Mes($(this).attr("id"));
        },
        closeText: 'Aceptar'
    });
   
     
    $('.tbMes').focus(function () {
        $(".ui-datepicker-calendar").hide();
    });
    $("#generarPro").click(function () {
       
      window.location.href= 'exportProduccion.php?mes='+mes+'&year='+ano; 
    });
    $("#generarRegisInf").click(function () {
       
      window.location.href= 'exportRegistrosCompras.php?mes='+mes+'&year='+ano; 
    });
     function Mes(id){
         
         
       
        
         if(id=="tbMes1"){
             mesMin=$('#tbMes1').val().split("/")[0]
        anoMin=$('#tbMes1').val().split("/")[1]
         mesMax=$('#tbMes2').val().split("/")[0]
        anoMax=$('#tbMes2').val().split("/")[1]
        $('#tbMes1').val(mesMin+"/"+anoMin)
        $('#tbMes1').blur();
         tablaProdu();
         }else if(id=="tbMesPro"){
             mes=$('#tbMesPro').val().split("/")[0]
            ano=$('#tbMesPro').val().split("/")[1]
        
            $('#tbMesPro').val(mes+"/"+ano)
            $('#tbMesPro').blur();
         
         }else if(id=="tbMes2"){
                mesMin=$('#tbMes1').val().split("/")[0]
        anoMin=$('#tbMes1').val().split("/")[1]
         mesMax=$('#tbMes2').val().split("/")[0]
        anoMax=$('#tbMes2').val().split("/")[1]
        $('#tbMes2').val(mesMax+"/"+anoMax)
        $('#tbMes2').blur();
         tablaProdu();
         }else{
            
             mes=$('#tbMes').val().split("/")[0]
            ano=$('#tbMes').val().split("/")[1]
            $('#tbMes').val(mes+"/"+ano)
            $('#tbMes').blur();
            tablaProdu(); 
         }
       
     }
   
   
    $.datepicker.regional['es'] = {
        closeText: 'Cerrar',
        prevText: '<Ant',
        nextText: 'Sig>',
        currentText: 'Hoy',
        monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
        monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
        dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
        dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
        dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
        weekHeader: 'Sm',
        dateFormat: 'dd/mm/yy',
        firstDay: 1,
        isRTL: false,
        showMonthAfterYear: false,
        yearSuffix: ''
    };
    $.datepicker.setDefaults($.datepicker.regional['es']);
    
  $("#tbVentasPeriodo").keyup(function(){
      var ventas=parseFloat($("#tbVentasPeriodo").val());
      var costePeriodo=parseFloat($("#tbCostesPeriodo").val());
      var ventaTotal=parseFloat($("#tbVentaTotal").val());
      
      var calculoVenta=(ventas/ventaTotal)*100;
      
      if(ventas==0||ventaTotal==0){
          
          $("#tbPorcentajeVentas").val(0);
      }else{
          
          $("#tbPorcentajeVentas").val(calculoVenta);
      }
      if(ventas!=0){
          $("#tbPorcentajeBalance").val((((ventas-costePeriodo)/ventas)*100).toFixed(2))
      }else{
          $("#tbPorcentajeBalance").val(0)
      }
          
      
       })
  
  
     $('#LoadRecordsButton').click(function (e) {
                     e.preventDefault();
                       
         var proveedor=$('#Provee').val();
         var cliente=$('#Clien').val();
         var codigo=$('#Proyee').val();
        var NFactura=$('#Factu').val();
         var NAlbaran=$('#Alba').val();
         
            tablaProdu(proveedor,cliente,codigo,NFactura,NAlbaran)
               
               
    });
    function tablaProdu(prove,clien,codi,nfac,nalba){ 
        
        if(prove==undefined){
            prove="0";
        }
        if(clien==undefined){
            clien="0";
        }
        if(codi==undefined){
            codi="0";
        }
        if(nfac==undefined){
            nfac="0";
        }
        if(nalba==undefined){
            nalba="0";
        }
        if(anoMin>anoMax){
            aux=anomin;
            aux2=mesMin;
            anoMin=anoMax;
            mesMin=mesMax;
            anoMax=aux;
            mesMax=aux2;
        }else if(anoMin==anoMax&&mesMin>mesMax){
            aux=anomin;
            aux2=mesMin;
            anoMin=anoMax;
            mesMin=mesMax;
            anoMax=aux;
            mesMax=aux2;
        }
        var proveedorEscogido=prove;
       var clienteEscogido=clien;
        var codigoEscogido=codi;
       var nfacturaEscogido=nfac;
        var nalbaranEscogido=nalba;
       var rolString=rol.toString(); 
             $('#tbProduc').jtable({
                        title: 'Proyectos',
                        paging: true,
                        pageSize: numFilas,
                        
                        sorting: true,
                        
                        defaultSorting: 'codigoProyecto ASC',
                          deleteConfirmation: function(data) {
                        data.deleteConfirmMessage = '¿ Estas seguro de borrar este Proyecto ?';
                         },
                        
                        actions: {
                            
                            listAction: 'jtable/tabla.php?action=list&&mes='+mes+'&&ano='+ano+'&&jefe='+abreviatura+'&&rol='+rolString+"&&numFilas="+numFilas,
                            
                            deleteAction: 'jtable/tabla.php?action=delete',
                            
                        },
                        fields: {
                             ID: {
                            key: true,
                            list: false
                        },
                        codigoProyecto: {
                            title: 'Codigo Proyecto',
                            
                        },
                        Cliente: {
                            title: 'Cliente',

                        },
                        Proyecto: {
                            title:"Nombre del Proyecto",

                        },
                        CostesPeriodo: {
                            title: 'Coste del Periodo',

                        },
                        CosteTotal: {
                            title: 'Costes Total',

                        },
                        PorcentajeCompras: {
                            title: '% Compras',

                        },
                        VentasPeriodo: {
                            title: 'Ventas del Periodo',

                        },
                        VentaTotal: {
                            title: 'Ventas Total',

                        },
                        PorcentajeVentas: {
                            title: '% Ventas',

                        },
                        PorcentajeBalance: {
                            title: '% Balance',

                        },
                        JefeProyecto: {
                            title: 'Jefe de Proyecto',

                        },
                        Fecha: {
                            type: 'date',
                            list: false
                        },
                        IDProyectos: {
                            list: false
                        },
                        Actualizar:{
                           display: function (data){
                                var $image = $('<div class="btn btn-primary"> <img src="jtable/scripts/jtable/themes/actualizar.png" width="15" height="15" alt="Edit" > </div>');
                                $image.click(function(){
                                    // Aquí ponemos el código Javascript a ejecutar
                                    var datos=$(this).parent().parent().html();
                                    contar(datos)
                                    var res = datos.substring(4, (numCar-5));
                                   res= res.split("</td><td>");
                                    
                                     idProyectoActualizar=data.record.IDProyectos;
                                   
                                    idProduccion=data.record.ID;
                                    codProyecto= res[0];
                                    cliente=res[1];
                                    NomProyecto=res[2];
                                    CostePeriodo=res[3];
                                    CosteTotal=res[4];
                                    cientoCompras=res[5];
                                    VentasPeriodo=res[6];
                                    VentasTotal=res[7];
                                    cientoVentas=res[8];
                                    cientoBalance=res[9];
                                    jefeProyecto=res[10];
                                    
                                    fecha=data.record.Fecha.split("-");
                                   
                                    
                                    fechaEsp=fecha[1]+"/"+fecha[0];
                                     $("#Proyecto option").each(function() {
                                      if($(this).val()==parseInt(idProyectoActualizar)){
                                          
                                          $(this).attr("selected","selected")
                                      }
                                    });
                                     var idProyecto=idProyectoActualizar;

                                     if( idProyecto==""){
                                         $("#borr2").html("")

                                     }else{
                                         if($("#pantEdit").val()!="edit"){
                                             $("#borr2").load("cargarProyectoProduccion.php",{
                                                'var1':idProyecto,
                                                 'var2':'1',
                                                 'var3':idProduccion,
                                                 'var4':fecha[1],
                                                 'var5':fecha[0],
                                                 'var6':fechaEsp
                                                });  
                                         }else{
                                              $("#borr2").load("cargarProyectoProduccion.php",{
                                                    'var3':idProduccion,
                                                  'var1':idProyecto,
                                                 'var2':'1',
                                                  'var4':fecha[1],
                                                 'var5':fecha[0],
                                                 'var6':fechaEsp
                                                });  
                                         }


                                     }
                                    /* $("#borr2").load("editarProduccion.php",{
                                            'var1':idProduccion,
                                            'var2':codProyecto,
                                             'var3':cliente,
                                            'var4':NomProyecto,
                                            'var5':CostePeriodo,
                                             'var6':CosteTotal,
                                            'var7':cientoCompras,
                                            'var8':VentasPeriodo,
                                            'var9':VentasTotal,
                                            'var10':cientoVentas,
                                            'var11': cientoBalance,
                                            'var12':jefeProyecto,
                                            'var13':fechaEsp,
                                            'var14':idProyectoActualizar
                                    }); */
                                    $("#Proyecto").focus();
                                    function contar(datos){
                                        datos.split("");
                                      
                                      numCar=datos.length;
                                    }
                                    
                                });
                                return $image;
                            } 
                        }

                        }

                    });

                    //Load person list from server
                    $('#tbProduc').jtable('load');
        
   
        
                 var rolString=rol.toString(); 
             $('#tbRegisComp').jtable({
                        title: 'Registro de Compras',
                 
                        paging: true,
                        pageSize: numFilas,
                        
                        sorting: true,
                        
                        defaultSorting: 'NombreProyecto ASC',
                          deleteConfirmation: function(data) {
                        data.deleteConfirmMessage = '¿ Estas seguro de borrar este Registro ?';
                         },
                        
                        actions: {
                            
                            listAction: 'jtable/tabla2.php?action=list&&mesMax='+mesMax+'&&anoMax='+anoMax+'&&mesMin='+mesMin+'&&anoMin='+anoMin+'&&jefe='+abreviatura+'&&rol='+rolString+'&&proveedor='+proveedorEscogido+'&&cliente='+clienteEscogido+'&&codigo='+codigoEscogido+'&&nfactura='+nfacturaEscogido+'&&nalbaran='+nalbaranEscogido+"&&numFilas="+numFilas,
                            
                            deleteAction: 'jtable/tabla2.php?action=delete',
                            
                        },
                        fields: {
                             ID: {
                            key: true,
                            list: false
                        },
                        Persona: {
                            title: 'Persona',
                            
                        },
                        codigoProyecto: {
                            title: 'Codigo Proyecto',
                             width: '20%'
                        },
                         
                        NombreProyecto: {
                            title:"Nombre del Proyecto",

                        },
                        NombreCliente: {
                            title: 'Cliente',

                        },
                        Proveedor: {
                            title: 'Proveedor',

                        },
                         fecha: {
                              title: 'Fecha',
                               display: function (data){
                               var fecha= data.record.Fecha;
                                fecha=fecha.split("-");
                                   
                                var FechaEsp=fecha[2]+"/"+fecha[1]+"/"+fecha[0]
                               
                                return FechaEsp;
                            } 
                            
                        },
                        CC: {
                            title: 'CC',

                        },
                         CA: {
                            title: 'CA',

                        },
                         BaseImponible: {
                            title: 'Importe sin IVA',

                        },
                        Importe: {
                            title: 'Importe IVA',

                        },
                        
                        Jefe: {
                            title: 'Jefe',

                        },
                        Concepto: {
                             title: 'Concepto',
                        },
                        NFactura: {
                            title: 'NºFactura',

                        },
                        NAlbaran: {
                            title: 'NºAlbaran',

                        },
                        OrdenCompra: {
                            title: 'Orden Compra',

                        },
                       
                       Presupuesto: {
                            title: 'Presupuesto',

                        },
                        
                        
                       CosteTotal: {
                            title: 'Coste',

                        },
                        VentaTotal: {
                            title: 'Venta',

                        },
                       
                        Actualizar:{
                           display: function (data){
                                var $image = $('<div class="btn btn-primary"> <img src="jtable/scripts/jtable/themes/lightcolor/edit.png" alt="Edit" > </div>');
                                $image.click(function(){
                                    // Aquí ponemos el código Javascript a ejecutar
                                    var datos=$(this).parent().parent().html();
                                    contar(datos)
                                    var res = datos.substring(4, (numCar-5));
                                   res= res.split("</td><td>");
                                   
                                    idProyectoActualizar=data.record.IDProyectos;
                                    IdRegistroCompra=data.record.ID;
                                    codProyecto= res[1];
                                    NomProyecto=res[2];
                                     CosteTotal=res[16];
                                     VentasTotal=res[17];
                                    Cliente=res[3];
                                    Proveedor=res[4];
                                    fecha=res[5].split("/");
                                    BaseImponible=res[8];
                                   
                                    Importe=res[9];
                                    Ca=res[6];
                                    Cc=res[7];
                                    Persona=abreviatura;
                                    Concepto=res[11];
                                    Albaran=res[13];
                                    Factura=res[12];
                                    OrdenCompra=res[14];
                                    Presupuesto=res[15];
                                    jefeProyecto=res[10];
                                   
                                    
                                    fechaEsp=fecha[0]+"/"+fecha[1]+"/"+fecha[2];
                                     $("#Proyectos option").each(function() {
                                      if($(this).val()==parseInt(idProyectoActualizar)){
                                          
                                          $(this).attr("selected","selected")
                                      }
                                    });
                                    
                                     $("#borr2").load("editarRegistroCompra.php",{
                                           'var20': IdRegistroCompra,
                                          'var2':  codProyecto,
                                         'var3': NomProyecto,
                                          'var4': CosteTotal,
                                          'var5': VentasTotal,
                                          'var6': Cliente,
                                          'var7': Proveedor,
                                          'var8':  fechaEsp,
                                         'var9': BaseImponible,
                                         'var10': Iva,
                                         'var11':Importe,
                                         'var12':  Ca,
                                         'var13': Cc,
                                         'var14': Persona,
                                         'var15':Concepto,
                                        'var16': Albaran,
                                         'var17': Factura,
                                         'var18': OrdenCompra,
                                         'var1': idProyectoActualizar,
                                         'var19': Presupuesto
                                    }); 
                                    $("#Proyectos").focus();
                                    $("#legRegis").html("Editar Registro de Compra")
                                    function contar(datos){
                                        datos.split("");
                                      
                                      numCar=datos.length;
                                    }
                                    
                                    
                                });
                                return $image;
                            } 
                        }

                        }

                    });

                    //Load person list from server
                    $('#tbRegisComp').jtable('load');
                    prueba();
                                    function prueba(){
                                        $(".jtable-title").html("<div class='jtable-title-text' >Registro de Compras<div style='float: right;'>Entradas por pagina: <select width:'100'  style=' width:50px; margin: 5px;' id='numeroFilas'><option value='5'>5</option><option value='10'>10</option><option value='25'>25</option><option value='50'>50</option><option value='100'>100</option></select></div></div>")
                                         $("#numeroFilas option").each(function() {
                                      if($(this).val()==numFilas){
                                          
                                          $(this).attr("selected","selected")
                                      }
                                    });
                                        $("#numeroFilas").change(function(){//cargo formulario en la pag crearRegistroCompra al cambiar 
                                        numFilas=$("#numeroFilas").val();
                                          tablaProdu();  
                                       })
                                    }
       
        }
       
    
  
   
});