<?php

/**
 * @var yii\web\View $this
 * @var ArrayDataProvider $dataProvider
 * @var AuthorTopSearch $searchModel
 */


use app\models\Author;
use app\models\search\AuthorTopSearch;
use kartik\date\DatePicker;
use yii\data\ActiveDataProvider;
use yii\data\ArrayDataProvider;
use yii\helpers\Html;

$this->title = 'Top authors';
?>
<div class="site-index">

    <div class="body-content">

        <?php $form = \yii\widgets\ActiveForm::begin(['method' => 'get', 'action' => ['top']]) ?>

        <span>Select years</span>
        <div style="margin-bottom: 10px;" class="d-flex">
            <?php
                echo DatePicker::widget([
                    'model' => $searchModel,
                    'name' => 'date_start',
                    'value' => $searchModel->date_start ?? '01.01.1500',
                    'type' => DatePicker::TYPE_RANGE,
                    'name2' => 'date_end',
                    'value2' => $searchModel->date_end ?? '01.01.2100',
                    'pluginOptions' => [
                        'autoclose' => true,
                        'format' => 'mm.dd.yyyy',
                    ],
                ]);
            ?>

                <?= Html::submitButton('Search', ['class' => 'btn btn-outline-secondary']) ?>

            <?php \yii\widgets\ActiveForm::end(); ?>

        </div>

        <div class="row">
            <?= \yii\grid\GridView::widget([
                'dataProvider' => $dataProvider,
                'columns' => [
                    'id',
                    'name',
                    'books_count'
                ],
                'summary' => false
            ]) ?>
        </div>

    </div>
</div>
