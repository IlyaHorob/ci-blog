<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users_model extends CI_Model
{
    private function _getCurrentDate()
    {
        $date = new DateTime();
        
        return $date->format('Y-m-d');
    }
    
    public function getUsers($limit = 0, $offset = 0)
    {
        $this->db->select('*');
        $this->db->from('users');
        if (!empty($limit)) {
            $this->db->limit($limit, $offset);
        }
        $query = $this->db->get();
        
        return $query->result_array();
    }
    
    public function getUser($userId)
    {
        $this->db->where('id', $userId);
        $query = $this->db->get('users');
        
        return $query->row_array();
    }
    
    public function getUserByEmail($email)
    {
        $this->db->where('email', $email);
        $query = $this->db->get('users');
        
        return $query->row_array();
    }
    
    public function save(array $userdata, $userId = null)
    {
        if (empty ($userId)) {
            $userdata['created_at'] = $this->_getCurrentDate();
            
            $this->db->insert('users', $userdata);
            
            return $this->db->insert_id();
        } else {
            $this->db->where('id', $userId);
            
            return $this->db->update('users', $userdata);
        }
    }
    
    public function delete($userId)
    {
        $this->db->where('id', $userId);
        $this->db->delete('users');
    }
}
