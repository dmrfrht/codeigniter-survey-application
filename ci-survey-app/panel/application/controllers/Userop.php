<?php

class Userop extends CI_Controller
{
  public $viewFolder = "";
  public $google_client;

  public function __construct()
  {
    parent::__construct();
    $this->viewFolder = "users_v";
    $this->load->model("user_model");
    $this->load->model("google_login_model");
    $this->load->model("facebook_login_model");
    $this->load->library('user_agent');
    include_once APPPATH . 'libraries/vendor/autoload.php';

    $this->load->library('facebook');

    $this->google_client = new Google_Client();
    $this->google_client->setClientId("553294855715-mih83dndt847konpuckcjh9snsts0j0v.apps.googleusercontent.com");
    $this->google_client->setClientSecret("z0rR13t2yH72qDoDD0bw3KvS");
    $this->google_client->setRedirectUri("https://www.anketofis.com/ci-survey-app/panel/userop/google_login");
    $this->google_client->addScope("email");
    $this->google_client->addScope("profile");
  }

  public function login()
  {
    if (get_active_user()) {
      redirect(base_url());
    }

    $viewData = new stdClass();
    $viewData->viewFolder = $this->viewFolder;
    $viewData->subViewFolder = "login";
    $viewData->google_client = $this->google_client;
    $viewData->facebook_login = $this->facebook->login_url();

    $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
  }

  public function do_login()
  {
    if (get_active_user()) {
      redirect(base_url());
    }

    $this->load->library("form_validation");

    $this->form_validation->set_rules("email", "Email", "required|trim|valid_email");
    $this->form_validation->set_rules("password", "Şifre", "required|trim|min_length[6]");

    $this->form_validation->set_message(
      array(
        "required" => "{field} alanı doldurulmalıdır",
        "valid_email" => "Lütfen geçerli bir email adresi giriniz",
        "min_length" => "{field} için en az 6  karakter girmelisiniz"
      )
    );

    $validation = $this->form_validation->run();
    if ($validation == FALSE) {
      $viewData = new stdClass();
      $viewData->viewFolder = $this->viewFolder;
      $viewData->subViewFolder = "login";
      $viewData->form_error = true;
      $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    } else {
      $user = $this->user_model->get(
        array(
          "email" => $this->input->post("email"),
          "password" => md5($this->input->post("password")),
          "isActive" => true
        )
      );

      if ($user) {
        // Session
        $alert = array(
          "title" => "İşlem başarılı",
          "text" => "$user->name $user->surname Hoşgeldiniz",
          "type" => "success"
        );

        /** Kullanıcı yetkilerini session a aktarıyoruz  */
        setUserRoles();
        /********************************  */

        /** users tablosunda güncelleme start  */
        $this->user_model->update(
          array(
            "email" => $this->input->post("email")
          ),
          array(
            "last_login_time" => date("Y-m-d H:i:s"),
            "last_device_ip" => $this->input->ip_address(),
            "browser" => $this->agent->browser(),
            "browser_version" => $this->agent->version(),
            "os" => $this->agent->platform(),
            "device_type" => $_SERVER['HTTP_USER_AGENT']
          )
        );
        /** users tablosunda güncelleme finish  */

        /** remember me start */
        if (!empty($this->input->post("remember_me"))) {
          set_cookie("loginEmail", $this->input->post("email"), time() + (10 * 365 * 24 * 60 * 60));
        } else {
          set_cookie("loginEmail", "");
        }
        /** remember me finish */

        $this->session->set_userdata("user", $user);
        $this->session->set_flashdata("alert", $alert);
        redirect(base_url());
      } else {
        // Hata
        $alert = array(
          "title" => "İşlem başarısız",
          "text" => "Lütfen giriş bilgilerinizi kontrol ediniz",
          "type" => "error"
        );

        $this->session->set_flashdata("alert", $alert);
        redirect(base_url("login"));
      }
    }
  }

  public function logout()
  {
    $this->session->unset_userdata("user");
    redirect(base_url("login"));
  }

  /** Şifre Sıfırlama ve Güncelleme start  */
  public function forgot_password()
  {
    if (get_active_user()) {
      redirect(base_url());
    }

    $viewData = new stdClass();

    $viewData->viewFolder = $this->viewFolder;
    $viewData->subViewFolder = "forgot_password";

    $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
  }

