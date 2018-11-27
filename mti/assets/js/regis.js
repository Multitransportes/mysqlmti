
function eMsg(params){
	alert("Error: L"+params+"+");
}//end eMsg

//login
$(document).on('submit', '#form-login', function(event) {
	event.preventDefault();
	/* Act on the event */
	var un = $('#un').val();
	var up = $('#up').val();

	$.ajax({
			url: 'data/login_user.php',
			type: 'post',
			dataType: 'json',
			data: {
				un:un,
				up:up
			},
			success: function (data) {
				console.log(data);
				if(data.logged == true){
					window.location = data.url;
				}else{
					alert(data.msg);
					$('#un').focus();
				}
			},
			//error: function(){
			//	alert('Error: L17+');

    		error: function (xhr, ajaxOptions, thrownError) {
		       alert(xhr.statusText);
		       alert(xhr.responseText);
		       alert(xhr.status);
		       alert(thrownError);

			}
		});
});

//inicio de bodega
//las lineas que se deben de poner en cada registro
//09/07/2018
//all bodega
// function showAllBodega()
// {
// 	$.ajax({
// 			url: 'data/all_bodega.php',
// 			success: function (data) {
// 				$('#all-bodegas').html(data);
// 			},
// 			error: function(){
// 				alert('Error: L+, all-bodega');
// 			}
// 		});
// }//end showAllItem
// showAllBodega();

$('#add-new-bodega').click(function(event) {
	/* Act on the event */
	$('#modal-bodega').find('.modal-title').text('Agregar Carga');
	$('#modal-bodega').modal('show');

	//para poner en blanco los campos 
	$('#bode-clavprod').val("");
	$('#bode-folioce').val("");
	$('#bode-remitente').val("");
	$('#bode-cons').val("");
	$('#bode-destino').val("");
	$('#bode-nbultos').val("");
	$('#bode-vol').val("");
	$('#bode-peso').val("");
	$('#bode-mercancia').val("");
	$('#bode-tbultos').val("");
	$('#bode-ubica').val("");
	$('#bode-medida').val("");
	$('#bode-docu').val("");
	$('#bode-lento').val("");
	$('#bode-peligro').val("");
	$('#bode-recol').val("");

	$('#submit-bodega').val('add');
});


$(document).on('submit', '#form-bodega', function(event) {
	event.preventDefault();
	/* Act on the event */
	// son los campos de la pantalla

	var bclavep = $('#bode-clavprod').val();
	var bfolioce = $('#bode-folioce').val();
	var bremitente = $('#bode-remitente').val();
	var bcons = $('#bode-cons').val();
	var bdestino = $('#bode-destino').val();
	var bnbultos = $('#bode-nbultos').val();
	var bvol = $('#bode-vol').val();
	var bpeso = $('#bode-peso').val();
	var bmercancia = $('#bode-mercancia').val();
	var btbultos = $('#bode-tbultos').val();
	var bubica = $('#bode-ubica').val();
	var bmedida = $('#bode-medida').val();
	var bdocu = $('#bode-docu').val();
	var blento = $('#bode-lento').val();
	var bpeligro = $('#bode-peligro').val();
	var brecol = $('#bode-recol').val();

	//alert(ipeso1)
	if($('#submit-bodega').val() == "add"){
		//alert(icons1)
    	// console.log('add ra');
	    $.ajax({
	    		url: 'data/add_bodega.php',
	    		type: 'post',
	    		cache: false,
	    		dataType: 'json',
	    		data: {
	    			bclavep:bclavep,
	    			bfolioce:bfolioce,
	    			bremitente:bremitente,
	    			bcons:bcons,
	    			bdestino:bdestino,
	    			bnbultos:bnbultos,
	    			bvol:bvol,
	    			bpeso:bpeso,
	    			bmercancia:bmercancia,
	    			btbultos:btbultos,
	    			bubica:bubica,
	    			bmedida:bmedida,
	    			bdocu:bdocu,
	    			blento:blento,
	    			bpeligro:bpeligro,
	    			brecol:brecol
	    		},
	    		success: function (data) {
	    			console.log(data);
	    			if(data.valid == true){
	    				$('#modal-message').find('#msg-body').text(data.msg);
	    				$('#modal-bodega').modal('hide');
	    				showAllBodegas();
	    				$('#modal-message').modal('show');
	    				$('#submit-bodega').val('null');
	    			}
	    		},	    		
	    		//error: function(){
	    		//	eMsg('301');

	    		error: function (xhr, ajaxOptions, thrownError) {
			       alert(xhr.statusText);
			       alert(xhr.responseText);
			       alert(xhr.status);
			       alert(thrownError);

	    		}//
	    	}).fail( function( jqXHR, textStatus, errorThrown ) {
			    alert( 'Error!!' +  textStatus );
			});

    }//end if == "add"
});

