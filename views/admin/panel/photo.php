<?php
/**
 * @var $modelPhoto \app\models\form\PhotoForm
 * @var $photos \app\models\Photo
 */

use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
use app\models\Photo;
use yii\widgets\LinkPager;

include Yii::$app->getBasePath() . '/views/components/admin-menu.php'
?>
<h2>Фото портфолио</h2>
<div class="row">
    <div class="col-md-4 photo-form">
        <h4>Добавить фотографию в портфолио</h4>
        <a href="<?= Url::to(['photo/add']) ?>"><?= Html::submitButton('Добавить фотографии', ['class' => 'btn btn-success']); ?></a>
    </div>
    <div class="col-md-8" style="padding-top: 10px">
        <h4 style="margin: auto">Карточки фотографий</h4>
        <div class="row items-card">
            <?php foreach ($photos as $key => $photo): ?>
                <div class="col-md-12 row card-item" data-id="<?= $photo->id ?>">
                    <? $form = ActiveForm::begin(['action' => '/photo/' . $photo->id . '/edit', 'method' => 'post']); ?>
                    <div class="col-md-5 portfolio admin">
                        <div class="picture-button button" data-id="<?= $key ?>">
                            <img class="photo" src="<?= $photo->picture ?>" alt="<?= $photo->title ?>">
                        </div>
                        <div class="mini-menu-update" data-picture="<?= $key ?>">
                            <div class="button">
                                <?= $form->field($modelPhoto, 'file')->fileInput(['class' => 'picture-file', 'id' => 'photoForm-file' . $photo->id, 'placeholder' => 'Изменить']); ?>
                            </div>

                            <div class="button delete" id="<?= $photo->id ?>">
                                Удалить
                            </div>
                        </div>
                        <div>
                            Направление:
                            <?= $photo->getDirectionRus() ?>
                        </div>
                    </div>
                    <div class="col-md-7 card-data">
                        <?= $form->field($modelPhoto, 'title')->textarea(['class' => 'title-text', 'data-content' => $photo->title, 'value' => $photo->title]); ?>
                        <?= $form->field($modelPhoto, 'description')->textarea(['class' => 'description-text', 'data-content' => $photo->description, 'value' => $photo->description]); ?>
                        <div class="row place-button">
                            <div class="col-sm-6"><?= $photo->updated_at ?></div>
                            <div class="col-sm-6 update">
                                <div class="item-button">
                                    <?= Html::submitButton('Изменить', ['class' => 'btn btn-success']) ?>
                                    <?php ActiveForm::end(); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
            <?php endforeach; ?>
            <?= LinkPager::widget([
                'pagination' => $pages,
            ]); ?>
        </div>
    </div>
</div>


<script>
    $(document).ready(function () {

        //Menu-photo toggle
        $(document).on('click', function (e) {
            if ((e.target).closest('.picture-button')) {
                var idPicture = $(e.target).closest('.picture-button').data('id');
                var pictures = $('.mini-menu-update');
                $.each(pictures, function () {
                    if ($(this).data('picture') == idPicture) {
                        $(this).toggleClass('active');
                    }
                });
            } else if ($('.mini-menu-update').hasClass('active')) {
                $('.mini-menu-update').removeClass('active');
            }
        });

        //Update card item
        $('form').submit(function (e) {
            e.preventDefault();
            $.ajax({
                method: $(this).attr('method'),
                url: $(this).attr('action'),
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function (data) {
                    var model = JSON.parse(data);
                    updateCard(model);
                }
            });
        });

        //Update data card
        function updateCard(model) {
            var item_card = $('.card-item[data-id=' + model.id + ']');
            item_card.find('img.photo').attr('src', model.picture);
            item_card.find('img.photo').attr('alt', model.title);
        }

        //Delete photo
        $('.delete').on('click', function () {
            var id = this.id;
            console.log(id);
            if (confirm("Вы действитель хотите удалить фото?")) {
                $.ajax({
                    method: 'get',
                    url: '/photo/' + id + '/delete',
                    success: function (data) {
                        alert(data);
                    }
                });
            }

        });
    });
</script>