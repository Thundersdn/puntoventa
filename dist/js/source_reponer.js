function pone_lista_Reponer(){
        $.ajax({
         beforeSend: function(){
           $("#lista_Reponer").html("Actualizando la lista...");
          },
         url: 'lista_reponer.php',
         type: 'POST',
         data: null,
         success: function(y){
           $("#lista_Reponer").html(y);
           $(document).ready(function() {
                $('#tabla_de_Reponer').DataTable();
                 });
           },
         error: function(jqXHR,estado,error){
          }
        });
      }