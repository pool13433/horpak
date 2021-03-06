<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class MRoomtype_model extends CI_Model {

    var $array_room_type = array();
    var $code_id = '';
    var $type_name = '';
    var $type_desc = '';
    var $std_price = '';

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
    }

    public function getDataSingle($id) {
        $this->db->from('m_room_type')->where('code_id', $id);
        $query = $this->db->get();
        return $query->row();
    }

    public function getDataAll() {
        $query = $this->db
                ->select('*')
                ->from('m_room_type')
                ->where('horpak_id',$this->session->userdata('horpak_id'))
                //->join('p_horpak', 'p_horpak.code_id = m_room_type.horpak_id', 'left')
                ->get();
        return $query->result_array();
    }

    public function setData($data) {
        $this->code_id = $data['code_id'];
        $this->array_room_type = array(
            'horpak_id' => $this->session->userdata('horpak_id'),
            'type_name' => $data['type_name'],
            'type_desc' => $data['type_desc'],
            'std_price' => $data['std_price'],
        );
    }

    public function getData() {
        return $this;
    }

    public function deleteData($id) {
        $this->db->where('code_id', $id);
        return $this->db->delete('m_room_type');
    }

    public function insertData() {
        return $this->db->insert('m_room_type', $this->array_room_type);
    }

    public function updateData() {
        $this->db->where('code_id', $this->code_id);
        return $this->db->update('m_room_type', $this->array_room_type);
    }

}
