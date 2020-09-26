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

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены, что хотите удалить этот элемент?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'attribute' => 'created_at',
                'label' => 'Дата создания',
                'value' => function($data) {
                    return $data->created_at;
                }
            ],

            [
                'attribute' => 'model.author',
                'label' => 'Автор',
                'value' => function($data) {
                    return $data->author->name;
                }
            ],
            [
                'attribute' => 'title',
                'label' => 'Заголовок',
                'value' => function($data) {
                    return $data->title;
                }
            ],
            [
                'attribute' => 'text',
                'format' => 'html',
                'label' => 'Текст',
                'value' => function($data) {
                    return $data->text;
                }
            ],
            [
                'attribute' => 'published',
                'format' => 'raw',
                'label' => false,
                'value' => function($data){
                    return $data->published ? '<span class="text-success">Опубликовано</span>' : '<span class="text-danger">Не опубликовано</span>';
                }
            ],
            [
                'attribute' => 'model.author',
                'label' => 'Теги',
                'value' => function($data) use ($postTags) {
                    return $postTags;
                }
            ],
        ],
    ]) ?>

    <p><?= Html::a('Список постов', ['index', 'id' => $model->id], ['class' => 'btn btn-primary']) ?></p>

</div>
