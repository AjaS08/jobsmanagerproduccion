$(function() { 
  // $("#btnGuardar").attr("disabled","disabled");
    if($("#pantEdit").val()!="edit"){
     $("#cargar").attr("enabled","enabled")
    }else{
            $("#cargar").attr("disabled", true);    
        $("#Proyecto").attr("disabled", true); 
        $("#tbMesPro").attr("disabled", true); 
         
          $("#Proyecto").css("background-color", "#999");
           $("#tbMesPro").css("background-color", "#999");
    }
     $("#btnGuardar").click(function(){
            var VentasPeriodo=$("#tbVentasPeriodo").val();
            if(VentasPeriodo!=""){
                $("#btnGuardar").attr("type","submit")
            }else{
                alert("El campo Ventas Periodo no puede estar vacío")
            }
     })
    $("#Editar").click(function(){
         var idProduccion=$("#idProduccion").val();
        var idProyecto=$("#Proyecto").val();
   
    var CostePeriodo=$("#tbCostesPeriodo").val();
    var CosteTotal=$("#tbCosteTotal").val();
    var cientoCompras=$("#tbPorcentajeCompras").val();
    var VentasPeriodo=$("#tbVentasPeriodo").val();
    var VentasTotal=$("#tbVentaTotal").val();
    var cientoVentas=$("#tbPorcentajeVentas").val();
    var cientoBalance=$("#tbPorcentajeBalance").val();
    var jefeProyecto=$("#tbJefeProyecto").val();
    var fecha=$("#tbFechaProduccion").val().split("/");
      if(VentasPeriodo!=""){
          var fechaEsp=fecha[1]+"/"+fecha[0]+"/01";
             $.post("jtable/tabla.php?action=update", {idProyecto: idProyecto, idProduccion: idProduccion, CostePeriodo: CostePeriodo, CosteTotal: CosteTotal, cientoCompras: cientoCompras, VentasPeriodo: VentasPeriodo, VentasTotal: VentasTotal, cientoVentas: cientoVentas, cientoBalance: cientoBalance, jefeProyecto: jefeProyecto, fecha: fechaEsp }, function(){
                 $('#tbProduc').jtable('reload');
                 $("#borr2").html("");
                 $("#pantEdit").val("0");
                 $("#cargar").attr('disabled', false);
                  $("#Proyecto").attr('disabled', false);
                   $("#tbMesPro").attr('disabled', false);

                  $("#Proyecto").css("background-color", "#FFFFFF");
                   $("#tbMesPro").css("background-color", "#FFFFFF");
            });
      }else{
          alert("El campo Ventas Periodo no puede estar vacío")
      }
    
      
       })
        
    $("#EditarRC").click(function(){
            var IdRegistroCompra=$("#idRegis").val();
            var idProyecto=$("#idProyec").val();
            var Proveedor=$("#Proveedor").val();
            var presupuesto=$("#tbPresupuesto").val();
            var  BaseImponible=$("#tbBaseImponible").val();
            var Iva=$("#tbIVA").val();
            var  Importe=$("#tbImporte").val();
            var Ca=$("#tbCA").val();
            var  Cc=$("#tbCC").val();
            var  Persona=$("#tbPersona").val();
            var Concepto=$("#tbConcepto").val();
            var   Albaran=$("#tbNAlbaran").val();
            var Factura=$("#tbNFactura").val();
            var OrdenCompra=$("#tbOrdenCompra").val();
            
            var fecha=$(".tbFecha").val().split("/");
            var fechaEsp=fecha[2]+"/"+fecha[1]+"/"+fecha[0];
       
    $.post("jtable/tabla2.php?action=update", {idProyecto: idProyecto, idRegistroCompra: IdRegistroCompra, Proveedor: Proveedor, Presupuesto: presupuesto, BaseImponible: BaseImponible, Iva: Iva, Importe: Importe, Ca: Ca, Cc: Cc, Persona: Persona, fecha: fechaEsp, Concepto: Concepto, Albaran: Albaran, Factura: Factura, OrdenCompra: OrdenCompra }, function(){
         $('#tbRegisComp').jtable('reload');
         $("#borr2").html("")
        $("#legRegis").html("Nuevo Registro de Compra")
    
    });
      
       })
    
    $("#CancelaPro").click(function(){
   
         $("#borr2").html("")
        $("#legRegis").html("Nuevo Registro de Compra")
         $("#pantEdit").val("0");
       $("#cargar").attr('disabled', false);
          $("#Proyecto").attr('disabled', false);
           $("#tbMesPro").attr('disabled', false);
           
          $("#Proyecto").css("background-color", "#FFFFFF");
           $("#tbMesPro").css("background-color", "#FFFFFF");
       })
         
   
   $('.tbFecha').datepicker({
        dateFormat : 'dd/mm/yy',
        changeMonth : true,
        changeYear : true,
        regional : "es",
        showButtonPanel : true,
        autoSize : true,
        showWeek : true
    });
   


/*
    
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
            $(this).datepicker('setDate', new Date(inst.selectedYear, inst.selectedMonth, 1));
            Mes();
        },
        closeText: 'Aceptar'
    });
    
     
    $('.tbMes').focus(function () {
        $(".ui-datepicker-calendar").hide();
    });
    
     function Mes(){
        mes=$('.tbMes').val().split("/")[0]
        ano=$('.tbMes').val().split("/")[1]
        $('.tbMes').val(mes+"/"+ano)
        $('.tbMes').blur();
         tablaProdu();
     }*/
   
   
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
      var comprobar=$("#tbVentasPeriodo").val().split("");
      if(isNaN(comprobar[comprobar.length-1]) && comprobar[comprobar.length-1]!="," && comprobar[comprobar.length-1]!="."){
       var defi= $("#tbVentasPeriodo").val();
          $("#tbVentasPeriodo").val(defi.substr(0,(comprobar.length-1)))
      }else{
          if(comprobar[comprobar.length-1]==","){
              var defi= $("#tbVentasPeriodo").val();
            $("#tbVentasPeriodo").val(defi.substr(0,(comprobar.length-1))+".")
          }
      }
      
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
  
$("#tbBaseImponible").keyup(function () {
         var comprobar=$("#tbBaseImponible").val().split("");
      if(isNaN(comprobar[comprobar.length-1]) && comprobar[comprobar.length-1]!="," && comprobar[comprobar.length-1]!="."){
       var defi= $("#tbBaseImponible").val();
          $("#tbBaseImponible").val(defi.substr(0,(comprobar.length-1)))
      }else{
          if(comprobar[comprobar.length-1]==","){
              var defi= $("#tbBaseImponible").val();
            $("#tbBaseImponible").val(defi.substr(0,(comprobar.length-1))+".")
          }
      }
        calcularIVA();
    });
$("#tbIVA").val(21)     
$("#tbIVA").keyup(function () {
       var comprobar=$("#tbIVA").val().split("");
      if(isNaN(comprobar[comprobar.length-1])){
       var defi= $("#tbIVA").val();
          $("#tbIVA").val(defi.substr(0,(comprobar.length-1)))
      }
        calcularIVA();
    });
      
 function calcularIVA(){
      
    var base = parseFloat(document.getElementById('tbBaseImponible').value);
    var iva = parseFloat(document.getElementById('tbIVA').value);
    if(!isNaN(base) && !isNaN(iva)){
        var porcentaje = parseFloat(((document.getElementById('tbBaseImponible').value * document.getElementById('tbIVA').value)/100));
        document.getElementById('tbImporte').value = base + porcentaje;
    }
    else{
        document.getElementById('tbImporte').value = "";
    }
    
}
  
    
    
});