function editModalbodega(bodegaed_ID){
	// $('#submit-bodega').val('add');
	//alert(bodegaed_ID)
	$.ajax({
			url: 'data/get_bodega.php',
			type: 'post',
			dataType: 'json',
			data: {
				bodegaed_ID:bodegaed_ID
			},
			success: function (data) {
				$('#submit-bodega').val(data.event);

				$('#bode-id').val(data.id);
				$('#bode-clavprod').val(data.clavprod);
				$('#bode-folioce').val(data.folioce);
				$('#bode-remitente').val(data.remitente);
				$('#bode-cons').val(data.cons1);
				$('#bode-destino').val(data.destino)

				$('#bode-nbultos').val(data.nbultos);
				$('#bode-vol').val(data.volumen);
				$('#bode-peso').val(data.peso);

				$('#bode-mercancia').val(data.mercancia);
				$('#bode-tbultos').val(data.tbulto);
				$('#bode-ubica').val(data.ubica);
				$('#bode-medida').val(data.medida);
				$('#bode-docu').val(data.docu);

				$('#bode-lento').val(data.lento);
				$('#bode-peligro').val(data.peligro);
				$('#bode-recol').val(data.recol);

				$('#modal-bodega').find('.modal-title').text("Editar Carga");
				$('#modal-bodega').modal('show');
			},
			// error: function(){
			// 	alert('Error: L302+');

    		error: function (xhr, ajaxOptions, thrownError) {
		       alert(xhr.statusText);
		       alert(xhr.responseText);
		       alert(xhr.status);
		       alert(thrownError);

			}
		});
}//end editModal

//save edit modal
$(document).on('submit', '#form-bodega', function(event) {
	event.preventDefault();
	/* Act on the event */
	var submit = $('#submit-bodega').val();
	var bbodegaed_id = $('#bode-id').val();

	var bclavep = $('#bode-clavprod').val();
	var bfolioce = $('#bode-folioce').val();
	var bremitente = $('#bode-remitente').val();
	var bcons = $('#bode-cons').val();
	var bdestino = $('#bode-destino').val();
	var bnbultos = $('#bode-nbultos').val();
	var bvol = $('#bode-vol').val();
	var bpeso = $('#bode-peso').val();
	var bmercancia = $('#bode-mercancia').val();
	var btbultos = $('#bode-tbultos').val();
	var bubica = $('#bode-ubica').val();
	var bmedida = $('#bode-medida').val();
	var bdocu = $('#bode-docu').val();

	var lento = $('#bode-lento').val();
	var ipeligro = $('#bode-peligro').val();
	var irecol = $('#bode-recol').val();

	//alert(submit);

	if(submit  == "edit"){
		$.ajax({
				url: '../data/edit_bodega.php',
				type: 'post',
				dataType: 'json',
				data: {
					bbodegaed_id:bbodegaed_id,
	    			bclavep:bclavep,
	    			bfolioce:bfolioce,
	    			bremitente:bremitente,
	    			bcons:bcons,
	    			bdestino:bdestino,
	    			bnbultos:bnbultos,
	    			bvol:bvol,
	    			bpeso:bpeso,
	    			bmercancia:bmercancia,
	    			btbultos:btbultos,
	    			bubica:bubica,
	    			bmedida:bmedida,
	    			bdocu:bdocu,
	    			ilento:ilento,
	    			ipeligro:ipeligro,
	    			irecol:irecol	    					
				},
				success: function (data) {
					// console.log(data);
					if(data.valid == true){
	    				$('#modal-message').find('#msg-body').text(data.msg);
	    				$('#modal-bodega').modal('hide');
	    				showAllBodegas();
	    				$('#modal-message').modal('show');
	    				$('#submit-bodega').val('null');

					}
				},
				// error: function(){
				// 	eMsg('303');

    		error: function (xhr, ajaxOptions, thrownError) {
		       alert(xhr.statusText);
		       alert(xhr.responseText);
		       alert(xhr.status);
		       alert(thrownError);

				}
			});
	}//end submit
});

