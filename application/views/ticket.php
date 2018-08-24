<!DOCTYPE html>
<html>
<head>
    <title>Print Invoice</title>
<STYLE>
    *
    {
        margin:0;
        padding:0;
        font-family:Arial;
        font-size:10pt;
        color:#000;
    }
</STYLE>
</head>
<body>
<div id="wrapper">
    <br>
    <br>
    <table class="heading" style="width:100%;">
        <tr>
            <td style="width:80mm; text-align: center;">
                <h3 class="heading">Municipalidad distrital de cajamarca <br>Ruc: 12345678901</h3>
            </td>
            <td rowspan="2" valign="top" align="right" style="">
                <table>
                    <tr><td><h3>Recibo No : </h3></td><td><h3>651561</h3></td></tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>
                <b>Buyer</b> :Client Name<br />
                <b>Buyer</b> :Client Name<br />
                <b>Buyer</b> :Client Name<br />
                <b>Buyer</b> :Client Name<br />
                <b>Buyer</b> :Client Name<br />
                <b>Buyer</b> :Client Name<br />
                <b>Buyer</b> :Client Name<br />
                <b>Buyer</b> :Client Name<br /><br>
            </td>
        </tr>
    </table>
    <div id="content">
        <div id="invoice_body">
            <table>
                <tr >
                    <td style="width:13%; border-top: 1px solid black; border-bottom: 1px dashed black;"><b>CANT.</b></td>
                    <td style="border-top: 1px solid black;border-bottom: 1px dashed black;"><b>DESCRIPCION</b></td>
                    <td style="width:18%; border-top: 1px solid black;border-bottom: 1px dashed black;"><b>IMPORTE</b></td>
                </tr>
            </table>

            <table>
                <tr>
                    <td style="width:13%;">1</td>
                    <td style="text-align:left; padding-left:10px;">Software Development<br />Description : Upgradation of telecrm</td>
                    <td style="width:18%;" class="mono">157.00</td>
                </tr>
                <tr>
                    <td colspan="3" style="border-top: 1px solid black;"></td>
                    <td style="border-top: 1px solid black;"></td>
                    <td style="border-top: 1px solid black;"></td>
                </tr>
                <tr>
                    <td colspan="3"></td>
                    <td>SUBTOTAL:</td>
                    <td class="mono">157.00</td>
                </tr>
                <tr>
                    <td colspan="3"></td>
                    <td>IGV:</td>
                    <td class="mono">157.00</td>
                </tr>
                <tr>
                    <td colspan="3" style="border-bottom: 1px solid black;"></td>
                    <td style="border-bottom: 1px solid black;">Total:</td>
                    <td class="mono" style="border-bottom: 1px solid black;">157.00</td>
                </tr>
            </table>
        </div>
    </div>
    <br/>
</div>
</body>
</html>