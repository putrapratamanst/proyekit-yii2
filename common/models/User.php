<?php
namespace common\models;

use Yii;
use yii\base\NotSupportedException;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\web\IdentityInterface;
use yii\helpers\Security;
use backend\models\Role;
use backend\models\Status;

use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\helpers\Html;
/**
 * User model
 *
 * @property integer $id
 * @property string $username
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property string $auth_key
 * @property integer $status_id
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $password write-only password
 */
class User extends ActiveRecord implements IdentityInterface
{
    const STATUS_PENDING = 10;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
     public function behaviors()
   {
   return [
   'timestamp' => [
   'class' => 'yii\behaviors\TimestampBehavior',
   'attributes' => [
   ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
   ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
   ],
   'value' => new Expression('NOW()'),
   ],
   ];
   }

    /**
     * @inheritdoc
     */
     public function rules()
   {
   return [
   ['status_id', 'default', 'value' => self::STATUS_PENDING],
   [['status_id'],'in', 'range'=>array_keys($this->getStatusList())],
   ['role_id', 'default', 'value' => 10],
   [['role_id'],'in', 'range'=>array_keys($this->getRoleList())],
   ['username', 'filter', 'filter' => 'trim'],
 ['username', 'required'],
 ['username', 'string', 'min' => 2, 'max' => 255],
 ['email', 'filter', 'filter' => 'trim'],
 ['email', 'required'],
 ['email', 'email'],
 ['email', 'unique'],
 ];
 }


 public function attributeLabels()
{
return [
/* Your other attribute labels */
'roleName' => Yii::t('app', 'Role'),
'statusName' => Yii::t('app', 'Status'),
'mahasiswaId' => Yii::t('app', 'Mahasiswa'),
'mahasiswaLink' => Yii::t('app', 'Mahasiswa'),
'userLink' => Yii::t('app', 'User'),
'username' => Yii::t('app', 'User'),
'userIdLink' => Yii::t('app', 'ID'),
];
}
    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status_id' => self::STATUS_PENDING]);
    }

    /**
     * @inheritdoc
     */
     public static function findIdentityByAccessToken($token, $type = null)
 {
 return static::findOne(['auth_key' => $token]);
 }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
     public static function findByUsername($username)
   {
   return static::findOne(['username' => $username, 'status_id' =>
   self::STATUS_PENDING]);
   }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
     public static function findByPasswordResetToken($token)
   {
     $expire = Yii::$app->params['user.passwordResetTokenExpire'];
$parts = explode('_', $token);
$timestamp = (int) end($parts);
if ($timestamp + $expire < time()) {
// token expired
return null;
}
return static::findOne([
'password_reset_token' => $token,
'status_id' => self::STATUS_ACTIVE,
]);
}

public function getId()
{
return $this->getPrimaryKey();
}

public function getAuthKey()
{
return $this->auth_key;
}

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return boolean
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }



    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }
    public function getRole()
{
return $this->hasOne(Role::className(), ['role_value' => 'role_id']);
}


public function getRoleName()
{
return $this->role ? $this->role->role_name : '- no role -';
}


public static function getRoleList()
{
$droptions = Role::find()->asArray()->all();
return Arrayhelper::map($droptions, 'role_value', 'role_name');
}



public function getStatus()
{
return $this->hasOne(Status::className(), ['status_value' => 'status_id']);
}

public function getStatusName()
{
  return $this->status ? $this->status->status_name : '- no status -';
}

public static function getStatusList()
{
$droptions = Status::find()->asArray()->all();
return Arrayhelper::map($droptions, 'status_value', 'status_name');
}


public function getMahasiswa()
{
return $this->hasOne(Mahasiswa::className(), ['user_id' => 'id']);
}

public function getMahasiswaId()
{
return $this->mahasiswa ? $this->mahasiswa->id : 'none';
}

public function getMahasiswaLink()
{
$url = Url::to(['mahasiswa/view', 'id'=>$this->mahasiswaId]);
$options = [];
return Html::a($this->mahasiswa ? 'mahasiswa' : 'none', $url, $options);
}
public function getUserIdLink()
{
$url = Url::to(['user/update', 'id'=>$this->id]);
$options = [];
return Html::a($this->id, $url, $options);
}


public function getUserLink()
{
  $url = Url::to(['user/view', 'id'=>$this->Id]);
$options = []; //
return Html::a($this->username, $url, $options);
}




}