function showAllBodegas(){
	var date = $('#dailyDate').val();
	dailybodegas(date);
}//end showAllbodegas
showAllBodegas();


function dailybodegas(date){
	$.ajax({
			url: 'data/all_bodega.php?date='+date,
			type: 'get',
			data: {
				date:date
			},
			success: function (data) {
				$('#all-bodegas').html(data);
			},
			error:function(){
				eMsg(474);
			}
		});	
}

function showAllChecador(){
	var date = $('#fechaini').val();
	
	dailychecador(date);
}//end showAllChecador
showAllChecador();

function dailychecador(date){
	$.ajax({
			url: 'data/all_checador.php?date='+date,
			type: 'get',
			data: {
				date:date
			},
			success: function (data) {
				$('#all-checador').html(data);
			},
			error:function(){
				eMsg(474);
			}
		});	
}

function showAllChecadorxp(){
	var date = $('#fechaini').val();
	var datef = $('#fechafin').val();
	
	//alert(date);
	//alert(datef);

	//dailychecadorxp(date,datef);
	dailychecadorxp(date);
}//end showAllChecador
showAllChecadorxp();

function dailychecadorxp(date){
	$.ajax({
			//url: 'data/all_checadorxp.php?date='+date+'&datef='+datef,
			url: 'data/all_checadorxp.php?date='+date,
			type: 'get',
			data: {
				date:date
			},
			success: function (data) {
				$('#all-checadorxp').html(data);
			},
			error:function(){
				eMsg(474);
			}
		});	
}

$(document).on('change', '#dailyDate', function(event) {
	event.preventDefault();
	/* Act on the event */
	var date = $('#dailyDate').val();
	if(date == '' || date == null){
		$('#printBut').hide();
	}else{
		$('#printBut').show();
	}
	dailybodegas(date);

});

$('#printBut').click(function(event) {
	/* Act on the event */
	var date = $('#dailyDate').val();
	window.open('data/print-sales.php?date='+date,'name','width=600,height=400');	
});

$('#printchec').click(function(event) {
	/* Act on the event */
	var fechaini = $('#fechaini').val();
	var fechafin = $('#fechafin').val();
	//window.open('pdfs/example13.php?fechaini='+fechaini,'name','width=600,height=400');	
	//window.open('data/print-checadordos.php?fechaini='+fechaini+'&fechafin='+fechafin,'name','width=600,height=400');	
	window.open('data/print-checador.php?fechaini='+fechaini+'&fechafin='+fechafin,'name','width=600,height=400');	
});

//para borrar las entradas a bodega
$('#del-bodega').click(function(event) {
	/* Act on the event */
	var check = 0;
	 $('input[type=checkbox]:checked').each(function(index) {
		check++;        
    });
	 if(check == 0){
	 	alert('Por favor selecciona la fila!');
	 }else{
	 	$('#confirm-type').val('expired');
		$('#modal-confirmation').modal('show');
	}//end if check == 0
});

$('.del-expired').click(function(event) {
	/* Act on the event */
	if($('#confirm-type').val() == "expired"){
			var finish = false;
		$('input[type=checkbox]:checked').each(function(index) {
			// console.log($(this).val());
			finish = true;
			var bodegaed_ID = $(this).val();			
			$.ajax({
					url: 'data/del_bodega.php',
					type: 'post',
					dataType: 'json',
					data: {
						bodegaed_ID:bodegaed_ID
					},
					success: function (data) {
						showAllBodegas();
					},
					// error: function(){
					// 	eMsg('195');

		    		error: function (xhr, ajaxOptions, thrownError) {
				       alert(xhr.statusText);
				       alert(xhr.responseText);
				       alert(xhr.status);
				       alert(thrownError);

					}
			    	}).fail( function( jqXHR, textStatus, errorThrown ) {
					    alert( 'Error!!' +  textStatus );
				});
	    });
		if(finish == true){
			$('#modal-confirmation').modal('hide');
			$('#modal-message').find('#msg-body').text('Eliminado correctamente!')
			$('#modal-message').modal('show');
  				showAllBodegas();
			$('#modal-message').modal('show');
			$('#submit-bodega').val('null');

		}//end finish
		
	}//end if
});

