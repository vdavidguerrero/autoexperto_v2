/**
 * Light Javascript "class" frameworking for you
 * to organize your code a little bit better.
 *
 * If you want more complex things, I'd suggest
 * importing something like Backbone.js as it
 * has much better abilities to handle a MVC
 * like framework including persistant stores (+1)
 *
 * @author  sjlu (Steven Lu)
 */
 
 
 
    $(document).ready(function()
    {
        $("#rnc").change(function() {
           if($("#rnc").val().length < 9){
               $("#rncError").text("Minimo 9 digitos") ;
           }
           else{
                $("#rncError").text("") ;
           }       
        });
        
        var ciudad = $("#ciudad");
        $("#listaCiudad li").on("click", function () {
          var selecion = $(this).text();
          ciudad.text(selecion);
        $("#laCiudad").attr('value', selecion);
        });
        
        
        var marca = $("#marca");
        $("#listaMarca li ").on("click", function () {
            var selecion = $(this).text();
            marca.text(selecion);
            $("#laMarca").attr('value', selecion);
            
            $.ajax({
                type: "GET",
                url: "/ad_controller/showAdModels/"+selecion,
                success: function(result)
                {	
                    $("#listaModelo").html(result);
                }
            });
        
        });
        
        var modelo = $("#modelo");
        $("#listaModelo ").on("click","li",function () {
            var selecion =  $(this).text();
            modelo.text(selecion);
            $("#elModelo").attr('value', selecion);
        });
        
         var tipo = $("#tipo");
        $("#listaTipo li").on("click", function () {
            var selecion =  $(this).text();
            tipo.text(selecion);
            $("#elTipo").attr('value', selecion);
        });
        
         var preciodesde = $("#precioDesde");
        $("#listaPrecioDesde li").on("click", function () {
            var selecion =  $(this).text();
            preciodesde.text(selecion);
            $("#elprecio1").attr('value', selecion);
        });
        
         var precioHasta = $("#precioHasta");
        $("#listaPrecioHasta li").on("click", function () {
            var selecion =  $(this).text();
            precioHasta.text(selecion);

            if($("#precioDesde").text() >= selecion)
            {
                alert("Seleccione un precio mayor");
                $("#precioHasta").text("Hasta");
            }
            else
            {
                $("#elprecio2").attr('value', selecion);
            }
        });
        
        var anoDesde = $("#anoDesde");
        $("#listaAnoDesde li").on("click", function () {
          var selecion =  $(this).text();
          anoDesde.text(selecion);
        $("#elano1").attr('value', selecion);
        });
        
         var anoHasta = $("#anoHasta");
        $("#listaAnoHasta li").on("click", function () {
          var selecion =  $(this).text();
          anoHasta.text(selecion);
          
           if($("#anoDesde").text() >= selecion)
          {
              alert("Seleccion un año mas reciente");
              $("#anoHasta").text("Hasta");
          }
          
          else
          {
               $("#elano2").attr('value', selecion);
          }
        
        });
        
    });
   