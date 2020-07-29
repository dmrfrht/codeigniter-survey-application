<?php

class Company_information extends MY_Controller
{
  public $viewFolder = "";

  public function __construct()
  {
    parent::__construct();
    $this->viewFolder = "company_information_v";
    $this->load->model("company_model");

    if (!get_active_user()) { // Burada geçmesi lazım bu controllera ulaşması için->ilk olarak construct cagrıldıgı ıcın burada yazdım
      redirect(base_url("login"));
    }
  }

  public function index()
  {
    $viewData = new stdClass();
    $user = get_active_user();
    $where = array(
      "id" => $user->company_id
    );

    $item = $this->company_model->get($where);

    $viewData->viewFolder = $this->viewFolder;
    $viewData->subViewFolder = "update";
    $viewData->item = $item;
    $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
  }

  public function update_information($id)
  {
    $this->load->library("form_validation");

    $oldUser = $this->company_model->get(
      array(
        "id" => $id
      )
    );

    if ($oldUser->company_title != $this->input->post("company_title")) {
      $this->form_validation->set_rules("company_title", "Firma Adı", "required|trim|is_unique[company_information.company_title]");
    }

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
        "valid_email" => "Lütfen geçerli bir email adresi giriniz",
        "is_unique" => "{field} alanı daha önceden kullanılmıştır",
        "min_length" => "{field} için en az 6  karakter girmelisiniz"
      )
    );

    $validate = $this->form_validation->run(); // run() -> true veya false döner.

    if ($validate) {
      $data = array(
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
        "number_staff_employed" => $this->input->post("number_staff_employed")
      );

      $update = $this->company_model->update(array(
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
      redirect(base_url('company_information'));
    } else {
      $viewData = new stdClass();
      $viewData->viewFolder = $this->viewFolder;
      $viewData->subViewFolder = "update";
      $viewData->form_error = true;

      $item = $this->company_model->get(
        array(
          "id" => $id
        )
      );

      $viewData->item = $item;
      $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }

  }

}
