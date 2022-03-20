<?php

namespace common\models;

use common\models\base\Pupil as BasePupil;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "_pupil".
 */
class Pupil extends BasePupil
{
    const GENDER_MALE = 1;
    const GENDER_FEMALE = 0;

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

    #region Getters
    public static function getCount()
    {
        return Pupil::find()->count();
    }
    #endregion
}
