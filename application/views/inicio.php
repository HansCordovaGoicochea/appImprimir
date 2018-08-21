<section class="content">

    <div class="panel">
            <div class="panel-body">
                <form enctype="multipart/form-data"
                      action="" name="frm" id="frm"
                      method="post">
                    <!--datos de la factura-->
                    <div class="row">
                        <div class="col-lg-12 col-xs-12 datos_1">
                        </div>
                    </div>
                    <!--inicio del detalle-->
                    <div class="row">
                        <div class="table-responsive">
                            <table class="table" id="detalle">
                                <thead>
                                <tr>
                                    <th>
                                        <h4></h4>
                                    </th>
                                    <th>
                                        <h4>Producto</h4>
                                    </th>
                                    <th>
                                        <h4>Descripción</h4>
                                    </th>
                                    <th>
                                        <h4>Cantidad</h4>
                                    </th>
                                    <th>
                                        <h4>Precio Unitario</h4>
                                    </th>
                                    <th>
                                        <h4>Importe</h4>
                                    </th>
                                    <th>
                                        <h4></h4>
                                    </th>
                                    <th style="width:0px; display: none">
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr class="count_trs tr_1" id="">
                                    <td style="width:0px;">
                                        <input name="txt_id_factura_ventas_det_1" id="txt_id_factura_ventas_det_1" value="" style="display:none;"/>
                                    </td>
                                    <td>
                                        <input type="number" name="txtCantidad_1" id="txtCantidad_1"  class="form-control cantidad" value="1" onchange="change_para_importe(1);">
                                    </td>
                                    <td>
                                        <textarea name="txtDescripcion_1" id="txtDescripcion_1" cols="20" rows="2"></textarea>
                                    </td>
                                    <td>
                                        <input type="number" name="txtCantidad_1" id="txtCantidad_1"  class="form-control cantidad" value="1" onchange="change_para_importe(1);">
                                    </td>
                                    <td>
                                        <input type="number" name="txtPrecioUnitario_tax_1" id="txtPrecioUnitario_tax_1"  class="form-control unitario_tax" value="0" onchange="change_para_importe(1);" >
                                    </td>
                                    <td>
                                        <input type="number" name="txtImporte_1" id="txtImporte_1" class="form-control importe" value="0">
                                    </td>
                                    <td>
                                        <button type="button" value="Borrar" id="btnBorrarSeccion_1" name="btnBorrarSeccion_1" class="btn btn-default pull-left eliminar_linea">
                                            <i class="icon-trash"></i>
                                        </button>
                                    </td>
                                    <td style="display:none;">
                                        <input type="number" name="txtPrecioUnitario_1" id="txtPrecioUnitario_1"  class="form-control unitario" value="0" onchange="change_para_importe(1);">
                                    </td>
                                </tr>
                                <tr class="tr" id="trAgregar">
                                    <td colspan="7"><a id='button_agregar' onclick="addRow();" class="pointer"
                                                       style="color: #00aff0;">Agregar nuevo Item</a></td>
                                </tr>

                                </tbody>
                            </table>
                        </div>

                        <!--fin del detalle-->
                        <!--seccion totales pagos-->
                        <div class="col-lg-offset-10">
                            <div class="row" style="margin-bottom: 10px;">
                                <div class="form-group">
                                    <label for="sub_total" class="control-label col-lg-5 col-xs-12"><strong>SubTotal:</strong></label>
                                    <div class="col-xs-7 text-right">
                                        <div class="input-group" style="margin-bottom: 5px">
                                                    <span id="simboloSubTotal"
                                                          class="input-group-addon"><strong>S/ </strong></span>
                                            <input type="text" id="sub_total" class="form-control col-lg-12"
                                                   name="sub_total" value="{$objFactura->subtotal}"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row" style="margin-bottom: 10px;">
                                <div class="form-group">
                                    <label for="monto_impuesto" class="control-label col-lg-5 col-xs-12"><strong>Impuesto:</strong></label>
                                    <div class="col-xs-7 text-right">
                                        <div class="input-group">
                                                    <span id="simboloimpuesto"
                                                          class="input-group-addon"><strong>S/ </strong></span>
                                            <input type="text" name="monto_impuesto" class="form-control"
                                                   id="monto_impuesto" value="{$objFactura->impuesto}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row" style="margin-bottom: 10px;">
                                <div class="form-group">
                                    <label for="costo_total"
                                           class="control-label col-lg-5 col-xs-12"><strong>Total:</strong></label>
                                    <div class="col-xs-7 text-right">
                                        <div class="input-group">
                                                    <span id="simboloTotal"
                                                          class="input-group-addon"><strong>S/ </strong></span>
                                            <input type="text" name="costo_total" class="form-control" id="costo_total" value="{$objFactura->total}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="panel-footer">
                    <button type="button" class="btn btn-default pull-right" id="imprimir_ticket" onclick="imprimir_ticket();" style="    margin-top: 20px;">
                        <i class="icon-print" style="display: block; margin: 0 auto; font-size: 28px; background: transparent; background-size: 26px; background-position: center;"></i>Imprimir Ticket
                    </button>
                </div>
        </div>
    </div>


