<?php
    class M_listiom extends CI_Model
    {

        function show_listiom()
        {
            $this->db->select('*');
            $this->db->select('sum(stsiom) as stsiomall');
            $this->db->select('count(stsiom) as stsiomcount');
            if($_SESSION['nmdept']!='admin'){
                $this->db->where('nmdept',$_SESSION['nmdept']);
            }
            $this->db->group_by('noiom');
            $this->db->order_by('noiomint', 'asc');
            $query = $this->db->get('v_iomlist');
            $data = $query->result_object();
            $query->free_result();
            return $data;
        }

        function filter_listiom()
        {
            $month = $this->input->get('month');
            $year = $this->input->get('year');
            

            $this->db->select('*');
            $this->db->select('sum(stsiom) as stsiomall');
            $this->db->select('count(stsiom) as stsiomcount');
            if($_SESSION['nmdept']!='admin'){
                $this->db->where('nmdept',$_SESSION['nmdept']);
            }
            if($month != 0){
                $this->db->where('month(tgliom)',$month);
            }
            if($year != 0){
                $this->db->where('year(tgliom)',$year);
            }
            $this->db->group_by('noiom');
            $this->db->order_by('noiomint', 'asc');
            $query = $this->db->get('v_iomlist');
            $data = $query->result_object();
            $query->free_result();
            return $data;
        }
    }
?>