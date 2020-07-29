<?php

class Register_info_model extends CI_Model
{
  public $tableName;

  public function __construct()
  {
    parent::__construct();
    $this->tableName = "users";
  }

  public function update($where = array(), $data = array())
  {
    return $this->db->where($where)->update($this->tableName, $data);
  }
}