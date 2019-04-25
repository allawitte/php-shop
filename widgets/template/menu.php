<?php
use yii\helpers\Url;
?>
<div class="container">
    <nav class="nav nav-menu">
        <a class="nav-link" href="/">Всё меню</a>
        <?php foreach ($data as $item): ?>
        <a class="nav-link" data-id="<?=$item['cat_name']?>" href="<?= Url::to(['category/view', 'id'=> $item['cat_name']])?>"><?= $item['browser_name'] ?></a>
        <?php endforeach; ?>
    </nav>
</div>
