<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%authors_books}}`.
 */
class m241028_135207_create_authors_books_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%authors_books}}', [
            'id' => $this->primaryKey(),
            'author_id' => $this->integer()->notNull(),
            'book_id' => $this->integer()->notNull()
        ]);

        $this->addForeignKey('fk_author_junction', '{{%authors_books}}', 'author_id', '{{%authors}}', 'id', 'CASCADE');
        $this->addForeignKey('fk_book_junction', '{{%authors_books}}', 'book_id', '{{%books}}', 'id', 'CASCADE');
        $this->createIndex('idx_author_junction', '{{%authors_books}}', 'author_id');
        $this->createIndex('idx_book_junction', '{{%authors_books}}', 'book_id');

        $this->batchInsert('{{%authors_books}}', ['author_id', 'book_id'], [
            [
                'author_id' => 1,
                'book_id' => 1
            ],
            [
                'author_id' => 1,
                'book_id' => 2
            ],
            [
                'author_id' => 2,
                'book_id' => 2
            ],
            [
                'author_id' => 3,
                'book_id' => 3
            ]
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_book_junction', '{{%authors_books}}');
        $this->dropForeignKey('fk_author_junction', '{{%authors_books}}');
        $this->dropIndex('idx_book_junction', '{{%authors_books}}');
        $this->dropIndex('idx_author_junction', '{{%authors_books}}');
        $this->dropTable('{{%authors_books}}');
    }
}
