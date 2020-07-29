<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <title>Kayıt Ol</title>
</head>
<body>


<h1 class="text-center">Firma Kayıt Formu</h1>

<form action="<?= base_url("firma-kayit-et") ?>" method="post">
  <div class="container">
    <div class="row">
      <div class="col-md-4 border border-primary p-3">
        <h3 class="text-center">Kişisel Bilgiler</h3>
        <div class="form-group">
          <label>Ad</label>
          <input type="text" class="form-control" name="name">
        </div>

        <div class="form-group">
          <label>Soyad</label>
          <input type="text" class="form-control" name="surname">
        </div>

        <div class="form-group">
          <label>E-posta</label>
          <input type="email" class="form-control" name="email">
        </div>

        <div class="form-group">
          <label>Telefon Numarası</label>
          <input type="text" class="form-control" name="mobile_phone" maxlength="10">
        </div>

        <div class="form-group">
          <label>Şifre</label>
          <input type="password" class="form-control" name="password">
        </div>

        <div class="form-group">
          <label>Şifre Tekrar</label>
          <input type="password" class="form-control" name="re_password">
        </div>

        <!-- Gizli Soru 1 ve Cevap  -->
<!--        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Gizli Soru 1</label>
              <select name="secret_question_1_id" class="form-control">
                <?php /*foreach ($secretQuestions as $secretQuestion): */?>
                  <option value="<?/*= $secretQuestion->id */?>"><?/*= $secretQuestion->secret_question */?></option>
                <?php /*endforeach; */?>
              </select>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Gizli Soru 1 Cevap</label>
              <input type="text" class="form-control" name="secret_question_1_answer">
            </div>
          </div>
        </div>-->

        <!-- Gizli Soru 2 ve Cevap  -->
        <!--<div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Gizli Soru 2</label>
              <select name="secret_question_2_id" class="form-control">
                <?php /*foreach ($secretQuestions as $secretQuestion): */?>
                  <option value="<?/*= $secretQuestion->id */?>"><?/*= $secretQuestion->secret_question */?></option>
                <?php /*endforeach; */?>
              </select>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Gizli Soru 2 Cevap</label>
              <input type="text" class="form-control" name="secret_question_2_answer">
            </div>
          </div>
        </div>-->
      </div>
      <div class="col-md-8 border border-success p-3">
        <h3 class="text-center">Firma Bilgileri</h3>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Firma Adı</label>
              <input type="text" class="form-control" name="company_title">
            </div>

            <div class="form-group">
              <label>Vergi Numarası</label>
              <input type="text" class="form-control" name="tax_number">
            </div>

            <div class="form-group">
              <label>Açık Adres</label>
              <textarea name="open_address" class="form-control"></textarea>
            </div>

            <div class="form-group">
              <label>İl</label>
              <input type="text" class="form-control" name="province">
            </div>

            <div class="form-group">
              <label>İlçe</label>
              <input type="text" class="form-control" name="district">
            </div>

            <div class="form-group">
              <label>Ülke</label>
              <input type="text" class="form-control" name="country">
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Firma Telefonu</label>
              <input type="text" class="form-control" name="company_phone" maxlength="10">
            </div>

            <div class="form-group">
              <label>Firma Cep Telefonu</label>
              <input type="text" class="form-control" name="company_cell_phone" maxlength="10">
            </div>

            <div class="form-group">
              <label>Firma E-posta</label>
              <input type="text" class="form-control" name="company_email">
            </div>

            <div class="form-group">
              <label>Firma Website</label>
              <input type="text" class="form-control" name="company_website">
            </div>

            <!--<div class="form-group">
              <label>Çalıştırılan Personel Aralığı</label>
              <div class="form-group">
                <select class="form-control" name="number_staff_employed">
                  <option value="1-50">1-50</option>
                  <option value="51-100">51-100</option>
                  <option value="101-200">101-200</option>
                  <option value="201-300">201-300</option>
                  <option value="301-400">301-400</option>
                  <option value="401-500">401-500</option>
                </select>
              </div>
            </div>-->
            <button type="submit" class="btn btn-primary float-right btn-lg mt-5">Kayıt Ol</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</form>


<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</body>
</html>