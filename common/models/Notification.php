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
    const GROUP_ALL = 1;
    const GROUP_TEACHER = 2;
    const GROUP_PUPIL = 3;

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

    public static function create(
        $title,
        $description,
        $group,
        $status
    )
    {
        $model = new Notification();

        $model->title = $title;
        $model->description = $description;
        $model->group = $group;
        $model->status = $status;

        return $model;
    }

    public function editData(
        $title,
        $description,
        $group,
        $status
    )
    {
        $this->title = $title;
        $this->description = $description;
        $this->group = $group;
        $this->status = $status;
    }
}
