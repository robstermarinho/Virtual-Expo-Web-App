// Service for send a multiform data to the server
angular.module('virtualExpoApp')
.service('fileUpload', ['$http','$q', function ($http, $q) {
	this.uploadFileToUrl = function(doc_file, logo_file, uploadUrl, data){
		return $q(function(resolve, reject){
			var fd = new FormData();


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
				resolve({
					status : true,
					data : response.data
				});
			}, function errorCallback(error) {
				reject({
					status : false,
					data : error.data
				});
			});
		});	
	}
}]);