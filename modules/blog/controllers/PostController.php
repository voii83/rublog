<?php

namespace app\modules\blog\controllers;

use app\modules\blog\models\BlogPostTag;
use Yii;
use app\modules\blog\models\BlogPost;
use app\modules\blog\models\BlogPostSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PostController implements the CRUD actions for BlogPost model.
 */
class PostController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all BlogPost models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BlogPostSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single BlogPost model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $postTags = implode(',', $model->postTags);

        return $this->render('view', [
            'model' => $model,
            'postTags' => $postTags,
        ]);
    }

    /**
     * Creates a new BlogPost model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new BlogPost();
        $postTags = '';
        $author = '';

        if ($model->load(Yii::$app->request->post()) && $post_id = $model->savePost()) {
            return $this->redirect(['view', 'id' => $post_id]);
        }

        return $this->render('create', [
            'model' => $model,
            'postTags' => $postTags,
            'author' => $author,
        ]);
    }

    /**
     * Updates an existing BlogPost model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $postTags = implode(',', $model->postTags);
        $author = $model->postAuthor->name;

        if ($model->load(Yii::$app->request->post()) && $post_id = $model->savePost()) {
            return $this->redirect(['view', 'id' => $post_id]);
        }

        return $this->render('update', [
            'model' => $model,
            'postTags' => $postTags,
            'author' => $author,
        ]);
    }

    /**
     * Deletes an existing BlogPost model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        BlogPostTag::deleteAll(['blog_post_id' => $id]);

        return $this->redirect(['index']);
    }

    /**
     * Finds the BlogPost model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return BlogPost the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        $model = BlogPost::query()
            ->where(['id' => $id])
            ->andWhere(['published' => true])
            ->one();

        if ($model !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