//fin de bodega

//inicio de cliente

function autocompletar() {
	var min_length = 0; // variable length
	var nombre = $('#bode-remitente').val();//obtener el nombre y/o termino de busqeuda
	if (nombre.length >= min_length) {
		$.ajax({
			url: 'class/cliente_busqueda.php',
			type: 'POST',
			data: {nombre:nombre},
			success:function(data){
				$('#lista_id').show();//mistrar la lista
				$('#lista_id').html(data);//mostrar resultado de consulta en la lista
			}
		});
	} else {
		$('#lista').hide();
	}
}

// funcion que setea valores a los input despues de busqueda
function set_item(id,item) {
	// setear valor al imput id y nombre
	$('#bode-remitente').val(item);
	//$('#id').val(id);

	// ocultar la lista
	$('#lista_id').hide();
}

//fin de cliente

//all item
function showAllItem()
{
	$.ajax({
			url: 'data/all_item.php',
			success: function (data) {
				$('#all-item').html(data);
			},
			error: function(){
				alert('Error: L42+');
			}
		});
}//end showAllItem
showAllItem();

$('#add-new-item').click(function(event) {
	/* Act on the event */
	$('#modal-item').find('.modal-title').text('Agregar producto');
	$('#modal-item').modal('show');
	$('#submit-item').val('add');
});

$(document).on('submit', '#form-item', function(event) {
	event.preventDefault();
	/* Act on the event */
	var iName = $('#item-name').val();
	var iPrice = $('#item-price').val();
	var iType = $('#item-type').val();
	var code = $('#code').val();
	var brand = $('#brand').val();
	var grams = $('#grams').val();
    if($('#submit-item').val() == "add"){
    	// console.log('add ra');
	    $.ajax({
	    		url: 'data/add_item.php',
	    		type: 'post',
	    		dataType: 'json',
	    		data: {
	    			iName:iName,
	    			iPrice:iPrice,
	    			iType:iType,
	    			code:code,
	    			brand:brand,
	    			grams:grams
	    		},
	    		success: function (data) {
	    			console.log(data);
	    			if(data.valid == true){
	    				$('#modal-message').find('#msg-body').text(data.msg);
	    				$('#modal-item').modal('hide');
	    				showAllItem();
	    				$('#modal-message').modal('show');
	    				$('#submit-item').val('null');
	    			}
	    		},
	    		error: function(){
	    			eMsg('N70');
	    		}//
	    	});
    }//end if == "add"
});

function editModal(item_id){
	// $('#submit-item').val('add');
	$.ajax({
			url: 'data/get_item.php',
			type: 'post',
			dataType: 'json',
			data: {
				item_id:item_id
			},
			success: function (data) {
				$('#submit-item').val(data.event);
				$('#item-name').val(data.name);
				$('#item-price').val(data.price);
				$('#item-id').val(data.id);
				$('#code').val(data.code);
				$('#brand').val(data.brand);
				$('#grams').val(data.grams);
				$('#item-type').val(data.type);
				$('#modal-item').find('.modal-title').text("Editar producto");
				$('#modal-item').modal('show');
			},
			error: function(){
				alert('Error: L56+');
			}
		});
}//end editModal

