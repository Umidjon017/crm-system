<?php

namespace common\models;

use Yii;
use \common\models\base\Notification as BaseNotification;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "notification".
 */
class Notification extends BaseNotification
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
