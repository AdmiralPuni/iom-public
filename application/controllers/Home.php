<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{

    public function index()
    {
        $data['title'] = 'Dashboard';
        $data['user'] = $this->db->get_where('tbuser', ['nmuser' =>
        $this->session->userdata('nmuser')])->row_array();
        $data['title'] = 'IMO | Home';
        $this->load->view('components/header', $data);
        $this->load->view('menu');
    }
}
