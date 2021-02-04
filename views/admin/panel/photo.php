<?php
/**
 * @var $modelPhoto \app\models\form\PhotoForm
 * @var $photos \app\models\Photo[]
 * @var $albums \app\models\AlbumPhotoPortfolio[]
 */

use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
use app\models\Photo;
use yii\widgets\LinkPager;

include Yii::$app->getBasePath() . '/views/components/admin-menu.php'
?>
<h2>Фото портфолио</h2>
<section>
    <div class="row">
        <div class="col-md-6">
            <a href="<?= Url::to(['album-photo-portfolio/add']) ?>">
                <?= Html::submitButton('Добавить альбом', ['class' => 'btn btn-success']); ?>
            </a>
        </div>
        <div class="col-md-6">
            <a href="<?= Url::to(['photo/add']) ?>">
                <?= Html::submitButton('Добавить фотографии', ['class' => 'btn btn-success']); ?>
            </a>
        </div>
    </div>
</section>
<section>
    <div class="row">
        <div class="col-md-6 photo-form">
            <!--    ALBUM COLUMN    -->
            <h4 style="text-align: center">Альбомы</h4>
            <div class="image_flex albums">
                <?php foreach ($albums as $album): ?>
                    <div class="<?= ($album->hidden == 'true') ? 'opacity' : '' ?>"
                         ondragover="allowDrow(event)"
                         ondrop="drop(event, this)"
                         data-id="<?= $album->id ?>">
                        <a href="<?= Url::to(['album-photo-portfolio/' . $album->id . '/edit']); ?>">
                            <div class="item column border-1 shadow scale">
                                <div class="image_box">
                                    <img class="album_img" src="<?= $album->cover ?: '/image/file.png' ?>"
                                         alt="<?= $album->title ?>">
                                </div>
                                <div class="description_item albums">
                                    <?= $album->title ?>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="col-md-6" style="padding-top: 10px">
            <!--    PHOTO COLUMN    -->
            <h4 style="margin: auto">Не распределенные фотографии</h4>
            <div class="row items">
                <?php foreach ($photos as $key => $photo): ?>
                    <div class="card-item" draggable="true" ondragstart="drag(event ,this)" data-id="<?= $photo->id ?>">
                        <? $form = ActiveForm::begin(['action' => '/photo/' . $photo->id . '/edit', 'method' => 'post']); ?>
                        <div class="item column align-center portfolio admin shadow radius">
                            <div class="picture-button button" data-id="<?= $key ?>">
                                <img draggable="false" class="photo" src="<?= $photo->picture ?>" alt="">
                            </div>

                            <div class="mini-menu-update" data-picture="<?= $key ?>">
                                <div class="button">
                                    <?= $form->field($modelPhoto, 'file')
                                        ->fileInput([
                                            'class' => 'picture-file',
                                            'id' => 'photoForm-file' . $photo->id,
                                            'placeholder' => 'Изменить',
                                            'data-card' => $photo->id
                                        ]); ?>
                                    <?= $form->field($modelPhoto, 'album_id')
                                        ->hiddenInput(['class' => 'namePhotoInput']); ?>
                                </div>
                                <div class="button delete" id="<?= $photo->id ?>">
                                    Удалить
                                </div>
                            </div>

                        </div>
                        <div class="col-md-7 card-data">
                            <div class="row place-button">
                                <div class="col-sm-12 update">
                                    <div id="account_button<?= $photo->id ?>" class="hidden">
                                        <?= Html::submitButton('Сохранить', ['class' => 'btn']) ?>
                                        <?php ActiveForm::end(); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </form>
                    </div>
                <?php endforeach; ?>
            </div>
            <?= LinkPager::widget([
                'pagination' => $pages,
            ]); ?>
        </div>
    </div>
</section>


<script>

    //photo added with draggable start
    function allowDrow(ev) {
        ev.preventDefault();
    }

    function drag(ev, block) {
        ev.dataTransfer.setData("card_id", ev.target.dataset.id);
        ev.dataTransfer.setData("method", $(block).find('form').attr('method'));
        ev.dataTransfer.setData("action", $(block).find('form').attr('action'));
        ev.dataTransfer.setData("data_name", $(block).find('form input.namePhotoInput[type=hidden]').attr('name'));
    }

    function drop(ev, block) {
        ev.preventDefault();
        var album_id = $(block).attr('data-id');
        var card_id = ev.dataTransfer.getData("card_id");
        var method = ev.dataTransfer.getData("method");
        var action = ev.dataTransfer.getData("action");
        var data_name = ev.dataTransfer.getData("data_name");

        $.ajax({
            method: method,
            url: action,
            data: {[data_name]: album_id},
            success: function () {
                $('.card-item[data-id=' + card_id + ']').remove();
            }
        });
    }

    //photo added with draggable end

    $(document).ready(function () {

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
                    hideButton(model.id);
                }
            });
        });

        //hide button
        function hideButton(id) {
            $('#account_button' + id).removeClass('active');
        }

        //Update data card
        function updateCard(model) {
            var item_card = $('.card-item[data-id=' + model.id + ']');
            item_card.find('img.photo').attr('src', model.picture);
            item_card.find('img.photo').attr('alt', model.id);
        }

        //Delete photo
        $('.delete').on('click', function () {
            var id = this.id;
            if (confirm("Вы действитель хотите удалить фото?")) {
                $.ajax({
                    method: 'get',
                    url: '/photo/' + id + '/delete',
                    success: function (data) {
                        $('.card-item[data-id=' + id + ']').remove();
                    }
                });
            }

        });
    });
</script>

