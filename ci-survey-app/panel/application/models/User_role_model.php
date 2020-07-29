<?php

//class User_role_model extends CI_Model
//{
//  public $tableName = "user_roles";
//
//  public function __construct()
//  {
//    parent::__construct();
//  }
//
//  // Tek Kayıt Getirme
//  public function get($where = array())
//  {
//    return $this->db->where($where)->get($this->tableName)->row();
//  }
//
//  // Tüm kayıtları getir
//  public function get_all($where = array(), $order = "id ASC")
//  {
//    return $this->db->where($where)->order_by($order)->get($this->tableName)->result();
//  }
//
//  // Kayıt Ekleme
//  public function add($data = array())
//  {
//    return $this->db->insert($this->tableName, $data);
//  }
//
//  // Kayıt Güncelleme
//  public function update($where = array(), $data = array())
//  {
//    return $this->db->where($where)->update($this->tableName, $data);
//  }
//
//  // Kayıt Silme
//  public function delete($where = array())
//  {
//    return $this->db->where($where)->delete($this->tableName);
//  }
//}

class User_role_model extends MY_Model
{
  public function __construct()
  {
    parent::__construct();
    $this->tableName = "user_roles";
  }
}