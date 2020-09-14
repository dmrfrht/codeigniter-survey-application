<?php

class Surveys extends MY_Controller
{
  public $viewFolder = "";

  public function __construct()
  {
    parent::__construct();
    $this->viewFolder = "survey_v";
    $this->load->model("survey_model");
    $this->load->model("question_model");
    $this->load->model("option_types_model");


    $this->load->model("product_image_model");
    $this->load->helper('string');

    if (!get_active_user()) { // Buradan geçmesi lazım bu controllera ulaşması için->ilk olarak construct cagrıldıgı ıcın burada yazdım
      redirect(base_url("login"));
    }
  }

  public function index()
  {
    $viewData = new stdClass();

    /** Tablodan verileri çekme  */
    $items = $this->survey_model->get_all();

    $unique_id = random_string('alnum', 30);

    /** View a gönderilecek değişkenler */
    $viewData->viewFolder = $this->viewFolder;
    $viewData->subViewFolder = "list";
    $viewData->items = $items;
    $viewData->unique_id = $unique_id;

    $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
  }

  public function new_form($unique_id)
  {
    if (!isAllowedWriteModule()) {
      redirect(base_url("surveys"));
    }

    $url = base_url('/anket/u/' . $unique_id);

    $pageWasRefreshed = isset($_SERVER['HTTP_CACHE_CONTROL']) && $_SERVER['HTTP_CACHE_CONTROL'] === 'max-age=0';

    if ($pageWasRefreshed) {
      //do something because page was refreshed;
      $this->survey_model->update(array("unique_url" => $url), array("unique_url" => $url));
      $this->question_model->update(array("survey_url" => $url), array("survey_url" => $url));
    } else {
      //do nothing;
      $this->survey_model->add(array("unique_url" => $url, "isActive" => true, "created_at" => Date('Y-m-d H:i:s')));
      $this->question_model->add(array("survey_url" => $url, "rank" => 0));
    }

    $questions = $this->question_model->get_all(array("survey_url" => $url), "rank ASC");
    $option_types = $this->option_types_model->get_all(array());

    $viewData = new stdClass();
    /** View a gönderilecek değişkenler */
    $viewData->viewFolder = $this->viewFolder;
    $viewData->subViewFolder = "add";
    $viewData->questions = $questions;

    $viewData->option_types = $option_types;

    $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
  }

