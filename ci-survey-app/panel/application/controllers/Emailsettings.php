<?php

class Emailsettings extends MY_Controller
{
  public $viewFolder = "";

  public function __construct()
  {
    parent::__construct();
    $this->viewFolder = "email_settings_v";
    $this->load->model("emailsettings_model");

    if (!get_active_user()) { // Burada geçmesi lazım bu controllera ulaşması için->ilk olarak construct cagrıldıgı ıcın burada yazdım
      redirect(base_url("login"));
    }
  }

  public function index()
  {
    $viewData = new stdClass();
    $items = $this->emailsettings_model->get_all(array());

    $viewData->viewFolder = $this->viewFolder;
    $viewData->subViewFolder = "list";
    $viewData->items = $items;
    $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
  }

  public function new_form()
  {
    if (!isAllowedWriteModule()) {
      redirect(base_url());
    }

    $viewData = new stdClass();
    $viewData->viewFolder = $this->viewFolder;
    $viewData->subViewFolder = "add";
    $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
  }

  public function save()
  {
    if (!isAllowedWriteModule()) {
      redirect(base_url());
    }

    $this->load->library("form_validation");

    $this->form_validation->set_rules("protocol", "Protokol Numarası", "required|trim");
    $this->form_validation->set_rules("host", "Eposta Sunucusu", "required|trim");
    $this->form_validation->set_rules("port", "Port Numarası", "required|trim");
    $this->form_validation->set_rules("user_name", "Kullanıcı Adı", "required|trim");
    $this->form_validation->set_rules("user", "Eposta (User)", "required|trim|valid_email");
    $this->form_validation->set_rules("from", "Kimden Gidecek (From)", "required|trim|valid_email");
    $this->form_validation->set_rules("to", "Kime Gidecek (To)", "required|trim|valid_email");
    $this->form_validation->set_rules("password", "Şifre", "required|trim");

    $this->form_validation->set_message(
      array(
        "required" => "<b>{field}</b> alanı doldurulmalıdır",
        "valid_email" => "Lütfen geçerli bir e-posta adresi giriniz"
      )
    );

    $validate = $this->form_validation->run();

    if ($validate) {
      $insert = $this->emailsettings_model->add(
        array(
          "protocol" => $this->input->post("protocol"),
          "host" => $this->input->post("host"),
          "port" => $this->input->post("port"),
          "user_name" => $this->input->post("user_name"),
          "user" => $this->input->post("user"),
          "from" => $this->input->post("from"),
          "to" => $this->input->post("to"),
          "password" => $this->input->post("password"),
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
      redirect(base_url("emailsettings"));
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
      redirect(base_url());
    }

    $viewData = new stdClass();

    $item = $this->emailsettings_model->get(
      array(
        "id" => $id
      )
    );
    $viewData->viewFolder = $this->viewFolder;
    $viewData->subViewFolder = "update";
    $viewData->item = $item;
    $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
  }

  public function update($id)
  {
    if (!isAllowedUpdateModule()) {
      redirect(base_url());
    }

    $this->load->library("form_validation");

    $this->form_validation->set_rules("protocol", "Protokol Numarası", "required|trim");
    $this->form_validation->set_rules("host", "Eposta Sunucusu", "required|trim");
    $this->form_validation->set_rules("port", "Port Numarası", "required|trim");
    $this->form_validation->set_rules("user_name", "Kullanıcı Adı", "required|trim");
    $this->form_validation->set_rules("user", "Eposta (User)", "required|trim|valid_email");
    $this->form_validation->set_rules("from", "Kimden Gidecek (From)", "required|trim|valid_email");
    $this->form_validation->set_rules("to", "Kime Gidecek (To)", "required|trim|valid_email");
    $this->form_validation->set_rules("password", "Şifre", "required|trim");

    $this->form_validation->set_message(
      array(
        "required" => "<b>{field}</b> alanı doldurulmalıdır",
        "valid_email" => "Lütfen geçerli bir e-posta adresi giriniz"
      )
    );

    $validate = $this->form_validation->run(); // run() -> true veya false döner.

    if ($validate) {
      $data = array(
        "protocol" => $this->input->post("protocol"),
        "host" => $this->input->post("host"),
        "port" => $this->input->post("port"),
        "user_name" => $this->input->post("user_name"),
        "user" => $this->input->post("user"),
        "from" => $this->input->post("from"),
        "to" => $this->input->post("to"),
        "password" => $this->input->post("password"),
      );

      $update = $this->emailsettings_model->update(array(
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
      redirect(base_url("emailsettings"));
    } else {
      $viewData = new stdClass();
      $viewData->viewFolder = $this->viewFolder;
      $viewData->subViewFolder = "update";
      $viewData->form_error = true;

      $item = $this->emailsettings_model->get(
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
      redirect(base_url());
    }

    $delete = $this->emailsettings_model->delete(
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
    redirect(base_url("emailsettings"));
  }

  public function isActiveSetter($id)
  {
    if (!isAllowedUpdateModule()) {
      redirect(base_url());
    }

    if ($id) {
      $isActive = ($this->input->post("data")) === "true" ? 1 : 0;

      $this->emailsettings_model->update(array(
        "id" => $id
      ), array(
        "isActive" => $isActive
      ));
    }
  }

}
