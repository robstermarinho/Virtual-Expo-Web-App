angular.module('virtualExpoApp').controller('EventController', ['$scope', '$http', '$routeParams', function($scope, $http, $routeParams){

	$scope.title = 'Event Page';
	$scope.eventId = $routeParams.eventId;
	$scope.single_event = {};
	$scope.stands = {};

	// Get a single event information
	$http.get('/api/events/' + $scope.eventId)
	.then(function successCallback(response) {
		if (response.data) {
			$scope.single_event = response.data;
		} else {
			$scope.message = "No info to show";
		}}, function errorCallback(error) {
			$scope.message = "Server Error";
		});
	
	// Get a list of stands in an event
	$http.get('/api/events/' + $scope.eventId + '/stands')
	.then(function successCallback(response) {
		if (response.data) {
			$scope.stands = response.data;
		} else {
			$scope.message = "No events to show";
		}}, function errorCallback(error) {
			$scope.message = "Server Error";
		});

	
}]);