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
  <div class="collapse navbar-collapse d-flex justify-content-end" id="navbarNavDropdown">
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
          <a class="dropdown-item" href="<?= base_url("bireysel-kayit-ol") ?>">Bireysel Kayıt</a>
          <a class="dropdown-item" href="<?= base_url("firma-kayit-ol") ?>">Firma Kaydı</a>
        </div>
      </li>
      <li class="nav-item active">
        <a class="dropdown-item" href="http://anketofis.com/ci-survey-app/panel/">Giriş Yap</a>
      </li>
    </ul>
  </div>
</nav>

<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img
        src="https://odevcim.com/wp-content/uploads/2020/01/Veri-Analizi-Data-Analysis-Yapt%C4%B1rma-Spss-Eviews-Stata-Gretl-Minitab-Gauss-R.png"
        class="d-block" width="100%" height="450px" alt="...">
    </div>
    <div class="carousel-item">
      <img src="https://getthematic.com/insights/content/images/wordpress/2019/01/shutterstock_1112175710-1.jpg"
           class="d-block" width="100%" height="450px" alt="...">
    </div>
    <div class="carousel-item">
      <img src="https://i.pinimg.com/originals/6f/a6/2f/6fa62f316d155c5f56a9ca283cd06741.png" class="d-block"
           width="100%" height="450px" alt="...">
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

</body>
</html>