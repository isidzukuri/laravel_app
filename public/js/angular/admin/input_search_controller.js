;
admin_app.controller('InputSearchController', function ($scope) {
  
    $scope.buttonClick = function () {
    	if($scope.autocomplete) window.location.href =  window.location.pathname+ '?search='+$scope.autocomplete;
    } 

});
