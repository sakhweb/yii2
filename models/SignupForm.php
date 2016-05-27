<?
namespace app\models;

use yii\base\Model;
use Yii;

/**
 * Signup form
 */
class SignupForm extends Model
{
	public $name;
	public $email;
	public $phone;
	public $password;
	public $verifyCode;

	public function rules()
	{
		return [
			['name', 'filter', 'filter' => 'trim'],
			['name', 'required'],
			['name', 'match', 'pattern' => '#^[\w_-]+$#i'],
			['name', 'unique', 'targetClass' => User::className(), 'message' => 'This username has already been taken.'],
			['name', 'string', 'min' => 2, 'max' => 255],

			['email', 'filter', 'filter' => 'trim'],
			['email', 'required'],
			['email', 'email'],
			['email', 'unique', 'targetClass' => User::className(), 'message' => 'This email address has already been taken.'],

			['phone', 'filter', 'filter' => 'trim'],
			['phone', 'required'],
			['phone', 'string', 'min' => 11, 'max'=>12],

			['password', 'required'],
			['password', 'string', 'min' => 6],

			['verifyCode', 'captcha', 'captchaAction' => '/site/captcha'],
		];
	}

	/**
	 * Signs user up.
	 *
	 * @return User|null the saved model or null if saving fails
	 */
	public function signup()
	{
		if ($this->validate()) {
			$user = new User();
			$user->name = $this->name;
			$user->email = $this->email;
			$user->phone = $this->phone;
			$user->setPassword($this->password);
			$user->status = User::STATUS_WAIT;
			$user->role_id = User::REG_USER;
			$user->generateAuthKey();
			$user->generateEmailConfirmToken();

			if ($user->save()) {
				Yii::$app->mailer->compose('@app/mail/emailConfirm', ['user' => $user])
					->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name])
					->setTo($this->email)
					->setSubject('Email confirmation for ' . Yii::$app->name)
					->send();
			} else {
				Yii::$app->getSession()->setFlash('error', 'error');
				return false;
			}

			return $user;
		}

		return null;
	}
}
?>