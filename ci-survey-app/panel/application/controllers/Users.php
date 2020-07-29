<?php

class Users extends MY_Controller
{
  public $viewFolder = "";

  public function __construct()
  {
    parent::__construct();
    $this->viewFolder = "users_v";
    $this->load->model("user_model");

    if (!get_active_user()) { // Burada geçmesi lazım bu controllera ulaşması için->ilk olarak construct cagrıldıgı ıcın burada yazdım
      redirect(base_url("login"));
    }
  }

  public function index()
  {
    $viewData = new stdClass();
    $user = get_active_user();
    if (isAdmin()) {
      $where = array();
    } else {
      $where = array(
        "id" => $user->id
      );
    }

    $items = $this->user_model->get_all($where);

    $viewData->viewFolder = $this->viewFolder;
    $viewData->subViewFolder = "list";
    $viewData->items = $items;
    $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
  }

  public function new_form()
  {
    if (!isAllowedWriteModule()) {
      redirect(base_url("users"));
    }

    $viewData = new stdClass();

    $this->load->model("user_role_model");
    $user_roles = $this->user_role_model->get_all(
      array(
        "isActive" => true
      )
    );

    $viewData->viewFolder = $this->viewFolder;
    $viewData->subViewFolder = "add";
    $viewData->user_roles = $user_roles;
    $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
  }

  public function save()
  {
    if (!isAllowedWriteModule()) {
      redirect(base_url("users"));
    }

    $this->load->library("form_validation");

    $this->form_validation->set_rules("name", "Ad", "required|trim");
    $this->form_validation->set_rules("surname", "Soyad", "required|trim");
    $this->form_validation->set_rules("user_role", "Yetki Rolü", "required|trim");
    $this->form_validation->set_rules("email", "Email", "required|trim|is_unique[users.email]|valid_email");
    $this->form_validation->set_rules("mobile_phone", "Telefon Numarası", "required|trim");
    $this->form_validation->set_rules("password", "Şifre", "required|trim|min_length[6]");
    $this->form_validation->set_rules("re_password", "Şifre Tekrar", "required|trim|min_length[6]|matches[password]");

    $this->form_validation->set_message(
      array(
        "required" => "{field} alanı doldurulmalıdır",
        "valid_email" => "Lütfen geçerli bir email adresi giriniz",
        "is_unique" => "{field} alanı daha önceden kullanılmıştır",
        "matches" => "Şifreler birbirleri ile uyuşmuyor",
        "min_length" => "{field} için en az 6  karakter girmelisiniz"
      )
    );

    $validate = $this->form_validation->run();

    if ($validate) {
      $insert = $this->user_model->add(
        array(
          "name" => $this->input->post("name"),
          "surname" => $this->input->post("surname"),
          "email" => $this->input->post("email"),
          "mobile_phone" => $this->input->post("mobile_phone"),
          "user_role" => $this->input->post("user_role"),
          "password" => md5($this->input->post("password")),
          "isActive" => true,
          "created_at" => date("Y-m-d H:i:s")
        )
      );

      if ($insert) {
        $alert = array(
          "title" => "İşlem başarılı",
          "text" => "Kayıt başarılı bir şekilde eklendi",
          "type" => "success"
        );
      } else {
        $alert = array(
          "title" => "İşlem başarısızdır",
          "text" => "Kayıt eklenirken bir hata oluştu",
          "type" => "error"
        );
      }

      $this->session->set_flashdata("alert", $alert);
      redirect(base_url("users"));
      die();
    } else {
      $viewData = new stdClass();
      $viewData->viewFolder = $this->viewFolder;
      $viewData->subViewFolder = "add";
      $viewData->form_error = true;
      $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }

  }

  public function update_form($id)
  {
    if (!isAllowedUpdateModule()) {
      redirect(base_url("users"));
    }

    $viewData = new stdClass();

    $item = $this->user_model->get(
      array(
        "id" => $id
      )
    );

    $this->load->model("user_role_model");
    $user_roles = $this->user_role_model->get_all(
      array(
        "isActive" => true
      )
    );
    $viewData->viewFolder = $this->viewFolder;
    $viewData->subViewFolder = "update";
    $viewData->item = $item;
    $viewData->user_roles = $user_roles;
    $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
  }

