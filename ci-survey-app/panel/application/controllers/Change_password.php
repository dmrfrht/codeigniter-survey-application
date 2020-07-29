<?php

class Change_password extends MY_Controller
{
  public $viewFolder = "";

  public function __construct()
  {
    parent::__construct();
    $this->viewFolder = "password_v";
    $this->load->model("user_model");

    if (!get_active_user()) { // Burada geçmesi lazım bu controllera ulaşması için->ilk olarak construct cagrıldıgı ıcın burada yazdım
      redirect(base_url("login"));
    }
  }

  public function index()
  {
    $viewData = new stdClass();
    $user = get_active_user();
    $where = array(
      "id" => $user->id
    );

    $items = $this->user_model->get($where);

    $viewData->viewFolder = $this->viewFolder;
    $viewData->subViewFolder = "password";
    $viewData->items = $items;
    $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
  }

  public function update_password($id)
  {
    if (!isAllowedUpdateModule()) {
      redirect(base_url());
    }

    $this->load->library("form_validation");

    $this->form_validation->set_rules("password", "Şifre", "required|trim|min_length[6]");
    $this->form_validation->set_rules("re_password", "Şifre Tekrar", "required|trim|min_length[6]|matches[password]");

    $this->form_validation->set_message(
      array(
        "required" => "{field} alanı doldurulmalıdır",
        "matches" => "Şifreler birbirleri ile uyuşmuyor",
        "min_length" => "{field} için en az 6  karakter girmelisiniz"
      )
    );

    $validate = $this->form_validation->run(); // run() -> true veya false döner.

    if ($validate) {
      $data = array(
        "password" => md5($this->input->post("password")),
        "last_password_change_time" => date("Y-m-d H:i:s")
      );

      $update = $this->user_model->update(array(
        "id" => $id
      ), $data);

      if ($update) {
        $alert = array(
          "title" => "İşlem başarılı",
          "text" => "Şifre başarılı bir şekilde güncellendi",
          "type" => "success"
        );
      } else {
        $alert = array(
          "title" => "İşlem başarısızdır",
          "text" => "Şifre güncellenirken bir hata oluştu",
          "type" => "error"
        );
      }

      $this->session->set_flashdata("alert", $alert);
      redirect(base_url("change_password"));
    } else {
      $viewData = new stdClass();
      $viewData->viewFolder = $this->viewFolder;
      $viewData->subViewFolder = "password";
      $viewData->form_error = true;

      $item = $this->user_model->get(
        array(
          "id" => $id
        )
      );

      $user = get_active_user();
      $where = array(
        "id" => $user->id
      );
      $items = $this->user_model->get($where);

      $viewData->item = $item;
      $viewData->items = $items;
      $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }
  }

}
