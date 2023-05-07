<?php

namespace app\models;

use Yii;
use yii\base\Model;
use app\models\User;
use app\models\Users;

/**
 * LoginForm is the model behind the login form.
 *
 * @property-read User|null $user
 *
 */
class LoginForm extends Model
{
    public $username;
    public $password;
    public $rememberMe = true;

    private $_user = false;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['username', 'password'], 'required'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
        ];
    }


    /**
     * Logs in a user using the provided username and password.
     * @return bool whether the user is logged in successfully
     */
    public function login()
    {
        $user=Users::find()->where(['phone'=>$this->username])->one();
        if (!$user || $user->password!=$this->password) {
            $this->addError($attribute, 'Incorrect username or password.');
        }else{
            $this->_user=User::findByUsername($this->username);
            return Yii::$app->user->login($this->_user, $this->rememberMe ? 3600*24*30 : 0);
        }
        return false;
    }
}
