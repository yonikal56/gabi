<?php
defined('BASEPATH') OR exit('Access Denied!');

class Menu extends CI_Controller {
    public function __construct() {
        parent::__construct();
    }
    
    public function index($page = 1) {
        $all_menu = $this->Menus_model->get_all_menu();
        $menu = $this->Menus_model->get_panel_menu($page, 10);
        if(count($menu) == 0 && $page != 1) {
            $page = 1;
            $menu = $this->Menus_model->get_panel_menu($page, 10);
        }
        $config['base_url'] = base_url().'admin/menu/';
        $config['total_rows'] = count($all_menu);
        $config['per_page'] = 10;
        $config['use_page_numbers'] = TRUE;
        
        $data = array(
            'title' => 'ניהול תפריט',
            'view' => 'admin/show_menu',
            'data' => array(
                'page' => $page,
                'menu_names' => $all_menu,
                'menu' => $menu,
                'pagination' => $this->pagination->create_links()
            )
        );
		$this->load->view('templates/main', $data);
	}
    
    public function delete($id, $page) {
        $menu = $this->Menus_model->get_menu_item($id);
        if(count($menu)) {
            $this->Menus_model->delete_menu_item($id);
            redirect(base_url().'admin/menu/'.$page);
        }
        redirect(base_url().'admin/menu/'.$page);
    }
    
    public function add() {
        $this->form_validation->set_rules('title', 'כותרת', 'trim|required|min_length[3]|max_length[50]');
        $this->form_validation->set_rules('url', 'URL', 'trim|required');
        if($this->form_validation->run()) {
            $this->Menus_model->add_menu_item($this->input->post('title'), (int) $this->input->post('internal'), $this->input->post('url'), $this->input->post('parent'), $this->Menus_model->get_unnamed_position($position));
            redirect(base_url().'admin/menu/1');
        }
        $this->index(1, $position);
    }
    
    public function up($id = null, $page = 1) {
        $menu = $this->Menus_model->get_menu_item($id);
        if(count($menu)) {
            $this->Menus_model->change_order($id, true);
            redirect(base_url().'admin/menu/'.$page);
        }
        redirect(base_url().'admin/menu/'.$page);
    }
    
    public function down($id = null, $page = 1) {
        $menu = $this->Menus_model->get_menu_item($id);
        if(count($menu)) {
            $this->Menus_model->change_order($id, false);
            redirect(base_url().'admin/menu/'.$page);
        }
        redirect(base_url().'admin/menu/'.$page);
    }
    
    public function edit($id = null, $page = 1) {
        $menu = $this->Menus_model->get_menu_item($id);
        if(count($menu) == 0) {
            redirect(base_url().'admin/menu/'.$page);
        }
        $this->form_validation->set_rules('title', 'כותרת', 'trim|required|min_length[3]|max_length[50]');
        $this->form_validation->set_rules('url', 'URL', 'trim|required');
        if($this->form_validation->run()) {
            $this->Menus_model->edit_menu($id, [
                'title' => $this->input->post('title'),
                'url' => $this->input->post('url'),
                'internal' => (int) $this->input->post('internal')
            ]);
            redirect(base_url().'admin/menu/'.$page);
        }
        
        $data = array(
            'title' => 'ניהול תפריט',
            'view' => 'admin/edit_menu',
            'data' => array(
                'page' => $page,
                'menu' => $menu
            )
        );
		$this->load->view('templates/main', $data);
    }
}