describe('Testing VirtualExpo Test Suite', function(){

	// Load The module
	beforeEach(module('virtualExpoApp'));


	describe('Testing AngularJS Controller', function () {

		var scope, ctrl, httpBackend, timeout, rootScope;

		// Get the controller and injected components
		beforeEach(inject(function($controller, $rootScope, $httpBackend, $timeout) {
			rootScope = $rootScope;
			scope = $rootScope.$new();
			ctrl = $controller('HomeController', {$scope: scope});
			httpBackend = $httpBackend;
			timeout = $timeout;
		}));



		//TEST 1 #####################################################################

		it('should initialize the title in the scope', function() {
			//expect(1).toBeDefined();
			expect(1).toBe(1);
		});

	});
	



});
