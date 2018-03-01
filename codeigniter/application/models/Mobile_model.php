<?php
  defined('BASEPATH') OR exit('No direct script access allowed');

  class Mobile_model extends CI_Model {

    public function get($table, $user) {
      $this->db->from($table)->where($user);
      $query = $this->db->get();
      return $query->result_array();
    }
    
    public function insert($table, $data) {
        return $this->db->insert($table, $data);
    }
  }

?>