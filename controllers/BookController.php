<?php

namespace app\controllers;

use app\models\Book;
use app\models\search\BookSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

class BookController extends Controller
{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index', 'view'],
                        'roles' => ['?'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['index', 'view'],
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

        $searchModel = new BookSearch();
        $dataProvider = $searchModel->search(\Yii::$app->request->queryParams);

        return $this->render('index', [
            'dataProvider' => $dataProvider
        ]);
    }

    public function actionView($id) {

        $model = Book::findOne($id);
        if (!$model) {
            throw new NotFoundHttpException();
        }

        return $this->render('view', [
            'model' => $model
        ]);
    }

    public function actionCreate() {

        $model = new Book();

        if (\Yii::$app->request->isPost) {
            if ($model->load(\Yii::$app->request->post())) {
                $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
                if ($model->upload() && $model->save(false)) {
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            }
        }

        return $this->render('create', [
            'model' => $model
        ]);
    }

    public function actionUpdate($id) {

        $model = Book::findOne($id);
        if (!$model) {
            throw new NotFoundHttpException();
        }

        if (\Yii::$app->request->isPost) {
            if ($model->load(\Yii::$app->request->post())) {
                $model->imageFile = UploadedFile::getInstance($model,'imageFile');
                if ($model->upload() && $model->save(false)) {
                    return $this->redirect(['view', 'id' => $id]);
                }
            }
        }

        return $this->render('update', [
            'model' => $model
        ]);
    }

    public function actionDelete($id) {

        $model = Book::findOne($id);
        if (!$model) {
            throw new NotFoundHttpException();
        }

        if ($model->delete()) {
            return $this->redirect('index');
        }

        return $this->redirect(['view', 'id' => $id]);

    }
}