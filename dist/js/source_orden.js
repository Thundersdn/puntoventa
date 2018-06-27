/***************************************************************************/
function lista_proveedores(){
         $(document).ready(function() {
          $.ajax({
          beforeSend: function(){
            $("#pone_provs").html("Recuperando proveedores...");
           },
          url: 'pone_provs_entrada.php',
          type: 'POST',
          data: null,
          success: function(x){
            $("#lista_provs").html(x);
            $(".select2").select2();
			actualizar_info_proveedor();
           },
           error: function(jqXHR,estado,error){
           }
           });
          });
         }
/***************************************************************************/ 
function actualizar_info_proveedor(){
	$(document).ready(function(){
		$.ajax({
			beforeSend: function(){
				$("#telefono").val("Cargando...");
				$("#ubicacion").val("Cargando...");
			},
			url: 'pone_info_provs.php',
			type: 'POST',
			dataType: 'json',
			data: "id_prov="+$("#proveedor").val(),
			success: function(x){
				//console.log(x);
				$("#telefono").val(x.telefono);
				$("#ubicacion").val(x.domicilio);
			},
			error: function(jqXHR,estado,error){
           }
			
		});
		
	});
}

/***************************************************************************/
function busca_articulo(){
          if($("#codigo").val()!=""){
         $(document).ready(function(){
          $.ajax({
          beforeSend: function(){
            $("#descripcion").html("Buscando informacion del articulo...");
           },
          url: 'busca_data_articulo_orden.php',
          type: 'POST',
          dataType: 'json',
          data: 'codigo='+$("#codigo").val(),
          success: function(x){
            if(x=='0'){
            alert("El codigo del articulo, no existe...");
            $("#codigo").val("");
            $('#codigo').focus();
            }else{
			 // console.log($("#proveedor").val());
			 
             if($("#proveedor").val() == x.proveedor){
				 $("#descripcion").val(x.descripcion);
				 $("#costo").val(x.costo);
				 $("#costo").attr("disabled", false);
				 $("#cantidad").val("");
				 $("#cantidad").attr("disabled", false);
				 $("#btn-add-article").attr("disabled", false);
				 $("#btn-cancel-article").attr("disabled", false);
				 $("#costo").select();
				 $("#costo").focus();
			 }else{
				var n = noty({
				  text: 'El proveedor registrado para este articulo no corresponde al proveedor seleccionado?',
				  buttons: [
					{addClass: 'btn btn-primary', text: 'Continuar', onClick: function($noty) {
						//console.log($noty.$bar.find('input#example').val());
						
						$noty.close();
						$("#descripcion").val(x.descripcion);
						 $("#costo").val(x.costo);
						 $("#costo").attr("disabled", false);
						 $("#cantidad").val("");
						 $("#cantidad").attr("disabled", false);
						 $("#btn-add-article").attr("disabled", false);
						 $("#btn-cancel-article").attr("disabled", false);
						 $("#costo").select();
						 $("#costo").focus();
						//noty({text: 'You clicked "Ok" button', type: 'success'});
					  }
					},
					{addClass: 'btn btn-danger', text: 'Cancelar', onClick: function($noty) {
						$noty.close();
						//noty({text: 'You clicked "Cancel" button', type: 'error'});
						$("#descripcion").val('');
						$("#costo").val('');
					  
					  }
					}
				  ],
				layout:'center',
				theme:'relax',
				type:'warning'});
				 
			 }
             }
           },
           error: function(jqXHR,estado,error){
             $("#data_articulo").html('Hubo un error: '+estado+' '+error);
           }
           });
          });
          }else{
          }
         }
