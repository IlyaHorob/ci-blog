<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    
        $this->session->set_userdata('current_page', 'main');
    }

    public function index()
    {
        $this->load->view('index');
    }
}
