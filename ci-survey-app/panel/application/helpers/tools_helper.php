<?php

function convertToSEO($text)
{
  $turkce = array("ç", "Ç", "ğ", "Ğ", "ü", "Ü", "ö", "Ö", "ı", "İ", "ş", "Ş", ".", ",", "!", "'", "\"", " ", "?", "*", "_", "|", "=", "(", ")", "[", "]", "{", "}");
  $convert = array("c", "c", "g", "g", "u", "u", "o", "o", "i", "i", "s", "s", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-");

  return strtolower(str_replace($turkce, $convert, $text));
}

function get_readable_date($date)
{
  return strftime('%e %B %Y', strtotime($date));
}

function get_active_user()
{
  $t = &get_instance();

  $user = $t->session->userdata("user");

  if ($user)
    return $user;
  else
    return false;
}

function isAdmin()
{
  $t = &get_instance();
  $user = $t->session->userdata("user");

  if ($user->user_role == "1")
    return true;
  else
    return false;
}

function get_user_roles()
{
  $t = &get_instance();
  return $t->session->userdata("user_roles");
}

function setUserRoles()
{
  $t = &get_instance();
  $t->load->model("user_role_model");
  $user_roles = $t->user_role_model->get_all(
    array(
      "isActive" => true
    )
  );

  $roles = array();
  foreach ($user_roles as $role) {
    $roles[$role->id] = $role->permissions;
  }
  $t->session->set_userdata("user_roles", $roles);
}

function getControllerList()
{
  $t = &get_instance();
  $controllers = array();

  $t->load->helper("file");
  $files = get_dir_file_info(APPPATH . "controllers", FALSE);

  foreach (array_keys($files) as $file) {
    if ($file !== "index.html") {
      $controllers[] = strtolower(str_replace(".php", "", $file));
    }
  }

  return $controllers;
}

function send_email($to_email = "", $subject = "", $message = "")
{
  $t = &get_instance();

  $t->load->model("emailsettings_model");

  $email_settings = $t->emailsettings_model->get(
    array(
      "isActive" => true
    )
  );

  $config = array(
    "protocol" => $email_settings->protocol,
    "smtp_host" => $email_settings->host,
    "smtp_port" => $email_settings->port,
    "smtp_user" => $email_settings->user,
    "smtp_pass" => $email_settings->password,
    "starttls" => true,
    "charset" => "utf-8",
    "mailtype" => "html",
    "wordwrap" => true,
    "newline" => "\r\n"
  );

  $t->load->library("email", $config);

  $t->email->from($email_settings->from, $email_settings->user_name);
  $t->email->to($to_email);
  $t->email->subject($subject);
  $t->email->message($message);
  return $t->email->send();
}

function get_settings()
{
  $t = &get_instance();
  $t->load->model("settings_model");

  if ($t->session->userdata("settings")) {
    $settings = $t->session->userdata("settings");
  } else {
    $settings = $t->settings_model->get();

    if (!$settings) {
      $settings = new stdClass();
      $settings->company_name = "Suare Soft";
      $settings->site_title = "default";
      $settings->logo = "default";
    }

//    $t->session->set_userdata("settings", $settings);

  }

  return $settings;
}

function return_email_html($reset_password_link)
{
  $html = "<!DOCTYPE html><html><head> <meta charset=\"utf-8\"> <meta http-equiv=\"x-ua-compatible\" content=\"ie=edge\"> <title>Password Reset</title> <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\"> <style type=\"text/css\"> /** * Google webfonts. Recommended to include the .woff version for cross-client compatibility. */ @media screen { @font-face { font-family: 'Source Sans Pro'; font-style: normal; font-weight: 400; src: local('Source Sans Pro Regular'), local('SourceSansPro-Regular'), url(https://fonts.gstatic.com/s/sourcesanspro/v10/ODelI1aHBYDBqgeIAH2zlBM0YzuT7MdOe03otPbuUS0.woff) format('woff'); } @font-face { font-family: 'Source Sans Pro'; font-style: normal; font-weight: 700; src: local('Source Sans Pro Bold'), local('SourceSansPro-Bold'), url(https://fonts.gstatic.com/s/sourcesanspro/v10/toadOcfmlt9b38dHJxOBGFkQc6VGVFSmCnC_l7QZG60.woff) format('woff'); } } /** * Avoid browser level font resizing. * 1. Windows Mobile * 2. iOS / OSX */ body, table, td, a { -ms-text-size-adjust: 100%; /* 1 */ -webkit-text-size-adjust: 100%; /* 2 */ } /** * Remove extra space added to tables and cells in Outlook. */ table, td { mso-table-rspace: 0pt; mso-table-lspace: 0pt; } /** * Better fluid images in Internet Explorer. */ img { -ms-interpolation-mode: bicubic; } /** * Remove blue links for iOS devices. */ a[x-apple-data-detectors] { font-family: inherit !important; font-size: inherit !important; font-weight: inherit !important; line-height: inherit !important; color: inherit !important; text-decoration: none !important; } /** * Fix centering issues in Android 4.4. */ div[style*=\"margin: 16px 0;\"] { margin: 0 !important; } body { width: 100% !important; height: 100% !important; padding: 0 !important; margin: 0 !important; } /** * Collapse table borders to avoid space between cells. */ table { border-collapse: collapse !important; } a { color: #1a82e2; } img { height: auto; line-height: 100%; text-decoration: none; border: 0; outline: none; } </style></head><body style=\"background-color: #e9ecef;\"> <!-- start preheader --> <div class=\"preheader\" style=\"display: none; max-width: 0; max-height: 0; overflow: hidden; font-size: 1px; line-height: 1px; color: #fff; opacity: 0;\"> A preheader is the short summary text that follows the subject line when an email is viewed in the inbox. </div> <!-- end preheader --> <!-- start body --> <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\"> <!-- start logo --> <tr> <td align=\"center\" bgcolor=\"#e9ecef\"> <!--[if (gte mso 9)|(IE)]> <table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"600\"> <tr> <td align=\"center\" valign=\"top\" width=\"600\"> <![endif]--> <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" style=\"max-width: 600px;\"> <tr> <td align=\"center\" valign=\"top\" style=\"padding: 36px 24px;\"> <a href=\"https://www.suaresoft.com\" target=\"_blank\" style=\"display: inline-block;\"> <img src=\"https://www.suaresoft.com/wp-content/uploads/2019/03/Ba%C5%9Fl%C4%B1ks%C4%B1z-1-1.png\" alt=\"Logo\" border=\"0\" width=\"70\" style=\"display: block; width: 70px; max-width: 70px; min-width: 70px;\"> </a> </td> </tr> </table> <!--[if (gte mso 9)|(IE)]> </td> </tr> </table> <![endif]--> </td> </tr> <!-- end logo --> <!-- start hero --> <tr> <td align=\"center\" bgcolor=\"#e9ecef\"> <!--[if (gte mso 9)|(IE)]> <table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"600\"> <tr> <td align=\"center\" valign=\"top\" width=\"600\"> <![endif]--> <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" style=\"max-width: 600px;\"> <tr> <td align=\"left\" bgcolor=\"#ffffff\" style=\"padding: 36px 24px 0; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; border-top: 3px solid #d4dadf;\"> <h1 style=\"margin: 0; font-size: 32px; font-weight: 700; letter-spacing: -1px; line-height: 48px;\">Şifrenizi Sıfırlayın</h1> </td> </tr> </table> <!--[if (gte mso 9)|(IE)]> </td> </tr> </table> <![endif]--> </td> </tr> <!-- end hero --> <!-- start copy block --> <tr> <td align=\"center\" bgcolor=\"#e9ecef\"> <!--[if (gte mso 9)|(IE)]> <table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"600\"> <tr> <td align=\"center\" valign=\"top\" width=\"600\"> <![endif]--> <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" style=\"max-width: 600px;\"> <!-- start copy --> <tr> <td align=\"left\" bgcolor=\"#ffffff\" style=\"padding: 24px; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px;\"> <p style=\"margin: 0;\"> Müşteri hesabı şifrenizi sıfırlamak için aşağıdaki düğmeye dokunun. Yeni bir şifre istemediyseniz, bu e-postayı güvenle silebilirsiniz. </p> </td> </tr> <!-- end copy --> <!-- start button --> <tr> <td align=\"left\" bgcolor=\"#ffffff\"> <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\"> <tr> <td align=\"center\" bgcolor=\"#ffffff\" style=\"padding: 12px;\"> <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\"> <tr> <td align=\"center\" bgcolor=\"#1a82e2\" style=\"border-radius: 6px;\"> <a href=\"{$reset_password_link}\" target=\"_blank\" style=\"display: inline-block; padding: 16px 36px; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px; color: #ffffff; text-decoration: none; border-radius: 6px;\"> Şifremi Değiştir </a> </td> </tr> </table> </td> </tr> </table> </td> </tr> <!-- end button --> <!-- start copy --> <tr> <td align=\"left\" bgcolor=\"#ffffff\" style=\"padding: 24px; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px;\"> <p style=\"margin: 0;\">Bu işe yaramazsa, aşağıdaki bağlantıyı kopyalayıp tarayıcınıza yapıştırın:</p> <p style=\"margin: 0;\"> <a href=\"{$reset_password_link}\" target=\"_blank\"> {$reset_password_link} </a> </p> </td> </tr> <!-- end copy --> </table> <!--[if (gte mso 9)|(IE)]> </td> </tr> </table> <![endif]--> </td> </tr> <!-- end copy block --> </table> <!-- end body --></body></html>";

  return $html;
}

