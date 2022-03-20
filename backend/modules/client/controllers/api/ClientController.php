<?php

namespace backend\modules\client\controllers\api;

/**
* This is the class for REST controller "ClientController".
*/

use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;

class ClientController extends \yii\rest\ActiveController
{
public $modelClass = 'common\models\Client';
}
