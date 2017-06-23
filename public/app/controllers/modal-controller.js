angular.module('virtualExpoApp').controller('ModalController', ['$scope', '$http', '$uibModal', '$log', '$document', function($scope, $http, $uibModal, $log, $document){

	var $ctrl = this;
	$ctrl.items = ['item1', 'item2', 'item3'];

	$ctrl.animationsEnabled = true;

	$ctrl.open = function (stand, size, parentSelector) {
		var parentElem = parentSelector ? 
		angular.element($document[0].querySelector('.modal-demo ' + parentSelector)) : undefined;
		var modalInstance = $uibModal.open({
			animation: $ctrl.animationsEnabled,
			ariaLabelledBy: 'modal-title',
			ariaDescribedBy: 'modal-body',
			templateUrl: 'myModalContent.html',
			controller: 'ModalInstanceCtrl',
			controllerAs: '$ctrl',
			size: 'lg',
			appendTo: parentElem,
			resolve: {
				stand: function () {
					return stand;
				}
			}
		});

		modalInstance.result.then(function (selectedItem) {
			$ctrl.selected = selectedItem;
		}, function () {
			$log.info('Modal dismissed at: ' + new Date());
		});
	};

	$ctrl.openComponentModal = function () {
		var modalInstance = $uibModal.open({
			animation: $ctrl.animationsEnabled,
			component: 'modalComponent',
			resolve: {
				items: function () {
					return $ctrl.items;
				}
			}
		});

		modalInstance.result.then(function (selectedItem) {
			$ctrl.selected = selectedItem;
		}, function () {
			$log.info('modal-component dismissed at: ' + new Date());
		});
	};

	$ctrl.openMultipleModals = function () {
		$uibModal.open({
			animation: $ctrl.animationsEnabled,
			ariaLabelledBy: 'modal-title-bottom',
			ariaDescribedBy: 'modal-body-bottom',
			templateUrl: 'stackedModal.html',
			size: 'lg',
			controller: function($scope) {
				$scope.name = 'bottom'
			}
		});

		$uibModal.open({
			animation: $ctrl.animationsEnabled,
			ariaLabelledBy: 'modal-title-top',
			ariaDescribedBy: 'modal-body-top',
			templateUrl: 'stackedModal.html',
			size: 'md',
			controller: function($scope) {
				$scope.name = 'top';  
			}
		});
	};

	$ctrl.toggleAnimation = function () {
		$ctrl.animationsEnabled = !$ctrl.animationsEnabled;
	};
}]);

angular.module('virtualExpoApp').controller('ModalInstanceCtrl', function ($uibModalInstance, stand) {
	var $ctrl = this;
	$ctrl.stand = stand;
	$ctrl.ModalInstanceCtrl = "asdasdasd";

	$ctrl.ok = function () {
		$uibModalInstance.close($ctrl.selected.item);
	};

	$ctrl.cancel = function () {
		$uibModalInstance.dismiss('cancel');
	};
});

// Please note that the close and dismiss bindings are from $uibModalInstance.

angular.module('virtualExpoApp').component('modalComponent', {
	templateUrl: 'myModalContent.html',
	bindings: {
		resolve: '<',
		close: '&',
		dismiss: '&'
	},
	controller: function () {
		var $ctrl = this;

		$ctrl.$onInit = function () {
			$ctrl.items = $ctrl.resolve.items;
			$ctrl.selected = {
				item: $ctrl.items[0]
			};
		};

		$ctrl.ok = function () {
			$ctrl.close({$value: $ctrl.selected.item});
		};

		$ctrl.cancel = function () {
			$ctrl.dismiss({$value: 'cancel'});
		};
	}
});