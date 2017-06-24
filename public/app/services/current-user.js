angular.module('virtualExpoApp').service('currentUser', ['$http','$q', function ($http, $q) {

	this.user = function(){
		return $q(function(resolve, reject){
			$http.get('/current_user')
			.then(function successCallback(response) {
				if (response.data) {
					resolve({
						status: true,
						current_user : response.data
					});
				}else{
					reject({
						status : false,
						msg : "No info to show" 
					});
				}

			}, function errorCallback(error) {
				reject({
					status : false,
					msg : error 
				});
			});
		});	
	}

}]);