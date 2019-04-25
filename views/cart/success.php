<?php
use yii\helpers\Url;
?>
<h2>Ваш заказ под номером <?= $session['currentId'] ?> принят</h2>
<a href="/" class="btn btn-success">Вернуться на главную</a>
<?php
if(isset($_POST['Order'])){
    Yii::$app->response->redirect(Url::to('order'));
}



