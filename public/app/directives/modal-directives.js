angular.module('modalDirectives', [])
.directive('modalEmail', function(){
	var ddo = {};
	ddo.restrict = 'E';
	ddo.templateUrl = 'app/partials/modal-email.html';
	return ddo;
});