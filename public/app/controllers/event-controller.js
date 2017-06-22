angular.module('virtualExpoApp').controller('EventController', ['$scope', '$http', '$routeParams', function($scope, $http, $routeParams){

	$scope.title = 'Event Page';
	$scope.eventId = $routeParams.eventId;
	$scope.single_event = {};
	$scope.stands = {};

	// Get svg polygon params
	$http.get('files/events/event_' +  $scope.eventId + '/hall_map/svg_params.json')
	.then(function(response){
		$scope.svg_params = response.data;            
	});

	// Get a single event
	$http.get('/api/events/' + $scope.eventId)
	.then(function successCallback(response) {
		if (response.data) {
			$scope.single_event = response.data;
		} else {
			$scope.message = "No info to show";
		}}, function errorCallback(error) {
			$scope.message = "Server Error";
		});
	
	// Get a list of stands for this event
	$http.get('/api/events/' + $scope.eventId + '/stands')
	.then(function successCallback(response) {
		var result = [];
		if (response.data) {
			response.data.forEach(function(stand){
				result.push({
					info: stand,
					svg: $scope.svg_params[stand.photo_url]
				});
			});
			$scope.stands = result;
		} else {
			$scope.message = "No events to show";
		}}, function errorCallback(error) {
			$scope.message = "Server Error";
		});

	// Open stand details
	$scope.standDetail = function(stand){
		
	}


}]);