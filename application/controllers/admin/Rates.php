<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rates extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
        if(!$this->Site_model->if_connected_admin())
        {
            redirect('admin/login');
        }
	}
    
    public function index()
	{
        $data = array(
            'title' => 'ניהול המלצות',
            'view' => 'admin/rates',
            'data' => array(
                'rates' => $this->Site_model->get('rates')
            )
        );
		$this->load->view('templates/main', $data);
	}
    
    public function delete($id = null)
    {
        if($id != null)
        {
            $this->Site_model->delete('rates', ['ID' => $id]);
        }
        redirect('admin/rates');
    }
}