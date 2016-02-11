;
admin_app.controller("RowInListController", function($scope, $http) {
    
	$scope.open_item = function(){
		window.location = $scope.href+'/edit';
	}

    $scope.delete_item = function(){
    	$scope.current_item = $(event.srcElement).parents('.row');
    	var req = {
		 	method: 'DELETE',
		 	url: $scope.href
		}
    	make_request(req, delete_success, delete_error);
    	event.stopPropagation();
    }

    var delete_success = function(){
    	$scope.current_item.remove();
    }

    var delete_error = function(){
    	alert('Basic ajax error');
    }

    function make_request(req, successCallback, errorCallback){
    	$http(req).then(successCallback, errorCallback);
    }

});



