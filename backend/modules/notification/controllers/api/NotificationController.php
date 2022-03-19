<?php

namespace backend\modules\notification\controllers\api;

/**
* This is the class for REST controller "NotificationController".
*/

use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;

class NotificationController extends \yii\rest\ActiveController
{
public $modelClass = 'common\models\Notification';
}
