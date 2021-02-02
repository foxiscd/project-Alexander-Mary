<?php
/**
 * @var $photos \app\models\Photo
 */
?>

<h1>Мои работы</h1>
<div class="image_flex">
    <?php foreach ($photos as $key => $photo): ?>
        <div class="portfolio_item">
            <a data-fancybox="gallery" data-caption="<?= $photo->title ?>" href="<?= $photo->picture ?>">
                <img class="portfolio_img" src="<?= $photo->picture ?>" alt="<?= $photo->title ?>">
            </a>
            <div class="portfolio_img_title">
                <div><?= $photo->title ?></div>
            </div>
        </div>
    <?php endforeach; ?>
</div>
