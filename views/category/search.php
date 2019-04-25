<?php use yii\helpers\Url; ?>
<?php $this->title = 'php-shop'.' | search'; ?>
<h2 class="text-center">Результаты поиска по запросу <span class="font-italic"><?= $search; ?></span></h2>
<div class="container">
    <div class="row justify-content-center">
        <?php if ($catGoods): ?>
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
                            <a href="#" data-name="<?= $item['link_name']?>" type="button" class="product-button__add btn btn-success">Заказать</a>
                            <a href="<?=Url::to(['good/index', 'name'=> $item['link_name']]) ?>" type="button" class="product-button__more btn btn-primary">Подробнее</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <h4>Ничего не найдено</h4>
        <?php endif; ?>
    </div>
</div>