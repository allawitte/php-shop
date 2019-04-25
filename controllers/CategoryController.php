<?php

namespace app\controllers;

use app\models\Good;

use yii\web\Controller;
use Yii;
class CategoryController extends Controller
{
    public function actionIndex(){
        $goods = new Good();
        $goods = $goods->getallGoods();
        return $this->render('index.php', compact('goods'));
    }

    public function actionView($id){
        $catGoods = new Good();
        $catGoods = $catGoods->getGoodsCategories($id);
        return $this->render('view', compact('catGoods'));
    }

    public function actionSearch(){
        $search = htmlspecialchars(Yii::$app->request->get('search'));
        $catGoods = new Good();
        $catGoods = $catGoods->getSearchResults($search);
        return $this->render('search', compact('catGoods', 'search'));
    }

}