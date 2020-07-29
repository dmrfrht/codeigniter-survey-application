<?php

class Google_login_model extends CI_Model
{
  public function Is_already_register($email)
  {
    $this->db->where('email', $email);
    $query = $this->db->get('users');
    if ($query->num_rows() > 0) {
      return true;
    } else {
      return false;
    }
  }

  public function Update_user_data($data, $email)
  {
    return $this->db->where('email', $email)->update('users', $data);
  }

  public function Insert_user_data($data)
  {
    return $this->db->insert('users', $data);
  }
}