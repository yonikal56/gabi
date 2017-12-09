<?php
defined('BASEPATH') OR exit('Access Denied!');

class Galleries extends CI_Controller {
    public function __construct() {
        parent::__construct();
    }
    
	public function index($page = 1) {
        $galleries = $this->Galleries_model->get_panel_galleries($page, 10);
        if(count($galleries) == 0 && $page != 1) {
            $page = 1;
            $galleries = $this->Galleries_model->get_panel_galleries($page, 10);
        }
        $config['base_url'] = base_url().'admin/galleries/';
        $config['total_rows'] = count($this->Galleries_model->get_galleries());
        $config['per_page'] = 10;
        $config['use_page_numbers'] = TRUE;
        
        $data = array(
            'title' => 'ניהול גלריות',
            'view' => 'admin/show_galleries',
            'data' => array(
                'page' => $page,
                'galleries' => $galleries,
                'pagination' => $this->pagination->create_links()
            )
        );
		$this->load->view('templates/main', $data);
	}
    
    public function delete($id, $page) {
        $gallery = $this->Galleries_model->get_gallery_by_id($id);
        if(count($gallery)) {
            $this->Galleries_model->delete_gallery($id);
            redirect(base_url().'admin/galleries/'.$page);
        }
        redirect(base_url().'admin/galleries/'.$page);
    }
    
    public function add() {
        $this->form_validation->set_rules('title', 'כותרת', 'trim|required|min_length[3]|max_length[50]');
        $this->form_validation->set_rules('machine_name', 'כתובת URL אישית', 'trim|required');
        if($this->form_validation->run()) {
            $this->Galleries_model->add_gallery($this->input->post("title"), $this->input->post("machine_name"), (int) $this->input->post('slider'), "");
            redirect(base_url().'admin/galleries/1');
        }
        $this->index(1);
    }
    
    public function edit($id = null, $page = 1) {
        if($id == null) {
            redirect(base_url().'admin/galleries/'.$page);
        }
        $gallery = $this->Galleries_model->get_gallery_by_id($id);
        if(count($gallery) == 0) {
            redirect(base_url().'admin/galleries/'.$page);
        }
        $this->form_validation->set_rules('title', 'כותרת', 'trim|required|min_length[3]|max_length[50]');
        $this->form_validation->set_rules('machine_name', 'כתובת URL אישית', 'trim|required');
        if($this->form_validation->run()) {
            $this->Galleries_model->edit_gallery($id, [
                'title' => $this->input->post('title'),
                'machine_name' => $this->input->post('machine_name')
            ]);
            redirect(base_url().'admin/galleries/'.$page);
        }
        $data = array(
            'title' => 'ניהול גלריות',
            'view' => 'admin/edit_gallery',
            'data' => array(
                'page' => $page,
                'gallery' => $gallery
            )
        );
		$this->load->view('templates/main', $data);
    }
}