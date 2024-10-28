<?php

namespace app\models;

use app\components\SmsService;
use Yii;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;

/**
 * This is the model class for table "books".
 *
 * @property int $id
 * @property string $name
 * @property int $publication_year
 * @property string|null $description
 * @property string $isbn
 * @property string|null $image
 *
 * @property Author[] $authors
 */
class Book extends ActiveRecord
{
    public $authors_ids;
    /**
     * @var UploadedFile
     */
    public $imageFile;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'books';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'publication_year', 'isbn'], 'required'],
            [['publication_year'], 'integer', 'min' => 1500, 'max' => 2100],
            [['description'], 'string', 'max' => 1000],
            [['name'], 'string', 'min' => 3, 'max' => 255],
            [['image'], 'string'],
            [['isbn'], 'string', 'min' => 13, 'max' => 13],
            [['authors_ids'], 'safe'],
            [['imageFile'], 'file', 'extensions' => 'png, jpg, jpeg'],
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
            'publication_year' => 'Publication Year',
            'description' => 'Description',
            'isbn' => 'ISBN',
            'image' => 'Image',
        ];
    }

    public function getAuthors()
    {
        return $this->hasMany(Author::class, ['id' => 'author_id'])
            ->viaTable('{{%authors_books}}', ['book_id' => 'id']);
    }

    public function beforeSave($insert)
    {
        if (!parent::beforeSave($insert)) {
            return false;
        }

        if (!$insert) {
            $this->linkAuthors();
        }

        return true;
    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);

        if ($insert) {
            $this->linkAuthors();

            // TODO: использовать очередь или пакетную отправку
            $smsService = new SmsService();
            foreach ($this->authors as $author) {
                $text = "Author " . $author->getFullname() . " published new book: " . $this->name;
                foreach ($author->subscriptions as $subscription) {
                    Yii::debug($smsService->send($subscription->phone_number, $text));
                }
            }
        }
    }

    private function linkAuthors() {
        if (!empty($this->authors_ids)) {
            AuthorBook::deleteAll(['book_id' => $this->id]);
            Yii::$app->db->createCommand()->batchInsert(
                AuthorBook::tableName(),
                ['author_id', 'book_id'],
                array_map(function ($element) {
                    return [$element, $this->id];
                }, $this->authors_ids)
            )->execute();
        }
    }

    public function afterFind()
    {
        parent::afterFind();
        $this->authors_ids = ArrayHelper::getColumn($this->authors, 'id');
    }

    public function upload()
    {
        if (!empty($this->imageFile)) {
            $this->deleteImage();
            if ($this->validate()) {
                $filename = 'uploads/' . Yii::$app->security->generateRandomString() . '.' . $this->imageFile->extension;
                $this->image = "/$filename";
                return $this->imageFile->saveAs($filename);
            } else {
                return false;
            }
        }
        return true;
    }

    public function afterDelete()
    {
        parent::afterDelete();
        $this->deleteImage();
    }

    private function deleteImage() {
        if (!empty($this->image)) {
            try {
                unlink(Yii::getAlias("@webroot" . $this->image));
            } catch (\Throwable $exception) {

            }
        }
    }
}