/****************************************************************************/
function cancela_add(){
   $("#descripcion").val("");
   $("#costo").val("");
   $("#cantidad").val("");
   $("#costo").attr('disabled', true);
   $("#cantidad").attr('disabled', true);
   $("#btn-add-article").attr('disabled', true);
   $("#btn-cancel-article").attr('disabled', true);
   $("#codigo").val("");
   $('#codigo').focus();
}
/********************************************************************************/
function agrega_a_lista(){
            var articulo=$("#codigo").val();
            var descripcion=$("#descripcion").val();
            var costou=$("#costo").val();
            var cantidad=$("#cantidad").val();
            var monto=cantidad*costou;
			/* Remover % de la entrada*/
            $("#tabla_articulos > tbody").append("<tr><td>"+articulo+"</td><td>"+descripcion+"</td><td>"+cantidad+"</td><td>$"+costou+"</td><td>$"+monto+"</td><td><button id='"+articulo+"' class='btn btn-danger btn-xs elimina_articulo' onclick='actualiza_entrada_temp(this.id);'><i class='fa fa-times'></i></button></td></tr>");
            /*graba la entrada temporalmente*/
             $.ajax({
          beforeSend: function(){
           },
          url: 'save_temp_entrada.php',
          type: 'POST',
          data: "proveedor="+$("#proveedor").val()+"&fecha="+$("#fecha").val()+"&num_fact="+$("#orden").val()+
          "&impuesto=0"+"&descuento=0"+"&articulo="+articulo+          "&costo="+$("#costo").val()+"&cantidad="+
		  $("#cantidad").val()+"&tipo="+"OC"+"&descripcion_articulo="+descripcion+"&descripcion_prov="+
		  $("#proveedor option:selected").html(),
          success: function(z){
             if(z=="0"){
               alert("No fue posible guardar el registro temporalmente, por favor consulte a soporte de inmediato...");
             }
           },
           error: function(jqXHR,estado,error){
           }
           });
          /*******************************************/

            $("#codigo").val("");
            resumen();
            cancela_add();
            $("#codigo").select();
         }
/***********************************************************************************/
$(function(){
         // Evento que selecciona la fila y la elimina
	      $(document).on("click",".elimina_articulo",function(){
	     	var parent = $(this).parents().parents().get(0);
		  $(parent).remove();
          resumen();
       	});
       });
/***********************************************************************************/
function resumen(){
            var totales=0;
            var t=0.00;
            var ar=0;
            $('#tabla_articulos > tbody > tr').each(function(){
				var montoss = parseInt($(this).find("td").eq(4).html().replace(/\D/g,''));
				var artcs = parseInt($(this).find('td').eq(2).html());
				totales = totales+montoss;
				ar = ar+artcs;
				t=t+montoss;
            });
            $("#net").val("$ "+totales);
            $("#tot").val("$ "+Math.round(t*1.19));
            $("#arts").val(ar);
            if(totales>0){
              $("#btn-procesa").prop('disabled', false);
              $("#btn-cancela").prop('disabled', false);
            }else{
              $("#btn-procesa").prop('disabled', true);
              $("#btn-cancela").prop('disabled', true);
            }
          }
/*************************************************************************************/
function revisa_entrada_ini(){
  $(document).ready(function(){
      $.ajax({
          beforeSend: function(){
           },
          url: 'search_temp_orden.php',
          type: 'POST',
          dataType: 'json',
          data: null,
          success: function(result){
             if(result!="0"){
               var prov_id='';
               var impuesto_id='';
              $.each(result, function(i, item){
                prov_id=result[i].proveedor;
                impuesto_id=result[i].impuesto_porcentaje;
                var costot=(result[i].cantidad * result[i].costo);
                var descuentot=(costot * result[i].desc_porcentaje/100).toFixed(2);
                //alert(result[i].articulo);
                $("#fecha").val(result[i].fecha);
                $("#orden").val(result[i].num_fact_nota);
                $("#descuento").val(result[i].desc_porcentaje);
                $("#tabla_articulos > tbody").append("<tr><td>"+result[i].articulo+"</td><td>"+result[i].descripcion_articulo+"</td><td>"+result[i].cantidad+"</td><td>$"+result[i].costo+"</td>"+
                "<td>$"+costot+"</td><td><button id='"+result[i].articulo+"' onclick='actualiza_entrada_temp(this.id);' class='btn btn-danger btn-xs elimina_articulo'><i class='fa fa-times'></i></button></td></tr>");
              })
              //alert(impuesto_id);
              //$("#proveedor").prepend("<option value='"+prov_id+"' selected>"+prov_desc+"</option>");
              //$('#proveedor option[value="'+prov_id+'"]').attr("selected", "selected");
              //$(".js-programmatic-set-val").on("click", function (){ $proveedor.val(prov_id).trigger("change"); });
              $("#proveedor").select2('val', prov_id);
              //$("#impuesto").select2('val', parseInt(impuesto_id));
               resumen();
               alert("Se encontro una Entrada X Compra pendiente, si no deseas que vuelva a aparecer, elimina la entrada...");
             }
           },
           error: function(jqXHR,estado,error){
           }
           });
        })
   }
