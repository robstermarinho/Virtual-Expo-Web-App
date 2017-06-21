<?php
/**
 * This is a model for Bookin
 *
 */
namespace App;

use App\User;
use App\Event;
use App\Stand;
use Illuminate\Database\Eloquent\Model;

class Bookin extends Model
{
    /**
     * It returns the user responsible for this booking
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(){
        return $this->belongsTo(User::class);
    }
    /**
     * It returns the event of this booking
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function event(){
        return $this->belongsTo(Event::class);
    }

    /**
     * It returns the stand for this booking
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function stand(){
        return $this->belongsTo(Stand::class);
    }    
}
