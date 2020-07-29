<?php

class User_model extends CI_Model
{
  public function __construct()
  {
    parent::__construct();
    $this->tableName = "users";
  }

  public function add($data = array())
  {
    return $this->db->insert($this->tableName, $data);
  }

}
