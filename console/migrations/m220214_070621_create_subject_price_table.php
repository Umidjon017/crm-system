<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%subject_price}}`.
 */
class m220214_070621_create_subject_price_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{_subject_price}}', [
            'id' => $this->primaryKey(),
            'subject_id' => $this->integer(),
            'price' => $this->bigInteger(),
            'status' => $this->tinyInteger(1)->notNull()->defaultValue(1),
            'is_deleted' => $this->tinyInteger(1)->notNull()->defaultValue(0),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'created_by' => $this->integer()->notNull(),
            'updated_by' => $this->integer()->notNull(),
        ]);

        $this->createIndex(
            'idx-subject_price-subject_id',
            '_subject_price',
            'subject_id'
        );

        $this->addForeignKey(
            'fk-subject_price-subject_id',
            '_subject_price',
            'subject_id',
            '_subject',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'fk-subject_price-subject_id',
            '_subject_price'
        );

        $this->dropIndex(
            'idx-subject_price-subject_id',
            '_subject_price'
        );

        $this->dropTable('{{_subject_price}}');
    }
}
