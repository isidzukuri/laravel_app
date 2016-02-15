;
admin_app.controller('FileuploadController', function ($scope, Upload, $timeout) {
  
    $scope.uploadFiles = function(files, errFiles) {
        $scope.files = files;
        $scope.errFiles = errFiles;

        angular.forEach(files, function(file) {
            file.upload = Upload.upload({
                url: window.admin_data.fileupload_settings.url,
                data: {file: file}
            });

            file.upload.then(function (response) {
                $timeout(function () {
                    file.result = response.data;
                });
            }, function (response) {
                if (response.status > 0) $scope.errorMsg = response.status + ': ' + response.data;
            }, function (evt) {
                file.progress = Math.min(100, parseInt(100.0 * evt.loaded / evt.total));
            });
        });
    }

});

// https://github.com/danialfarid/ng-file-upload;
