<div class="row survey-details">
  <div class="col-md-12">
    <h4 class="m-b-lg">
      Yeni Anket Ekle
    </h4>
  </div>

  <form action="<?= base_url("surveys/save") ?>" method="post" class="">


    <div class="col-md-12">
      <div class="col-md-3"></div>
      <div class="col-md-6">
        <div class="widget" style="border-radius: 7px;">
          <div class="widget-body">

            <div class="form-group">
              <div class="row">
                <div class="col-md-12">
                  <input type="text" class="form-control" placeholder="Anket Başlığı" name="title">
                </div>
              </div>

              <?php if (isset($form_error)): ?>
                <small class="pull-right input-form-error"><?= form_error("title") ?></small>
              <?php endif; ?>
            </div>

            <div class="form-group">
              <div class="row">
                <div class="col-md-12">
                  <input type="text" class="form-control" placeholder="Anket Açıklaması" name="description">
                </div>
              </div>

              <?php if (isset($form_error)): ?>
                <small class="pull-right input-form-error"><?= form_error("description") ?></small>
              <?php endif; ?>
            </div>


          </div>
        </div>
      </div>
      <div class="col-md-3"></div>
    </div>

    <div id="questions" class="sortable" data-url="<?= base_url("surveys/questionRankSetter") ?>">
      <?php foreach ($questions as $question): ?>
        <div class="col-md-12 question" id="ord-<?= $question->id ?>">
          <!-- question start -->
          <div class="col-md-12">
            <div class="col-md-3"></div>
            <div class="col-md-6">
              <div class="widget" style="border-radius: 7px;">
                <div class="widget-body">
                  <div class="form-group">
                    <div class="row">
                      <div class="col-md-6">
                        <input
                          type="text"
                          class="form-control question-input"
                          placeholder="Soru" name="title"
                          data-url="<?= base_url("surveys/addQuestionTitle/$question->id") ?>"
                          value="<?= $question->title ?>"
                        >
                      </div>
                      <div class="col-md-5">
                        <select name="option_types" class="form-control option_types"
                                data-url="<?= base_url("surveys/changeToOptionType/$question->id") ?>">
                          <option value="">Soru Tipi</option>
                          <?php foreach ($option_types as $option_type): ?>
                            <option
                              <?= ($option_type->id == $question->option_type) ? ' selected' : null ?>
                              value="<?= $option_type->id ?>">
                              <?= $option_type->type_text ?>
                            </option>
                          <?php endforeach; ?>
                        </select>
                      </div>

                      <div class="col-md-1" style="display: flex; flex-direction: row; justify-content: space-around;">
                        <a style="" title="Resim Ekle" href=""><i class="fa fa-image fa-2x"></i></a>
                      </div>
                    </div>
                  </div>

                  <!-- option checkbox  start -->
                  <div class="form-group option">
                    <div class="row">
                      <div class="col-md-1"
                           style="display: flex; flex-direction: row; justify-content: center; align-items: center;">
                        <a href="" class=""><i class="fa fa-bars fa-2x"></i> </a>
                      </div>
                      <div class="col-md-9">
                        <input type="text" class="form-control">
                      </div>
                      <div class="col-md-2" style="display: flex; flex-direction: row; justify-content: space-around;">
                        <a style="" title="Kaldır" href=""><i class="fa fa-close fa-2x"></i></a>
                        <a style="" title="Resim Ekle" href=""><i class="fa fa-image fa-2x"></i></a>
                      </div>
                    </div>
                  </div>
                  <!-- option checkbox  end -->

                  <!-- other option start -->
                  <div class="form-group">
                    <div class="row">
                      <div class="col-md-10">
                        <a data-url="<?= base_url("surveys/addToCheckboxOption/") ?>"
                           class="add-checkbox-option">Seçenek ekle</a> veya <a href="" class="">"Diğer" seçeneği
                          ekle</a>
                      </div>
                    </div>
                  </div>

                  <div class="form-group other-option-container">
                    <div class="row">
                      <div class="col-md-10">
                        <input type="text" class="form-control">
                      </div>
                      <div class="col-md-2" style="display: flex; flex-direction: row; justify-content: space-around;">
                        <a style="" title="Kaldır" href=""><i class="fa fa-close fa-2x"></i></a>
                      </div>
                    </div>
                  </div>
                  <!-- other option end -->


                  <hr>

                  <div class="form-group alt-footer"
                       style="display:flex; flex-direction: row; justify-content: flex-end; align-items: center; text-align: center;">
                    <a title="Sil"><i class="fa fa-trash fa-2x"></i></a>
                    <span class="required">
                  <label for="switch-3-3">Zorunlu</label>
                </span>
                    <input
                      data-url="<?= base_url("surveys/isQuestionRequired/$question->id") ?>"
                      class="switch-3-3"
                      type="checkbox"
                      data-switchery
                      data-size="small"
                      data-color="#188ae2"
                      <?= $question->required ? ' checked' : null ?>
                    />
                  </div>

                </div>
              </div>
            </div>
            <div class="col-md-3 question-right-side"
                 style="display: flex; flex-direction: column; width: 50px; background: #fff;">
              <a class="add-question" data-url="<?= base_url("surveys/addNewQuestion/$question->survey_url")  ?>"
                 style="margin-bottom: 10px; margin-left: 3px; margin-top: 10px;" title="Soru Ekle"
                 href=""><i class="fa fa-plus fa-2x"></i>
              </a>
              <a style="margin-bottom: 10px;" href=""><i class="fa fa-align-justify fa-2x"></i></a>
            </div>
          </div>
          <!-- question end -->
        </div>
      <?php endforeach; ?>
    </div>

    <div class="col-md-12">
      <div class="col-md-3"></div>
      <div class="col-md-6">
        <div class="widget">
          <div class="widget-body">
            <button type="submit" class="btn btn-primary btn-md btn-outline">Önizle</button>
            <a href="<?= base_url("surveys") ?>" class="btn btn-md btn-danger btn-outline">İptal</a>
          </div>
        </div>
      </div>
    </div>

  </form>
</div>


