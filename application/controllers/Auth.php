<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }

    public function index()
    {
        $this->form_validation->set_rules('nmuser', 'Username', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'IMO | Login Page';
            $this->load->view('components/header', $data);
            $this->load->view('auth');
        } else {
            $this->_login();
        }
    }


    private function _login()
    {
        $nmuser = $this->input->post('nmuser');
        $password = $this->input->post('password');

        $user = $this->db->get_where('tbuser', ['nmuser' => $nmuser])->row_array();

        // Jika usernya ada
        if ($user) {
            // cek password
            if (password_verify($password, $user['password'])) {
                $data = [
                    'kduser' => $user['kduser'],
                    'nmuser' => $user['nmuser'],
                    'stsappr' => $user['stsappr'],
                    'nmdept' => $user['nmdept'],
                    'error_code' => ''
                ];
                $this->session->set_userdata($data);
                redirect('home');
            } else {
                $data = [
                    'error_code' => '001'
                ];
                $this->session->set_userdata($data);
                redirect('auth',$data);
            }
        } else {
            $data = [
                'error_code' => '001'
            ];
            $this->session->set_userdata($data);
            redirect('auth',$data);
        }
    }

    public function registration()
    {
        $this->form_validation->set_rules('nmuser', 'Name', 'required|trim');
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[5]|matches[password2]', [
            'matches' => 'Password dont match!',
            'min_length' => 'Password too short!'
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');


        if ($this->form_validation->run() == false) {
            $data = [
                'error_code' => '001'
            ];
            $this->session->set_userdata($data);
            redirect('user', $data);
        } else {
            $data = [
                'kduser' => htmlspecialchars($this->input->post('kduser', true)),
                'nmuser' => htmlspecialchars($this->input->post('nmuser', true)),
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'nmdept' => ($this->input->post('nmdept', true)),
                'stsappr' => htmlspecialchars($this->input->post('stsappr', true))
            ];
            $this->db->insert('tbuser', $data);
            $data = [
                'error_code' => '002'
            ];
            $this->session->set_userdata($data);
            redirect('user', $data);
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('nmuser');
        $this->session->unset_userdata('stsappr');

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        You have been logged out!
        </div>');
        redirect('auth');
    }
}
