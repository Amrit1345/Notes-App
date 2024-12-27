<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Note_model extends CI_Model {

    public function __construct(){
        $this->load->database();
    }

    public function get_all_notes() {
        return $this->db
            ->where('user_id', $this->session->userdata('user_id'))
            ->where('deleted_at', null)
            ->order_by('updated_at', 'DESC')
            ->get('notes')->result();
    }

    public function insert_note($title, $desc, $content) {
        $data = array('user_id' => $this->session->userdata('user_id'),'title' => $title, 'desc' => $desc, 'content' => $content);
        $this->db->insert('notes', $data);
    }

    public function get_note_by_id($id) {
        return $this->db->get_where('notes', array('id' => $id))->row();
    }

    public function update_note($id, $title, $desc, $content) {
        $data = array('title' => $title, 'desc' => $desc, 'content' => $content);
        $this->db->set('updated_at', 'NOW()', FALSE);
        $this->db->where('id', $id);
        $this->db->update('notes', $data);
    }

    public function delete_note($id) {
        $this->db->set('deleted_at', 'NOW()', FALSE);
        $this->db->where('id', $id);
        $this->db->update('notes');
    }

    public function search_notes($search_term, $user_id) {

        $this->db->where('user_id', $user_id)
        ->where('deleted_at', null)->order_by('updated_at', 'DESC');
        
        if (!empty($search_term)) {
            $this->db->group_start();
            $this->db->like('title', $search_term);
            $this->db->or_like('desc', $search_term);
            $this->db->group_end();
        }

        $query = $this->db->get('notes');
        return $query->result();
    }
}
