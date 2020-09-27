<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\blog\models\BlogPostSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Список постов';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="blog-post-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Создать пост', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'class' => \yii\grid\ActionColumn::class,
                'template' => '{view} {update} {delete}',
            ],

            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'created_at',
                'label' => 'Дата создания',
                'value' => function($data) {
                    return $data->created_at;
                },
                'filter'=>DatePicker::widget([
                    'model' => $searchModel,
                    'attribute' => 'created_at',
                    'value' => date('yy-m-d'),
                    'pluginOptions' => [
                        'format' => 'yyyy-mm-dd',
                        'todayHighlight' => true
                    ]
                ]),
            ],
            [
                'attribute' => 'model.author',
                'label' => 'Автор',
                'value' => function($data) {
                    return $data->author->name;
                },
            ],
            'title',
        ],
    ]); ?>

</div>
