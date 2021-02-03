<?php
/**
 * @var $albums \app\models\AlbumPhotoPortfolio[]
 */

use yii\helpers\Url;

?>

<h1>Мои работы</h1>
<div class="image_flex">
    <?php foreach ($albums as $key => $album): ?>
        <?php if ($album->hidden == 'false'): ?>
            <div class="portfolio_item">
                <a href="<?= Url::to(['album-photo-portfolio/' . $album->id . '/view']) ?>">
                    <img class="portfolio_img" src="<?= $album->cover ?: '/image/file.png' ?>"
                         alt="<?= $album->title ?>">
                </a>
                <div class="portfolio_img_title">
                    <div><?= $album->title ?></div>
                </div>
            </div>
        <?php endif; ?>
    <?php endforeach; ?>
</div>
