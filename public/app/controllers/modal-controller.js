angular.module('virtualExpoApp').controller('ModalController', ['$scope', '$http', '$uibModal', '$log', '$document', function($scope, $http, $uibModal, $log, $document){

	var $ctrl = this;

	// Open a modal with stand Detail
	$ctrl.openStandDetail = function (stand) {
		var modalInstance = $uibModal.open({
			animation: true,
			ariaLabelledBy: 'modal-title',
			ariaDescribedBy: 'modal-body',
			templateUrl: 'modalStand.html',
			controller: 'ModalStandCtrl',
			controllerAs: '$ctrl',
			size: 'lg',
			resolve: {
				stand: function () {
					return stand;
				}
			}
		});
	};
}]);




//*************************************
angular.module('virtualExpoApp')
.directive('fileModel', ['$parse', function ($parse) {
	return {
		restrict: 'A',
		link: function(scope, element, attrs) {
			var model = $parse(attrs.fileModel);
			var modelSetter = model.assign;

			element.bind('change', function(){
				scope.$apply(function(){
					modelSetter(scope, element[0].files[0]);
				});
			});
		}
	};
}]);


angular.module('virtualExpoApp')
.service('fileUpload', ['$http', function ($http) {
	this.uploadFileToUrl = function(doc_file, logo_file, uploadUrl, data){
		console.log(typeof logo_file);
		console.log(data.company_logo);
		var fd = new FormData();
		if(typeof doc_file == 'undefined'){
			alert("You need to update the marketing document.");
		}else if(typeof logo_file == 'undefined' && data.company_logo == null){
			alert("You need to specify the logo of the company.");
		}else{

			if(typeof logo_file != 'undefined'){
				fd.append('logo_file', logo_file);
			}
			
			fd.append('doc_file', doc_file);
			$http.post(uploadUrl, fd, {
				transformRequest: angular.identity,
				headers: {'Content-Type': undefined},
				params: data,
			})
			.then(function successCallback(response) {

			}, function errorCallback(error) {

			});
			
		}

	}
}]);
//*************************************

angular.module('virtualExpoApp').controller('ModalBookinCtrl', function (fileUpload, $scope , $uibModalInstance, stand, $uibModal, $http) {
	var $ctrl = this;
	$ctrl.stand = stand;
	$scope.reservation = {};
	$scope.reservation.event_id = $ctrl.stand.info.event_id;
	$scope.reservation.stand_id = $ctrl.stand.info.id;
	$scope.reservation.price = $ctrl.stand.info.price;
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

		$ctrl.reserve = function () {
			$uibModalInstance.close();
		};		
	}


	// Confirm Reservation
	$scope.confirmReservation = function(){
		fileUpload.uploadFileToUrl($scope.doc_file, $scope.logo_file, 'api/bookins', $scope.reservation);
	};

	$ctrl.cancel = function () {
		$uibModalInstance.dismiss('cancel');
	};


});
