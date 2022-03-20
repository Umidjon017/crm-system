<?php

namespace backend\modules\group\forms;

use common\models\Group;
use common\models\GroupDays;
use Yii;
use yii\base\Model;
use yii\helpers\ArrayHelper;

class GroupCreateForm extends Model
{
    public $name;
    public $subject_id;
    public $teacher_id;
    public $level;
    public $action;
    public $type;
    public $price;
    public $period_start;
    public $duration;
    public $start_hour;
    public $end_hour;
    public $status;

    public $group_days;

    public function rules()
    {
        return [
            [['name', 'subject_id', 'teacher_id', 'level', 'action', 'type', 'price', 'period_start', 'duration', 'start_hour', 'end_hour', 'status'], 'required'],
            [['level', 'action', 'type', 'duration', 'status'], 'integer'],
            [['group_days', 'price'], 'safe'],
            [['name', 'period_start', 'subject_id', 'teacher_id', 'start_hour', 'end_hour'], 'string', 'max' => 255]
        ];
    }

    public function attributeLabels()
    {
        return ArrayHelper::merge(
            parent::attributeLabels(),
            [
                'teacher_id' => Yii::t('ui', 'Teacher name'),
                'subject_id' => Yii::t('ui', 'Subject name'),
                'start_hour' => Yii::t('ui', 'Start'),
                'end_hour' => Yii::t('ui', 'End'),
            ]
        );
    }

    public function saveData()
    {
        $groupModel = Group::create(
            $this->name,
            $this->subject_id,
            $this->teacher_id,
            $this->level,
            $this->action,
            $this->type,
            $this->price,
            $this->period_start,
            $this->duration,
            $this->start_hour,
            $this->end_hour,
            $this->status,
        );

        $transaction = Yii::$app->db->beginTransaction();
        try {
            if (!$groupModel->save(false)) {
                throw new \Exception('Произошла ошибка при сохранении данных.');
            }

            if($this->group_days){
                $groupModel->addGroupDays($groupModel, $this->group_days);
            }

            Yii::$app->session->setFlash('success', Yii::t('ui', "Данные созданы успешно"));
            $transaction->commit();
        } catch (\Exception $e) {
            Yii::$app->session->setFlash('error', Yii::t('ui', "Произошла ошибка. Пожалуйста, попробуйте еще раз") . $e->getMessage());
            $transaction->rollBack();
            throw $e;
        }
    }
}
