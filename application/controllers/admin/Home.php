<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class home extends CI_Controller {
    public function __construct() {
        parent::__construct();
        if(!$this->Site_model->if_connected_admin())
        {
            redirect('admin/login');
        }
    }
    
    public function index()
    {
        $data = array(
            'title' => 'פאנל ניהול',
            'view' => 'admin/home',
            'data' => array(
                
            )
        );
        $this->load->view('templates/main', $data);
    }
}