<?php

class Secret_question_model extends CI_Model
{
  public function __construct()
  {
    parent::__construct();
    $this->tableName = "secret_questions";
  }

  public function get_all($where = array(), $order = "id ASC")
  {
    return $this->db->where($where)->order_by($order)->get($this->tableName)->result();
  }
}