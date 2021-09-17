<?php
    class m_item extends CI_Model
    {

        function show_item()
        {
            $this->db->select('*');
            $this->db->limit(3);
            $query = $this->db->get('tbitm');
            $data = $query->result_object();
            $query->free_result();
            return $data;
        }

        function show_item_unlimited()
        {
            $this->db->select('*');
            $query = $this->db->get('tbitm');
            $data = $query->result_object();
            $query->free_result();
            return $data;
        }

        function filter_item(){
            $kditem = $this->input->get('kode');
            $nmitem = $this->input->get('ket');

            $this->db->select('*');
            if($kditem != ""){
                $this->db->like('kditem',$kditem,'both');
            }
            if($nmitem != ""){
                $this->db->like('nmitem',$nmitem,'both');
            }
            $query = $this->db->get('tbitm');
            $data = $query->result_object();
            $query->free_result();
            return $data;
        }

        function show_item_iom()
        {
            $kditem = $this->input->get('kode_item');
            $nmitem = $this->input->get('keterangan');
            $this->db->select('*');
            if($kditem != ''){
                $this->db->like('kditem', $kditem, 'both');
            }
            if($nmitem != ''){
                $this->db->like('nmitem', $nmitem, 'both');
            }
            $item = explode(",",trim($this->input->get('item')));
            $this->db->where_not_in('kditem', $item);
            $this->db->limit(3);
            $query = $this->db->get('tbitm');
            $data = $query->result_object();
            $query->free_result();
            return $data;
        }

        function show_item_iom_show()
        {
            $kditem = explode(",",trim($this->input->get('kode_item')));
            $this->db->where_in('kditem', $kditem);
            $query = $this->db->get('tbitm');
            $data = $query->result_object();
            $query->free_result();
            return $data;
        }

        function insert()
        {
            $kditem = $this->input->post('kode');
            $nmitem = $this->input->post('ket');
            $data = array(
                'kditem' => $kditem,
                'nmitem' => $nmitem
            );
            if($this->db->insert('tbitm', $data)){
                return 0;
            }
            else{
                return $this->db->error()['code'];
            }
            
        }

        function update(){
            $kditem = $this->input->post('kode');
            $nmitem = $this->input->post('ket');
            $this->db->where('kditem', $kditem);
            $this->db->set('nmitem',$nmitem);
            if($this->db->update('tbitm')){
                return 0;
            }
            else{
                return $this->db->error()['code'];
            }
        }

        function delete(){
            $kditem = $this->input->post('kode');
            $this->db->where('kditem', $kditem);
            if($this->db->delete('tbitm')){
                return 0;
            }
            else{
                return $this->db->error()['code'];
            }
        }
    }
?>