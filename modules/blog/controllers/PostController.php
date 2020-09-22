<?php

namespace app\modules\blog\controllers;

use yii\web\Controller;

/**
 * Post controller for the `blog` module
 */
class PostController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
}
