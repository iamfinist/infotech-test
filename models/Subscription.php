<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "subscriptions".
 *
 * @property int $id
 * @property string $phone_number
 * @property int $author_id
 */
class Subscription extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'subscriptions';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['phone_number', 'author_id'], 'required'],
            [['author_id'], 'integer'],
            [['phone_number'], 'string', 'min' => 11, 'max' => 11],
            [['phone_number'], 'unique', 'targetAttribute' => ['phone_number', 'author_id']]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'phone_number' => 'Phone Number',
            'author_id' => 'Author ID',
        ];
    }
}
