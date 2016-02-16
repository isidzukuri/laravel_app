;
admin_app.controller('CropController', function ($scope, Upload, $timeout, $element) {
  
    $scope.crop_pls = false;
    $scope.file = false;

    $scope.real_coords = false;
    $scope.original_img = false;
    $scope.scale_coef = {x:1, y:1};

    $scope.$watch("picFile", function (newValue) {
        if(typeof newValue == "string"){
            original_img = new Image();
            original_img.src = newValue;
            $scope.original_img = original_img;
        }
    });

    $scope.update_scale_coef = function () {
        if($scope.original_img){
            cropper_field = $element.find('canvas');        
            $scope.scale_coef.x = $scope.original_img.width / cropper_field.width();
            $scope.scale_coef.y = $scope.original_img.height / cropper_field.height();
        }
    }

    $scope.$watch("AreaCoords", function (newValue) { 
        if(newValue){
            $scope.update_scale_coef();
            $scope.real_coords = {
                w: parseInt(newValue.w * $scope.scale_coef.x),
                h: parseInt(newValue.h * $scope.scale_coef.y),
                x: parseInt(newValue.x * $scope.scale_coef.x),
                y: parseInt(newValue.y * $scope.scale_coef.y),
            }
        }
    });

    $scope.upload = function (file) {
        if(!file) return false;
        $scope.file = file;

        Upload.upload({
            url: window.admin_data.crop_fileupload_settings.url,
            data: {file: file },
        }).then(function (response) {
            $timeout(function () {
                $scope.result = response.data;
                file.result = response.data;
                $scope.picFile = '/'+response.data.path + response.data.file_name;
                $element.find('.progress').hide();
            });
        }, function (response) {
            if (response.status > 0) $scope.errorMsg = response.status + ': ' + response.data;
        }, function (evt) {
            $scope.progress = parseInt(100.0 * evt.loaded / evt.total);
        });
    }

    $scope.crop_img = function () {
        $scope.crop_pls = true;
    }

});
// https://github.com/alexk111/ngImgCrop;
// https://github.com/CrackerakiUA/ngImgCropFullExtended