// Reservation Modal controller
angular.module('virtualExpoApp').controller('reservationModalController', function($http, $scope,$rootScope, currentUser, $uibModalInstance, stand, fileUpload) {
	$scope.stand = stand;
	$scope.msg = {
		error : "",
		success : ""
	};
	// Dismiss Email modal
	$scope.cancel = function () {
		$uibModalInstance.dismiss('cancel');
	};


	$scope.reservation = {};
	$scope.reservation.event_id = stand.info.event_id;
	$scope.reservation.stand_id = stand.info.id;
	$scope.reservation.price = stand.info.price;
	$scope.reservation.company_name;
	$scope.reservation.company_id;

	$scope.current_user ={}

	// Get current user
	$scope.getCurrentUser = function(){
		$http.get('/current_user')
		.then(function successCallback(response) {
			if (response.data) {
				$scope.current_user = response.data;
				$scope.reservation.user_id = response.data.id;
				$scope.reservation.company_name = response.data.company.name;
				$scope.reservation.company_id = response.data.company.id;
				$scope.reservation.company_logo = response.data.company.logo_url;
			} else {
				$scope.message = "No info to show";
			}}, function errorCallback(error) {
				$scope.message = "Server Error";
			});	
	};

	// Confirm Reservation
	$scope.confirmReservation = function(){

		if(typeof $scope.doc_file == 'undefined'){
			$scope.msg.error = "You need to upload a marketing document file.";
		}else if(typeof $scope.logo_file == 'undefined' && $scope.reservation.company_logo == null){
			$scope.msg.error = "You need to specify the logo of the company";
		}
		else if($scope.reservation.company_name == ""){
			$scope.msg.error = "Please, specify a name for the company.";
		}
		else{
			$scope.msg.error = "";
			fileUpload.uploadFileToUrl($scope.doc_file, $scope.logo_file, 'api/bookins', $scope.reservation)
			.then(function(response){
				if(response.status){
					$uibModalInstance.dismiss();
					alert("Reservation confirmed!");
					$rootScope.$broadcast('newReservation');
				}
            })
            .catch(function(error){
                
            });
		}


	};

	$scope.cancel = function () {
		$uibModalInstance.dismiss('cancel');
	};
});