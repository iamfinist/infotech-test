<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%authors}}`.
 */
class m241028_133930_create_authors_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%authors}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'surname' => $this->string()->notNull(),
            'patronymic' => $this->string()
        ]);

        $this->batchInsert('{{%authors}}',
            ['name', 'surname', 'patronymic'],
            [
                [
                    'name' => 'Иван',
                    'surname' => 'Иванов',
                    'patronymic' => 'Иванович'
                ],
                [
                    'name' => 'Петр',
                    'surname' => 'Петров',
                    'patronymic' => 'Петрович'
                ],
                [
                    'name' => 'Андрей',
                    'surname' => 'Андреев',
                    'patronymic' => 'Андреевич'
                ]
            ]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%authors}}');
    }
}
