<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Iom extends CI_Controller
{

    function __construct()
    {

        parent::__construct();

        $this->load->model('m_listiom');
        $this->load->model('m_item');
        $this->load->model('m_iom');
    }
    public function index()
    {
        $data['data'] = $this->m_listiom->show_listiom();
        $data['title'] = 'IMO | Daftar Memo';
        $this->load->view('components/header', $data);
        $this->load->view('listiom', $data);
    }

    public function approve(){
        $data['data'] = $this->m_listiom->show_listiom();
        $data['title'] = 'IMO | Daftar Memo';
        $this->load->view('components/header', $data);
        $this->load->view('listiom', $data);
    }

    public function view(){
        $data['title'] = 'IMO | ' . $this->input->get('no');
        $this->load->view('components/header', $data);
        $this->load->view('components/menubar', $data);
        $data['data'] = $this->m_iom->show_iom();
        $data['details'] = $this->m_iom->show_iom_details();
        $this->load->view('viewiom', $data);
        $this->load->view('components/footer', $data);
    }

    public function filter()
    {
        $data['data'] = $this->m_listiom->filter_listiom();
        $data['title'] = 'IMO | Daftar Memo';
        $this->load->view('components/header', $data);
        $this->load->view('listiom', $data);
    }

    public function newiom()
    {
        $data['title'] = 'IMO | New Memo';
        $this->load->view('components/header', $data);
        $this->load->view('components/menubar', $data);
        $this->load->view('newiom', $data);
        $this->load->view('components/footer', $data);
    }

    public function ajax_item(){
        $data['data'] = $this->m_item->show_item_iom();
        $this->load->view('components/ajax/newiomitem', $data);
    }

    public function ajax_item_show(){
        $data['data'] = $this->m_item->show_item_iom_show();
        $this->load->view('components/ajax/iomitemlist', $data);
    }

    public function item_insert(){
        $this->m_iom->insert();
        $data['title'] = 'IMO | New Memo';
        $this->load->view('components/header', $data);
        $this->load->view('components/menubar', $data);
        $this->load->view('newiom', $data);
        $this->load->view('components/footer', $data);
    }

    public function approve_item(){
        $this->m_iom->approve();
    }

    public function disapprove_item(){
        $this->m_iom->disapprove();
    }

    public function update(){
        $this->m_iom->update();
    }

    public function delete(){
        $this->m_iom->delete();
    }

    public function delete_item(){
        $this->m_iom->delete_item();
    }
    
    public function add_item(){
        $this->m_iom->insert_item();
    }
}
