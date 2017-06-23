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

angular.module('virtualExpoApp').controller('ModalStandCtrl', function ($uibModalInstance, stand, $uibModal) {
	var $ctrl = this;
	$ctrl.stand = stand;
	

	$ctrl.reserve = function () {
		$uibModalInstance.close();

		var modalInstance = $uibModal.open({
			animation: true,
			ariaLabelledBy: 'modal-title',
			ariaDescribedBy: 'modal-body',
			templateUrl: 'modalBookin.html',
			controller: 'ModalBookinCtrl',
			controllerAs: '$ctrl',
			size: 'lg',
			resolve: {
				stand: function () {
					return $ctrl.stand;
				}	
			}
		});
	};

	$ctrl.cancel = function () {
		$uibModalInstance.dismiss('cancel');
	};
});


angular.module('virtualExpoApp').controller('ModalBookinCtrl', function ($scope , $uibModalInstance, stand, $uibModal, $http) {
	var $ctrl = this;
	$ctrl.stand = stand;
	$scope.reservation = {

	};

	// Get a single event
	$scope.getCurrentUser = function(){
		$http.get('/current_user')
		.then(function successCallback(response) {
			if (response.data) {
				$scope.reservation = response.data;
			} else {
				$scope.message = "No info to show";
			}}, function errorCallback(error) {
				$scope.message = "Server Error";
			});

		$ctrl.reserve = function () {
			$uibModalInstance.close();
		};		

	}



	$ctrl.cancel = function () {
		$uibModalInstance.dismiss('cancel');
	};
});
