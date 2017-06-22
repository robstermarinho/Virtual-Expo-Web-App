angular.module('virtualExpoApp').controller('HomeController', ['$scope', '$http', function($scope, $http){

	$scope.title = 'Events Expo';
	$scope.events = {};
	$scope.single_event;

	// Get all events
	$scope.getAllEvents = function() {
		$http.get('/api/events')
		.then(function successCallback(response) {
			var result = [];
			if (response.data) {

				response.data.forEach(function(event, index){
					result.push({
						info: event,
						coords:  $scope.getCoords(event.location),
						options: {
							labelContent: event.name,
							labelAnchor:"22 0",
							labelClass:"marker-labels",
						}
					});
				})
				console.log(result);
				$scope.events = result;
			} else {
				$scope.message = "No events";
			}}, function errorCallback(error) {
				$scope.message = "Server Error";
			});
	};	


	// A function to get coords of the event in the map
	$scope.getCoords = function(address) {
		var coords = {
			latitude : 0,
			longitude: 0
		};
		var key = 'AIzaSyAuMYvgGhGXf8WI7YEp25CIT0UGqkR5sGQ';
		address = address.replace(/\s/g, "+");

		$http.get('https://maps.googleapis.com/maps/api/geocode/json?address=' + address + '&key=' + key)
		.then(function successCallback(response) {
			if (response.data.status == "OK") {
				coords.latitude = response.data.results[0].geometry.location.lat;
				coords.longitude = response.data.results[0].geometry.location.lng;
			} else {
				$scope.message = response.status;
			}}, function errorCallback(error) {
				$scope.message = "Server Error";
			});

		return coords;
	};	
	

	$scope.map = { 
		center: { 
			latitude: -3.7686907,
			longitude: -38.5137953
		}, 
		zoom: 11,
		markers: {
			id:1,
			coords : {
			latitude: -1,
			longitude: -18 
			},
			showWindow:true,
			options: {
				labelContent:"Markers id 1",
				labelAnchor:"22 0",
				labelClass:"marker-labels",
			}
		}

	};

	$scope.eventInfo = function(event){
		$scope.single_event = event;
		$scope.$apply();
	};



}]);