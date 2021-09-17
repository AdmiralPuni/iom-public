<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Item extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('m_item');
    }

    public function index()
    {
        $data['status'] = "";
        $data['data'] = $this->m_item->show_item_unlimited();
        $data['title'] = 'IMO | User';
        $this->load->view('components/header', $data);
        $this->load->view('item', $data);
    }

    public function search(){
        $data['data'] = $this->m_item->filter_item();
        $data['title'] = 'IMO | User';
        $this->load->view('components/header', $data);
        $this->load->view('item', $data);
    }

    public function insert(){
        $data['status'] = $this->m_item->insert();
        $data['data'] = $this->m_item->show_item_unlimited();
        $data['title'] = 'IMO | User';
        $this->load->view('components/header', $data);
        $this->load->view('item', $data);
    }

    public function update(){
        $data['status'] = $this->m_item->update();
        $data['data'] = $this->m_item->show_item_unlimited();
        $data['title'] = 'IMO | User';
        $this->load->view('components/header', $data);
        $this->load->view('item', $data);
    }

    public function delete(){
        $data['status'] = $this->m_item->delete();
        $data['data'] = $this->m_item->show_item_unlimited();
        $data['title'] = 'IMO | User';
        $this->load->view('components/header', $data);
        $this->load->view('item', $data);
    }
}
