<?php

namespace backend\modules\notification\forms;

use common\models\Notification;
use yii\base\Model;

class NotificationUpdateForm extends Model
{
    public $title;
    public $description;
    public $group;
    public $status;

    private $notification;

    public function __construct(Notification $notification, $config = [])
    {
        $this->notification = $notification;

        $this->title = $notification->title;
        $this->description = $notification->description;
        $this->group = $notification->group;
        $this->status = $notification->status;

        parent::__construct($config);
    }

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
        $this->notification->editData(
            $this->title,
            $this->description,
            $this->group,
            $this->status
        );

        $this->notification->update();
    }
}
