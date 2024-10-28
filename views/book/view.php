<?php

/**
 * @var yii\web\View $this
 * @var Book $model
 */

use app\models\Book;
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
                    'name',
                    'description:html',
                    'publication_year',
                    'isbn',
                    [
                        'label' => 'Authors',
                        'value' => function (Book $model) {
                            $authors = [];
                            foreach ($model->authors as $author) {
                                $authors[] = Html::a($author->getFullname(), ['/author/view', 'id' => $model->id]);
                            }
                            return implode(", ", $authors);
                        },
                        'format' => 'html'
                    ],
                    [
                        'label' => 'Image',
                        'value' => function (Book $model) {
                            return Html::img($model->image);
                        },
                        'format' => 'html'
                    ]
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
