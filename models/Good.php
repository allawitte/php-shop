<?php
/**
 * Created by PhpStorm.
 * User: HP
 * Date: 4/17/2019
 * Time: 12:38 PM
 */

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class Good extends ActiveRecord
{
    public static function tableName()
    {
        return 'good';
    }
    public function getallGoods(){
        $goods = Yii::$app->cache->get('goods');
        if(!$goods){
            $goods = Good::find()->asArray()->all();
            Yii::$app->cache->set('goods', $goods, 30);
        }
        return $goods;
    }

    public function getGoodsCategories($id){
        $catGoods = Yii::$app->cache->get('category');
        if(!$catGoods){
            $catGoods =  Good::find()->where(['category'=> $id])->asArray()->all();
            Yii::$app->cache->set('catGoods', $catGoods, 30);
        }

        return $catGoods;
    }

    public function getSearchResults($search){
        $searchResults =  Good::find()->where(['like', 'name', $search])->asArray()->all();
        return $searchResults;
    }

    public function getOneGood($name){
        return Good::find()->where(['link_name'=>$name])->one();
    }
}