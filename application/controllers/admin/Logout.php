<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Logout extends CI_Controller {
    public function __construct()
	{
		parent::__construct();
        if($this->Site_model->if_connected_admin())
        {
            $this->Site_model->logout_admin();
            redirect('admin/login');
        }
	}
    
    public function index()
    {
        
    }
}