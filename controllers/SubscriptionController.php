<?php

namespace app\controllers;

use app\models\Subscription;
use yii\web\BadRequestHttpException;
use yii\web\NotFoundHttpException;

class SubscriptionController extends \yii\web\Controller
{
    public function actionCreate() {

        $model = new Subscription();

        if (\Yii::$app->request->isPost) {
            if ($model->load(\Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['/']);
            }
        }

        if (empty($author_id = \Yii::$app->request->queryParams['author_id'])) {
            throw new NotFoundHttpException();
        }

        return $this->render('create', [
            'model' => $model,
            'author_id' => $author_id
        ]);
    }
}