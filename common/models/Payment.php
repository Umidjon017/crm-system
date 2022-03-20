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
    const TYPE_INCOME = 1;
    const TYPE_OUTCOME = 0;
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
}
