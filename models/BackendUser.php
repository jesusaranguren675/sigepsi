<?php

namespace app\models;

use Yii;
/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $username
 * @property string $auth_key
 * @property string $password_hash
 * @property string|null $password_reset_token
 * @property string $email
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 * @property string|null $verification_token
 */
class BackendUser extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{

    public $created_at;
    public $updated_at;
    public $password_reset_token;
    public $verification_token;
    public $id_comunidad;

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
            [['username', 'auth_key', 'password_hash', 'email', 'created_at', 'updated_at'], 'required'],
            [['status', 'created_at', 'updated_at'], 'default', 'value' => null],
            [['status', 'created_at', 'updated_at'], 'integer'],
            [['username', 'password_hash', 'password_reset_token', 'email', 'verification_token'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['email'], 'unique'],
            [['password_reset_token'], 'unique'],
            [['username'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
     public function attributeLabels()
     {
         return [
             'id' => 'ID',
             'username' => 'Nombre de usuario',
             'auth_key' => 'Auth Key',
             'password_hash' => 'Contraseña',
             'password_reset_token' => 'Password Reset Token',
             'email' => 'Correo Electrónico',
             'status' => 'Estatus',
             'created_at' => 'Created At',
             'updated_at' => 'Updated At',
             'verification_token' => 'Verification Token',
         ];
     }


    public static function findIdentity($id){
        return static::findOne($id);
    }
 
    public static function findIdentityByAccessToken($token, $type = null){
        throw new NotSupportedException();//I don't implement this method because I don't have any access token column in my database
    }
 
    public function getId(){
        return $this->id;
    }
 
    public function getAuthKey(){
        //return $this->authKey;//Here I return a value of my authKey column
    }
 
    public function validateAuthKey($authKey){
        //return $this->authKey === $authKey;
    }

    public static function findByUsername($username){
        return self::findOne(['username'=>$username]);
    }
 
    public function validatePassword($password){

        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }


}
