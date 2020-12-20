<?php
use yii\helpers\Html;
/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">
    <div class="body-content">
        <div class="row">
            <div class="col-lg-6">
                <h3>Админ модуль</h3>
                <?= Html::a('Все новости', '/admin/default/index');?>
                <hr>
                <?= Html::a('Создать новость', '/admin/default/create');?>
                <hr>

            </div>
            <div class="col-lg-6">
                <h3>Вывод новостей</h3>
                <?= Html::a('Все новости', '/news/default/index');?>
                <hr>

            </div>
        </div>

    </div>
</div>
