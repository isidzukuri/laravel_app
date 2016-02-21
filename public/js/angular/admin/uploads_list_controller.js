;
admin_app.controller("UploadsListController", function($scope, $http, $element) {
    
	
    $element.find('.delete_item').click(function(){
        $scope.current_item = $(this).parents('.row');
        data = {
            _method: 'DELETE',
            path: $scope.full_path
        }
        $http.post("/admin/upload/delete", data)
            .success(delete_success)
            .error(delete_error);
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


});



