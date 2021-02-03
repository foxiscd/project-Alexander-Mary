<?php
/**
 * @var $album \app\models\AlbumPhotoPortfolio
 * @var $photos \app\models\Photo[]
 */

use yii\helpers\Url;
use yii\helpers\Html;

?>
<h1>Альбом <?= $album->title ?></h1>
<div class="image_flex">
    <?php foreach ($photos as $key => $photo): ?>
        <div class="portfolio_item">
            <a data-fancybox="gallery" data-caption="<?= $photo->id ?>" href="<?= $photo->picture ?>">
                <img class="portfolio_img" src="<?= $photo->picture ?>" alt="<?= $photo->id ?>">
            </a>
        </div>
    <?php endforeach; ?>
</div>
