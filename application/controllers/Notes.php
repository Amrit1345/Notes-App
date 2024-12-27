<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notes extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('Note_model');
        $this->load->helper('url');
        $this->load->library('form_validation');
        $this->load->helper('form');
    }

    public function index() {
        if (!$this->session->userdata('logged_in')) {
            redirect('users/login');
        }

        $data['notes'] = $this->Note_model->get_all_notes();
        $this->load->view('templates/header');
        $this->load->view('notes_view', $data);
        $this->load->view('templates/footer');
    }

    public function add() {
        if (!$this->session->userdata('logged_in')) {
            redirect('users/login');
        }

        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('desc', 'Desc', 'required');
        $this->form_validation->set_rules('content', 'Content', 'required');

        if($this->form_validation->run() === FALSE){
            $this->session->set_flashdata('error', 'Title, description and content are required fields.');

            $data['notes'] = $this->Note_model->get_all_notes();
            $this->load->view('templates/header');
            $this->load->view('notes_view', $data);
            $this->load->view('templates/footer');
        } else {

            $title = $this->input->post('title');
            $desc = $this->input->post('desc');
            $content = $this->input->post('content');


            if (!empty($title) && !empty($desc)) {
                $this->Note_model->insert_note($title, $desc, $content);
                $this->session->set_flashdata('success', 'Notes added successfully.');
            }
            else{
                $this->session->set_flashdata('error', 'Title and description are required.');
            }
            redirect('notes');
        }
    }

    public function edit($id) {
        if (!$this->session->userdata('logged_in')) {
            redirect('users/login');
        }

        $data['note'] = $this->Note_model->get_note_by_id($id);
        $this->load->view('templates/header');
        $this->load->view('edit_note_view', $data);
        $this->load->view('templates/footer');
    }

    public function update($id) {
        if (!$this->session->userdata('logged_in')) {
            redirect('users/login');
        }

        $title = $this->input->post('title');
        $desc = $this->input->post('desc');
        $content = $this->input->post('content');
        
        if (!empty($title) && !empty($desc)) {
            $this->Note_model->update_note($id, $title, $desc, $content);
            $this->session->set_flashdata('update', 'Notes updated successfully.');
        }
        redirect('notes');
    }

    public function delete($id) {
        if (!$this->session->userdata('logged_in')) {
            redirect('users/login');
        }

        $this->Note_model->delete_note($id);
        $this->session->set_flashdata('delete', 'Notes deleted successfully.');
        redirect('notes');
    }

    public function search_notes() {
        if (!$this->session->userdata('logged_in')) {
            redirect('users/login');
        }

        $search_term = $this->input->get('q');
        $user_id = $this->session->userdata('user_id');

        $this->load->model('Note_model');
        $data['notes'] = $this->Note_model->search_notes($search_term, $user_id);

        $this->load->view('templates/header');
        $this->load->view('notes_view', $data);
        $this->load->view('templates/footer');
    }    
    
}
