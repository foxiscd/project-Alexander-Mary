<?php
/**
 * @var $photos \app\models\Photo
 */
?>

<h1>Мои работы</h1>
<div class="image_flex">
<?php foreach ($photos as $key => $photo): ?>
    <a data-fancybox="gallery" data-caption="<?= $photo->title ?>" href="<?= $photo->picture ?>">
        <img src="<?= $photo->picture ?>" alt="<?= $photo->title ?>">
    </a>
<?php endforeach; ?>
</div>
