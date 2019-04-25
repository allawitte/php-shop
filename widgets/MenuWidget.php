<?php
/**
 * Created by PhpStorm.
 * User: HP
 * Date: 4/17/2019
 * Time: 2:47 PM
 */

namespace app\widgets;
use app\models\Category;
use yii\base\Widget;

class MenuWidget extends Widget
{
    public $data;

    public function run(){
        $this->data = new Category();
        $this->data = $this->data->getCategories();
        $this->data = $this->categoryToTemplate($this->data);
        return $this->data;
    }

    public function categoryToTemplate($data){
        ob_start();
        include __DIR__.'/template/menu.php';
        return ob_get_clean();
    }
}