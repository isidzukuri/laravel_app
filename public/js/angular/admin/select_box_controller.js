;
admin_app.controller('SelectBoxController', function($scope, $element, $http) {
 
 	$('.attach_select_2').select2({
 		tags:true,
 		createTag: function(newTag) {
		       return {
		           id: newTag.term,
		           text: newTag.term
		       };
		   }
 	});
 	
});