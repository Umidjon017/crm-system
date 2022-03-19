<?php

namespace backend\modules\payment\controllers\api;

/**
* This is the class for REST controller "PaymentController".
*/

use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;

class PaymentController extends \yii\rest\ActiveController
{
public $modelClass = 'common\models\Payment';
}
