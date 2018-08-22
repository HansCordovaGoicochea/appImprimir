<section class="content">

    <div class="panel">
            <div class="panel-body">
                <form enctype="multipart/form-data"
                      action="" name="frm" id="frm"
                      method="post">
                    <!--datos de la factura-->
                    <div class="row">
                        <div class="col-lg-12 col-xs-12 datos_1">
                            <div class="col-lg-6 col-xs-12">
                                <div class="form-group">
                                    <label>CLIENTE</label>
                                    <input type="text" class="form-control" name="txtCliente" id="txtCliente" placeholder="Ingrese el cliente ...">
                                </div>
                                <div class="form-group">
                                    <div class="col-lg-5 col-xs-12">
                                        <label>NRO. DOCUMENTO</label>
                                        <input type="number" class="form-control " name="txtDocumento" id="txtDocumento" placeholder="Ingrese el número de documento ...">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Fecha:</label>
                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" class="form-control pull-right" id="datepicker">
                                    </div>
                                    <!-- /.input group -->
                                </div>
                            </div>
                            <div class="col-lg-6 col-xs-12">
                                <div class="form-group">
                                    <label>DIRECCIÓN</label>
                                    <input type="text" class="form-control" name="txtDireccion" id="txtDireccion" placeholder="Ingrese la dirección ...">
                                </div>
                                <div class="form-group">
                                    <label>OBS</label>
                                    <input type="text" class="form-control" name="txtObs" id="txtObs" placeholder="Ingrese la obs ...">
                                </div>
                            </div>
                        </div>

                    </div>
                    <!--inicio del detalle-->
                    <div class="row">
                        <div class="box-body table-responsive no-padding">
                            <table class="table table-hover table-bordered" width="100%">
                                <thead>
                                <tr>
                                    <th width="3%">#</th>
                                    <th width="15%">
                                        Cantidad
                                    </th>
                                    <th width="55%">
                                        Descripción
                                    </th>
                                    <th width="20%">
                                        Importe
                                    </th>
                                    <th width="5%">
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr class="count_trs tr_1" id="">
                                    <td>1</td>
                                    <td>
                                        <input type="number" name="txtCantidad_1" id="txtCantidad_1"  class="form-control cantidad" value="1" onchange="change_para_importe(1);">
                                    </td>
                                    <td>
                                        <textarea name="txtDescripcion_1" id="txtDescripcion_1" cols="80" rows="3"></textarea>
                                    </td>
                                    <td>
                                        <input type="number" name="txtImporte_1" id="txtImporte_1" class="form-control importe" value="0">
                                    </td>
                                    <td>
                                        <button type="button" value="Borrar" id="btnBorrarSeccion_1" name="btnBorrarSeccion_1" class="btn btn-default pull-left eliminar_linea">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr class="tr" id="trAgregar">
                                    <td colspan="7"><a id='button_agregar' onclick="addRow();" class="pointer"
                                                       style="color: #00aff0; cursor: pointer;">Agregar nuevo Item</a></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>

                        <!--fin del detalle-->
                        <!--seccion totales pagos-->

                        <div class="col-lg-offset-9" style="margin-right: 30px">
                            <div class="row" style="margin-bottom: 10px;">
                                <div class="form-group">
                                    <label for="sub_total" class="control-label col-lg-5 col-xs-12"><strong>SubTotal:</strong></label>
                                    <div class="col-xs-7 text-right">
                                        <div class="input-group" style="margin-bottom: 5px">
                                                    <span id="simboloSubTotal"
                                                          class="input-group-addon"><strong>S/ </strong></span>
                                            <input type="text" id="sub_total" class="form-control col-lg-12"
                                                   name="sub_total" value=""/>
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
                                                   id="monto_impuesto" value="">
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
                                            <input type="text" name="costo_total" class="form-control" id="costo_total" value="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </form>
                <div class="panel-footer">
                    <button type="button" class="btn btn-default pull-right" id="imprimir_ticket" onclick="imprimir_ticket();" style="    margin-top: 20px;">
                        <i class="fa fa-print" style="display: block; margin: 0 auto; font-size: 28px; background: transparent; background-size: 26px; background-position: center;"></i>Imprimir Ticket
                    </button>
                </div>
        </div>
    </div>

</section>
