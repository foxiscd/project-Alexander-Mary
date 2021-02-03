<?php
/**
 * @var $album \app\models\AlbumPhotoPortfolio
 * @var $photos \app\models\Photo[]
 * @var $modelAlbum \app\models\form\AlbumPhotoPortfolioForm
 */

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>
<h1>Альбом <?= $album->title ?></h1>
<div class="row">
    <div class="col-sm-4">
        <div>
            <?php $form = ActiveForm::begin(); ?>
            <?= $form->field($modelAlbum, 'title')->input('text', ['value' => $album->title]); ?>
            <?= $form->field($modelAlbum, 'description')->input('text', ['value' => $album->description]); ?>
            <?= $form->field($modelAlbum, 'cover')->input('text', ['value' => $album->cover, 'data-target' => 'cover']); ?>
            <?= $form->field($modelAlbum, 'sort')->input('text', ['value' => $album->sort]); ?>
            <?= $form->field($modelAlbum, 'hidden')->dropDownList(['false' => 'Нет', 'true' => 'Да'], ['default' => $album->hidden]); ?>
            <?= Html::submitButton('Сохранить', ['class' => 'btn hidden']) ?>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
    <div class="image_flex col-sm-8">
        <?php foreach ($photos as $key => $photo): ?>
            <div class="portfolio_item picture-button" data-id="<?= $photo->id ?>">
                <img class="portfolio_img" src="<?= $photo->picture ?>" alt="<?= $photo->id ?>">
                <div class="portfolio_img_title">
                    <div><?= $photo->created_at ?></div>
                </div>

                <div class="mini-menu-update  post" data-picture="<?= $photo->id ?>">
                    <div class="button" onclick="return addCover(this)" data-value="<?= $photo->picture ?>">
                        Добавить на обложку
                    </div>
                    <div class="button delete" id="<?= $photo->id ?>">
                        Удалить
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<script>
    function addCover(block) {
        var path = $(block).data('value');
        console.log(path);
        var input = $(document).find('input[data-target=cover]');
        input.val(path);
        $('button.hidden').addClass('active');
    }
</script>

