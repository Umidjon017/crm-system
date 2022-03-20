<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%rel_client_group}}`.
 */
class m220320_143743_create_rel_client_group_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%rel_client_group}}', [
            'id' => $this->primaryKey(),
            'client_id' => $this->integer()->notNull(),
            'group_id' => $this->integer()->notNull(),
            'status' => $this->tinyInteger(1)->notNull()->defaultValue(1)->comment('0 -> False, 1 -> true'),
            'is_deleted' => $this->tinyInteger(1)->notNull()->defaultValue(0),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'created_by' => $this->integer()->notNull(),
            'updated_by' => $this->integer()->notNull(),
        ]);
        $this->createIndex(
            'idx-rel_client_group-client_id',
            'rel_client_group',
            'client_id'
        );

        $this->addForeignKey(
            'fk-rel_client_group-client_id',
            'rel_client_group',
            'client_id',
            'client',
            'id',
            'RESTRICT'
        );;

        // Subject
        $this->createIndex(
            'idx-rel_client_group-group_id',
            'rel_client_group',
            'group_id'
        );

        $this->addForeignKey(
            'fk-rel_client_group-group_id',
            'rel_client_group',
            'group_id',
            'group',
            'id',
            'RESTRICT'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {

        $this->dropForeignKey(
            'fk-rel_client_group-group_id',
            'rel_client_group'
        );

        $this->dropIndex(
            'idx-rel_client_group-group_id',
            'rel_client_group'
        );

        // Teacher
        $this->dropForeignKey(
            'fk-rel_client_group-client_id',
            'rel_client_group'
        );

        $this->dropIndex(
            'idx-rel_client_group-client_id',
            'rel_client_group'
        );
        $this->dropTable('{{%rel_client_group}}');
    }
}
