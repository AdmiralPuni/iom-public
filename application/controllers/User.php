<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{

    public function index()
    {
        $data['title'] = 'User Profile';
        $data['user'] = $this->db->get_where('tbuser', ['nmuser' =>
        $this->session->userdata('nmuser')])->row_array();

        $this->load->view('components/header', $data);
        $this->load->view('components/menubar', $data);
        $this->load->view('user', $data);
        $this->load->view('components/footer', $data);
    }
}
