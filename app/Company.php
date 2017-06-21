<?php
/**
 * This is a model for Company
 *
 */
namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{

    /**
     * Table name in database
     *
     * @var string
     */
    protected $table = 'companies';

    /**
     * Roles in the system
     *
     * @var string
     */ 	
    const ADMIN_COMPANY = 'true';
    const REGULAR_COMPANY = 'false';
    
    /**
     * The attributes that are mass assignable
     *
     * @var array
     */
    protected $fillable = [
    	'name', 'admin','logo_url', 'document_url'
    ];

    /**
     * It returns the user that the company belongs to
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(){
    	return $this->belongsTo(User::class);
    }
    
    /**
     * It returns TRUE if the company has admin role
     *
     * @return boolean
     */
    public function isAdmin(){
    	return $this->admin == Company::ADMIN_COMPANY;
    }
}
