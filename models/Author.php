<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "authors".
 *
 * @property int $id
 * @property string $name
 * @property string $surname
 * @property string|null $patronymic
 *
 * @property Book[] $books
 * @property Subscription[] $subscriptions
 */
class Author extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'authors';
    }

    public static function getDropdownList()
    {
        return ArrayHelper::map(self::find()->all(), 'id', function (Author $model) {
            return $model->getFullname();
        });
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'surname'], 'required'],
            [['name', 'surname', 'patronymic'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'surname' => 'Surname',
            'patronymic' => 'Patronymic',
        ];
    }

    public function getBooks()
    {
        return $this->hasMany(Book::class, ['id' => 'book_id'])
            ->viaTable(AuthorBook::tableName(), ['author_id' => 'id']);
    }

    public function getSubscriptions() {
        return $this->hasMany(Subscription::class, ['author_id' => 'id']);
    }

    public function getFullname()
    {
        return trim(implode(" ", [$this->surname, $this->name, $this->patronymic]));
    }
}
