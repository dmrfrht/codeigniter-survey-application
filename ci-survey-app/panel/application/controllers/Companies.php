<?php

class Companies extends MY_Controller
{
  public $viewFolder = "";

  public function __construct()
  {
    parent::__construct();
    $this->viewFolder = "company_v";
    $this->load->model("company_model");

    if (!get_active_user()) { // Buradan geçmesi lazım bu controllera ulaşması için->ilk olarak construct cagrıldıgı ıcın burada yazdım
      redirect(base_url("login"));
    }
  }

  public function index()
  {
    $viewData = new stdClass();

    /** Tablodan verileri çekme  */
    $items = $this->company_model->get_all();

    /** View a gönderilecek değişkenler */
    $viewData->viewFolder = $this->viewFolder;
    $viewData->subViewFolder = "list";
    $viewData->items = $items;

    $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
  }

  public function new_form()
  {
    if (!isAllowedWriteModule()) {
      redirect(base_url("companies"));
    }

    $viewData = new stdClass();

    /** View a gönderilecek değişkenler */
    $viewData->viewFolder = $this->viewFolder;
    $viewData->subViewFolder = "add";

    $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
  }

  public function save()
  {
    if (!isAllowedWriteModule()) {
      redirect(base_url("companies"));
    }

    $this->load->library("form_validation");
    $this->form_validation->set_rules("company_title", "firma başlığı", "required|trim|is_unique[company_information.company_title]");
    $this->form_validation->set_rules("tax_number", "Vergi Numarası", "required|trim");
    $this->form_validation->set_rules("open_address", "Açık Adres", "required|trim");
    $this->form_validation->set_rules("province", "İl", "required|trim");
    $this->form_validation->set_rules("district", "İlçe", "required|trim");
    $this->form_validation->set_rules("country", "Ülke", "required|trim");
    $this->form_validation->set_rules("company_phone", "Firma Telefonu", "required|trim");
    $this->form_validation->set_rules("company_cell_phone", "Firma Cep Telefonu", "required|trim");
    $this->form_validation->set_rules("company_email", "Firma E-posta", "required|trim|valid_email");
    $this->form_validation->set_rules("company_website", "Firma Website", "required|trim");
    $this->form_validation->set_rules("number_staff_employed", "Çalıştırılan Personel Aralığı", "required|trim");

    $this->form_validation->set_message(
      array(
        "required" => "{field} alanı doldurulmalıdır",
        "is_unique" => "Bu {field} sistemde kayıtlıdır",
        "valid_email" => "Lütfen geçerli bir email adresi giriniz",
      )
    );

    $validate = $this->form_validation->run();

    if ($validate) {
      $insert = $this->company_model->add(
        array(
          "company_title" => $this->input->post("company_title"),
          "tax_number" => $this->input->post("tax_number"),
          "open_address" => $this->input->post("open_address"),
          "province" => $this->input->post("province"),
          "district" => $this->input->post("district"),
          "country" => $this->input->post("country"),
          "company_phone" => $this->input->post("company_phone"),
          "company_cell_phone" => $this->input->post("company_cell_phone"),
          "company_email" => $this->input->post("company_email"),
          "company_website" => $this->input->post("company_website"),
          "number_staff_employed" => $this->input->post("number_staff_employed"),
          "isActive" => true,
          "created_at" => date("Y-m-d H:i:s")
        )
      );

      // TODO Alert Sistemi Eklenecek !!!!!!!!!!!!!!!!!!!!
      if ($insert) {
        $alert = array(
          "title" => "İşlem Başarılı",
          "text" => "Kayıt Başarılı Bir Şekilde Eklendi",
          "type" => "success"
        );
      } else {
        $alert = array(
          "title" => "İşlem Başarısız",
          "text" => "Kayıt Eklendirken Bir Sorun Oluştu",
          "type" => "error"
        );
      }

      $this->session->set_flashdata("alert", $alert);
      redirect(base_url("companies"));
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
      redirect(base_url("companies"));
    }

    $viewData = new stdClass();

    /** Tablodan verileri çekme  */
    $item = $this->company_model->get(
      array(
        "id" => $id
      )
    );

    /** View a gönderilecek değişkenler */
    $viewData->viewFolder = $this->viewFolder;
    $viewData->subViewFolder = "update";
    $viewData->item = $item;

    $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
  }

