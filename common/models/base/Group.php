<?php
// This class was automatically generated by a giiant build task
// You should not change it manually as it will be overwritten on next build

namespace common\models\base;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the base-model class for table "group".
 *
 * @property integer $id
 * @property string $name
 * @property integer $subject_id
 * @property integer $teacher_id
 * @property integer $level
 * @property integer $action
 * @property integer $type
 * @property integer $price
 * @property string $period_start
 * @property integer $duration
 * @property string $start_hour
 * @property string $end_hour
 * @property integer $status
 * @property integer $is_deleted
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $created_by
 * @property integer $updated_by
 *
 * @property \common\models\Subject $subject
 * @property \common\models\Teacher $teacher
 * @property \common\models\GroupDays[] $groupDays
 * @property string $aliasModel
 */
abstract class Group extends \yii\db\ActiveRecord
{



    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'group';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            [
                'class' => BlameableBehavior::className(),
            ],
            [
                'class' => TimestampBehavior::className(),
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'subject_id', 'teacher_id', 'level', 'action', 'type', 'period_start', 'duration', 'start_hour', 'end_hour'], 'required'],
            [['subject_id', 'teacher_id', 'level', 'action', 'type', 'price', 'duration', 'status', 'is_deleted'], 'integer'],
            [['name', 'period_start', 'start_hour', 'end_hour'], 'string', 'max' => 255],
            [['subject_id'], 'exist', 'skipOnError' => true, 'targetClass' => \common\models\Subject::className(), 'targetAttribute' => ['subject_id' => 'id']],
            [['teacher_id'], 'exist', 'skipOnError' => true, 'targetClass' => \common\models\Teacher::className(), 'targetAttribute' => ['teacher_id' => 'id']]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('models', 'ID'),
            'name' => Yii::t('models', 'Name'),
            'subject_id' => Yii::t('models', 'Subject ID'),
            'teacher_id' => Yii::t('models', 'Teacher ID'),
            'level' => Yii::t('models', 'Level'),
            'action' => Yii::t('models', 'Action'),
            'type' => Yii::t('models', 'Type'),
            'price' => Yii::t('models', 'Price'),
            'period_start' => Yii::t('models', 'Period Start'),
            'duration' => Yii::t('models', 'Duration'),
            'start_hour' => Yii::t('models', 'Start Hour'),
            'end_hour' => Yii::t('models', 'End Hour'),
            'status' => Yii::t('models', 'Status'),
            'is_deleted' => Yii::t('models', 'Is Deleted'),
            'created_at' => Yii::t('models', 'Created At'),
            'updated_at' => Yii::t('models', 'Updated At'),
            'created_by' => Yii::t('models', 'Created By'),
            'updated_by' => Yii::t('models', 'Updated By'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubject()
    {
        return $this->hasOne(\common\models\Subject::className(), ['id' => 'subject_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTeacher()
    {
        return $this->hasOne(\common\models\Teacher::className(), ['id' => 'teacher_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroupDays()
    {
        return $this->hasMany(\common\models\GroupDays::className(), ['group_id' => 'id']);
    }


    
    /**
     * @inheritdoc
     * @return \common\models\query\GroupQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\GroupQuery(get_called_class());
    }


}
