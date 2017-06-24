// Email Modal controller
angular.module('virtualExpoApp').controller('emailController', function($http, $scope, currentUser, $uibModalInstance) {

	$scope.email = "";

	// get current user email
	currentUser.user().then(function(data){
		if(data.status){
			$scope.email = data.current_user.email;
		}
	});

	// Dismiss Email modal
	$scope.cancel = function () {
		$uibModalInstance.dismiss('cancel');
	};

	// Send email action
	$scope.sendEmailReport = function(){
		$http.post('email', {email : $scope.email})
		.then(function successCallback(response) {
			console.log(response);
		}, function errorCallback(error) {
			console.log(response);
		});
	}
});