;
admin_app.controller('CropController', function ($scope, Upload, $timeout) {
  
    $scope.crop_pls = false;
    $scope.file = false;

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
                $scope.picFile = '/'+response.data.path + response.data.file_name
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