<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%group}}`.
 */
class m220320_125515_create_group_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%group}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull(),
            'subject_id' => $this->integer()->notNull(),
            'teacher_id' => $this->integer()->notNull(),
            'level' => $this->tinyInteger(1)->notNull(),
            'action' => $this->tinyInteger(1)->notNull(),
            'type' => $this->tinyInteger(1)->notNull(),
            'price' => $this->bigInteger(),
            'period_start' => $this->string(255)->notNull(),
            'duration' => $this->tinyInteger(2)->notNull(),
            'start_hour' => $this->string()->notNull(),
            'end_hour' => $this->string()->notNull(),
            'status' => $this->tinyInteger(1)->notNull()->defaultValue(1),
            'is_deleted' => $this->tinyInteger(1)->notNull()->defaultValue(0),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'created_by' => $this->integer()->notNull(),
            'updated_by' => $this->integer()->notNull(),
        ]);

        // creates index for column `subject_id`
        $this->createIndex(
            'idx-group-subject_id',
            'group',
            'subject_id'
        );

        // add foreign key for table `_subject`
        $this->addForeignKey(
            'fk-group-subject_id',
            'group',
            'subject_id',
            '_subject',
            'id',
            'RESTRICT'
        );

        // creates index for column `teacher_id`
        $this->createIndex(
            'idx-group-teacher_id',
            'group',
            'teacher_id'
        );

        // add foreign key for table `_teacher`
        $this->addForeignKey(
            'fk-group-teacher_id',
            'group',
            'teacher_id',
            '_teacher',
            'id',
            'RESTRICT'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `_subject`
        $this->dropForeignKey(
            'fk-group-subject_id',
            'group',
        );

        // drops index for column `subject_id`
        $this->dropIndex(
            'idx-group-subject_id',
            'group',
        );

        // drops foreign key for table `_teacher`
        $this->dropForeignKey(
            'fk-group-teacher_id',
            'group',
        );

        // drops index for column `teacher_id`
        $this->dropIndex(
            'idx-group-teacher_id',
            'group',
        );

        $this->dropTable('{{%group}}');
    }
}
