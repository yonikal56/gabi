<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {
    public function __construct()
	{
		parent::__construct();
        if($this->Site_model->if_connected_admin())
        {
            redirect('admin/home'); 
        }
	}
    
    public function index()
    {
        $this->form_validation->set_rules('username', 'username', 'trim|required|xss_clean|htmlspecialchars');
        $this->form_validation->set_rules('password', 'password', 'trim|required|xss_clean|htmlspecialchars');
        if($this->form_validation->run() == FALSE)
        {
            $data = array(
                'title' => 'Login',
                'view' => 'admin/login',
                'data' => array(
                    'message' => validation_errors(),
                    'message_class' => 'error'
                )
            );
        }
        else
        {
            if($this->Site_model->login_admin($_POST['username'], $_POST['password']))
            {
                redirect('admin/home');
            }
            else
            {
                $data = array(
                    'title' => 'Login',
                    'view' => 'admin/login',
                    'data' => array(
                        'message' => 'Incorrect details.',
                        'message_class' => 'error'
                    )
                );
            }
        }
        $this->load->view('templates/main', $data);
    }
}