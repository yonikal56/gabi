<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Site_model extends CI_Model {    
    public function get($table = 'pages', $where = [], $order_by = null, $limit = null) {
        if($limit != null) {
            if(is_array($limit)) {
                $this->db->limit($limit[0], $limit[1]);
            }
            else {
                $this->db->limit($limit);
            }
        }
        if($order_by != null) {
            $orders = explode(' ', $order_by);
            $this->db->order_by($orders[0], $orders[1]);
        }
        if(count($where)) {
            return $this->db->get_where($table, $where)->result_array();
        }
        else {
            return $this->db->get($table)->result_array();
        }
    }
    
    public function insert($table = 'settings', $inserts = []) {
        $this->db->insert($table, $inserts);
        return $this->db->insert_id();
    }
    
    public function update($table = 'settings', $where = [], $updates = []) {
        foreach ($updates as $key => $value) {
            if(is_array($value)) {
                $this->db->set($key, $value[0], $value[1]);
            }
            else {
                $this->db->set($key, $value);
            }
        }
        $this->db->update($table, [], $where);
        if($this->db->affected_rows() >=0) {
            return true;
        } 
        else {
            return false; 
        }
    }
    
    public function delete($table = 'settings', $where = [], $limit = null) {
        $row = $this->get($table, $where);
        if(isset($row[0])) {
            if($limit != null) {
                $this->db->delete($table, $where, $limit);
            }
            else {
                $this->db->delete($table, $where);
            }
        }
        return $this->db->affected_rows();
    }
    
    public function get_tables_list() {
        $list_of_tables = [];
        $tables = $this->db->query("SHOW TABLES")->result_array();
        foreach ($tables as $table) {
            $list_of_tables[] = reset($table);
        }
        return $list_of_tables;
    }
    
    public function change_tab_order($id, $dir)
    {
        if($this->if_tab_exists($id))
        {
            $tab = $this->get_tab($id);
            if($dir == 'up' && $tab['order'] >= 2)
            {
                $data = array(
                    'order' => $tab['order']
                );
                $this->db->where('order', $tab['order'] - 1);
                $this->db->update('tabs', $data); 

                $data = array(
                    'order' => $tab['order'] - 1
                );
                $this->db->where('ID', $tab['ID']);
                $this->db->update('tabs', $data);
            }
            elseif($dir == 'down' && $tab['order'] < count($this->get_tabs()))
            {
                $data = array(
                    'order' => $tab['order']
                );
                $this->db->where('order', $tab['order'] + 1);
                $this->db->update('tabs', $data); 

                $data = array(
                    'order' => $tab['order'] + 1
                );
                $this->db->where('ID', $tab['ID']);
                $this->db->update('tabs', $data);
            }
        }
    }
    
    public function if_connected_admin()
    {
        if($this->session->userdata('username') == 'Admin' && $this->session->userdata('password') == '625a021cceb01ba635852e9636fc39b0')
        {
            return true;
        }
        else
        {
            $this->logout_admin();
            return false;
        }
    }
    
    public function logout_admin()
    {
        $data = array(
            'username' => '',
            'password' => ''
        );
        $this->session->unset_userdata($data);
    }
    
    public function login_admin($username, $password)
    {
        if($username == 'Admin' && $password == '625a021cceb01ba635852e9636fc39b0')
        {
            $data = array(
                'username' => 'Admin',
                'password' => '625a021cceb01ba635852e9636fc39b0'
            );
            $this->session->set_userdata($data);
            return true;
        }
        else
        {
            return false;
        }
    }
}