//save edit modal
$(document).on('submit', '#form-item', function(event) {
	event.preventDefault();
	/* Act on the event */
	var submit = $('#submit-item').val();
	var item_id = $('#item-id').val();

	var iName = $('#item-name').val();
	var iPrice = $('#item-price').val();
	var iType = $('#item-type').val();
	var code = $('#code').val();
	var brand = $('#brand').val();
	var grams = $('#grams').val();

	if(submit  == "edit"){
		$.ajax({
				url: 'data/edit_item.php',
				type: 'post',
				dataType: 'json',
				data: {
					item_id:item_id,
					iName:iName,
	    			iPrice:iPrice,
	    			iType:iType,
	    			code:code,
	    			brand:brand,
	    			grams:grams
				},
				success: function (data) {
					// console.log(data);
					if(data.valid == true){
						$('#modal-message').find('#msg-body').text(data.msg);
						$('#modal-item').modal('hide');
						showAllItem();
						$('#modal-message').modal('show');
					}
				},
				error: function(){
					eMsg('127');
				}
			});
	}//end submit
});

function showAllStockList(){
	$.ajax({
			url: 'data/all_stocklist.php',
			type: 'post',
			success: function (data) {
				$('#all-stocklist').html(data);
			},
			error: function(){
				eMsg('152');
			}
		});
}//end showAllStockList
showAllStockList();

// $('#del-stock').on('click', '.selector', function(event) {
// 	event.preventDefault();
// 	/* Act on the event */
// 	// $('input[type=checkbox]:checked').each(function(index) {
//  //        //where the magic begins wahaha. ge ahak.
//  // 		console.log($(this).val())
//  //    });
//  	console.log('sad');
// });
$('#del-stock').click(function(event) {
	/* Act on the event */
	var check = 0;
	 $('input[type=checkbox]:checked').each(function(index) {
		check++;        
    });
	 if(check == 0){
	 	alert('Please Select Row!');
	 }else{
	 	$('#confirm-type').val('expired');
		$('#modal-confirmation').modal('show');
	}//end if check == 0
});


$('#add-stock').click(function(event) {
	/* Act on the event */
	$('#modal-stock').find('.modal-title').text('Nuevo stock');
	$('#modal-stock').modal('show');
});

//form stock
var fuck = 0;
$(document).on('submit', '#form-stock', function(event) {
	event.preventDefault();
	/* Act on the event */
    var item_id = $('#item-id').val();
    var qty = $('#qty').val();
    var xDate = $('#xDate').val();
    var manu = $('#manu').val();
    var purc = $('#purc').val();
    fuck++;
    // alert(fuck);
    $.ajax({
    		url: 'data/add_fuck.php',
    		type: 'post',
    		// dataType: 'json',
    		data: {
    			item_id:item_id,
    			qty:qty,
    			xDate:xDate,
    			manu:manu,
    			purc:purc
    		},
    		success: function (data) {
    			console.log(data);
    			// console.log('stock');
    			// if(data.valid == true){
    				$('#modal-stock').modal('hide');
 		   			showAllStockList();
    				$('#modal-message').find('#msg-body').text(data.msg);
    				$('#modal-message').modal('show');
    			// }
    		},
    		error: function(){
    			eMsg('233');
    		}
    	});

});

//all expired
function showAllExpired(){
	$.ajax({
			url: 'data/all_expired.php',
			type: 'post',
			// data: {},
			success: function (data) {
				$('#all-expired').html(data);
			},
			error: function(){
				eMsg('260');
			}
		});
}//end showAllExpired
showAllExpired();

//all stock
function showAllStocks(){
	$.ajax({
			url: 'data/all_stock.php',
			type: 'post',
			success: function (data) {
				$('#all-stock').html(data);
			},
			error: function(){
				eMsg('275');
			}
		});
}//end showAllStocks
showAllStocks();

//stock report print
$('#stock-report').click(function(event) {
	/* Act on the event */
	// window.open('print.php?datePick=<?php echo $datePick; ?>','name','width=auto,height=auto');
	window.open('data/print.php','name','width=auto,height=auto');
});

function showOrder(){
	$.ajax({
			url: 'data/order.php',
			type: 'post',
			success: function (data) {
				$('#order').html(data);
			},
			error: function(){
				eMsg('297');
			}
		});
}//end showOrder
showOrder();

//add to cart
function toCart(stock_id, qty, item_id){
	$('#stock-id').val(stock_id);
	$('#item-id').val(item_id);
	$('#item-qty').val(qty);
	$('#modal-to-cart').modal('show');
}//end toCart