  // Bu fonksiyon ile şifreyi biz sıfırlıyoruz. yeni karmaşık şifreyi email olarak gönderiyoruz.
  /*public function reset_password()
  {
    if (get_active_user()) {
      redirect(base_url());
    }

    $this->load->library("form_validation");

    $this->form_validation->set_rules("email", "Email", "required|trim|valid_email");

    $this->form_validation->set_message(
      array(
        "required" => "{field} alanı doldurulmalıdır",
        "valid_email" => "Lütfen geçerli bir email adresi giriniz",
      )
    );

    $validation = $this->form_validation->run();
    if (!$validation) {
      $viewData = new stdClass();
      $viewData->viewFolder = $this->viewFolder;
      $viewData->subViewFolder = "forgot_password";
      $viewData->form_error = true;
      $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    } else {
      $user = $this->user_model->get(
        array(
          "isActive" => true,
          "email" => $this->input->post("email")
        )
      );

      if ($user) {
        $this->load->helper("string");
        $temp_password = random_string(); // Geçici şifre

        $send = send_email($user->email, "Şifremi Unuttum", return_email_html($temp_password));

        if ($send) {
          $this->user_model->update(
            array(
              "id" => $user->id
            ),
            array(
              "password" => md5($temp_password)
            )
          );

          $alert = array(
            "title" => "İşlem başarısız",
            "text" => "Şifreniz sıfırlanmıştır. Lütfen e-postanızı kontrol ediniz",
            "type" => "success"
          );

          $this->session->set_flashdata("alert", $alert);
          redirect(base_url("login"));
        } else {
          $alert = array(
            "title" => "İşlem başarısız",
            "text" => "Sifreniz sıfırlanırken bir sorun oluştu. Daha sonra tekrar deneyniz",
            "type" => "error"
          );

          $this->session->set_flashdata("alert", $alert);
          redirect(base_url("sifremi-unuttum"));
        }

      } else {
        $alert = array(
          "title" => "İşlem başarısız",
          "text" => "Böyle bir kullanıcı bulunamamıştır",
          "type" => "error"
        );

        $this->session->set_flashdata("alert", $alert);
        redirect(base_url("sifremi-unuttum"));
      }
    }

  }*/

  // Bu fonksiyon ile şifresini sıfırlayabileceği bir link oluşturup kullanıcıya mail atıcaz oda o maile tıklayıp şifresini sıfılayabilecek
  public function send_reset_password_mail()
  {
    if (get_active_user()) {
      redirect(base_url());
    }

    $this->load->library("form_validation");
    $this->form_validation->set_rules("email", "Email", "required|trim|valid_email");
    $this->form_validation->set_message(
      array(
        "required" => "{field} alanı doldurulmalıdır",
        "valid_email" => "Lütfen geçerli bir email adresi giriniz",
      )
    );

    $validation = $this->form_validation->run();
    if (!$validation) {
      $viewData = new stdClass();
      $viewData->viewFolder = $this->viewFolder;
      $viewData->subViewFolder = "forgot_password";
      $viewData->form_error = true;
      $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    } else {
      $user = $this->user_model->get(
        array(
          "isActive" => true,
          "email" => $this->input->post("email")
        )
      );

      if ($user) {
        $this->load->helper("string");
        $reset_password_link = base_url("sifre-sifirla?ci=" . $user->email);

        $send = send_email($user->email, "Şifremi Unuttum", return_email_html($reset_password_link));

        if ($send) {
          $alert = array(
            "title" => "İşlem başarılı",
            "text" => "Şifrenizi sıfırlayabileceğiniz link mail adresinize gönderilmiştir.",
            "type" => "success"
          );

          $this->session->set_flashdata("alert", $alert);
          redirect(base_url("login"));
        } else {
          $alert = array(
            "title" => "İşlem başarısız",
            "text" => "Sifreniz sıfırlanırken bir sorun oluştu. Daha sonra tekrar deneyniz",
            "type" => "error"
          );

          $this->session->set_flashdata("alert", $alert);
          redirect(base_url("sifremi-unuttum"));
        }

      } else {
        $alert = array(
          "title" => "İşlem başarısız",
          "text" => "Böyle bir kullanıcı bulunamamıştır",
          "type" => "error"
        );

        $this->session->set_flashdata("alert", $alert);
        redirect(base_url("sifremi-unuttum"));
      }
    }
  }

