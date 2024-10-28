<?php

namespace app\controllers;

use app\models\Author;
use app\models\search\AuthorSearch;
use app\models\search\AuthorTopSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class AuthorController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index', 'top', 'view'],
                        'roles' => ['?'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['index', 'top', 'view'],
                        'roles' => ['user'],
                    ],
                    [
                        'allow' => true,
                        'roles' => ['admin'],
                    ],
                ],
            ],
        ];
    }
    public function actionIndex() {

        $searchModel = new AuthorSearch();
        $dataProvider = $searchModel->search(\Yii::$app->request->queryParams);

        return $this->render('index', [
            'dataProvider' => $dataProvider
        ]);
    }

    public function actionTop() {

        $searchModel = new AuthorTopSearch();
        $dataProvider = $searchModel->search(\Yii::$app->request->queryParams);

        return $this->render('top', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider
        ]);
    }

    public function actionView($id) {

        $model = Author::findOne($id);
        if (!$model) {
            throw new NotFoundHttpException();
        }

        return $this->render('view', [
            'model' => $model
        ]);
    }

    public function actionCreate() {

        $model = new Author();

        if (\Yii::$app->request->isPost) {
            if ($model->load(\Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('create', [
            'model' => $model
        ]);
    }

    public function actionUpdate($id) {

        $model = Author::findOne($id);
        if (!$model) {
            throw new NotFoundHttpException();
        }

        if (\Yii::$app->request->isPost) {
            if ($model->load(\Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('update', [
            'model' => $model
        ]);
    }

    public function actionDelete($id) {

        $model = Author::findOne($id);
        if (!$model) {
            throw new NotFoundHttpException();
        }

        if ($model->delete()) {
            return $this->redirect('index');
        }

        return $this->redirect(['view', 'id' => $id]);

    }
}