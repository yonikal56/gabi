<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pages extends CI_Controller {
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
            'title' => 'ניהול דפים',
            'view' => 'admin/pages',
            'data' => array(
                'pages' => $this->Pages_model->get_pages()
            )
        );
		$this->load->view('templates/main', $data);
	}
    
    public function delete($id = null)
    {
        if($id != null)
        {
            $this->Pages_model->delete_page($id);
        }
        redirect('admin/pages');
    }
    
    public function edit($page_id = null)
    {
        if($page_id == null)
        {
            redirect('admin/pages');
        }
        if(count($this->Pages_model->get_page($page_id)) == 0)
        {
            redirect('admin/pages');
        }
        $page_for_d = array($this->Pages_model->get_page($page_id));
        $this->form_validation->set_rules('title', 'כותרת', 'trim|required|xss_clean|htmlspecialchars');
        $this->form_validation->set_rules('machine_name', 'URL', 'trim|required|xss_clean|htmlspecialchars');
        if($this->form_validation->run() == FALSE)
        {
            $data = array(
                'title' => 'עריכת דף',
                'view' => 'admin/edit_page',
                'data' => array(
                    'message' => validation_errors(),
                    'message_class' => 'error',
                    'page' => $page_for_d
                )
            );
        }
        else
        {
            $this->Pages_model->edit_page($page_id, [
                'title' => $this->input->post('title', TRUE),
                'content' => $this->input->post('content'),
                'keywords' => $this->input->post('keywords', TRUE),
                'description' => $this->input->post('description', TRUE)
            ]);
            redirect('admin/pages');
        }
        $this->load->view('templates/main', $data);
    }
    
    public function add()
    {
        $this->form_validation->set_rules('title', 'כותרת', 'trim|required|xss_clean|htmlspecialchars');
        $this->form_validation->set_rules('machine_name', 'URL', 'trim|required|xss_clean|htmlspecialchars');
        if($this->form_validation->run() == FALSE)
        {
            $data = array(
                'title' => 'הוספת דף',
                'view' => 'admin/add_page',
                'data' => array(
                    'message' => validation_errors(),
                    'message_class' => 'error'
                )
            );
        }
        else
        {
            $this->Pages_model->add_page($this->input->post('title', TRUE), $this->input->post('machine_name', TRUE), 
                    $this->input->post('content'), $this->input->post('keywords', TRUE), $this->input->post('description', TRUE));
            redirect('admin/pages');
        }
        $this->load->view('templates/main', $data);
    }
}