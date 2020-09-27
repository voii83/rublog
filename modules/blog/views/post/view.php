<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\blog\models\BlogPost */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Список постов', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="blog-post-view">

    <h1><?= Html::encode($model->title) ?></h1>
    <div class="row">
        <div class="col-sm-6">
            <h3><?= $model->author->name ?></h3>
        </div>
        <div class="col-sm-6">
            <p class="text-right"><?= $model->created_at ?></p>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <?= $model->text ?>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <?php foreach ($postTags as $postTag) : ?>
                <span class="label label-info"><?= $postTag ?></span>
            <?php endforeach; ?>
        </div>
    </div>

    <hr>

    <div class="row">
        <div class="col-sm-12">
            <p>
            <?= Html::a('Список постов', ['index', 'id' => $model->id], ['class' => 'btn btn-warning']) ?>
            <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Вы уверены, что хотите удалить этот элемент?',
                    'method' => 'post',
                ],
            ]) ?>
            </p>
        </div>
    </div>

</div>
