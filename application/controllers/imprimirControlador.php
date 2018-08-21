<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class imprimirControlador extends CI_Controller {


    /**
     * imprimirControlador constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->load->view('layout/header');
        $this->load->view('layout/menu');
        $this->load->view('inicio');
        $this->load->view('layout/footer');
    }
}
