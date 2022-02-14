<?php

namespace backend\modules\catalog\controllers\api;

/**
* This is the class for REST controller "SubjectController".
*/

use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;

class SubjectController extends \yii\rest\ActiveController
{
public $modelClass = 'common\models\Subject';
}
