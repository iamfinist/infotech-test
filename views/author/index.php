<?php

/**
 * @var yii\web\View $this
 * @var ActiveDataProvider $dataProvider
 */


use app\models\Author;
use yii\data\ActiveDataProvider;
use yii\grid\ActionColumn;
use yii\helpers\Html;

$this->title = 'Authors';
?>
<div class="site-index">

    <div class="body-content">

        <div class="row">
            <?php if (Yii::$app->user->can('admin')) { ?>
                <?= Html::a('Create', ['create'], ['class' => 'btn col-1 mb-3 btn-outline-secondary']) ?>
            <?php } ?>
            <?= \yii\grid\GridView::widget([
                'dataProvider' => $dataProvider,
                'columns' => [
                    'id',
                    [
                        'attribute' => 'name',
                        'value' => function (Author $model) {
                            return \yii\helpers\Html::a($model->getFullname(), \yii\helpers\Url::to(['view', 'id' => $model->id]));
                        },
                        'format' => 'html'
                    ],
                    [
                        'class' => ActionColumn::class,
                        'template' => '{subscribe}',
                        'buttons' => [
                            'subscribe' => function ($url, $model, $key) {
                                return Html::a('Subscribe', ['/subscription/create', 'author_id' => $model->id], ['class' => 'btn btn-outline-secondary']);
                            }
                        ]
                    ],
                ],
                'summary' => false
            ]) ?>
        </div>

    </div>
</div>
