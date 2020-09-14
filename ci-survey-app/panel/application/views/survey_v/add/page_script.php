<script>
  $(function () {
    $('.question-right-side').on('click', '.add-question', function (e) {
      console.log("soru Ekle")

      e.preventDefault();
    });

    $('.question').on('change', '.option_types', function () {
      // Select Option Her Değiştiğinde O Sorunun Tipini Dinamik Olarak Değiştirmem Lazım
      // Aynı Zamanda Sorunun Şıklarınıda Değiştirmeliyim -> Görünüm olarak

      var $data_url = $(this).data("url");
      var $data = this.value;

      $.post($data_url, {data: $data}, function (res) {
      })
    });

    $('.question').on('keyup', '.question-input', function () {
      var $data_url = $(this).data("url");
      var $data = this.value;

      $.post($data_url, {data: $data}, function (res) {
      })
    });

    $('.question').on('change', '.switch-3-3', function () {
      var $data_url = $(this).data("url");
      var $data = $(this).prop("checked");

      $.post($data_url, {data: $data}, function (res) {
      })
    });

    $(".survey-details").on("sortupdate", ".sortable", function (event, ui) {
      var $data = $(this).sortable("serialize");
      var $data_url = $(this).data("url");

      $.post($data_url, {data: $data}, function (res) {
        console.log(res)
      })
    });

  });
</script>