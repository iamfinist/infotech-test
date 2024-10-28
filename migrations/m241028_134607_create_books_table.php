<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%books}}`.
 */
class m241028_134607_create_books_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%books}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'publication_year' => $this->integer()->notNull(),
            'description' => $this->text(),
            'isbn' => $this->string(13)->notNull(),
            'image' => $this->string()
        ]);

        $this->batchInsert('{{%books}}', ['name', 'publication_year', 'isbn'], [
            [
                'name' => 'Война и мир',
                'publication_year' => 1865,
                'isbn' => '9785699120147'
            ],
            [
                'name' => '1984',
                'publication_year' => 1949,
                'isbn' => '9785699120148'
            ],
            [
                'name' => 'Бойцовский клуб',
                'publication_year' => 1996,
                'isbn' => '9785699120149'
            ]
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%books}}');
    }
}
