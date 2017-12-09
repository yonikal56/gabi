<?php

class Menus_model extends CI_Model {
    private $menu = [];
    
    public function __construct() {
        parent::__construct();
        $this->load_menu();
    }
    
    public function get_named_position($num) {
        switch($num) {
            case 0:
                return 'top';
            case 1:
                return 'side';
            default:
                return 'unknown';
        }
    }
    
    public function get_unnamed_position($name) {
        switch($name) {
            case 'top':
                return 0;
            case 'side':
                return 1;
            default:
                return 'unknown';
        }
    }
    
    public function load_menu() {
        $this->menus = $this->Site_model->get('menu',[],'ORDER ASC');
    }

    public function get_menu($parentID = 0, $type="nav nav-pills") {
        $current_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $menus = $this->get_menu_by_parent($parentID);
        $str = '<ul class="'.$type.'">';
        foreach ($menus as $menu) {
            $link = ($menu['internal'] == 0 ? base_url() . $menu['url'] : $menu['url']);
            $str .= "<li class='dropdown".($current_link == $link ? " active" : "")."'><a href='".$link."'>{$menu['title']}</a>";
            if(count($this->get_menu_by_parent( $menu['ID']))) {
                $str .= $this->get_menu($menu['ID'], "dropdown-menu");
            }
            $str .= '</li>';
        }
        $str .= '</ul>';
        return $str;
    }
    
    public function get_menu_arr($parentID = 0) {
        $menus = $this->get_menu_by_parent($parentID);
        $arr = [];
        foreach ($menus as $menu) {
            $arr[$menu['ID']] = $menu;
            if(count($this->get_menu_by_parent($name, $menu['ID']))) {
                $arr[$menu['ID']]['sub'] = $this->get_menu_arr($name, $menu['ID']);
            }
        }
        return $arr;
    }
    
    public function get_panel_menu($page, $per_page) {
        return array_slice($this->menus, ($page-1)*$per_page, $per_page);
    }
    
    public function get_panel_number() {
        return count($this->menus);
    }
    
    public function get_menu_by_parent($parentID) {
        $menus = [];
        foreach ($this->menus as $menu) {
            if($menu['parent'] == $parentID) {
                $menus[] = $menu;
            }
        }
        return $menus;
    }
    
    public function add_menu_item($title, $internal, $url, $parentID) {
        $order = count($this->get_menu_by_parent($parentID));
        $menu = [
            'title' => $title,
            'internal' => $internal,
            'url' => $url,
            'parent' => $parentID,
            '`order`' => $order
        ];
        $id = $this->Site_model->insert('menu', $menu);
        $menu['ID'] = $id;
        $this->menus[($menu['position'] == '0') ? 'top' : 'side'][] = $menu;
        return $id;
    }
    
    public function get_menu_item($id) {
        foreach($this->menus as $menu) {
            if($menu['ID'] == $id) {
                return $menu;
            }
        }
    }
    
    public function delete_menu_item($id) {
        $menu = $this->get_menu_item($id);
        if(isset($menu['title'])) {
            $parent_menus_count = count($this->get_menu_by_parent((($menu['position'] == '0') ? 'top' : 'side'), $menu['parent'])) - 1;
            $sub_menus = $this->get_menu_by_parent((($menu['position'] == '0') ? 'top' : 'side'), $id);
            $add = 0;
            $this->Site_model->update('menu', ['parent' => $menu['parent'], '`order` >' => $menu['order']], ['`order`' => ['`order`-1', false]]);
            foreach($sub_menus as $sub_menu) {
                $this->Site_model->update('menu', ['ID' => $sub_menu['ID']], ['parent' => $menu['parent'], '`order`' => ($parent_menus_count + $add++)]);
            }
            $this->Site_model->delete('menu', ['ID' => $id], 1);
            $this->load_menu();
        }
    }
    
    public function get_all_menu() {
        return $this->menus;
    }
    
    public function change_order($id, $up = true) {
        $menu = $this->get_menu_item($id);
        if(count($menu) != 0) {
            if($up && $menu['order'] >= 1) {
                $this->Site_model->update('menu', ['`order`' => $menu['order'] - 1, 'parent' => $menu['parent']], ['`order`' => $menu['order']]);
                $this->Site_model->update('menu', ['ID' => $id], ['`order`' => [$menu['order']-1, false]]);
            } elseif(!$up && $menu['order'] < count($this->get_menu_by_parent($this->get_named_position($menu['position']), $menu['parent']))-1) {
                $this->Site_model->update('menu', ['`order`' => $menu['order'] + 1, 'parent' => $menu['parent']], ['`order`' => $menu['order']]);
                $this->Site_model->update('menu', ['ID' => $id], ['`order`' => [$menu['order']+1, false]]);
            }
        }
    }
    
    public function edit_menu($id, $updates) {
        foreach($this->menus as $mkey => $menu) {
            if($menu['ID'] == $id) {
                foreach ($updates as $key => $value) {
                    $menu[$key] = $value;
                }
                $this->menus[$mkey] = $menu;
            }
        }
        return $this->Site_model->update('menu', ['ID' => $id], $updates);
    }
}