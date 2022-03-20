<?php

namespace backend\modules\client\forms;

use common\models\Client;
use Yii;
use yii\base\Model;

class ClientUpdateForm extends Model
{
    public $full_name;
    public $gender;
    public $visited_date;
    public $comment;
    public $status;

    public $groupList;

    private $client;

    public function __construct(Client $client, $config = [])
    {
        $this->client = $client;

        $this->full_name = $client->full_name;
        $this->gender = $client->gender;
        $this->visited_date = $client->visited_date;
        $this->comment = $client->comment;
        $this->status = $client->status;

        foreach ($client->groups as $group){
            $this->groupList[] = $group->id;
        }
        parent::__construct($config);
    }

    public function rules()
    {
        return [
            [['full_name','gender','visited_date','status','comment', 'groupList'],'required'],
            [['status','gender'],'integer'],
            ['groupList','safe'],
            [['full_name','comment'],'string']
        ];
    }

    public function saveData(): bool
    {
        $this->client->editData(
            $this->full_name,
            $this->gender,
            $this->visited_date,
            $this->comment,
            $this->status,
        );

        $transaction = Yii::$app->db->beginTransaction();
        try {
            if ($this->client->update() === false) {
                throw new \RuntimeException('Ошибка сохранения.');
            }

            $this->client->unlinkAll('groups', true);

            $this->client->addGroups($this->groupList);

            Yii::$app->session->setFlash('success', Yii::t('ui', "Данные созданы успешно"));
            $transaction->commit();

            return true;
        } catch (\Exception $e) {
            Yii::$app->session->setFlash('error', Yii::t('ui', "Произошла ошибка. Пожалуйста, попробуйте еще раз") . $e->getMessage());
            $transaction->rollBack();
            throw $e;
            return false;
        }
    }
}