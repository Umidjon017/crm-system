<?php

namespace common\models;

use Yii;
use \common\models\base\RelTeacherSubject as BaseRelTeacherSubject;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "_rel_teacher_subject".
 */
class RelTeacherSubject extends BaseRelTeacherSubject
{
    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;

    public function behaviors()
    {
        return ArrayHelper::merge(
            parent::behaviors(),
            [
                # custom behaviors
            ]
        );
    }

    public function rules()
    {
        return ArrayHelper::merge(
            parent::rules(),
            [
                # custom validation rules
            ]
        );
    }

    #region iSOLID
    public static function createByTeacher($teacher_id, $subject_id)
    {
        $newModel = new RelTeacherSubject;

        $newModel->teacher_id = $teacher_id;
        $newModel->subject_id = $subject_id;
        $newModel->status = RelTeacherSubject::STATUS_ACTIVE;

        return $newModel;
    }
    #endregion
}