$(document).on('submit', '#form-toCart', function(event) {
	event.preventDefault();
	/* Act on the event */
	var stock_id = $('#stock-id').val();
	var item_id = $('#item-id').val();
	var qty = $('#item-qty').val();
	var cartQty = $('#cart-qty').val();//add to cart
	var newStockQty = qty - cartQty;
	if(newStockQty < 0){
		alert('El artículo no es suficiente!');
	}else{
		// alert('Enough!');
		$.ajax({
				url: 'data/add_cart.php',
				type: 'post',
				data: {
					stock_id:stock_id,
					item_id:item_id,
					cqty:cartQty,
					nqty:newStockQty
				},
				success: function (data) {
					console.log(data);
					showOrder();
					$('#modal-to-cart').modal('hide');
				},
				error:function(){
					eMsg('331');
				}
			});
	}//end if !qty
});

//del from cart
function delCart(stock_id, qty, cart_id){
	$.ajax({
			url: 'data/del_cart.php',
			type: 'post',
			data: {
				stock_id:stock_id,
				cart_id:cart_id,
				qty:qty
			},
			success: function (data) {
				console.log(data);
				showOrder();
			},
			error: function(){
				eMsg('354');
			}
		});
}//end delCart

//order form
$(document).on('submit', '#form-order', function(event) {
	event.preventDefault();
	/* Act on the event */
	var custName = $('#customer-name').val();
	var tender = $('#tendered').val();
	var totalOrder = $('#totalOrder').val();
	var change = tender - totalOrder;

	if(change < 0){
		alert('Datos insuficientes!');
	}else{
		//good vibes
		$.ajax({
				url: 'data/add_transaction.php',
				type: 'post',
				// dataType: 'json',
				data: {
					custName:custName,
					tender:tender,
					totalOrder:totalOrder,
					change:change
				},
				success: function (data) {
					console.log(data);
				},
				error: function(){
					eMsg('385');
				}
			});
	}//end change < 0
	
});//form order


function confirm_cart(){
	$('#confirm-type').val('confirmCart');
	$('#modal-confirmation').modal('show');
}//end confirm_cart

$('#confirm-yes').click(function(event) {
	/* Act on the event */
	var choice = $('#confirm-type').val();
	if(choice == 'confirmCart'){
		$.ajax({
				url: 'data/confirm_order.php',
				type: 'post',
				dataType: 'json',
				data:{
					click:'yes'
				},
				success: function (data) {
					// console.log(data);
					if(data.valid == true){
						$('#confirm-type').val(' ');
						$('#modal-confirmation').modal('hide');
						showOrder();
						$('#modal-message').find('#msg-body').text(data.msg);
						$('#modal-message').modal('show');
					}
				},
				error: function(){
					eMsg(445);
				}
			});
	}
});


//<script type="text/javascript">
    
    function numeros(e){
        key = e.keyCode || e.which;
        tecla = String.fromCharCode(key).toLowerCase();
        letras = " 0123456789";
        especiales = [8,37,39,46];
     
        tecla_especial = false
        for(var i in especiales){
            if(key == especiales[i]){
                tecla_especial = true;
                break;
            } 
        }
     
        if(letras.indexOf(tecla)==-1 && !tecla_especial)
            return false;
    }

//</script>

// function showAllSales(){
// 	var date = $('#dailyDate').val();
// 	dailySales(date);
// }//end showAllSales
// showAllSales();

// function dailySales(date){
// 	$.ajax({
// 			url: 'data/all_sales.php?date='+date,
// 			type: 'get',
// 			data: {
// 				date:date
// 			},
// 			success: function (data) {
// 				$('#all-sales').html(data);
// 			},
// 			error:function(){
// 				eMsg(474);
// 			}
// 		});	
// }


// $(document).on('change', '#dailyDate', function(event) {
// 	event.preventDefault();
// 	/* Act on the event */
// 	var date = $('#dailyDate').val();
// 	if(date == '' || date == null){
// 		$('#printBut').hide();
// 	}else{
// 		$('#printBut').show();
// 	}
// 	dailySales(date);

// });

// $('#printBut').click(function(event) {
// 	/* Act on the event */
// 	var date = $('#dailyDate').val();
// 	window.open('data/print-sales.php?date='+date,'name','width=600,height=400');	
// });

