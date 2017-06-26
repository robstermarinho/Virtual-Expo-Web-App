angular.module('modalDirectives', [])
.directive('modalEmail', function(){
	var ddo = {};
	ddo.restrict = 'E';
	ddo.templateUrl = 'app/partials/modal-email.html';
	return ddo;
})
.directive('modalStand', function(){
	var ddo = {};
	ddo.restrict = 'E';
	ddo.templateUrl = 'app/partials/modal-stand.html';
	return ddo;
})
.directive('modalReservation', function(){
	var ddo = {};
	ddo.restrict = 'E';
	ddo.templateUrl = 'app/partials/modal-reservation.html';
	return ddo;
})
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