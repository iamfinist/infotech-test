<?php

namespace app\models\search;

use app\models\Author;
use yii\data\ArrayDataProvider;

class AuthorTopSearch extends Author
{
    public $date_start;
    public $date_end;

    public function rules()
    {
        return [
            [['date_start', 'date_end'], 'string']
        ];
    }

    public function search($params) {

        $this->load($params, "");

        \Yii::debug($this->date_start);
        \Yii::debug($this->date_end);

        $year_start = 1500;
        $year_end = 3000;

        if (!empty($this->date_start)) {
            $year_start = intval(date("Y", strtotime($this->date_start)));
        }

        if (!empty($this->date_end)) {
            $year_end = intval(date("Y", strtotime($this->date_end)));
        }

        $top_authors = \Yii::$app->db->createCommand("
            select authors.id, concat_ws(' ', authors.surname, authors.name, authors.patronymic) as name, count(books.id) as books_count from authors
            inner join authors_books on authors.id = authors_books.author_id 
            inner join books on authors_books.book_id = books.id
            where books.publication_year >= :year_start
            and books.publication_year <= :year_end
            group by authors.id 
            order by books_count desc
            limit 10;
        ", ['year_start' => $year_start, 'year_end' => $year_end])->query()->readAll();

        \Yii::debug($top_authors);

        return new ArrayDataProvider([
            'allModels' => $top_authors
        ]);
    }
}