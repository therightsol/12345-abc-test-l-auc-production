<?php

namespace Modules\Users\Entities;

use App\Notifications\ResetPasswordNotification;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Modules\CommonBackend\Entities\BaseModel;

class UserModel extends BaseModel implements Authenticatable, CanResetPassword
{
    use softDeletes, Notifiable;

    protected $fillable = ['username', 'email', 'password'];

    protected $table = 'users';

    public function scopeFilter($query, $filters)
    {
        return $filters->apply($query);
    }

    public function getForeignKey()
    {
        return 'user_id';
    }

    public function hasRole($role)
    {
        return in_array($this->user_role, $role);
    }

    public function isAdmin(){
        return $this->user_role == 'admin' ? true : false;
    }

    /**
     * Get the name of the unique identifier for the user.
     *
     * @return string
     */
    public function getAuthIdentifierName()
    {
        // TODO: Implement getAuthIdentifierName() method.
        return 'id';
    }

    /**
     * Get the unique identifier for the user.
     *
     * @return mixed
     */
    public function getAuthIdentifier()
    {
        // TODO: Implement getAuthIdentifier() method.
        $name = $this->getAuthIdentifierName();

        return $this->attributes[$name];
    }

    /**
     * Get the password for the user.
     *
     * @return string
     */
    public function getAuthPassword()
    {
        // TODO: Implement getAuthPassword() method.
        return $this->attributes['password'];
    }

    /**
     * Get the token value for the "remember me" session.
     *
     * @return string
     */
    public function getRememberToken()
    {
        // TODO: Implement getRememberToken() method.
        return $this->attributes[$this->getRememberTokenName()];
    }

    /**
     * Set the token value for the "remember me" session.
     *
     * @param  string $value
     * @return void
     */
    public function setRememberToken($value)
    {
        // TODO: Implement setRememberToken() method.
        $this->attributes[$this->getRememberTokenName()] = $value;
    }

    /**
     * Get the column name for the "remember me" token.
     *
     * @return string
     */
    public function getRememberTokenName()
    {
        // TODO: Implement getRememberTokenName() method.
        return 'remember_token';
    }
	
	/**
	 * Get the e-mail address where password reset links are sent.
	 *
	 * @return string
	 */
	public function getEmailForPasswordReset ()
	{
		// TODO: Implement getEmailForPasswordReset() method.
		return $this->attributes['email'];
	}
	
	/**
	 * Send the password reset notification.
	 *
	 * @param  string $token
	 *
	 * @return void
	 */
	public function sendPasswordResetNotification ($token)
	{
		// TODO: Implement sendPasswordResetNotification() method.
		$this->notify(new ResetPasswordNotification($token));
		
	}

}
