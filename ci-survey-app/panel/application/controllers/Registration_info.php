<?php

class Registration_info extends MY_Controller
{
  public $viewFolder = "";

  public function __construct()
  {
    parent::__construct();
    $this->viewFolder = "registration_info_v";
    $this->load->model("user_model");
    $this->load->model("register_info_model");
    $this->load->model("secret_question_model");

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

    $item = $this->user_model->get($where);
    $secretQuestions = $this->secret_question_model->get_all();

    $viewData->viewFolder = $this->viewFolder;
    $viewData->subViewFolder = "update";
    $viewData->item = $item;
    $viewData->secretQuestions = $secretQuestions;

    $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
  }

  public function update_information($id)
  {
    if (!isAllowedUpdateModule()) {
      redirect(base_url("registration_info"));
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
    $this->form_validation->set_rules("mobile_phone", "Telefon Numarası", "required|trim");
    $this->form_validation->set_rules("secret_question_1_id", "Gizli Soru 1", "required|trim");
    $this->form_validation->set_rules("secret_question_2_id", "Gizli Soru 2", "required|trim");
    $this->form_validation->set_rules("secret_question_1_answer", "Gizli Soru 1 Cevap", "required|trim");
    $this->form_validation->set_rules("secret_question_2_answer", "Gizli Soru 2 Cevap", "required|trim");

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
        "secret_question_1_id" => $this->input->post("secret_question_1_id"),
        "secret_question_2_id" => $this->input->post("secret_question_2_id"),
        "secret_question_1_answer" => $this->input->post("secret_question_1_answer"),
        "secret_question_2_answer" => $this->input->post("secret_question_2_answer")
      );

      $update = $this->register_info_model->update(array(
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
      redirect(base_url("registration_info"));
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

      $secretQuestions = $this->secret_question_model->get_all();

      $viewData->item = $item;
      $viewData->secretQuestions = $secretQuestions;
      $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }

  }

}
