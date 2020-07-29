<div role="tabpanel" class="tab-pane fade" id="tab-3">
  <div class="row">
    <div class="col-md-12">
      <div class="form-group">
        <label>Facebook Hesabınızın Kullanıcı Adı</label>
        <input class="form-control" placeholder="https://www.facebook.com/" name="social_media_facebook" type="text"
               value="<?= isset($form_error) ? set_value("social_media_facebook") : $items->social_media_facebook ?>">
      </div>
    </div>
    <div class="col-md-12">
      <div class="form-group">
        <label>Twitter Hesabınızın Kullanıcı Adı</label>
        <input class="form-control" placeholder="https://www.twitter.com/" name="social_media_twitter" type="text"
               value="<?= isset($form_error) ? set_value("social_media_twitter") : $items->social_media_twitter ?>">
      </div>
    </div>
    <div class="col-md-12">
      <div class="form-group">
        <label>Instagram Hesabınızın Kullanıcı Adı</label>
        <input class="form-control" placeholder="https://www.instagram.com/" name="social_media_instagram" type="text"
               value="<?= isset($form_error) ? set_value("social_media_instagram") : $items->social_media_instagram ?>">
      </div>
    </div>
    <div class="col-md-12">
      <div class="form-group">
        <label>Linkedin Hesabınızın Kullanıcı Adı</label>
        <input class="form-control" placeholder="https://www.linkedin.com/in/" name="social_media_linkedin" type="text"
               value="<?= isset($form_error) ? set_value("social_media_linkedin") : $items->social_media_linkedin ?>">
      </div>
    </div>
  </div>
</div>