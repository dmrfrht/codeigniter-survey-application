<?php

class Company_model extends CI_Model
{
  public function __construct()
  {
    parent::__construct();
    $this->tableName = "company_information";
  }

  public function add($data = array())
  {
    return $this->db->insert($this->tableName, $data);
  }

}
