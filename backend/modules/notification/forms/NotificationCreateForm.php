<?php

namespace backend\modules\notification\forms;

use common\models\Notification;
use yii\base\Model;

class NotificationCreateForm extends Model
{
    public $title;
    public $description;
    public $group;
    public $status;

    public function rules()
    {
        return [
            [['title', 'description', 'group', 'status'], 'required'],
            [['group', 'status'], 'integer'],
            [['title', 'description'], 'string']
        ];
    }

    public function saveData()
    {
        $notificationModel = Notification::create(
            $this->title,
            $this->description,
            $this->group,
            $this->status
        );

        $notificationModel->save();
    }
}
