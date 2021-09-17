<?php
class M_listuser extends CI_Model
{
    function show_item_unlimited()
    {
        $this->db->select('*');
        $query = $this->db->get('tbuser');
        $data = $query->result_object();
        $query->free_result();
        return $data;
    }

    function update()
    {
        $kduser = $this->input->post('kode');
        $nmuser = $this->input->post('ket');
        $nmdept = $this->input->post('dept');
        $stsappr = $this->input->post('stsappr');
        $password = $this->input->post('password');
        $this->db->where('kduser', $kduser);
        $this->db->set('nmuser', $nmuser);
        $this->db->set('nmdept', $nmdept);
        $this->db->set('stsappr', $stsappr);
        $this->db->set('password', password_hash($password, PASSWORD_DEFAULT));
        if ($this->db->update('tbuser')) {
            return 0;
        } else {
            return $this->db->error()['code'];
        }
    }

    function delete()
    {
        $kduser = $this->input->post('kode');
        $this->db->where('kduser', $kduser);
        if ($this->db->delete('tbuser')) {
            return 0;
        } else {
            return $this->db->error()['code'];
        }
    }
}
