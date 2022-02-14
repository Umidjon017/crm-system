<?php

namespace common\models;

use Yii;
use \common\models\base\Subject as BaseSubject;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "_subject".
 */
class Subject extends BaseSubject
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