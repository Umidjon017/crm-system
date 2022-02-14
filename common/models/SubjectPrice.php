<?php

namespace common\models;

use Yii;
use \common\models\base\SubjectPrice as BaseSubjectPrice;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "_subject_price".
 */
class SubjectPrice extends BaseSubjectPrice
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
