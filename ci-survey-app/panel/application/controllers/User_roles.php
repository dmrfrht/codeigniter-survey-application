<?php

class User_roles extends MY_Controller
{
  public $viewFolder = "";

  public function __construct()
  {
    parent::__construct();
    $this->viewFolder = "user_roles_v";
    $this->load->model("user_role_model");

    if (!get_active_user()) {
      redirect(base_url("login"));
    }
  }

  public function index()
  {
    $viewData = new stdClass();
    $items = $this->user_role_model->get_all();

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
    $this->form_validation->set_rules("title", "Başlık", "required|trim");
    $this->form_validation->set_message(
      array(
        "required" => "<b>{field}</b> alanı doldurulmalıdır"
      )
    );

    $validate = $this->form_validation->run(); // run() -> true veya false döner.
    if ($validate) {
      $insert = $this->user_role_model->add(
        array(
          "title" => $this->input->post("title"),
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
      redirect(base_url("user_roles"));
    } else {
      // Hata dönüşleri
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

    $item = $this->user_role_model->get(
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

    $this->form_validation->set_rules("title", "Başlık", "required|trim");

    $this->form_validation->set_message(
      array(
        "required" => "<b>{field}</b> alanı doldurulmalıdır"
      )
    );

    $validate = $this->form_validation->run(); // run() -> true veya false döner.

    if ($validate) {
      $update = $this->user_role_model->update(array(
        "id" => $id
      ), array(
        "title" => $this->input->post("title")
      ));

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

      /** İşlemin sonucunu sessiona yazıyoruz */
      $this->session->set_flashdata("alert", $alert);
      redirect(base_url("user_roles"));
    } else {
      // Hata dönüşleri
      $viewData = new stdClass();
      $viewData->viewFolder = $this->viewFolder;
      $viewData->subViewFolder = "update";
      $viewData->form_error = true;

      $item = $this->user_role_model->get(
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

    $delete = $this->user_role_model->delete(
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
    redirect(base_url("user_roles"));
  }

  public function isActiveSetter($id)
  {
    if (!isAllowedUpdateModule()) {
      redirect(base_url());
    }

    if ($id) {
      $isActive = ($this->input->post("data")) === "true" ? 1 : 0;

      $this->user_role_model->update(array(
        "id" => $id
      ), array(
        "isActive" => $isActive
      ));
    }
  }

  public function permissions_form($id)
  {
    if (!isAllowedUpdateModule()) {
      redirect(base_url());
    }

    $viewData = new stdClass();

    $item = $this->user_role_model->get(
      array(
        "id" => $id
      )
    );
    $viewData->viewFolder = $this->viewFolder;
    $viewData->subViewFolder = "permissions";
    $viewData->item = $item;
    $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
  }

  public function update_permissions($id)
  {
    if (!isAllowedUpdateModule()) {
      redirect(base_url());
    }

    $permissions = json_encode($this->input->post("permissions"));

    $data = array(
      "permissions" => $permissions
    );

    $update = $this->user_role_model->update(array(
      "id" => $id
    ), $data);

    if ($update) {
      $alert = array(
        "title" => "İşlem başarılı",
        "text" => "Yetk' tanımı bir şekilde güncellendi",
        "type" => "success"
      );
    } else {
      $alert = array(
        "title" => "İşlem başarısızdır",
        "text" => "Yetki tanımlanırken bir hata oluştu",
        "type" => "error"
      );
    }

    $this->session->set_flashdata("alert", $alert);
    redirect(base_url("user_roles/permissions_form/$id"));
  }

}