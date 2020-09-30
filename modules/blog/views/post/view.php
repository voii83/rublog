<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;

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

    <hr>

    <div class="row">
        <div class="col-sm-12">
            <h4>Комментарии</h4>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <?php yii\widgets\Pjax::begin(['id' => 'new_comment']) ?>
            <?php $form = ActiveForm::begin(['options' => ['data-pjax' => true]]); ?>


            <small>Добавить комментарий</small>
            <?= $form->field($commentsForm, 'text')->textarea(['rows' => 3])->label(false) ?>
            <div class="form-group">
                <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
            </div>

            <?php ActiveForm::end(); ?>
            <?php Pjax::end(); ?>
        </div>
    </div>

    <?php Pjax::begin(['id' => 'comments']) ?>
    <div class="row">
        <div class="col-sm-12">
            <ul>
            <?php foreach ($comments as $comment) : ?>
                <li><?= $comment->text ?></li>
            <?php endforeach; ?>
            </ul>
        </div>
    </div>
    <?php Pjax::end() ?>

</div>

<?php
$script = <<< JS
    $("document").ready(function(){
        $("#new_comment").on("pjax:end", function() {
            $.pjax.reload({container:"#comments"});
            $('#comment-text').val('');
        });
    });
JS;
$this->registerJs($script, yii\web\View::POS_READY);
?>