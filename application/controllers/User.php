<?php

class User extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model("user_model");
    $this->load->model("company_model");
    $this->load->model("secret_question_model");
    $this->load->library("user_agent");
  }

  /** Bireysel Kayıt */
  public function individual_register_form()
  {
    $viewData = new stdClass();
    $secretQuestions = $this->secret_question_model->get_all();

    $viewData->secretQuestions = $secretQuestions;
    $this->load->view('register_individual', $viewData);
  }

  public function do_individual_register()
  {
    $this->load->library("form_validation");

    $this->form_validation->set_rules("name", "Ad", "required|trim");
    $this->form_validation->set_rules("surname", "Soyad", "required|trim");
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
          "user_role" => '3',
          "password" => md5($this->input->post("password")),
          "isActive" => true,
          "ip_registration_first" => $this->input->ip_address(),
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
      redirect(base_url());
      die();
    } else {
      redirect(base_url("bireysel-kayit-ol"));
    }
  }

  /** Firma Kaydı */
  public function company_register_form()
  {
    $viewData = new stdClass();
    $secretQuestions = $this->secret_question_model->get_all();

    $viewData->secretQuestions = $secretQuestions;
    $this->load->view('register_company', $viewData);
  }

  public function do_company_register()
  {
    $this->load->library("form_validation");

    $this->form_validation->set_rules("name", "Ad", "required|trim");
    $this->form_validation->set_rules("surname", "Soyad", "required|trim");
    $this->form_validation->set_rules("email", "Email", "required|trim|is_unique[users.email]|valid_email");
    $this->form_validation->set_rules("mobile_phone", "Telefon Numarası", "required|trim");
    $this->form_validation->set_rules("password", "Şifre", "required|trim|min_length[6]");
    $this->form_validation->set_rules("re_password", "Şifre Tekrar", "required|trim|min_length[6]|matches[password]");

    $this->form_validation->set_rules("company_title", "Şirket Adı", "required|trim|is_unique[company_information.company_title]");
    $this->form_validation->set_rules("tax_number", "Vergi Numarası", "required|trim");
    $this->form_validation->set_rules("open_address", "Açık Adres", "required|trim");
    $this->form_validation->set_rules("province", "İl", "required|trim");
    $this->form_validation->set_rules("country", "İlçe", "required|trim");
    $this->form_validation->set_rules("company_phone", "Firma Telefon", "required|trim");
    $this->form_validation->set_rules("company_cell_phone", "Firma Cep Telefon", "required|trim");
    $this->form_validation->set_rules("company_email", "Firma E-posta Adresi", "required|trim");
    $this->form_validation->set_rules("company_website", "Firma Website", "required|trim");

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
      $insertCompanyInfo = $this->company_model->add(
        array(
          'company_title' => $this->input->post("company_title"),
          'tax_number' => $this->input->post("tax_number"),
          'open_address' => $this->input->post("open_address"),
          'province' => $this->input->post("province"),
          'district' => $this->input->post("district"),
          'country' => $this->input->post("country"),
          'company_phone' => $this->input->post("company_phone"),
          'company_cell_phone' => $this->input->post("company_cell_phone"),
          'company_email' => $this->input->post("company_email"),
          'company_website' => $this->input->post("company_website"),
          'isActive' => true,
          "created_at" => date("Y-m-d H:i:s")
        )
      );

      $insertUser = $this->user_model->add(
        array(
          "name" => $this->input->post("name"),
          "surname" => $this->input->post("surname"),
          "email" => $this->input->post("email"),
          "mobile_phone" => $this->input->post("mobile_phone"),
          "user_role" => '2',
          "password" => md5($this->input->post("password")),
          "company_id" => $this->db->insert_id(),
          "ip_registration_first" => $this->input->ip_address(),
          "isActive" => true,
          "created_at" => date("Y-m-d H:i:s")
        )
      );

      if ($insertUser && $insertCompanyInfo) {
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
      redirect(base_url());
      die();
    } else {
      redirect(base_url("firma-kayit-ol"));
    }
  }

}