/****************************************************************************************/
function actualiza_prov_temp(){
     $(document).ready(function(){
         $.ajax({
          beforeSend: function(){
           },
          url: 'update_prov_orden.php',
          type: 'POST',
          data: 'id_prov='+$("#proveedor").val()+"&nombre_prov="+$("#proveedor option:selected").html(),
          success: function(t){
				actualizar_info_proveedor();
           },
           error: function(jqXHR,estado,error){
           }
           });
       })
}
/*******************************************************************************************/
function actualiza_fecha_temp(){
     $(document).ready(function(){
         $.ajax({
          beforeSend: function(){
           },
          url: 'update_fecha_entrada.php',
          type: 'POST',
          data: 'fecha='+$("#fecha").val(),
          success: function(t){

           },
           error: function(jqXHR,estado,error){
           }
           });
       })
}
/*********************************************************************************/
function actualiza_num_fac_entrada_temp(){
     $(document).ready(function(){
         $.ajax({
          beforeSend: function(){
           },
          url: 'update_factura_orden.php',
          type: 'POST',
          data: 'num_fact='+$("#orden").val(),
          success: function(t){

           },
           error: function(jqXHR,estado,error){
           }
           });
       })
}
/*********************************************************************************/
function actualiza_impuesto_temp(){
     $(document).ready(function(){
         $.ajax({
          beforeSend: function(){
           },
          url: 'update_impuesto_entrada.php',
          type: 'POST',
          data: 'impuesto='+$("#impuesto").val(),
          success: function(t){

           },
           error: function(jqXHR,estado,error){
           }
           });
       })
}
/************************************************************************************/
function actualiza_descuento_temp(){
     $(document).ready(function(){
       //alert($("#descuento").val());
         $.ajax({
          beforeSend: function(){
           },
          url: 'update_descuento_entrada.php',
          type: 'POST',
          data: 'descuento='+$("#descuento").val(),
          success: function(t){
            if(t=="0"){
              alert("No se pudo actualizar el descuento en los registros temporales de la entrada... Consulte a Soporte!!!");
            }
           },
           error: function(jqXHR,estado,error){
           }
           });
       })
}
/*****************************************************************************************/
function actualiza_entrada_temp(codigo){
   //alert(codigo);
   var art=codigo;
   $(document).ready(function(){
         $.ajax({
          beforeSend: function(){
           },
          url: 'update_articulos_en_tempentrada.php',
          type: 'POST',
          data: 'articulo='+art,
          success: function(t){

           },
           error: function(jqXHR,estado,error){
           }
           });
       })
}
/**************************************************************************************/
function cancela_entrada_all(){
   $(document).ready(function(){
         $.ajax({
          beforeSend: function(){
           },
          url: 'cancela_temporden.php',
          type: 'POST',
          data: null,
          success: function(t){

           },
           error: function(jqXHR,estado,error){
           }
          });
       })
   // $("#tabla_articulos > tbody:last").children().remove();
     //cancela_add();
     //resumen();
     //alert("Se cancelo el proceso de Entrada X Compra....");
    $("#proveedor").focus();
}
/**************************************************************************************/
function procesa_entrada(){
	var n_orden = $("#num_orden2").val();
	var total = $('#tot').val().replace(/\D/g,'');
  //alert($("#descuento").val());
          if($("#proveedor").val()==""||$("#fecha").val()==""||$("#orden").val()==""){
            window.alert("Los campos Proveedor, Fecha, Orden de compra no pueden estar vacios...");
            return false;
          }
          $("#btn-procesa").prop('disabled', true);
           var n = noty({
                  text: "Deseas procesar la entrada...?",
                  theme: 'relax',
                  layout: 'center',
                  type: 'information',
                  modal: 'true',
                  buttons     : [
                    {addClass: 'btn btn-primary',
                     text    : 'Si',
                     onClick : function ($noty){
                          $noty.close();
						  $.ajax({
                             beforeSend: function(){
                              },
                             url: 'procesa_compra_total.php',
                             type: 'POST',
							data: 'fecha='+$("#fecha").val()+'&proveedor='+$("#proveedor").val()+
							'&num_fact='+$("#orden").val()+'&total='+total,
							success: function(x){
							},
							error: function(jqXHR,estado,error){
                              }
                             });
                          $('#tabla_articulos > tbody > tr').each(function(){
                             var cod = $(this).find('td').eq(0).html();
                             var can = $(this).find('td').eq(2).html();
                             var cu  = $(this).find('td').eq(3).html().replace(/\D/g,'');
                             $.ajax({
                             beforeSend: function(){
                              },
                             url: 'procesa_compra.php',
                             type: 'POST',
                             data: 'codigo='+cod+'&cantidad='+can+'&fecha='+$("#fecha").val()+'&costou='+cu+
                             '&proveedor='+$("#proveedor").val()+'&descuento=0'+'&tasa_iva=19'+'&num_orden='+$("#num_orden2").val()+'&num_fact='+$("#orden").val(),
                             success: function(x){
                                if(x=="0"){
                                   var n = noty({
                                   text: "Hubo un error al procesar el articulo: "+cod+'. Consulte a soporte inmediatamente...!',
                                   theme: 'relax',
                                   layout: 'topLeft',
                                   type: 'success',
                                  })
                                  }else{

                                   var n = noty({
                                   text: "Se proceso el articulo: "+cod,
                                   theme: 'relax',
                                   layout: 'topLeft',
                                   type: 'success',
                                   timeout: 4000,
                                  })
                                  }
                              },
                             error: function(jqXHR,estado,error){
                              }
                             });
                           });
						   $("#tabla_articulos > tbody:last").children().remove();
						    cancela_add();
                            resumen();
                            pone_num_entrada();
                            $("#btn-procesa").prop('disabled', true);
                            $("#tabla_articulos > tbody:last").children().remove();       
                            cancela_entrada_all();
							
							var n = noty({
							  text: 'Desea exportar la orden de compra a pdf?',
							  buttons: [
								{addClass: 'btn btn-primary', text: 'Si', onClick: function($noty) {
									//console.log($noty.$bar.find('input#example').val());
									$noty.close();
									window.open("/imprimir_orden_compra.php?n_orden="+n_orden,"_blank");
									
								  }
								},
								{addClass: 'btn btn-danger', text: 'No', onClick: function($noty) {
									$noty.close();
									//noty({text: 'You clicked "Cancel" button', type: 'error'});
									
								  
								  }
								}
							  ],
							layout:'center',
							theme:'relax',
							type:'info'});
							
							
                          }

                   },
                   {addClass: 'btn btn-danger',
                    text    : 'No',
                    onClick : function ($noty){
                       $("#btn-procesa").prop('disabled', false);
                       $noty.close();
                    }
                    }
                  ]
              });
         }
/********************************************************************************************/
function pone_num_entrada(){
             $(document).ready(function(){
              $.ajax({
               beforeSend: function(){
               $("#num_orden").html("Buscando prox. orden...");
               },
             url: 'busca_num_orden.php',
             type: 'POST',
             data: null,
             success: function(x){
             $("#num_orden").html('Orden de Compra # '+x);
             $("#num_orden2").val(x);
			 $("#orden").val(x);
             },
             error: function(jqXHR,estado,error){
             $("#num_orden").html('Hubo un error!!!'+' '+estado +' '+error);
             }
            });
            });
           }
/*******************************************************************************************/