<?php

use App\User;
use App\Event;
use App\Stand;
use App\Bookin;
use App\Company;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){


	    /**
	     * Disable Foreign Key Checks
	     *
	     */   
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
	    /**
	     * We have to truncate all tables (original state)
	     *
	     */    
	    Company::truncate();	
	    User::truncate();
	    Bookin::truncate();
	    Stand::truncate();
	    Event::truncate();

	    /**
	     * Run factories
	     *
	     */  

	    $usersQuantity = 10;
	    $eventQuantity = 5;
	    $standQuantity = 100;
	    $bookinQuantity = 30;

	    /**
	     * Create the users and their companies
	     *
	     */ 
	    factory(User::class, $usersQuantity)->create()->each(function($user){
	    	factory(Company::class)->create(['user_id' => $user]);
	    });
	    factory(Event::class, $eventQuantity)->create();
	    factory(Stand::class, $standQuantity)->create();

	    /**
	     * Create the bookins and change their stand to unavailabe
	     *
	     */ 	    
	    factory(Bookin::class, $bookinQuantity)->create()
	    ->each(function($bookin){
	    	$stand = $bookin->stand;
	    	$stand->status = Stand::UNAVAILABLE_STAND;
	    	$stand->save();
	    });


	}
}