  function show_reset_password_display()
  {
    if (get_active_user()) {
      redirect(base_url());
    }

    $viewData = new stdClass();

    $email = $_GET["ci"];

    $viewData->viewFolder = $this->viewFolder;
    $viewData->subViewFolder = "reset_password";
    $viewData->email = $email;

    $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
  }

  public function update_password()
  {
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

    $validate = $this->form_validation->run();

    if ($validate) {
      $update = $this->user_model->update(
        array(
          "email" => $_GET["ci"]
        ),
        array(
          "password" => md5($this->input->post("password")),
        )
      );

      if ($update) {
        $alert = array(
          "title" => "İşlem başarılı",
          "text" => "Şifre başarılı bir şekilde güncellenmiştir",
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
      redirect(base_url("login"));
      die();
    } else {
      $viewData = new stdClass();
      $email = $_GET["ci"];
      $viewData->viewFolder = $this->viewFolder;
      $viewData->subViewFolder = "reset_password";
      $viewData->form_error = true;
      $viewData->email = $email;
      $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }
  }
  /*********** Şifre Sıfırlama ve Güncelleme end  */

  /** Google Login Start */
  public function google_login()
  {
    if ($_GET["code"]) {
      $token = $this->google_client->fetchAccessTokenWithAuthCode($_GET["code"]);

      if (!isset($token["error"])) {
        $this->google_client->setAccessToken($token['access_token']);
        $this->session->set_userdata('access_token', $token['access_token']);
        $google_service = new Google_Service_Oauth2($this->google_client);
        $data = $google_service->userinfo->get();

        if ($this->google_login_model->Is_already_register($data['email'])) { // Bu arkadaş kayıtlı ise
          //update data
          $user_data = array(
            'name' => $data['given_name'],
            'surname' => $data['family_name'],
            'email' => $data['email'],
            "last_login_time" => date("Y-m-d H:i:s"),
            "last_device_ip" => $this->input->ip_address(),
            "browser" => $this->agent->browser(),
            "browser_version" => $this->agent->version(),
            "os" => $this->agent->platform(),
            "device_type" => $_SERVER['HTTP_USER_AGENT'],
            "ip_registration_first" => $this->input->ip_address()
          );

          $update = $this->google_login_model->Update_user_data($user_data, $data['email']);

          if ($update) {
            // Session
            $alert = array(
              "title" => "İşlem başarılı",
              "text" => "$data->given_name $data->family_name Hoşgeldiniz",
              "type" => "success"
            );

            /** Kullanıcı yetkilerini session a aktarıyoruz  */
            setUserRoles();
            /********************************  */

            $user = $this->user_model->get(
              array(
                "email" => $data["email"]
              )
            );

            $this->session->set_userdata("user", $user);
            $this->session->set_flashdata("alert", $alert);
            redirect(base_url());
          } else {
            // Hata
            $alert = array(
              "title" => "İşlem başarısız",
              "text" => "Lütfen giriş bilgilerinizi kontrol ediniz",
              "type" => "error"
            );

            $this->session->set_flashdata("alert", $alert);
            redirect(base_url("login"));
          }

        } else {
          //insert data
          $user_data = array(
            'login_oauth_uid' => $data['id'],
            'name' => $data['given_name'],
            'surname' => $data['family_name'],
            'email' => $data['email'],
            "user_role" => '3',
            "isActive" => true,
            "last_device_ip" => $this->input->ip_address(),
            "browser" => $this->agent->browser(),
            "browser_version" => $this->agent->version(),
            "os" => $this->agent->platform(),
            "device_type" => $_SERVER['HTTP_USER_AGENT'],
            "ip_registration_first" => $this->input->ip_address(),
            "created_at" => date("Y-m-d H:i:s")
          );

          $insert = $this->google_login_model->Insert_user_data($user_data);

          if ($insert) {
            // Session
            $alert = array(
              "title" => "İşlem başarılı",
              "text" => "$data->given_name $data->family_name Hoşgeldiniz",
              "type" => "success"
            );

            /** Kullanıcı yetkilerini session a aktarıyoruz  */
            setUserRoles();
            /********************************  */
            $user = $this->user_model->get(
              array(
                "email" => $data["email"]
              )
            );

            $this->session->set_userdata("user", $user);
            $this->session->set_flashdata("alert", $alert);
            redirect(base_url());
          } else {
            // Hata
            $alert = array(
              "title" => "İşlem başarısız",
              "text" => "Lütfen giriş bilgilerinizi kontrol ediniz",
              "type" => "error"
            );

            $this->session->set_flashdata("alert", $alert);
            redirect(base_url("login"));
          }
        }
      }
    }
  }
  /** Google Login End */

  /** Facebook Login Start */
  public function facebook_login()
  {
    if ($_GET["code"]) {
      if ($this->facebook->is_authenticated()) {
        $access_token = $this->facebook->is_authenticated();
        $fbUser = $this->facebook->request('get', '/me?fields=id,first_name,last_name,email,link,gender,picture');


        $id = $fbUser["id"];
        $name = $fbUser["first_name"];
        $surname = $fbUser["last_name"];
        $email = $fbUser["email"];

/*        echo '<pre>';
        echo 'ID: ' . $id . '<br>';
        echo 'Name: ' . $name . '<br>';
        echo 'Surname: ' . $surname . '<br>';
        echo 'Email: ' . $email;*/
     /*   echo 'Access Token: ' . $access_token . '<br>';
        echo '<pre>';
        print_r($fbUser);
        die();*/

        if ($this->facebook_login_model->Is_already_register($email)) {
          //update data
          $user_data = array(
            'name' => $name,
            'surname' => $surname,
            'email' => $email,
            "last_login_time" => date("Y-m-d H:i:s"),
            "last_device_ip" => $this->input->ip_address(),
            "browser" => $this->agent->browser(),
            "browser_version" => $this->agent->version(),
            "os" => $this->agent->platform(),
            "device_type" => $_SERVER['HTTP_USER_AGENT'],
            "ip_registration_first" => $this->input->ip_address()
          );

          $update = $this->facebook_login_model->Update_user_data($user_data, $email);

          if ($update) {
            // Session
            $alert = array(
              "title" => "İşlem başarılı",
              "text" => "$name $surname Hoşgeldiniz",
              "type" => "success"
            );

            /** Kullanıcı yetkilerini session a aktarıyoruz  */
            setUserRoles();
            /********************************  */

            $user = $this->user_model->get(
              array(
                "email" => $email
              )
            );

            $this->session->set_userdata("user", $user);
            $this->session->set_flashdata("alert", $alert);
            redirect(base_url());
          } else {
            // Hata
            $alert = array(
              "title" => "İşlem başarısız",
              "text" => "Lütfen giriş bilgilerinizi kontrol ediniz",
              "type" => "error"
            );

            $this->session->set_flashdata("alert", $alert);
            redirect(base_url("login"));
          }
        } else {
          //insert data
          $user_data = array(
            'login_oauth_uid' => $id,
            'name' => $name,
            'surname' => $surname,
            'email' => $email,
            "user_role" => '3',
            "isActive" => true,
            "last_device_ip" => $this->input->ip_address(),
            "browser" => $this->agent->browser(),
            "browser_version" => $this->agent->version(),
            "os" => $this->agent->platform(),
            "device_type" => $_SERVER['HTTP_USER_AGENT'],
            "ip_registration_first" => $this->input->ip_address(),
            "created_at" => date("Y-m-d H:i:s")
          );

          $insert = $this->facebook_login_model->Insert_user_data($user_data);

          if ($insert) {
            // Session
            $alert = array(
              "title" => "İşlem başarılı",
              "text" => "$name $surname Hoşgeldiniz",
              "type" => "success"
            );

            /** Kullanıcı yetkilerini session a aktarıyoruz  */
            setUserRoles();
            /********************************  */
            $user = $this->user_model->get(
              array(
                "email" => $email
              )
            );

            $this->session->set_userdata("user", $user);
            $this->session->set_flashdata("alert", $alert);
            redirect(base_url());
          } else {
            // Hata
            $alert = array(
              "title" => "İşlem başarısız",
              "text" => "Lütfen giriş bilgilerinizi kontrol ediniz",
              "type" => "error"
            );

            $this->session->set_flashdata("alert", $alert);
            redirect(base_url("login"));
          }
        }
      }
    }
  }
  /** Facebook Login End */
}

