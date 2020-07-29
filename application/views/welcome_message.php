<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <title>Survey App</title>
</head>
<body>


<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Survey Application</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
          aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="#">Ana Sayfa <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown"
           aria-haspopup="true" aria-expanded="false">
          Panel
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="<?= base_url("bireysel-kayit-ol")  ?>">Bireysel Kayıt</a>
          <a class="dropdown-item" href="<?= base_url("firma-kayit-ol")  ?>">Firma Kaydı</a>
        </div>
      </li>
      <li class="nav-item active">
        <a class="dropdown-item" href="http://hobibank.com/ci-survey-app/panel/">Giriş Yap</a>
      </li>
    </ul>
  </div>
</nav>

<h1>Survey Application</h1>
<h2>Survey Application</h2>
<h3>Survey Application</h3>
<h4>Survey Application</h4>
<h5>Survey Application</h5>
<h6>Survey Application</h6>

<h1 style="text-align: center; font-size: 100px;">SuareSoft Corporation</h1>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

</body>
</html>