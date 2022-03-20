<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%client_phone}}`.
 */
class m220320_143708_create_client_phone_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%client_phone}}', [
            'id' => $this->primaryKey(),
            'client_id' => $this->integer()->notNull(),
            'phone' => $this->string(255),
            'type'=>$this->tinyInteger(1)->notNull()->defaultValue(1),
            'status' => $this->tinyInteger(1)->notNull()->defaultValue(1),
            'is_deleted' => $this->tinyInteger(1)->notNull()->defaultValue(0),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'created_by' => $this->integer()->notNull(),
            'updated_by' => $this->integer()->notNull()
        ]);
        // creates index for column post_id
        $this->createIndex(
            'idx-client_phone-client_id',
            'client_phone',
            'client_id'
        );

        // add foreign key for table post
        $this->addForeignKey(
            'fk-client_phone-client_id',
            'client_phone',
            'client_id',
            'client',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table post
        $this->dropForeignKey(
            'fk-client_phone-client_id',
            'client_phone'
        );

        // drops index for column post_id
        $this->dropIndex(
            'idx-client_phone-client_id',
            'client_phone'
        );
        $this->dropTable('{{%client_phone}}');
    }
}