</section>
<script>

    $("#btnProcesar").on('click', function (e) {
        var Objsecciones = {};
        Objsecciones.valor = [];

        if( $("input[name=tipo_venta]:radio").is(':checked')) {
            if ($('input[name=tipo_venta]:checked').val() === 'delivery' && $.trim($("#direccion_delivery").val()) === '') {
                jAlert('Escriba un Dirección para el delivery!');
                $("#btnProcesar").finish();
                return false;
            }
            if ($('input[name=tipo_venta]:checked').val() === 'mesa') {
                if (parseInt($("#nro_mesa").val()) === 0 || $.trim($("#nro_mesa").val()) === ''){
                    jAlert('¡Coloque el numero de mesa Gracias!');
                    $("#btnProcesar").finish();
                    return false;
                }
            }
        } else{
            jAlert('Selecciones el tipo de venta!');
            $("#btnProcesar").finish();
            return false;
        }
        // return false;

        // $("#btnProcesar").finish();
        // return false;
        var errores = 0;
        $("#detalle").find("tbody tr.count_trs").each(function (index) {
            var id_factura_ventas_det = $(this).find("td:eq(0)").find("input").val();
            var id_producto = $(this).find("td:eq(1)").find("select option:selected").val();
            var descripcion = $(this).find("td:eq(2)").find("textarea").val();
            var cantidad = $(this).find("td:eq(3)").find("input").val();
            var precio_unitario = $(this).find("td:eq(4)").find("input").val();
            var importe = $(this).find("td:eq(5)").find("input").val();
            var precio_sin_tax = $(this).find("td:eq(7)").find("input").val();


            if (parseInt(id_producto) === 0) {
                errores++;
            }

            if ($.trim(cantidad) === '' && $.trim(precio_tax) === '' && $.trim(importe) === '') {
                errores++;
            }

            Objsecciones.valor.push({
                "id_factura_ventas_det": id_factura_ventas_det,
                "id_producto": id_producto,
                'descripcion': descripcion,
                'cantidad': cantidad,
                'precio_unitario': precio_unitario,
                'importe': importe,
                'precio_sin_tax': precio_sin_tax,
            });

        });
        var jsonDetalle = JSON.stringify(Objsecciones);


        if (errores > 0) {
            jAlert('LLENE TODOS LOS CAMPOS!');
            $("#btnProcesar").finish();
            return false;
        }
        else {
            if ($('input[name=tipo_venta]:checked').val() === 'mesa') {
                $('#btnProcesar').attr('disabled', true);
                varificar_mesa(function(res){
                    // here you use the output
                    {
                        if (res.estado == 'ocupado'){
                            jAlert('Mesa OCUPADA!');
                            $('#nro_mesa').css('background-color','red');
                            $('#nro_mesa').val('');
                            $('#btnProcesar').attr('disabled', false);
                            $("#btnProcesar").finish();
                            return false;
                        }else{
                            $('#nro_mesa').css('background-color','green');
                            // showSuccessMessage('Mesa Disponible');
                            $('.adminfacturaventas').waitMe({
                                effect: 'bounce',
                                text: 'Guardando...',
//    bg : rgba(255,255,255,0.7),
                                color: '#000',
                                maxSize: '',
                                textPos: 'vertical',
                                fontSize: '',
                                source: ''
                            });

                            llenarDetalleEsquema(jsonDetalle);
                        }
                    }

                });
            }
            else{
                $('.adminfacturaventas').waitMe({
                    effect: 'bounce',
                    text: 'Guardando...',
//    bg : rgba(255,255,255,0.7),
                    color: '#000',
                    maxSize: '',
                    textPos: 'vertical',
                    fontSize: '',
                    source: ''
                });

                llenarDetalleEsquema(jsonDetalle);
            }


        }


    });

    function llenarDetalleEsquema(jsonDetalle) {
        $('#resultado').css('display', '');
        var htmlmensaje = '';

        var formData = new FormData();
        formData.append('ajax', "1");
        formData.append('token', "{getAdminToken tab='AdminFacturaVentas'}");
        formData.append('tab', "AdminFacturaVentas");
        formData.append('action', "addFactura");

        formData.append('id_factura_ventas', $('#txtidFacturaVentas').val());
        formData.append('tipo_venta', $('input[name=tipo_venta]:checked').val());
        if ($('input[name=tipo_venta]:checked').val() === 'delivery'){
            formData.append('direccion_delivery', $("#direccion_delivery").val());
        }

        formData.append('jsonDetalle', jsonDetalle);

        formData.append('subtotal', $('#sub_total').val());
        formData.append('impuesto', $('#monto_impuesto').val());
        formData.append('total', $('#costo_total').val());
        formData.append('id_caja', $('#id_caja').val());
        formData.append('nro_mesa', $('#nro_mesa').val());

        $.ajax({
            type: "POST",
            url: "{$link->getAdminLink('AdminFacturaVentas')|addslashes}",
            async: true,
            dataType: "json",
            enctype: 'multipart/form-data',
            cache: false,
            contentType: false,
            processData: false,
            data: formData,
            success: function (res) {
                if (res.errors === 'mal') {
                    $.growl.error({ title: "" + res.correcto + "", message: "" });
                    $('.adminfacturaventas').waitMe('hide');
                }
                else {
                    $('#txtidFacturaVentas').val(res.id_factura);
                    var i = 0;
                    if (res.detalle) {
                        $.each(res.detalle, function (index) {
                            i++;
                            id_seccion = this.clave_seccion;
                            $("#id_factura_ventas_det_" + i).val(id_seccion);
                            $('#detalle tbody tr.tr_' + i).attr('id', id_seccion);
//                            alert($("#txt_id_seccion_"+(index+1)).val(id_seccion));

                        });
                    }
                    if (res.cajasaldo2) {
                        $.each(res.cajasaldo2, function (index) {
                            id_caja = this.id_apertura_caja;
                            tipo_moneda = this.tipo_moneda;
                            monto_inicial = parseFloat(this.monto_inicial).toFixed(2);
                            $("#caja_"+id_caja+"_"+tipo_moneda).text('S/'+monto_inicial);
                            $("#valor_caja_"+id_caja+"_"+tipo_moneda).val(monto_inicial);
//                            alert($("#txt_id_seccion_"+(index+1)).val(id_seccion));

                        });
                    }
                    $.growl.notice({ title: "" + res.correcto + "", message: "" });
                    $('#mensaje').text(res.correcto);
                    $('#mensaje').show();
                    $('#trAgregar').hide();
                    // location.reload();
                    {*window.location.replace("{$link->getAdminLink('AdminFacturaVentas')|addslashes}&id_factura_ventas="+ res.id_factura +"&updatefactura_ventas");*}
                    if ($('input[name=tipo_venta]:checked').val() === 'llevar'){
                        $('#imprimir_ticket').removeAttr('href');
                        var url = '{$link->getAdminLink('AdminPdf')|escape:'html':'UTF-8'}&submitAction=generateInvoicePDF&id_ventarapida='+ res.id_factura +'&documento=ticket';
                        $('#imprimir_ticket').attr('href', url.replace('&amp;', '&'));
                        $('#imprimir_ticket').show();
                    }else{
                        window.location.reload();
                    }
                    $('#btnProcesar').hide();
                    $('.eliminar_linea').hide();

                    $('.adminfacturaventas').waitMe('hide');
                }
            }
        })
    }

    $('.eliminar_linea').die().live('click', function(e)
    {
        e.preventDefault();
        id = $(this).parent().parent().attr('id');
        if (id){
            if (confirm("{/literal}{l s='Seguro de eliminar?' js=1}{literal}"))
                doAdminAjax({
                    "action":"deleteDetalle",
                    "id_factura_ventas_det":id,
                    "token" : "{/literal}{$token|escape:'html':'UTF-8'}{literal}",
                    "tab" : "AdminFacturaVentas",
                    "ajax" : 1 }, afterDelete
                );
        }else{
            var trs=$("#detalle tr.count_trs").length;

            if(trs>1)
            {
                $(this).parent().parent().remove();
            }
            else{

                $("#detalle tbody tr.tr_1").find("td:eq(0)").find("input").val('');
                $("#detalle tbody tr.tr_1").find("td:eq(1)").find("select").val(0).trigger("chosen:updated");
                $("#detalle tbody tr.tr_1").find("td:eq(2)").val('');
                $("#detalle tbody tr.tr_1").find("td:eq(3)").find("input").val(1);
                $("#detalle tbody tr.tr_1").find("td:eq(4)").find("input").val(0);
                $("#detalle tbody tr.tr_1").find("td:eq(5)").find("input").val(0);
                $("#detalle tbody tr.tr_1").find("td:eq(7)").find("input").val(0);
                $('#sub_total').val(0);
                $('#monto_impuesto').val(0);
                $('#costo_total').val(0);

                $.growl.error({ message: "Usted no puede eliminar la primera fila!!" });
            }

        }
    });


        function addRow() {
            var i = $('#detalle tr.count_trs').length;
            if (i>0){
                i++;
                FilasSeccion(i);
            }

        }

        function FilasSeccion(i, id_factura_ventas_det = '') {
//        var i = 1;
//        var row;
// alert(id_producto);
            row = ' <tr class="count_trs tr_'+i+'" id="'+id_factura_ventas_det+'">\n' +
                '                                       <td style="width:0px;">\n' +
                '                                           <input name="txt_id_factura_ventas_det_'+i+'" id="txt_id_factura_ventas_det_'+i+'" value="" style="display:none;"/>\n' +
                '                                       </td>\n' +
                '                                       <td>\n' +
                '                                          <div class="col-xs-10">\n' +
                '<select name="cb_productos_'+i+'" id="cb_productos_'+i+'" class="form-control chosen" onchange="change_product('+i+');">\n' +
                '                                                  <option value="0" data-descripcioncorta="" data-priceunit="0.00" data-priceunit_tax="0.00">- Seleccionar -</option>\n' +
            '                                                  </select>\n'+
            '                                              </div>\n'+
            '                                       </td>\n'+
            '                                       <td>\n'+
            '                                          <textarea name="txtDescripcion_'+i+'" id="txtDescripcion_'+i+'" cols="20" rows="2"></textarea>\n'+
            '                                          </td>\n'+
            '                                       <td>\n'+
            '                                          <input type="number" name="txtCantidad_'+i+'" id="txtCantidad_'+i+'"  class="form-control cantidad" value="1" onchange="change_para_importe('+i+');">\n'+
            '                                          </td>\n'+
            '                                       <td>\n'+
            '                                          <input type="number" name="txtPrecioUnitario_tax_'+i+'" id="txtPrecioUnitario_tax_'+i+'"  class="form-control unitario_tax" value="0" onchange="change_para_importe('+i+');"  >\n'+
            '                                        </td>\n'+
            '                                       <td>\n'+
            '                                          <input type="number" name="txtImporte_'+i+'" id="txtImporte_'+i+'" class="form-control importe" value="0">\n'+
            '                                       </td>\n'+
            '                                       <td>\n'+
            '                                            <button type="button" value="Borrar" id="btnBorrarSeccion_'+i+'" name="btnBorrarSeccion_'+i+'" class="btn btn-default pull-left eliminar_linea">\n'+
            '                                                <i class="icon-trash"></i>\n'+
            '                                                </button>\n'+
            '                                            </td>\n'+
            '                                       <td>\n'+
            '                                          <input type="number" name="txtPrecioUnitario_'+i+'" id="txtPrecioUnitario_'+i+'"  class="form-control unitario" value="0" onchange="change_para_importe('+i+');" style="display:none;">\n'+
            '                                          </td>\n'+
            '                                    </tr>';

            $("#trAgregar").closest("tr").before(row);
//            $('#dataTable').append(row);
//             $('#cb_productos_' + i + '').val(id_producto).trigger('change');

            resetBind3(i);
            $('.chosen').chosen({ width: '250px' });
            $("#detalle tr").find('select').chosen();


        }

        function change_product(num, id_producto_comb = 0) {
            // alert(num);
            var descripcion_corta_pro = $('#cb_productos_' + num + ' option:selected').data("descripcioncorta");
            var precio_pro = $('#cb_productos_' + num + ' option:selected').data("priceunit");
            var precio_pro_tax = $('#cb_productos_' + num + ' option:selected').data("priceunit_tax");
//			alert(descripcion_corta_pro);
//			alert(precio_pro);
//             bar = jQuery('<p>').html(descripcion_corta_pro).text();
            $('#txtDescripcion_' + num + '').text();
            $('#txtPrecioUnitario_' + num + '').val(parseFloat(precio_pro)).trigger('change');
            $('#txtPrecioUnitario_tax_' + num + '').val(parseFloat(precio_pro_tax).toFixed(2)).trigger('change');

            change_para_importe(num);

        }

        function change_para_importe(num) {
            var cantidad = $('#txtCantidad_' + num + '').val();
            var precio_pro = $('#txtPrecioUnitario_tax_' + num + '').val();
            var subtotal = parseFloat(parseFloat(cantidad) * parseFloat(precio_pro));
            var precio_pro = $('#txtImporte_' + num + '').val(parseFloat(subtotal).toFixed(2));

            var total = 0;
            var precios_unitarios = 0;
            $('.importe').each(function () {
                total += parseFloat($(this).val());
            });

            $('.unitario').each(function () {
                precios_unitarios += parseFloat($(this).val());
            });

            $('#sub_total').val(parseFloat(precios_unitarios).toFixed(2));
            $('#monto_impuesto').val(parseFloat(total - precios_unitarios).toFixed(2));
            $('#costo_total').val(parseFloat(total).toFixed(2));



            // calcularMontos();
        }



        function imprimir_ticket()
        {

            $.ajax({
                type:"POST",
                url: "{$link->getAdminLink('AdminFacturaVentas')|addslashes}",
                async: true,
                dataType: "json",
                data : {
                    ajax: "1",
                    token: "{getAdminToken tab='AdminFacturaVentas'}",
                    tab: "AdminFacturaVentas",
                    action: "imprimirTicket",
                    id_venta: $('#txtidFacturaVentas').val(),
                },
                success : function (res) {
                    if (res === 1){
                        showSuccessMessage('Imprimiendo...');
                        setTimeout(function () {
                            window.location.reload();
                        }, 1000)
                    }else{
                        jAlert(res.msg);
                        // showSuccessMessage('Mesa Disponible');
                    }
                },
            });


//        resetBind();
        }

</script>
