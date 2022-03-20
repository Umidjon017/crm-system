<?php

namespace backend\modules\client\forms;

use common\models\Client;
use Yii;
use yii\base\Model;

class ClientCreateForm extends Model
{
    public $full_name;
    public $gender;
    public $visited_date;
    public $comment;
    public $status;
    public $group_list;
    public $client_id;


    public function rules()
    {
        return [
            [['full_name','gender','visited_date','status', 'group_list'],'required'],
            [['status','gender'],'integer'],
            ['group_list', 'safe'],
            [['visited_date','comment', 'full_name'],'string']
        ];

    }

    public function saveData(): bool
    {
        $clientModel = Client::create(
            $this->full_name,
            $this->gender,
            $this->visited_date,
            $this->comment,
            $this->status
        );

        $transaction = Yii::$app->db->beginTransaction();
        try {
            if (!$clientModel->save(false)) {
                throw new \Exception('Произошла ошибка при сохранении данных.');
            }

            $this->client_id=$clientModel->id;
            $clientModel->addGroups($this->group_list);

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