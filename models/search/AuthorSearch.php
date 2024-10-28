<?php

namespace app\models\search;

use app\models\Author;
use yii\data\ActiveDataProvider;

class AuthorSearch extends Author
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