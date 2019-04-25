<?php
/**
 * Created by PhpStorm.
 * User: HP
 * Date: 4/18/2019
 * Time: 12:29 PM
 */

namespace app\controllers;
use yii\web\Controller;
use app\models\Good;

class GoodController extends Controller
{
    public function actionIndex($name){
        $good = new Good();
        $good = $good->getOneGood($name);
        return $this->render('index', compact('good'));
    }

}