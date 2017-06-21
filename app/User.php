<?php
/**
 * This is a model for User
 *
 */
namespace App;

use App\Bookin;
use App\Company;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * It returns the company that refers to the user
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function company(){
        return $this->hasOne(Company::class);
    }
    /**
     * It returns the bookins of an user
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function bookins(){
        return $this->hasMany(Bookin::class);
    }

    
}
