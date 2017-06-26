<?php

use App\User;
use App\Event;
use App\Stand;
use App\Bookin;
use App\Company;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

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
	    $bookinQuantity = 5;

	    /**
	     * Creating the regular users and their companies
	     *
	     */ 

	    factory(User::class, $usersQuantity)->create()->each(function($user){
	    	$company_created = factory(Company::class)->create(['user_id' => $user->id
	    		]);
	    	$company_created->logo_url = "companies/company_" . $company_created->id . '/company-logo.png'; 
	    	$company_created->save();
	    });

	    /**
	     * Creating the events
	     *
	     */ 

	    $event_1 = factory(Event::class)->create([
	    	'id' => 1,
	    	'name' => "IEEE Conference 2017",
	    	'location' => "Av. Washington Soares, 999 - Edson Queiroz, Fortaleza - CE, 60811-341",
	    	'photo_url' => "events/event_1/event_center_ceara.jpg"
	    	]);

	    $event_2 = factory(Event::class)->create([
	    	'id' => 2,
	    	'name' => "Beach Park Conference",
	    	'location' => "Rua Porto das Dunas, 2734 - Porto das Dunas, Aquiraz - CE, 61700-000",
	    	'photo_url' => "events/event_2/beach_park.jpg"
	    	]);

	    $event_3 = factory(Event::class)->create([
	    	'id' => 3,
	    	'name' => "CBF Conference",
	    	'location' => "Av. Alberto Craveiro, 2901 - Castelão, Fortaleza - CE, 60861-211",
	    	'photo_url' => "events/event_3/castelao.jpg"
	    	]);


	    /**
	     * Creating the stands
	     *
	     */
	    factory(Stand::class)->create([
	    	'id' => 1,
	    	'name' => 'Pecém Stand',
	    	'event_id' => $event_1->id,
	    	]);
	    factory(Stand::class)->create([
	    	'id' => 2,
	    	'name' => 'Taíba Stand',
	    	'event_id' => $event_1->id,
	    	]);
	    factory(Stand::class)->create([
	    	'id' => 3,
	    	'name' => 'Mundaú Stand',
	    	'event_id' => $event_1->id,
	    	]);
	    factory(Stand::class)->create([
	    	'id' => 4,
	    	'name' => 'Almofala Stand',
	    	'event_id' => $event_1->id,
	    	]);
	    factory(Stand::class)->create([
	    	'id' => 5,
	    	'name' => 'Jericoacoara Stand',
	    	'event_id' => $event_1->id,
	    	]);

	    factory(Stand::class, 5)->create([
	    	'event_id' => $event_2->id
	    ]);
	    factory(Stand::class, 5)->create([
	    	'event_id' => $event_3->id
	    ]);
	    /**
	     * Creating the bookins
	     *
	     */ 


	    factory(Bookin::class, $bookinQuantity)
	    ->create()
	    ->each(function($bookin){
	    	// Get the stand
	    	$stand = $bookin->stand;

	    	// Choose a name to the doc file
	    	$file_name = 'marketing_doc.txt';
	    	$doc_url = 'events/event_' . $bookin->event->id . '/stand_' . $stand->id . '/' .$file_name;

	    	// Creating the marketing documents
	    	Storage::disk('files')->put($doc_url, 'Marketing Doc for '.$stand->name);

	    	$stand->document_url = $doc_url;
	    	$stand->save();
	    });


	    // Creatinf the admin user and company
	    $admin_user = factory(User::class)->create([
	    	"name" => "admin",
	    	"email" => "admin@admin.com",
	    	]);

	    factory(Company::class)->create(['user_id' => $admin_user->id,
	    	'admin' => Company::ADMIN_COMPANY
	    	]);

	}
}
