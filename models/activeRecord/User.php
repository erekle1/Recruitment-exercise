<?php

namespace app\models\activeRecord;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property int $personal_code
 * @property int $phone
 * @property bool $active
 * @property bool $dead
 * @property string $lang
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['first_name', 'last_name', 'email', 'personal_code', 'phone'], 'required'],
            [['first_name', 'last_name', 'email',], 'string', 'length' => [1, 100]],
            [['personal_code', 'phone'], 'default', 'value' => null],
            [['personal_code', 'phone'], 'integer'],
            [['active', 'dead'], 'boolean'],
            ['email', 'email'],
            ['email', 'unique'],
            [
                'personal_code',
                'validatePersonalCode',
            ]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'email' => 'Email',
            'personal_code' => 'Personal Code',
            'phone' => 'Phone',
            'active' => 'Active',
            'dead' => 'Dead',
            'lang' => 'Lang',
        ];
    }

    public function validatePersonalCode($attribute, $params, $validator)
    {
        /*
         * Check first number of personal Code (must be between [1,...,5,6])
         */
        $centurySign = intval(substr($this->$attribute, 0, 1));
        if ($centurySign < 1 || $centurySign > 6) {
            $this->addError($attribute, 'Personal Code is invalid.');
        }

        /*
         * Check Length of Personal Code (must be 11 digit)
         */
        if (strlen($this->$attribute) != 11) {
            $this->addError($attribute, "Personal Code must be consists of 11 digits.");
        }

        /*
         * Check if date from Personal code is valid
         */
        $dateFromPersonalCode = $this->getDateFromPersonalCode($this->$attribute);
        $d                    = \DateTime::createFromFormat('Y-d-m', $dateFromPersonalCode);
        if ($d && $d->format('Y-d-m') !== $dateFromPersonalCode) {
            $this->addError($attribute, 'Personal Code is invalid');
        }

    }

    public function getAge($baseDate = null)
    {
        is_null($baseDate) ? $bDate = date('Y-m-d') : $bDate = $baseDate;
        $personalCode         = $this->personal_code;
        $dateFromPersonalCode = $this->getDateFromPersonalCode($personalCode);
        $birthDay             = new \DateTime($dateFromPersonalCode);
        $now                  = new \DateTime($bDate);
        $age                  = $now->diff($birthDay)->y;

        return $age;
    }

    private function getDateFromPersonalCode($personalCode)
    {
        $centurySign = substr($personalCode, 0, 1);

        $century = "";
        switch ($centurySign) {
            case 1:
            case 2:
                $century = "18";
                break;
            case 3:
            case 4:
                $century = "19";
                break;
            case 5:
            case 6:
                $century = "20";
                break;
        }
        $year  = $century . substr($personalCode, 1, 2);
        $month = substr($personalCode, 3, 2);
        $day   = substr($personalCode, 5, 2);

        return "$year-$month-$day";
    }
}