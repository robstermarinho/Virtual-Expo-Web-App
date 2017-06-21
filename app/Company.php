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
     * The attributes that are mass assignable
     *
     * @var array
     */
    protected $fillable = [
        'company_name', 'logo_url', 'document_url',
    ];

    /**
     * It returns the user that the company belongs to
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(){
    	return $this->belongsTo(User::class);
    }
    
}
