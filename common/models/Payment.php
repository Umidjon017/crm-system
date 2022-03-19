<?php

namespace common\models;

use Yii;
use \common\models\base\Payment as BasePayment;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "payment".
 */
class Payment extends BasePayment
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
