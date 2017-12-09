<?php

class Galleries_model extends CI_Model {
    private $galleries = [];
    
    public function __construct() {
        parent::__construct();
        $this->load_galleries();
    }
    
    public function load_galleries() {
        $this->galleries = $this->Site_model->get('galleries');
        foreach($this->galleries as $key => $value)
        {
            $this->galleries[$key]['images'] = $this->Site_model->get('images', ['gallery_ID' => $value['ID']]);
        }
    }

    public function get_galleries() {
        return $this->galleries;
    }
    
    public function get_gallery($machine_name) {
        foreach ($this->galleries as $gallery) {
            if($gallery['machine_name'] == $machine_name) {
                return $gallery;
            }
        }
    }
    
    public function get_panel_galleries($page, $per_page) {
        return array_slice($this->galleries, ($page - 1) * $per_page, $per_page);
    }
    
    public function get_gallery_by_id($id) {
        foreach ($this->galleries as $gallery) {
            if($gallery['ID'] == $id) {
                return $gallery;
            }
        }
    }
    
    public function add_gallery($title, $machine_name) {
        $gallery = [
            'title' => $title,
            'machine_name' => $machine_name
        ];
        $id = $this->Site_model->insert('galleries', $gallery);
        $gallery['ID'] = $id;
        $this->galleries[] = $gallery;
        return $id;
    }
    
    public function edit_gallery($id, $updates) {
        foreach($this->galleries as $gkey => $gallery) {
            if($gallery['ID'] == $id) {
                foreach ($updates as $key => $value) {
                    $gallery[$key] = $value;
                }
                $this->galleries[$gkey] = $gallery;
            }
        }
        return $this->Site_model->update('galleries', ['ID' => $id], $updates);
    }
    
    public function delete_gallery($id) {
        $gallery = $this->get_gallery_by_id($id);
        if(isset($gallery['title'])) {
            $return = $this->Site_model->delete('galleries', ['ID' => $id], 1);
            $this->load_galleries();
            return $return;
        }
    }
}