  public function update($id)
  {
    if (!isAllowedUpdateModule()) {
      redirect(base_url("companies"));
    }

    $this->load->library("form_validation");

    $this->form_validation->set_rules("company_title", "firma başlığı", "required|trim|is_unique[company_information.company_title]");
    $this->form_validation->set_rules("tax_number", "Vergi Numarası", "required|trim");
    $this->form_validation->set_rules("open_address", "Açık Adres", "required|trim");
    $this->form_validation->set_rules("province", "İl", "required|trim");
    $this->form_validation->set_rules("district", "İlçe", "required|trim");
    $this->form_validation->set_rules("country", "Ülke", "required|trim");
    $this->form_validation->set_rules("company_phone", "Firma Telefonu", "required|trim");
    $this->form_validation->set_rules("company_cell_phone", "Firma Cep Telefonu", "required|trim");
    $this->form_validation->set_rules("company_email", "Firma E-posta", "required|trim|valid_email");
    $this->form_validation->set_rules("company_website", "Firma Website", "required|trim");
    $this->form_validation->set_rules("number_staff_employed", "Çalıştırılan Personel Aralığı", "required|trim");

    $this->form_validation->set_message(
      array(
        "required" => "{field} alanı doldurulmalıdır",
        "is_unique" => "Bu {field} sistemde kayıtlıdır",
        "valid_email" => "Lütfen geçerli bir email adresi giriniz",
      )
    );

    $validate = $this->form_validation->run();

    if ($validate) {
      $update = $this->company_model->update(
        array(
          "id" => $id
        ),
        array(
          "company_title" => $this->input->post("company_title"),
          "tax_number" => $this->input->post("tax_number"),
          "open_address" => $this->input->post("open_address"),
          "province" => $this->input->post("province"),
          "district" => $this->input->post("district"),
          "country" => $this->input->post("country"),
          "company_phone" => $this->input->post("company_phone"),
          "company_cell_phone" => $this->input->post("company_cell_phone"),
          "company_email" => $this->input->post("company_email"),
          "company_website" => $this->input->post("company_website"),
          "number_staff_employed" => $this->input->post("number_staff_employed"),
        )
      );

      // TODO Alert Sistemi Eklenecek !!!!!!!!!!!!!!!!!!!!
      if ($update) {
        $alert = array(
          "title" => "İşlem Başarılı",
          "text" => "Kayıt Başarılı Bir Şekilde Güncellendi",
          "type" => "success"
        );
      } else {
        $alert = array(
          "title" => "İşlem Başarısız",
          "text" => "Kayıt Güncellenirken Bir Sorun Oluştu",
          "type" => "error"
        );
      }
      $this->session->set_flashdata("alert", $alert);
      redirect(base_url("companies"));
    } else {
      $viewData = new stdClass();

      /** Tablodan verileri çekme  */
      $item = $this->company_model->get(
        array(
          "id" => $id
        )
      );

      /** View a gönderilecek değişkenler */
      $viewData->viewFolder = $this->viewFolder;
      $viewData->subViewFolder = "update";
      $viewData->form_error = true;
      $viewData->item = $item;

      $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }
  }

  public function delete($id)
  {
    if (!isAllowedDeleteModule()) {
      redirect(base_url("companies"));
    }

    $delete = $this->company_model->delete(
      array(
        "id" => $id
      )
    );

    // TODO Alert Sistemi Eklenecek !!!!!!!!!!!!!!!!!!!!
    if ($delete) {
      $alert = array(
        "title" => "İşlem Başarılı",
        "text" => "Kayıt Başarılı Bir Şekilde Silindi",
        "type" => "success"
      );
    } else {
      $alert = array(
        "title" => "İşlem Başarısız",
        "text" => "Kayıt Silinirken Bir Sorun Oluştu",
        "type" => "error"
      );
    }
    $this->session->set_flashdata("alert", $alert);
    redirect(base_url("companies"));
  }

  public function isActiveSetter($id)
  {
    if (!isAllowedUpdateModule()) {
      die();
    }

    if ($id) {
      $isActive = ($this->input->post("data") === "true") ? 1 : 0;

      $this->company_model->update(
        array(
          "id" => $id
        ),
        array(
          "isActive" => $isActive
        )
      );

    }
  }

}
