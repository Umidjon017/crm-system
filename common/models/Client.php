<?php

namespace common\models;

use Yii;
use \common\models\base\Client as BaseClient;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "client".
 * @property \common\models\Group[] $groups
 * @property \common\models\ClientPhone[] $clientPhones
 */
class Client extends BaseClient
{
    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;

    const GENDER_MALE = 1;
    const GENDER_FEMALE = 0;

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
    public function attributeLabels()
    {
        return ArrayHelper::merge(
            parent::attributeLabels(),
            [
                'viewActiveTypes' => Yii::t('ui', 'type')
            ]
        );
    }


    #region Checkers
    public function isCurrentPhones($phones)
    {
        return $this->getActivePhones() === $phones;
    }
    #endregion

    public function getGroupsText()
    {
        $result = '';
        foreach ($this->groups as $group) {
            $result .= $group->name . '; ' ;
        }
        return $result;
    }

    public function getPhoneText()
    {
        $result = '';
        foreach ($this->clientPhones as $phone) {
            $result .= $phone->phone . '; ';
        }
        return $result;
    }

    public function getPhoneTypeText()
    {
        $result = '';
        foreach ($this->clientPhones as $type) {
            if($type->type==1){
                $result .="Mobile phone; ";
            }else{
                $result .="Home phone;";
            }
        }
        return $result;
    }

    public function getGroups()
    {
        return $this->hasMany(Group::class, ['id' => 'group_id'])
            ->via('relClientGroups');
    }

    #region Viewer
    public function getViewActivePhones()
    {
        return nf($this->getActivePhones());
    }
    #endregion
    public function addGroups(array $group_list)
    {
        foreach ($group_list as $group_id) {
            $groupModel = Group::findOne($group_id);
            $this->link('groups', $groupModel);
        }
    }

    #region iSOLID
    public static function create(
        $full_name,
        $gender,
        $visited_date,
        $comment,
        $status
    )
    {
        $model = new Client();
        $model->full_name = $full_name;
        $model->gender = $gender;
        $model->visited_date = $visited_date;
        $model->comment = $comment;
        $model->status = $status;

        return $model;
    }

    public function editData($full_name,$gender,$visited_date,$comment, $status)
    {
        $this->full_name = $full_name;
        $this->gender = $gender;
        $this->visited_date = $visited_date;
        $this->comment = $comment;
        $this->status = $status;
    }
    #endregion

}
