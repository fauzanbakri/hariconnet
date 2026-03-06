<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PemakaianMaterial extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        // Simple stub view for Pemakaian Material
        $this->load->view('pemakaian_material');
    }
}
