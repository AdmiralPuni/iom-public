<?php
class m_user extends CI_Model
{

    function show_user()
    {
        $this->db->select('kduser,nmuser,nmdept,stsappr,password');
        $query = $this->db->get('tbuser');
        $data = $query->result_object();
        $query->free_result();
        return $data;
    }

    function filter()
    {
        $kduser = $this->input->get('kduser');
        $nmuser = $this->input->get('nmuser');
        $nmdept = $this->input->get('nmdept');
        $stsappr = $this->input->get('stsappr');
        $password = $this->input->get('password');

        $this->db->select('*');
        if ($kduser != "") {
            $this->db->like('kduser', $kduser, 'both');
        }
        if ($nmuser != "") {
            $this->db->like('nmuser', $nmuser, 'both');
        }
        if ($nmdept != "") {
            $this->db->like('nmdept', $nmdept, 'both');
        }
        if ($stsappr != "") {
            $this->db->like('stsappr', $stsappr, 'both');
        }
        if ($password != "") {
            $this->db->like('stsappr', $password, 'both');
        }
        $query = $this->db->get('tbuser');
        $data = $query->result_object();
        $query->free_result();
        return $data;
    }
}
