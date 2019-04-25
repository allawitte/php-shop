<?= \app\widgets\MenuWidget::widget(); ?>
<?php $this->title = 'php-shop'.' | '.$catGoods[0]['category']; ?>
<?php use yii\helpers\Url; ?>
<div class="container">
    <div class="row justify-content-center">
        <?php foreach ($catGoods as $item): ?>
            <div class="col-4">
                <div class="product">
                    <div class="product-img">
                        <img src="/img/<?= $item['img'] ?>" alt="<?= $item['link_name'] ?>">
                    </div>
                    <div class="product-name"><?= $item['name'] ?></div>
                    <div class="product-descr">Состав: <?= $item['composition'] ?></div>
                    <div class="product-price">Цена: <?= $item['price'] ?> рублей</div>
                    <div class="product-buttons">
                        <a href="#" data-name="<?= $item['link_name']?>" class="product-button__add btn btn-success">Заказать</a>
                        <a href="<?=Url::to(['good/index', 'name'=> $item['link_name']]) ?>" type="button" class="product-button__more btn btn-primary">Подробнее</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>