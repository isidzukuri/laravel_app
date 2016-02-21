;
admin_app.controller("UploadsListController", function($scope, $http, $element) {
    
	// $scope.open_item = function(){
	// 	window.location = $scope.href+'/edit';
	// }

    
 //    $scope.delete_item = function(){
 //    	
 //    }

    $element.find('.delete_item').click(function(){
        $scope.current_item = $(this).parents('.row');
        // var req = {
        //     method: 'DELETE',
        //     url: $scope.full_path
        // }
        make_request(req, delete_success, delete_error);
        // event.stopPropagation();
        return false;
    });

    // $element.find('.copy_link').click(function(){
    // //     window.prompt("Copy to clipboard: Ctrl+C, Enter", $scope.url);
    //     // window.open($scope.url, '_blank');
    // });

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



