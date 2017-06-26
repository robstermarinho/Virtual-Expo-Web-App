// Email Modal controller
angular.module('virtualExpoApp').controller('emailModalController', function($http, $scope, currentUser, $uibModalInstance) {

	$scope.email = "";
	$scope.msg = {
		error : "",
		success : ""
	};
	$scope.btn_status = false;

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
		$scope.btn_status = true;
		$http.post('email', {email : $scope.email})
		.then(function successCallback(response) {
			$scope.msg.success = response.data.msg;
			$scope.msg.error = "";
			$scope.btn_status = false;
		}, function errorCallback(error) {
			$scope.msg.error = error.data.msg;
			$scope.msg.success = "";
			$scope.btn_status = false;
		});
	}
});