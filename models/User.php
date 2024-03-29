<?php

namespace app\models;

use app\models\AuthAssignment;
use yii\base\Model;

class User extends \yii\base\BaseObject implements \yii\web\IdentityInterface
{
    public $id;
    public $username;
    public $password;
    public $authKey;
    public $accessToken;

    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        if (($user = Users::findOne(['id' => $id])) !== null) {

                return new static([
                    'id' => $user->id,
                    'username' => $user->phone,
                    'password' => $user->password,
                    'authKey' => 'user',
                    'accessToken' => '100-token',
                ]);

        }
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {

            // if ('100-token' === $token) {
            //     return new static([
            //         'id' => '1',
            //         'username' => 'mohammadmokhtari@gmail.com',
            //         'password' => '12345',
            //         'authKey' => 'test100key',
            //         'accessToken' => '100-token',
            //     ]);
            // }


        return null;
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        if (($user = Users::findOne(['phone' => $username])) !== null) {

                return new static([
                    'id' => $user->id,
                    'username' => $user->phone,
                    'password' => $user->password,
                    'authKey' => 'user',
                    'accessToken' => '100-token',
                ]);
        }

        return null;
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return $this->password === $password;
    }
}
