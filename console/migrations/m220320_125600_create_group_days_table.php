<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%group_days}}`.
 */
class m220320_125600_create_group_days_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%group_days}}', [
            'id' => $this->primaryKey(),
            'group_id' => $this->integer()->notNull(),
            'day_number' => $this->tinyInteger(1)->notNull(),
            'status' => $this->tinyInteger(1)->notNull()->defaultValue(1),
            'is_deleted' => $this->tinyInteger(1)->notNull()->defaultValue(0),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'created_by' => $this->integer()->notNull(),
            'updated_by' => $this->integer()->notNull(),
        ]);

        // Group
        $this->createIndex(
            'idx-group_days-group_id',
            'group_days',
            'group_id'
        );

        $this->addForeignKey(
            'fk-group_days-group_id',
            'group_days',
            'group_id',
            'group',
            'id',
            'RESTRICT'
        );

        // day_number
        $this->createIndex(
            'idx-group_days-day_number',
            'group_days',
            'day_number'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // day_number
        $this->dropIndex(
            'idx-group_days-day_number',
            'group_days',
        );

        // Group
        $this->dropForeignKey(
            'fk-group_days-group_id',
            'group_days',
        );

        $this->dropIndex(
            'idx-group_days-group_id',
            'group_days',
        );

        $this->dropTable('{{%group_days}}');
    }
}
