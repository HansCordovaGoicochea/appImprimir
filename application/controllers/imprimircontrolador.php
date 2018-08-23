<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require __DIR__ . '/../../vendor/ticket/autoload.php'; //Nota: si renombraste la carpeta a algo diferente de "ticket" cambia el nombre en esta línea
use Mike42\Escpos\Printer;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;

class imprimircontrolador extends CI_Controller {


    /**
     * imprimirControlador constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
        $this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");

        $this->load->helper('url');
        $this->load->library('session');
    }

    public function index()
    {
        $this->load->view('layout/header');
        $this->load->view('layout/menu');
        $this->load->view('inicio');
        $this->load->view('layout/footer');
    }

    public function imprimir() {
        if ($this->input->is_ajax_request()) {
            $impresora = $this->input->post('impresora');
            $emisor = $this->input->post('emisor');
            $ruc_emisor = $this->input->post('ruc_emisor');
            $recibo = $this->input->post('recibo');
            $cliente = $this->input->post('cliente');
            $documento = $this->input->post('documento');
            $fecha = $this->input->post('fecha');
            $obs = $this->input->post('obs');
            $ref = $this->input->post('ref');
            $direccion = $this->input->post('direccion');
            $subtotal = $this->input->post('subtotal');
            $impuesto = $this->input->post('impuesto');
            $total = $this->input->post('total');

            /*
             Aquí, el nombre de mi impresora. Recuerda que debes compartirla
             desde el panel de control
         */

            $nombre_impresora = $impresora;
//        $nombre_impresora = "BIXOLON SRP-350";

            try {
                $connector = new WindowsPrintConnector($nombre_impresora);
                $printer = new Printer($connector);

                #Mando un numero de respuesta para saber que se conecto correctamente.

                $printer -> feedReverse(2);
                $printer->setJustification(Printer::JUSTIFY_LEFT);
                $printer -> setEmphasis(true);
                $printer -> text(new item('Recibo N° '.$recibo.''));

                # Vamos a alinear al centro lo próximo que imprimamos
                $printer->setJustification(Printer::JUSTIFY_CENTER);

                /*
                    Ahora vamos a imprimir un encabezado
                */

                $printer->text("".$emisor."" . "\n");
//                $printer->text("".strtoupper($cajasaldo2[0]['direccion_caja'])." Tel: ". $cajasaldo2[0]['telefono_caja'] . "\n");
//        $printer->text("".strtoupper($cajasaldo2[0]['ciudad_caja'])." ".strtoupper($cajasaldo2[0]['provincia_caja'])." ".strtoupper($cajasaldo2[0]['distrito_caja'])."" . "\n");
                $printer->text("RUC:". $ruc_emisor ."" . "\n");
                $printer->text(wordwrap('', 32));
                $printer -> feed();
                $printer -> setJustification(Printer::JUSTIFY_LEFT);
                $printer->text("NOMBRE: ". $cliente . "\n");
                $printer->text("DIRECC: ". $direccion . "\n");
                $printer->text("N°Doc.: ". $documento . "\n");
                $printer->text("OBS: ". $obs . "\n");
                $printer->text("REF: ". $ref . "\n");
                #La fecha también
                date_default_timezone_set("America/Lima");
                $printer->text("Fecha: " . $fecha . "\n");
                $printer -> feed();



                $printer->setJustification(Printer::JUSTIFY_CENTER);
                /*
                    Ahora vamos a imprimir los
                    productos
                */
                $productos = array();
                $productos[] = new Producto( 'CANT','PROD.',   'SUBTO');

                $objDetalle = json_decode(($this->input->post('jsonDetalle')));
                $arrayobjetos = $objDetalle->valor;
                foreach ($arrayobjetos as $clave => $valor) {
                    $productos[] = new Producto( $valor->cantidad, $valor->descripcion, $valor->importe);
                }


//                $subtotal = new item('Subtotal', '12.95');
//                $tax = new item('A local tax', '1.30');


                //d($productos);

                /* Items */
                $printer -> setJustification(Printer::JUSTIFY_LEFT);
                $printer -> setEmphasis(false);

                $printer->text("----------------------------------------");
                foreach ($productos as $p) {
                    $printer -> text($p);
                }
                $printer->text("----------------------------------------");
                $printer -> setJustification(Printer::JUSTIFY_RIGHT);
                $printer -> setEmphasis(true);
                $printer->text("              SUBTOTAL  : " . $subtotal . " \n");
                $printer->text("                   IGV  : " . $impuesto . " \n");
                $printer->text("                 TOTAL  : " . $total . " \n");
                $printer->text("----------------------------------------");
                $printer->text("". date("Y-m-d H:i:s") . "\n");
                $printer -> feed();

                /*
                    Cortamos el papel. Si nuestra impresora
                    no tiene soporte para ello, no generará
                    ningún error
                */
                $printer->cut();

                /*
                    Por medio de la impresora mandamos un pulso.
                    Esto es útil cuando la tenemos conectada
                    por ejemplo a un cajón
                */
                $printer->pulse();

                /*
                    Para imprimir realmente, tenemos que "cerrar"
                    la conexión con la impresora. Recuerda incluir esto al final de todos los archivos
                */
                $printer->close();
                echo json_encode(1);
            } catch (Exception $e) {
                die(json_encode(array('errors' => true, 'msg' => "No se pudo imprimir en esta impresora: " . $e->getMessage() . "\n")));
            }
        } else {
            redirect('error404');
        }
    }
    public function imprimirAbrir() {


            $data = array(

            );

            $html = $this->load->view('ticket', $data, true);
            $this->load->library('pdf');
            $pdf = $this->pdf->load();

            $pdf->SetProtection(array('copy','print'), '', 'cesar',128);

            $pdf->AddPage('P',// L - landscape, P - portrait
                '', '', '', '',
                '', // margin_left
                '',// margin right
                '',// margin top
                '',// margin bottom
                '',// margin header
                0);// margin footer

            $pdf->WriteHTML($html);
            //this the the PDF filename that user will get to download
            $pdfFilePath = "TICKET.pdf";
            //download it.
//            $pdf->Output($pdfFilePath, "D");
            $pdf->Output($pdfFilePath,'I');

            echo json_encode(array('estado' => true, 'archivo' =>$pdfFilePath));
    }
}


