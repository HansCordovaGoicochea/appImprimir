var getUrl = window.location;
var base_url = '';
if  (getUrl.host === '192.168.1.6:8069') {
    base_url = getUrl.protocol + "//192.168.1.6:81/" + getUrl.pathname.split('/')[1] + "/";
}else  if (getUrl.host !== 'localhost:81') {
    base_url = getUrl.protocol + "//192.168.1.6:81/" + getUrl.pathname.split('/')[1] + "/";
}
else  if (getUrl.host === 'localhost:81'){
    base_url = getUrl.protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1] + "/";
}
else{
    base_url = getUrl.protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1] + "/";
}
// alert(base_url);
//Initialize Select2 Elements
    $('.select2').select2()

    //Date picker
    $('#datepicker').datepicker({
        autoclose: true
    });


    function addRow() {
        var i = $('#detalle tr.count_trs').length;
        if (i>0){
            i++;
            FilasSeccion(i);
        }
    }

    function FilasSeccion(i) {
        row = ' <tr class="count_trs tr_'+i+'" id="'+i+'">\n' +
            '                                       <td style="width:0px;">'+i+'</td>\n' +
            '                                       <td>\n'+
            '                                          <input type="number" name="txtCantidad_'+i+'" id="txtCantidad_'+i+'"  class="form-control cantidad" value="1" onchange="change_para_importe('+i+');">\n'+
            '                                          </td>\n'+
            '                                       <td>\n'+
            '                                          <textarea name="txtDescripcion_'+i+'" id="txtDescripcion_'+i+'" cols="80" rows="3"></textarea>\n'+
            '                                          </td>\n'+
            '                                       <td>\n'+
            '                                          <input type="number" name="txtImporte_'+i+'" id="txtImporte_'+i+'" class="form-control importe" value="0">\n'+
            '                                       </td>\n'+
            '                                       <td>\n'+
            '                                            <button type="button" value="Borrar" id="btnBorrarSeccion_'+i+'" name="btnBorrarSeccion_'+i+'" class="btn btn-default pull-left eliminar_linea">\n'+
            '                                               <i class="fa fa-trash"></i>\n'+
            '                                                </button>\n'+
            '                                            </td>\n'+
            '                                    </tr>';

        $("#trAgregar").closest("tr").before(row);
    }

    $(document).on('click', 'button.eliminar_linea', function () {
        var trs=$("#detalle tr.count_trs").length;
        id = $(this).parent().parent().attr('id');
        if(trs>1)
        {
            $(this).closest('tr').remove();
        }
        else{
            $("#detalle tbody tr#"+id+".count_trs").find("td:eq(0)").find("input").val('');
            $("#detalle tbody tr#"+id+".count_trs").find("td:eq(1)").find("input").val('1');
            $("#detalle tbody tr#"+id+".count_trs").find("td:eq(2)").find("textarea").text('');
            $("#detalle tbody tr#"+id+".count_trs").find("td:eq(3)").find("input").val(0);

            alert("Usted no puede eliminar la primera fila!!");
        }

    });


    function imprimir_ticket($param) {
        var Objsecciones = {};
        Objsecciones.valor = [];

        $("#detalle").find("tbody tr.count_trs").each(function (index) {
            var cantidad = $(this).find("td:eq(1)").find("input").val();
            var descripcion = $(this).find("td:eq(2)").find("textarea").val();
            var importe = $(this).find("td:eq(3)").find("input").val();

            Objsecciones.valor.push({
                'cantidad': cantidad,
                'descripcion': descripcion,
                'importe': importe,
            });

        });
        var jsonDetalle = JSON.stringify(Objsecciones);

        var formData = new FormData();

        formData.append('impresora', $('#txtImpresora').val());
        formData.append('emisor', $('#txtEmisor').val());
        formData.append('ruc_emisor', $('#txtRucEmisor').val());
        formData.append('recibo', $('#txtRecibo').val());
        formData.append('cliente', $('#txtCliente').val());
        formData.append('documento', $('#txtDocumento').val());
        formData.append('fecha', $('#datepicker').val());
        formData.append('direccion', $('#txtDireccion').val());
        formData.append('obs', $('#txtObs').val());
        formData.append('ref', $('#txtRef').val());

        formData.append('jsonDetalle', jsonDetalle);

        formData.append('subtotal', $('#sub_total').val());
        formData.append('impuesto', $('#monto_impuesto').val());
        formData.append('total', $('#costo_total').val());

        // var $this = $(this);
        //$this.button('loading');
        $.ajaxblock();
        if($param === 'directo'){
            url = base_url + "index.php/imprimircontrolador/imprimir";
            $.ajax({
                url: url,
                type: "POST",
                dataType: "json",
                cache: false,
                contentType: false,
                processData: false,
                data: formData,
                // data:{
                //     fecha_facturacion: 'fgfgfgfg',
                // }
            }).done(function( data, textStatus, jqXHR ){
                if(data['success']!="false" && data['success']!=false)
                {
                    $("#json_code").text(JSON.stringify(data, null, '\t'));
                    if(typeof(data['result'])!='undefined')
                    {
                        alert(data['result']);
                    }
                    //$this.button('reset');
                    $("#error").hide();
                    $(".result").show();
                    $.ajaxunblock();
                }
                else
                {
                    if(typeof(data['msg'])!='undefined')
                    {
                        alert( data['msg'] );
                    }
                    //$this.button('reset');
                    $.ajaxunblock();
                }
            }).fail(function( jqXHR, textStatus, errorThrown ){
                alert( "Solicitud fallida:" + textStatus );
                $(this).button('reset');
                $.ajaxunblock();
            });
        }
        else{
            $('#modal_reporte_tareo').modal('show');
            url = base_url + "index.php/imprimircontrolador/imprimirAbrir";
            $('#contenido_modal_reporte').html('<embed style="height: 500px;" id="objeto_reporte_m" width="100%" class="contenido-pdf" src="' + url + '">');
            $.ajaxunblock();
        }

    }

/* ++++++++++++++++++++++++++++++++++++++
+	Create 	: 	Josue Mazco Puma		+
+	e-mail 	: 	JossMP@gmail.com		+
+	twitter : 	@JossMP777				+
++++++++++++++++++++++++++++++++++++++ */
(function($){
    $.ajaxblock 	= function(){
        $("body").prepend("<div id='ajax-overlay'><div id='ajax-overlay-body' class='center'><i class='fa fa-spinner fa-pulse fa-3x fa-fw'></i><span class='sr-only'>Loading...</span></div></div>");
        $("#ajax-overlay").css({
            position: 'absolute',
            color: '#FFFFFF',
            top: '0',
            left: '0',
            width: '100%',
            height: '100%',
            position: 'fixed',
            background: 'rgba(39, 38, 46, 0.67)',
            'text-align': 'center',
            'z-index': '9999'
        });
        $("#ajax-overlay-body").css({
            position: 'absolute',
            top: '40%',
            left: '50%',
            width: '120px',
            height: '48px',
            'margin-top': '-12px',
            'margin-left': '-60px',
            //background: 'rgba(39, 38, 46, 0.1)',
            '-webkit-border-radius':	'10px',
            '-moz-border-radius':	 	'10px',
            'border-radius': 		 	'10px'
        });
        $("#ajax-overlay").fadeIn(50);
    };
    $.ajaxunblock 	= function(){
        $("#ajax-overlay").fadeOut(100, function()
        {
            $("#ajax-overlay").remove();
        });
    };
})(jQuery);
