<?php
/**
 * This is a model for Stand.
 *
 */
namespace App;

use App\Event;
use App\Bookin;
use Illuminate\Database\Eloquent\Model;

class Stand extends Model
{

    /**
     * It defines the availability of the stands
     *
     */
	const AVAILABLE_STAND = 'available';
	const UNAVAILABLE_STAND = 'unavailable';

    /**
     * It returns the event that this stand refers to
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function event(){
    	return $this->belongsTo(Event::class);
    }

    /**
     * It returns the booking that this stand is associated to
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function bookin(){
    	return $this->belongsTo(Bookin::class);
    }


}
