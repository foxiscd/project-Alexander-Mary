<?php
/**
 * @var $modelPost \app\models\form\PostForm
 * @var $posts \app\models\Post[]
 */

use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;

include Yii::$app->getBasePath() . '/views/components/admin-menu.php'
?>
<h2>Карточки блога</h2>
<div class="row" style="padding-top: 10px">
    <div class="col-md-4">
        <div class="photo-form">
            <h4>Добавить пост в блог</h4>
            <a href="<?= Url::to(['post/add']) ?>"><?= Html::submitButton('Добавить пост', ['class' => 'btn btn-success']); ?></a>
        </div>
    </div>
    <div class="col-md-8">
        <h4 style="margin: auto">Карточки постов</h4>
        <div class="row items-card">
            <?php if (!empty($posts)): ?>
            <?php foreach ($posts as $key => $post): ?>
                <div class="col-md-12 row card-item padding-2 item shadow-active"
                     data-id="<?= $post->id ?>">
                    <? $form = ActiveForm::begin(['action' => '/post/' . $post->id . '/edit', 'method' => 'post']); ?>
                    <div class="col-md-4 portfolio admin">
                        <div class="picture-button button" data-id="<?= $post->id ?>">
                            <img class="photo" src="<?= $post->picture ?>" alt="<?= $post->title ?>">
                        </div>
                        <div class="mini-menu-update m_top_0" data-picture="<?= $post->id ?>">
                            <div class="button">
                                <?= $form->field($modelPost, 'file')->fileInput([
                                    'class' => 'picture-file',
                                    'id' => 'photoForm-file' . $post->id,
                                    'placeholder' => 'Изменить',
                                ]); ?>
                            </div>
                            <div class="button delete" id="<?= $post->id ?>">
                                Удалить
                            </div>
                        </div>
                        <div>
                            <?= $form->field($modelPost, 'theme')->textarea([
                                'class' => 'title-text',
                                'data-content' => $post->theme,
                                'value' => $post->theme,
                            ]); ?>
                        </div>
                    </div>
                    <div class="col-md-8 card-data">
                        <?= $form->field($modelPost, 'title')->textarea([
                            'class' => 'title-text',
                            'data-content' => $post->title,
                            'value' => $post->title,
                        ]); ?>
                        <?= $form->field($modelPost, 'description')->textarea([
                            'class' => 'description-text',
                            'data-content' => $post->description,
                            'value' => $post->description,
                            'id' => 'myTextarea',
                        ]); ?>
                        <div class="row" style="padding-top: 20px">
                            <div class="col-sm-6"><?= $post->updated_at ?></div>
                            <div class="col-sm-6 update">
                                <div class="item-button">
                                    <?= Html::submitButton('Изменить', ['class' => 'btn btn-success hidden']) ?>
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
    <?php endif; ?>
</div>


<script>
    $(document).ready(function () {

        //Menu-photo toggle
        $(document).on('click', function (e) {
            if ($(e).hasClass('.picture-button')) {
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

        //Update card
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
            $('button.hidden.active').removeClass('active');
        }
    });
</script>

