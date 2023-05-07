<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property string $name
 * @property int $phone
 * @property string $gmail
 * @property string $password
 * @property string|null $date
 * @property int|null $status
 */
class Users extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'phone', 'gmail', 'password'], 'required'],
            [['phone', 'status'], 'integer'],
            [['date'], 'safe'],
            [['name', 'gmail'], 'string', 'max' => 256],
            [['password'], 'string', 'max' => 128],
            [['gmail'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'نام و نام خانوادگی',
            'phone' => 'شماره موبایل',
            'gmail' => 'ایمیل',
            'password' => 'گذرواژه',
            'date' => 'تاریخ ثبت نام',
            'status' => 'وضعیت کاربر',
        ];
    }
}
