<?php

class Profile extends MY_Controller
{
  public $viewFolder = "";

  public function __construct()
  {
    parent::__construct();
    $this->viewFolder = "profile_v";
    $this->load->model("profile_model");
    $this->load->model("user_model");
    $this->load->model("register_info_model");

    if (!get_active_user()) { // Burada geçmesi lazım bu controllera ulaşması için->ilk olarak construct cagrıldıgı ıcın burada yazdım
      redirect(base_url("login"));
    }
  }

  public function index()
  {
    $viewData = new stdClass();
    $user = get_active_user();

    $items = $this->profile_model->get(
      array(
        "user_id" => $user->id
      )
    );

    $registration_info = $this->user_model->get(
      array(
        "id" => $user->id
      )
    );

    if ($items)
      $viewData->subViewFolder = "update";
    else
      $viewData->subViewFolder = "no_content";

    $viewData->viewFolder = $this->viewFolder;
    $viewData->items = $items;
    $viewData->active_user = $user;
    $viewData->registration_info = $registration_info;
    $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
  }

  public function new_form()
  {
    if (!isAllowedWriteModule()) {
      redirect(base_url("profile"));
    }

    $viewData = new stdClass();

    $viewData->viewFolder = $this->viewFolder;
    $viewData->subViewFolder = "add";
    $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
  }

  public function save()
  {
    if (!isAllowedWriteModule()) {
      redirect(base_url("profile"));
    }

    $user = get_active_user();

    $insert = $this->profile_model->add(
      array(
        "user_id" => $user->id,
        "email_2" => $this->input->post("email_2"),
        "mobile_phone_2" => $this->input->post("mobile_phone_2"),
        "home_phone" => $this->input->post("home_phone"),
        "monthly_net_income" => $this->input->post("monthly_net_income"),
        "monthly_income_of_the_house" => $this->input->post("monthly_income_of_the_house"),
        "is_family_alive" => $this->input->post("is_family_alive"),
        "is_family_together" => $this->input->post("is_family_together"),
        "you_married" => $this->input->post("you_married"),
        "have_a_child" => $this->input->post("have_a_child"),
        "number_of_children" => $this->input->post("number_of_children"),
        "have_a_house" => $this->input->post("have_a_house"),
        "you_a_tenant" => $this->input->post("you_a_tenant"),
        "have_a_car" => $this->input->post("have_a_car"),
        "how_many_cars" => $this->input->post("how_many_cars"),
        "social_media_facebook" => $this->input->post("social_media_facebook"),
        "social_media_twitter" => $this->input->post("social_media_twitter"),
        "social_media_instagram" => $this->input->post("social_media_instagram"),
        "social_media_linkedin" => $this->input->post("social_media_linkedin")
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
    redirect(base_url("profile"));
    die();
  }

  public function update_form($id)
  {
    if (!isAllowedUpdateModule()) {
      redirect(base_url("profile"));
    }

    $viewData = new stdClass();

    $item = $this->profile_model->get(
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
      redirect(base_url("users"));
    }

    $dataExtraInfo = array(
      "email_2" => $this->input->post("email_2"),
      "mobile_phone_2" => $this->input->post("mobile_phone_2"),
      "home_phone" => $this->input->post("home_phone"),
      "monthly_net_income" => $this->input->post("monthly_net_income"),
      "monthly_income_of_the_house" => $this->input->post("monthly_income_of_the_house"),
      "is_family_alive" => $this->input->post("is_family_alive"),
      "is_family_together" => $this->input->post("is_family_together"),
      "you_married" => $this->input->post("you_married"),
      "have_a_child" => $this->input->post("have_a_child"),
      "number_of_children" => $this->input->post("number_of_children"),
      "have_a_house" => $this->input->post("have_a_house"),
      "you_a_tenant" => $this->input->post("you_a_tenant"),
      "have_a_car" => $this->input->post("have_a_car"),
      "how_many_cars" => $this->input->post("how_many_cars"),
      "social_media_facebook" => $this->input->post("social_media_facebook"),
      "social_media_twitter" => $this->input->post("social_media_twitter"),
      "social_media_instagram" => $this->input->post("social_media_instagram"),
      "social_media_linkedin" => $this->input->post("social_media_linkedin")
    );

    $updateExtraInfo = $this->profile_model->update(array(
      "id" => $id
    ), $dataExtraInfo);

    if ($updateExtraInfo) {
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
    redirect(base_url("profile"));
  }

}
