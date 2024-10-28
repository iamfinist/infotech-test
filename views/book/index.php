<?php

/**
 * @var yii\web\View $this
 * @var ActiveDataProvider $dataProvider
 */


use app\models\Book;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;

$this->title = 'Books';
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
                        'value' => function (Book $model) {
                            return \yii\helpers\Html::a($model->name, \yii\helpers\Url::to(['view', 'id' => $model->id]));
                        },
                        'format' => 'html'
                    ],
                    'publication_year',
                    'isbn'
                ],
                'summary' => false
            ]) ?>
        </div>

    </div>
</div>