  public function update_password_form($id)
  {
    if (!isAllowedUpdateModule()) {
      redirect(base_url("users"));
    }

    $viewData = new stdClass();

    $item = $this->user_model->get(
      array(
        "id" => $id
      )
    );
    $viewData->viewFolder = $this->viewFolder;
    $viewData->subViewFolder = "password";
    $viewData->item = $item;
    $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
  }

  public function update($id)
  {
    if (!isAllowedUpdateModule()) {
      redirect(base_url("users"));
    }

    $this->load->library("form_validation");

    $oldUser = $this->user_model->get(
      array(
        "id" => $id
      )
    );

    if ($oldUser->email != $this->input->post("email")) {
      $this->form_validation->set_rules("email", "Email", "required|trim|is_unique[users.email]|valid_email");
    }

    $this->form_validation->set_rules("name", "Ad", "required|trim");
    $this->form_validation->set_rules("surname", "Soyad", "required|trim");
    $this->form_validation->set_rules("user_role", "Yetki Rolü", "required|trim");
    $this->form_validation->set_rules("mobile_phone", "Telefon Numarası", "required|trim");

    $this->form_validation->set_message(
      array(
        "required" => "{field} alanı doldurulmalıdır",
        "valid_email" => "Lütfen geçerli bir email adresi giriniz",
        "is_unique" => "{field} alanı daha önceden kullanılmıştır",
        "min_length" => "{field} için en az 6  karakter girmelisiniz"
      )
    );

    $validate = $this->form_validation->run(); // run() -> true veya false döner.

    if ($validate) {
      $data = array(
        "name" => $this->input->post("name"),
        "surname" => $this->input->post("surname"),
        "email" => $this->input->post("email"),
        "mobile_phone" => $this->input->post("mobile_phone"),
        "user_role" => $this->input->post("user_role")
      );

      $update = $this->user_model->update(array(
        "id" => $id
      ), $data);

      if ($update) {
        $alert = array(
          "title" => "İşlem başarılı",
          "text" => "Kayıt başarılı bir şekilde güncellendi",
          "type" => "success"
        );
      } else {
        $alert = array(
          "title" => "İşlem başarısızdır",
          "text" => "Kayıt güncellenirken bir hata oluştu",
          "type" => "error"
        );
      }

      $this->session->set_flashdata("alert", $alert);
      redirect(base_url("users"));
    } else {
      $viewData = new stdClass();
      $viewData->viewFolder = $this->viewFolder;
      $viewData->subViewFolder = "update";
      $viewData->form_error = true;

      $item = $this->user_model->get(
        array(
          "id" => $id
        )
      );

      $this->load->model("user_role_model");
      $user_roles = $this->user_role_model->get_all(
        array(
          "isActive" => true
        )
      );

      $viewData->user_roles = $user_roles;
      $viewData->item = $item;
      $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }

  }

  public function update_password($id)
  {
    if (!isAllowedUpdateModule()) {
      redirect(base_url("users"));
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
      redirect(base_url("users"));
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
      $viewData->item = $item;
      $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }

  }

  public function delete($id)
  {
    if (!isAllowedDeleteModule()) {
      redirect(base_url("product"));
    }

    $delete = $this->user_model->delete(
      array(
        "id" => $id
      )
    );
    // TODO alert sistemi gerçekleştirilecek
    if ($delete) {
      $alert = array(
        "title" => "İşlem başarılı",
        "text" => "Kayıt başarılı bir şekilde silindi",
        "type" => "success"
      );
    } else {
      $alert = array(
        "title" => "İşlem başarısızdır",
        "text" => "Kayıt silinirken bir hata oluştu",
        "type" => "error"
      );
    }

    /** İşlemin sonucunu sessiona yazıyoruz */
    $this->session->set_flashdata("alert", $alert);
    redirect(base_url("users"));
  }

  public function isActiveSetter($id)
  {
    if (!isAllowedUpdateModule()) {
      redirect(base_url("users"));
    }

    if ($id) {
      $isActive = ($this->input->post("data")) === "true" ? 1 : 0;

      $this->user_model->update(array(
        "id" => $id
      ), array(
        "isActive" => $isActive
      ));
    }
  }

}
