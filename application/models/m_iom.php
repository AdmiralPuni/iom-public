<?php
    class m_iom extends CI_Model
    {

        function insert()
        {
            $item = $this->input->get('item');
            $ket = $this->input->get('ket');
            $data = array(
                'tgliom' => date("Y-m-d"),
                'kduser' => $_SESSION['kduser'],
                'ket' => $ket
            );
            $this->db->insert('tbiom', $data);

            $item_explode = explode(",",rtrim($item,", "));
            foreach($item_explode as $insert){
                $data = array(
                    'kditem' => $insert,
                    'stsiom' => 0,
                    'tglselesai' => NULL
                );
                $this->db->set('noiom','(select max_noiom from v_maxnoiom)',FALSE);
                $this->db->insert('tbiomdet', $data);
            }
            $query = $this->db->get('v_maxnoiom');
            $result = $query->result();
            $noiom = $result[0]->max_noiom;
            redirect('iom/view?no=' . urlencode($noiom), 'refresh');
        }

        function approve(){
            $noiom = $this->input->post('noiom');
            $kditem = $this->input->post('kditem');
            $stsappr;
            if($_SESSION['nmuser'] == 'admin'){
                $stsappr = $this->input->post('approval');
            }
            else{
                $stsappr = $_SESSION['stsappr'];
            }
            $this->db->set('stsiom', 'stsiom+' . $stsappr,FALSE);
            $this->db->where('noiom', $noiom);
            $this->db->where('kditem', $kditem);
            $this->db->update('tbiomdet');
            redirect('iom/view?no=' . urlencode($noiom), 'refresh');
        }

        function disapprove(){
            $noiom = $this->input->post('noiom');
            $kditem = $this->input->post('kditem');
            if($_SESSION['nmuser'] == 'admin'){
                $stsappr = $this->input->post('approval');
            }
            else{
                $stsappr = $_SESSION['stsappr'];
            }
            $this->db->set('stsiom', 'stsiom-' . $stsappr ,FALSE);
            $this->db->where('noiom', $noiom);
            $this->db->where('kditem', $kditem);
            $this->db->update('tbiomdet');
            redirect('iom/view?no=' . urlencode($noiom), 'refresh');
        }

        function show_iom()
        {
            $no = $this->input->get(urldecode('no'));
            $this->db->select('*');
            if($_SESSION['nmdept']!='admin'){
                $this->db->where('nmdept',$_SESSION['nmdept']);
            }
            $this->db->where('noiom', $no);
            $this->db->order_by('tgliom', 'asc');
            $query = $this->db->get('v_iomlist');
            $data = $query->result_object();
            $query->free_result();
            return $data;
        }

        function show_iom_details()
        {
            $no = $this->input->get(urldecode('no'));
            $this->db->where('noiom', $no);
            $query = $this->db->get('v_iomdet');
            $data = $query->result_object();
            $query->free_result();
            return $data;
        }

        function update(){
            $noiom = $this->input->post('noiom');
            $kduser = $this->input->post('kduser');
            $ket = $this->input->post('ket');
            $this->db->where('noiom', $noiom);
            if($kduser != ''){
                $this->db->set('kduser',$kduser);
            }
            if($ket != ''){
                $this->db->set('ket',$ket);
            }
            $this->db->update('tbiom');
            redirect('iom/view?no=' . urlencode($noiom), 'refresh');
        }

        function delete(){
            $noiom = $this->input->post('noiom');
            $this->db->where('noiom', $noiom);
            $this->db->delete('tbiom');
            redirect('iom', 'refresh');
        }

        function delete_item(){
            $noiom = $this->input->post('noiom');
            $kditem = $this->input->post('kditem');
            $this->db->where('noiom', $noiom);
            $this->db->where('kditem', $kditem);
            $this->db->delete('tbiomdet');
            redirect('iom/view?no=' . urlencode($noiom), 'refresh');
        }

        function insert_item(){
            $noiom = $this->input->post('noiom');
            $kditem = $this->input->post('kditem');
            $data = array(
                'kditem' => $kditem,
                'stsiom' => 0,
                'tglselesai' => NULL
            );
            $this->db->set('noiom', $noiom);
            $this->db->insert('tbiomdet', $data);
            redirect('iom/view?no=' . urlencode($noiom), 'refresh');
        }
    }
?>