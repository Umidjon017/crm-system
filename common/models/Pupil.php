<?php

namespace common\models;

use Yii;
use \common\models\base\Pupil as BasePupil;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "_pupil".
 */
class Pupil extends BasePupil
{

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
}
