// Stand Modal controller
angular.module('virtualExpoApp').controller('standModalController', function($http, $scope, currentUser, $uibModal, $uibModalInstance, stand) {
	$scope.stand = stand;

	// Dismiss Email modal
	$scope.cancel = function () {
		$uibModalInstance.dismiss('cancel');
	};

	// Display confirm reservation modal
	$scope.reserve = function () {
		$uibModalInstance.dismiss();


		var reservationModal = $uibModal.open({
			animation: true,
			ariaLabelledBy: 'modal-title',
			ariaDescribedBy: 'modal-body',
			templateUrl: 'modalReservation.html',
			controller: 'reservationModalController',
			size: 'lg',
			resolve: {
				stand: function () {
					return stand;
				}
			}
		});
	};



});