var virtualExpoApp = angular.module('virtualExpoApp', 
	['ui.bootstrap', // Handle bootstrap functions in AngularJS
	'uiGmapgoogle-maps',
	'ngRoute'])
.config(
    ['uiGmapGoogleMapApiProvider', function(GoogleMapApiProviders) {
        GoogleMapApiProviders.configure();
    }]
)
.config(function($routeProvider, $locationProvider){

    $locationProvider.hashPrefix('!');

    //Home page
    $routeProvider.when('/',{
        templateUrl: 'app/partials/map.html',
        controller: 'HomeController'
    });

    //Event page
    $routeProvider.when('/event/:eventId',{
        templateUrl: 'app/partials/event.html',
        controller: 'EventController'
    });
});