<?php

namespace app\models\search;

use app\models\Book;
use yii\data\ActiveDataProvider;

class BookSearch extends Book
{
    public function rules()
    {
        return parent::rules();
    }

    public function search($params) {

        $this->load($params);

        $query = self::find();

        return new ActiveDataProvider([
            'query' => $query
        ]);
    }
}