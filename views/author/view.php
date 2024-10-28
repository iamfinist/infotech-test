<?php

/**
 * @var yii\web\View $this
 * @var Author $model
 */

use app\models\Author;
use yii\helpers\Html;
use yii\widgets\DetailView;

$this->title = $model->name;
?>
<div class="site-index">

    <div class="body-content">

        <div class="row">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'surname',
                    'name',
                    'patronymic'
                ]
            ]) ?>

            <?php if (Yii::$app->user->can('admin')) { ?>
                <div>
                    <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-outline-secondary']) ?>
                    <?= Html::a('Delete', ['delete', 'id' => $model->id], ['class' => 'btn btn-danger', 'id' => 'delete-button']) ?>
                </div>
            <?php } ?>
        </div>

    </div>
</div>
