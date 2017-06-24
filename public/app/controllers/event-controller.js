angular.module('virtualExpoApp').controller('EventController', [
	'$scope', 
	'$http', 
	'$routeParams', 
	'currentUser',
	'$uibModal', 
	function(
		$scope, 
		$http, 
		$routeParams, 
		currentUser,
		$uibModal){

		$scope.title = 'Event Page';
		$scope.eventId = $routeParams.eventId;
		$scope.single_event = {};
		$scope.stands = {};
		$scope.current_user = {};

	// get current user
	currentUser.user().then(function(data){
		if(data.status){
			$scope.current_user = data.current_user;
		}
	});

	$scope.openEmailModal = function(){
		// Open a modal with stand Detail
		var emailModal = $uibModal.open({
			animation: true,
			ariaLabelledBy: 'modal-title',
			ariaDescribedBy: 'modal-body',
			templateUrl: 'modaEmail.html',
			controller: 'emailController',
			size: 'sm'
		})
		.result.catch(function(res) {
			if (!(res === 'cancel' || res === 'escape key press')) {
				throw res;
			}
		});
	};

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
					svg: $scope.svg_params['stand_' + stand.id],
					company_logo: stand.bookin != null ? 'files/' + stand.bookin.user.company.logo_url : '',
					company_id : stand.bookin != null ?  stand.bookin.user.company.id : false,
				});
			});
			$scope.stands = result;
		} else {
			$scope.message = "No events to show";
		}}, function errorCallback(error) {
			$scope.message = "Server Error";
		});

}]);