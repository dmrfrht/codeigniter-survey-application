<?php

class Settings extends MY_Controller
{
  public $viewFolder = "";

  public function __construct()
  {
    parent::__construct();
    $this->viewFolder = "settings_v";
    $this->load->model("settings_model");

    if (!get_active_user()) { // Burada geçmesi lazım bu controllera ulaşması için->ilk olarak construct cagrıldıgı ıcın burada yazdım
      redirect(base_url("login"));
    }
  }

  public function index()
  {
    $viewData = new stdClass();
    $item = $this->settings_model->get();

    if ($item)
      $viewData->subViewFolder = "update";
    else
      $viewData->subViewFolder = "no_content";

    $viewData->viewFolder = $this->viewFolder;
    $viewData->item = $item;
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

    if ($_FILES["logo"]["name"] == "") {
      $alert = array(
        "title" => "İşlem Başarısız",
        "text" => "Lütfen bir görsel seçiniz",
        "type" => "error"
      );

      $this->session->set_flashdata("alert", $alert);
      redirect(base_url("settings/new_form"));
      die();
    }

    $this->form_validation->set_rules("company_name", "Şirket Adı", "required|trim");
    $this->form_validation->set_rules("site_title", "Site Başlığı", "required|trim");
    $this->form_validation->set_rules("email", "E-posta Adresi", "required|trim|valid_email");

    $this->form_validation->set_message(
      array(
        "required" => "{field} alanı doldurulmalıdır",
        "valid_email" => "Lütfen geçerli bir {field} giriniz",
      )
    );

    $validate = $this->form_validation->run();

    if ($validate) {
      $file_name = convertToSEO($this->input->post("company_name")) . "." . pathinfo($_FILES["logo"]["name"], PATHINFO_EXTENSION);

      $config["allowed_types"] = "jpg|jpeg|png";
      $config["upload_path"] = "uploads/$this->viewFolder/";
      $config["file_name"] = $file_name;

      $this->load->library("upload", $config);

      $upload = $this->upload->do_upload("logo");

      if ($upload) {
        $uploaded_file = $this->upload->data("file_name");

        $insert = $this->settings_model->add(
          array(
            "company_name" => $this->input->post("company_name"),
            "site_title" => $this->input->post("site_title"),
            "email" => $this->input->post("email"),
            "about_us" => $this->input->post("about_us"),
            "logo" => $uploaded_file,
            "created_at" => date("Y-m-d H:i:s")
          )
        );

        if ($insert) {
          $alert = array(
            "title" => "İşlem Başarlı",
            "text" => "Kayıt başarılı bir şekilde eklendi",
            "type" => "success"
          );
        } else {
          $alert = array(
            "title" => "İşlem Başarısız",
            "text" => "Kayıt ekleme sırasında bir problem oluştu",
            "type" => "error"
          );
        }

      } else {
        $alert = array(
          "title" => "İşlem Başarısız",
          "text" => "Görsel yüklenirken bir problem oluştu",
          "type" => "error"
        );

        $this->session->set_flasdata("alert", $alert);
        redirect(base_url("settings/new_form"));
        die();
      }

      $this->session->set_flashdata("alert", $alert);
      redirect(base_url("settings"));
      die();
    } else {
      $viewData = new stdClass();

      /** View a gönderilecek değişkenler */
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

    $item = $this->settings_model->get(
      array(
        "user_id" => $id
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

    $this->form_validation->set_rules("company_name", "Şirket Adı", "required|trim");
    $this->form_validation->set_rules("site_title", "Site Başlığı", "required|trim");
    $this->form_validation->set_rules("email", "E-posta Adresi", "required|trim|valid_email");

    $this->form_validation->set_message(
      array(
        "required" => "{field} alanı doldurulmalıdır",
        "valid_email" => "Lütfen geçerli bir {field} giriniz",
      )
    );

    $validate = $this->form_validation->run(); // run() -> true veya false döner.

    if ($validate) {
      if ($_FILES["logo"]["name"] !== "") {
        $file_name = convertToSEO($this->input->post("company_name")) . '.' . pathinfo($_FILES["logo"]["name"], PATHINFO_EXTENSION);

        $config = array(
          "allowed_types" => "jpg|jpeg|png",
          "upload_path" => "uploads/$this->viewFolder/",
          "file_name" => $file_name
        );

        $this->load->library("upload", $config);
        $upload = $this->upload->do_upload("logo");

        if ($upload) {
          $uploaded_file = $this->upload->data("file_name");

          $data = array(
            "company_name" => $this->input->post("company_name"),
            "site_title" => $this->input->post("site_title"),
            "email" => $this->input->post("email"),
            "about_us" => $this->input->post("about_us"),
            "logo" => $uploaded_file,
          );
        } else {
          $alert = array(
            "company_name" => $this->input->post("company_name"),
            "site_title" => $this->input->post("site_title"),
            "email" => $this->input->post("email"),
            "about_us" => $this->input->post("about_us"),
          );
          $this->session->set_flashdata("alert", $alert);
          redirect(base_url("setting/update_form/$id"));
          die();
        }
      } else {
        $data = array(
          "company_name" => $this->input->post("company_name"),
          "site_title" => $this->input->post("site_title"),
          "email" => $this->input->post("email"),
          "about_us" => $this->input->post("about_us"),
        );
      }

      $update = $this->settings_model->update(array("id" => $id), $data);

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

      // session
      $settings = $this->settings_model->get();
      $this->session->set_flashdata("settings", $settings);

      /** İşlemin sonucunu sessiona yazıyoruz */
      $this->session->set_flashdata("alert", $alert);
      redirect(base_url("settings"));
    } else {
      // Hata dönüşleri
      $viewData = new stdClass();
      $viewData->viewFolder = $this->viewFolder;
      $viewData->subViewFolder = "update";
      $viewData->form_error = true;

      $item = $this->settings_model->get(
        array(
          "id" => $id
        )
      );
      $viewData->item = $item;
      $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }

  }
}
