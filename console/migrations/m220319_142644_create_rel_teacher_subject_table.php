<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%rel_teacher_subject}}`.
 */
class m220319_142644_create_rel_teacher_subject_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{_rel_teacher_subject}}', [
            'id' => $this->primaryKey(),
            'teacher_id' => $this->integer()->notNull(),
            'subject_id' => $this->integer()->notNull(),
            'status' => $this->tinyInteger(1)->notNull()->defaultValue(1)->comment('0 -> False, 1 -> true'),
            'is_deleted' => $this->tinyInteger(1)->notNull()->defaultValue(0),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'created_by' => $this->integer()->notNull(),
            'updated_by' => $this->integer()->notNull(),
        ]);

        // Teacher
        $this->createIndex(
            'idx-rel_teacher_subject-teacher_id',
            '_rel_teacher_subject',
            'teacher_id'
        );

        $this->addForeignKey(
            'fk-rel_teacher_subject-teacher_id',
            '_rel_teacher_subject',
            'teacher_id',
            '_teacher',
            'id',
            'RESTRICT'
        );

        // Subject
        $this->createIndex(
            'idx-rel_teacher_subject-subject_id',
            '_rel_teacher_subject',
            'subject_id'
        );

        $this->addForeignKey(
            'fk-rel_teacher_subject-subject_id',
            '_rel_teacher_subject',
            'subject_id',
            '_subject',
            'id',
            'RESTRICT'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // Subject
        $this->dropForeignKey(
            'fk-rel_teacher_subject-subject_id',
            '_rel_teacher_subject'
        );

        $this->dropIndex(
            'idx-rel_teacher_subject-subject_id',
            '_rel_teacher_subject'
        );

        // Teacher
        $this->dropForeignKey(
            'fk-rel_teacher_subject-teacher_id',
            '_rel_teacher_subject'
        );

        $this->dropIndex(
            'idx-rel_teacher_subject-teacher_id',
            '_rel_teacher_subject'
        );

        $this->dropTable('{{_rel_teacher_subject}}');
    }
}
