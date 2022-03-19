<?php

namespace backend\modules\catalog\controllers\api;

/**
* This is the class for REST controller "RoomController".
*/

use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;

class RoomController extends \yii\rest\ActiveController
{
public $modelClass = 'common\models\Room';
}