  public function save()
  {
    if (!isAllowedWriteModule()) {
      redirect(base_url("product"));
    }

    $this->load->library("form_validation");
    $this->form_validation->set_rules("title", "Başlık", "required|trim");
    $this->form_validation->set_message(
      array(
        "required" => "{field} alanı doldurulmalıdır"
      )
    );

    $validate = $this->form_validation->run();

    if ($validate) {
      $insert = $this->survey_model->add(
        array(
          "title" => $this->input->post("title"),
          "description" => $this->input->post("description"),
          "url" => convertToSEO($this->input->post("title")),
          "rank" => 0,
          "isActive" => true,
          "createdAt" => date("Y-m-d H:i:s")
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
      redirect(base_url("product"));
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
      redirect(base_url("product"));
    }

    $viewData = new stdClass();

    /** Tablodan verileri çekme  */
    $item = $this->survey_model->get(
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
      redirect(base_url("product"));
    }

    $this->load->library("form_validation");
    $this->form_validation->set_rules("title", "Başlık", "required|trim");
    $this->form_validation->set_message(
      array(
        "required" => "{field} alanı doldurulmalıdır"
      )
    );

    $validate = $this->form_validation->run();

    if ($validate) {
      $update = $this->survey_model->update(
        array(
          "id" => $id
        ),
        array(
          "title" => $this->input->post("title"),
          "description" => $this->input->post("description"),
          "url" => convertToSEO($this->input->post("title")),
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
      redirect(base_url("product"));
    } else {
      $viewData = new stdClass();

      /** Tablodan verileri çekme  */
      $item = $this->survey_model->get(
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
      redirect(base_url("product"));
    }

    $delete = $this->survey_model->delete(
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
    redirect(base_url("surveys"));
  }

  public function image_delete($id, $parent_id)
  {
    $file_name = $this->product_image_model->get(
      array(
        "id" => $id
      )
    );

    $delete = $this->product_image_model->delete(
      array(
        "id" => $id
      )
    );

    // TODO Alert Sistemi Eklenecek !!!!!!!!!!!!!!!!!!!!
    if ($delete) {
      unlink("uploads/{$this->viewFolder}/$file_name->img_url");

      $alert = array(
        "title" => "İşlem Başarılı",
        "text" => "Resim Başarılı Bir Şekilde Silindi",
        "type" => "success"
      );
    } else {
      $alert = array(
        "title" => "İşlem Başarısız",
        "text" => "Resim Silinirken Bir Sorun Oluştu",
        "type" => "error"
      );
    }
    $this->session->set_flashdata("alert", $alert);
    redirect(base_url("product/image_form/$parent_id"));
  }

  public function isActiveSetter($id)
  {
    if (!isAllowedUpdateModule()) {
      die();
    }

    if ($id) {
      $isActive = ($this->input->post("data") === "true") ? 1 : 0;

      $this->survey_model->update(
        array(
          "id" => $id
        ),
        array(
          "isActive" => $isActive
        )
      );

    }
  }

  public function imageIsActiveSetter($id)
  {
    if ($id) {
      $isActive = ($this->input->post("data") === "true") ? 1 : 0;

      $this->product_image_model->update(
        array(
          "id" => $id
        ),
        array(
          "isActive" => $isActive
        )
      );

    }
  }

  public function isCoverSetter($id, $parent_id)
  {
    if ($id && $parent_id) {
      $isCover = ($this->input->post("data") === "true") ? 1 : 0;

      /** Kapak Yapılmak İstenene Resim */
      $this->product_image_model->update(
        array(
          "id" => $id,
          "product_id" => $parent_id
        ),
        array(
          "isCover" => $isCover
        )
      );

      /** Kapak Yapılmayan Diğer Kayıtlar */
      $this->product_image_model->update(
        array(
          "id !=" => $id,
          "product_id" => $parent_id
        ),
        array(
          "isCover" => 0
        )
      );

      $viewData = new stdClass();

      $item_images = $this->product_image_model->get_all(
        array(
          "product_id" => $parent_id
        ), "rank ASC"
      );

      /** View a gönderilecek değişkenler */
      $viewData->viewFolder = $this->viewFolder;
      $viewData->subViewFolder = "image";
      $viewData->item_images = $item_images;

      $render_html = $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/render_elements/image_list_v", $viewData, true);
      echo $render_html;

    }
  }

  public function rankSetter()
  {
    if (!isAllowedUpdateModule()) {
      die();
    }

    $data = $this->input->post("data");

    parse_str($data, $order);
    $items = $order["ord"];

    foreach ($items as $rank => $id) {
      $this->survey_model->update(
        array(
          "id" => $id,
          "rank !=" => $rank
        ),
        array(
          "rank" => $rank
        )
      );
    }

  }

  public function imageRankSetter()
  {
    $data = $this->input->post("data");

    parse_str($data, $order);
    $items = $order["ord"];

    foreach ($items as $rank => $id) {
      $this->product_image_model->update(
        array(
          "id" => $id,
          "rank !=" => $rank
        ),
        array(
          "rank" => $rank
        )
      );
    }

  }

  public function image_form($id)
  {
    $viewData = new stdClass();

    /** Tablodan verileri çekme  */
    $item = $this->survey_model->get(
      array(
        "id" => $id
      )
    );

    $item_images = $this->product_image_model->get_all(
      array(
        "product_id" => $id
      ), "rank ASC"
    );

    /** View a gönderilecek değişkenler */
    $viewData->viewFolder = $this->viewFolder;
    $viewData->subViewFolder = "image";
    $viewData->item = $item;
    $viewData->item_images = $item_images;

    $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
  }

  public function image_upload($id)
  {
    $file_name = convertToSEO(pathinfo($_FILES["file"]["name"], PATHINFO_FILENAME)) . '.' . pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION);

    $config["allowed_types"] = "jpg|jpeg|png";
    $config["upload_path"] = "uploads/$this->viewFolder/";
    $config["file_name"] = $file_name;

    $this->load->library("upload", $config);
    $upload = $this->upload->do_upload("file");

    if ($upload) {
      $uploaded_file = $this->upload->data("file_name");

      $this->product_image_model->add(
        array(
          "img_url" => $uploaded_file,
          "rank" => false,
          "isActive" => true,
          "createdAt" => date('Y-m-d h:i:s'),
          "product_id" => $id,
          "isCover" => false
        )
      );

    } else {
      echo 'islem basarısız';
    }

  }

  public function refresh_image_list($id)
  {
    $viewData = new stdClass();

    $item_images = $this->product_image_model->get_all(
      array(
        "product_id" => $id
      )
    );

    /** View a gönderilecek değişkenler */
    $viewData->viewFolder = $this->viewFolder;
    $viewData->subViewFolder = "image";
    $viewData->item_images = $item_images;

    $render_html = $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/render_elements/image_list_v", $viewData, true);
    echo $render_html;
  }

  public function aa()
  {
    echo 'selamke';
  }

  /** Questions Tablosu start  */
  public function changeToOptionType($id)
  {
    // Questions tablosunda option_type kolonunu guncellıcem
    $data = $this->input->post("data");

    $this->question_model->update(
      array(
        "id" => $id
      ),
      array(
        "option_type" => $data
      )
    );
  }

  public function addQuestionTitle($id)
  {
    // Questions tablosundaki title kolonunu anlık güncellicem
    $data = $this->input->post("data");

    $this->question_model->update(
      array(
        "id" => $id
      ),
      array(
        "title" => $data
      )
    );
  }

  public function isQuestionRequired($id)
  {
    // Question tablosundaki required kolonunu güncellicem
    if ($id) {
      $isRequired = ($this->input->post("data") === "true") ? 1 : 0;

      $this->question_model->update(
        array(
          "id" => $id
        ),
        array(
          "required" => $isRequired
        )
      );

    }
  }

  public function questionRankSetter()
  {
    $data = $this->input->post("data");

    parse_str($data, $order);
    $items = $order["ord"];

    foreach ($items as $rank => $id) {
      $this->question_model->update(
        array(
          "id" => $id,
          "rank !=" => $rank
        ),
        array(
          "rank" => $rank
        )
      );
    }
  }

  public function addNewQuestion($url)
  {
    echo $url;
  }

  /** Questions Tablosu end  */
}
