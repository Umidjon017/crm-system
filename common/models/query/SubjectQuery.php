<?php

namespace common\models\query;

use common\models\Subject;

/**
 * This is the ActiveQuery class for [[\common\models\Subject]].
 *
 * @see \common\models\Subject
 */
class SubjectQuery extends \yii\db\ActiveQuery
{
    public $tableName = '_subject';

    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return \common\models\Subject[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \common\models\Subject|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    public function active()
    {
        return $this->andWhere(["$this->tableName.status" => Subject::STATUS_ACTIVE]);
    }
}
