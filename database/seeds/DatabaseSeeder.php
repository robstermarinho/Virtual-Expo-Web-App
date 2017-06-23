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

	    $usersQuantity = 3;
	    $eventQuantity = 3;
	    $standQuantity = 12;
	    $bookinQuantity = 3;

	    /**
	     * Creating the users and their companies
	     *
	     */ 
	    factory(User::class, $usersQuantity)->create()->each(function($user){
	    	factory(Company::class)->create(['user_id' => $user, 'logo_url' => 'company-logo.png']);
	    });

	    /**
	     * Creating the events
	     *
	     */ 	    
	    factory(Event::class)->create([
	    	'name' => "Beach Park Conference",
	    	'location' => "Rua Porto das Dunas, 2734 - Porto das Dunas, Aquiraz - CE, 61700-000",
	    	'photo_url' => "beach_park.jpg"
	    	]);

	    $event_center = factory(Event::class)->create([
	    	'name' => "IEEE Conference 2017",
	    	'location' => "Av. Washington Soares, 999 - Edson Queiroz, Fortaleza - CE, 60811-341",
	    	'photo_url' => "event_center_ceara.jpg"
	    	]);

	    factory(Event::class)->create([
	    	'name' => "CBF Conference",
	    	'location' => "Av. Alberto Craveiro, 2901 - Castelão, Fortaleza - CE, 60861-211",
	    	'photo_url' => "castelao.jpg"
	    	]);


	    /**
	     * Creating the stands
	     *
	     */
	    factory(Stand::class)->create([
	    	'name' => 'Pecém Stand',
	    	'event_id' => $event_center->id,
	    	'photo_url' => 'stand-photo.png'
	    	]);
	    factory(Stand::class)->create([
	    	'name' => 'Taíba Stand',
	    	'event_id' => $event_center->id,
	    	'photo_url' => 'stand-photo.png'
	    	]);
	    factory(Stand::class)->create([
	    	'name' => 'Mundaú Stand',
	    	'event_id' => $event_center->id,
	    	'photo_url' => 'stand-photo.png'
	    	]);
	    factory(Stand::class)->create([
	    	'name' => 'Almofala Stand',
	    	'event_id' => $event_center->id,
	    	'photo_url' => 'stand-photo.png'
	    	]);
	    factory(Stand::class)->create([
	    	'name' => 'Jericoacoara Stand',
	    	'event_id' => $event_center->id,
	    	'photo_url' => 'stand-photo.png'
	    	]);

	    /**
	     * Creating the bookins
	     *
	     */ 


	    factory(Bookin::class, $bookinQuantity)->create();


	}
}
