<?php
$header_data = array(
    'base_url' => base_url(),
    'title' => isset($title) ? $title : 'גבי אינסטלטור נתניה',
    'description' => isset($description) ? $description : 'גבי אינסטלטור נתניה',
    'keywords' => isset($keywords) ? $keywords : 'אינסטלטור,גבי אינסטלטור,גבי אינסטלטור נתניה, אינסטלטור נתניה'
);
$footer_data = array(
    'year' => date('Y'),
    'base_url' => base_url(),
);
$data = isset($data) ? $data : array();
$data['message'] = isset($data['message']) ? $data['message'] : '';
$data['message_class'] = isset($data['message_class']) ? $data['message_class'] : 'error';
$data['base_url'] = base_url();
$this->parser->parse('templates/header', $header_data);
$this->parser->parse($view, $data);
$this->parser->parse('templates/footer', $footer_data);