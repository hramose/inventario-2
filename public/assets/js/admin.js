$(window).ready(function () {


	/* Script Chosen */
	var config = {
        '.chosen-select'           : {},
        '.chosen-select-deselect'  : {allow_single_deselect:true},
        '.chosen-select-no-single' : {disable_search_threshold:10},
        '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
        '.chosen-select-width'     : {width:"95%"}
    }

    for (var selector in config) {
        $(selector).chosen(config[selector]);
    }






    $.datepicker.regional['es'] = {
    	changeYear: true,
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


   	$(".fecha").datepicker( {   dateFormat: "yy-mm-dd"   });

   	$('.mes_anio').datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat: 'mm/yy',

        onClose: function () {
            var iMonth = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
            var iYear = $("#ui-datepicker-div .ui-datepicker-year :selected").val();

            $(this).datepicker('setDate', new Date(iYear, iMonth, 1));
            $(this).datepicker('refresh');
        }
    });

   	/*  Reset Form */
   	$(document).on('click', '.cerrarForm', function(){
   		$('.modal').modal('hide')
   	});



   	// Mostrar Panel hide
   	$(document).on('click', '#showRepEmp', function(){
   		$("#addRepEmpresa").show('slow');
   		$(this).hide();
   		$("#hideRepEmp").show();
   	});
   	// cultar
   	$(document).on('click', '#hideRepEmp', function(){
   		$("#addRepEmpresa").hide('slow');
   		$(this).hide();
   		$("#showRepEmp").show();
   	});




   	// SCRIPT VENTAS
   	$(document).on('change', '.num_unidades', function(){

   		//Obtengo ID de la Compra
	   		var ide = $(this).attr('id');
	   		ide = ide.split("_");
	   		ide = ide[1];

	   	actualizarValor(ide);

   	});

   	$(document).on('click', '.numuni', function(){
   		//Obtengo ID de la Compra
	   		var ide = $(this).attr('id');
	   		ide = ide.split("_");
	   		//obtengo operación
	   		var op = ide[0];
	   		ide = ide[1];

	   	var cantidad = $("#cantidad_"+ide).val();

	   	if(cantidad == ''){
	   		cantidad = 0;
	   	}

	   	cantidad = parseInt(cantidad);

	   	if(op == 'menos'){
	   		cantidad--;
	   		$("#cantidad_"+ide).val(cantidad);
	   	}else if(op == 'mas'){
	   		cantidad++;
	   		$("#cantidad_"+ide).val(cantidad);
	   	}

	   	actualizarValor(ide);
   	});

   	function actualizarValor(ide){
   		var valor_total = 0;
   		var unidades = $("#cantidad_"+ide).val();
   		var valor = $("#costo_uni_iva_"+ide).val();
	   	var total = valor*unidades;

	   	$("#total_"+ide).text($.number(total));


	   	$(".calcValorIVA").each(function(index){
	   		var valor = $(this).text().replace(/,/g, '');
	   		if(valor == ''){valor=0;}
	   		valor = parseInt(valor);

	   		valor_total += valor;

	   		$("#precio_total").text( $.number(valor_total) );

	   	});
   	}

});