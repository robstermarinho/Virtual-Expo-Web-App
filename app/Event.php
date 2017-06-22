<?php
/**
 * This is a model for Event
 *
 */
namespace App;

use App\Stand;
use App\Bookin;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    /**
     * It returns the bookins of a certain event
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function bookins(){
        return $this->hasMany(Bookin::class);
    }
    /**
     * It returns the stands of an event
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function stands(){
        return $this->hasMany(Stand::class, 'event_id');
    }    
}
