<?php

class Option_types_model extends CI_Model
{
  public $tableName;

  public function __construct()
  {
    parent::__construct();
    $this->tableName = "option_types";
  }

  public function get_all($where = array(), $order = "id ASC")
  {
    return $this->db->where($where)->order_by($order)->get($this->tableName)->result();
  }
}