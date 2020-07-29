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

<form action="<?= base_url("bireysel-kayit-et") ?>" method="post" class="p-4">
  <div class="container">
    <div class="row">
      <div class="col-md-2"></div>

      <div class="col-md-8">
        <h1 class="text-center">Bireysel Kayıt Formu</h1>
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

        <!-- Gizli Soru 1 ve Cevap  -->
<!--        <div class="row">
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

        <button type="submit" class="btn btn-primary float-right btn-lg">Kayıt Ol</button>
      </div>

      <div class="col-md-2"></div>
    </div>
  </div>
</form>


<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</body>
</html>