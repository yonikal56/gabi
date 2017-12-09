<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Page extends CI_Controller {
    public function index()
    {
        $rates = $this->Site_model->get("rates", [], "time ASC");
        $data = array(
            'view' => 'home',
            'data' => array(
                'rates' => $rates
            )
        );
        $this->load->view('templates/main', $data);
    }
    
    public function get_rates_ajax()
    {
        $rates = $this->Site_model->get("rates", [], "time ASC");
        $data = array(
            'rates' => $rates
        );
        $this->load->view('rates', $data);
    }
    
    public function add_rate()
    {
        $data = array(
            
        );
        $this->load->view('add_rate', $data);
    }
    
    public function add_rate_ajax()
    {
        //Global Form Errors
        $this->form_validation->set_message('required', 'חייב למעלה את השדה %s');
        $this->form_validation->set_message('min_length', 'השדה %s חייב להיות לפחות %d תווים');
        $this->form_validation->set_message('max_length', 'השדה %s חייב להיות עד %d תווים');
        if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            $this->form_validation->set_rules('fullname', 'שם פרטי מלא', 'trim|required|max_length[20]');
            $this->form_validation->set_rules('ratebody', 'תוכן הביקורת', 'trim|required|min_length[5]|max_length[100]');
            if($this->form_validation->run()) {
                $rating = $this->input->post('rating') / 2;
                $this->Site_model->insert("rates", [
                    'rate' => $rating,
                    'comment' => $this->input->post('ratebody'),
                    'nick' => $this->input->post('fullname'),
                    'time' => time(),
                    'IP' => $_SERVER['REMOTE_ADDR']
                ]);
                echo "true";
            }
            echo validation_errors();
        }
    }
}