/* A wrapper to do organise item names & prices into columns */
class item
{
    private $name;
    private $price;
    private $dollarSign;

    public function __construct($name = '', $price = '', $dollarSign = false)
    {
        $this -> name = $name;
        $this -> price = $price;
        $this -> dollarSign = $dollarSign;
    }

    public function __toString()
    {
        $rightCols = 10;
        $leftCols = 38;
        if ($this -> dollarSign) {
            $leftCols = $leftCols / 2 - $rightCols / 2;
        }
        $left = str_pad($this -> name, $leftCols) ;

        $sign = ($this -> dollarSign ? 'S/ ' : '');
        $right = str_pad($sign . $this -> price, $rightCols, ' ', STR_PAD_LEFT);
        return "$left$right\n";
    }
}

/*
	Una pequeña clase para
	trabajar mejor con
	los productos
	Nota: esta clase no es requerida, puedes
	imprimir usando puro texto de la forma
	que tú quieras
*/
class Producto{

    public function __construct($cantidad, $nombre, $importe){
        $this->cantidad = $cantidad;
        $this->nombre = $nombre;
        $this->importe = $importe;
    }
    public function __toString()
    {
        $rightCols = 10;
        $leftCols = 25;
//        if ($this -> dollarSign) {
//            $leftCols = $leftCols / 2 - $rightCols / 2;
//        }
        $left = str_pad($this -> cantidad, 5) ;
        $leftce = str_pad($this -> nombre, $leftCols) ;
        $right = str_pad($this -> importe, $rightCols, ' ', STR_PAD_LEFT);
        return "$left$leftce$right\n";
    }
}

