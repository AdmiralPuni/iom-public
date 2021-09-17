<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Userlist extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('m_user');
        $this->load->model('m_listuser');
    }

    public function index()
    {
        $data['data'] = $this->m_user->show_user();
        $data['title'] = 'IMO | List User';
        $this->load->view('components/header', $data);
        $this->load->view('userlist', $data);
    }

    public function search()
    {
        $data['data'] = $this->m_user->filter();
        $data['title'] = 'IMO | List User';
        $this->load->view('components/header', $data);
        $this->load->view('userlist', $data);
    }

    public function update()
    {
        $data['status'] = $this->m_listuser->update();
        $data['data'] = $this->m_listuser->show_item_unlimited();
        $data['title'] = 'IMO | List User';
        $this->load->view('components/header', $data);
        $this->load->view('userlist', $data);
    }

    public function delete()
    {
        $data['status'] = $this->m_listuser->delete();
        $data['data'] = $this->m_listuser->show_item_unlimited();
        $data['title'] = 'IMO | List User';
        $this->load->view('components/header', $data);
        $this->load->view('userlist', $data);
    }
}
