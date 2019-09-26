<?php

namespace app\models;

use app\models\activeRecord\User;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "loan".
 *
 * @property int $id
 * @property int $user_id
 * @property string $amount
 * @property string $interest
 * @property int $duration
 * @property string $start_date
 * @property string $end_date
 * @property int $campaign
 * @property bool $status
 */
class Loan extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'loan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'amount', 'interest', 'duration', 'start_date', 'end_date', 'campaign'], 'required'],
            [['user_id', 'duration', 'campaign'], 'default', 'value' => null],
            [['user_id', 'duration', 'campaign'], 'integer'],
            [['amount', 'interest'], 'number'],
            [['start_date', 'end_date'], 'safe'],
            [['start_date', 'end_date'], 'date', 'format' => 'Y-m-d',],
            [['status'], 'boolean'],
            [['start_date', 'end_date'], 'validatePastDate'],
            ['end_date', 'validateEndDate'],
            ['user_id', 'validateUserExistence'],
            ['user_id', 'validateUserUnderAge']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id'         => 'ID',
            'user_id'    => 'User ID',
            'amount'     => 'Amount',
            'interest'   => 'Interest',
            'duration'   => 'Duration',
            'start_date' => 'Start Date',
            'end_date'   => 'End Date',
            'campaign'   => 'Campaign',
            'status'     => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     *  Start date and End Date would not be from the past days
     * @param $attribute
     * @param $params
     * @param $validator
     */
    public function validatePastDate($attribute, $params, $validator)
    {
        $now       = new \DateTime(date('Y-m-d'));
        $startDate = new \DateTime($this->$attribute);
        if ($now > $startDate) {
            $this->addError($attribute, 'You can not choose a day from the past');
        }
    }

    /**
     * End date would not be before start date
     * @param $attribute
     * @param $params
     * @param $validator
     */
    public function validateEndDate($attribute, $params, $validator)
    {
        $startDate = new \DateTime($this->start_date);
        $endDate   = new \DateTime($this->end_date);
        if ($endDate < $startDate) {
            $this->addError($attribute, 'You have choose a day after the start date ');
        }
    }

    /**
     * Check if the User exist in the database by selected id
     * @param $attribute
     * @param $params
     * @param $validator
     */
    public function validateUserExistence($attribute, $params, $validator)
    {
        if (is_null(User::findOne($this->user_id))) {
            $this->addError($attribute, "User with id $this->user_id does not exist");
        }
    }

    /**
     * Validate if User age is under 18
     * @param $attribute
     * @param $params
     * @param $validator
     */
    public function validateUserUnderAge($attribute, $params, $validator)
    {
        $user = User::findOne($this->user_id);
        if ($user->age < 18) {
            $this->addError($attribute,
                "The Age of this user must be greater than 18");
        }
    }
}
