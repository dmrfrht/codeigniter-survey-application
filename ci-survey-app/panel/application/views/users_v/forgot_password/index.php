<!DOCTYPE html>
<html lang="tr">
<head>
  <?php $this->load->view("includes/head"); ?>
  <?php $this->load->view("{$viewFolder}/{$subViewFolder}/pages_style"); ?>
</head>

<body class="simple-page">

<?php $this->load->view("{$viewFolder}/{$subViewFolder}/content") ?>

<script src="<?= base_url("assets") ?>/assets/js/iziToast.min.js"></script>
<?php $this->load->view("includes/alert") ?>
</body>
</html>