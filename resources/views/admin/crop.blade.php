@section('js')
<script src='/js/lib/ng-file-upload-shim.min.js'></script>
<script src='/js/lib/ng-file-upload.min.js'></script>
<script src='/js/lib/ng-img-crop.js'></script>
@append

@section('js_footer')
<script src='/js/angular/admin/crop_controller.js'></script>
@append

@section('css')
<link href="/css/ng-img-crop.css" rel="stylesheet" type="text/css" />
@append

@section('plain_js')
	angular_dependencies.push('ngFileUpload');
  angular_dependencies.push('ngImgCrop');
	window.admin_data.crop_fileupload_settings = {
		url: "<% $action_path %>/upload_img_file"
	}
@append

<div ng-controller="CropController">
        <span ngf-select="upload($file)" ng-model="picFile" accept="image/*" class="btn btn-primary"><% trans("admin.select_picture") %></span>
        <div ng-show="picFile">
          <div class="cropArea pull-left">
          <!--  result-image-size='{w: 340,h: 200}' -->
              <img-crop 
                area-type="rectangle" 
                @if(isset($aspect_ratio))
                aspect-ratio="<% $aspect_ratio %>"
                @endif
                image="picFile" 
                result-image="croppedImage" 
                ng-init="picFile='<% isset($item) && $item->img_ext ? "/images/post/{$item->id}/original.{$item->img_ext}" : '' %>'"
                area-coords="AreaCoords" >
              </img-crop>
          </div>
          <div class="pull-left crop_preview">
              <img ng-src="{{croppedImage}}" />
          </div>
          <div class="clearfix"></div>
        </div>
        <span ng-if="picFile && !crop_pls" ng-click="crop_img()" class="btn btn-warning"><% trans("admin.crop") %></span>
        <input type="hidden" name="cropped_coords[]" value="{{real_coords}}" ng-if="crop_pls" />
        <input type="hidden" name="cropped_images[]" value="{{file.result.file_name}}" ng-if="file" />
        
        <span class="progress" ng-show="progress >= 0">
          <div class="progress-bar" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width:{{progress}}%" ng-bind="progress + '%'"></div>
        </span>
        <!-- <span ng-show="result">Upload Successful</span> -->
        <span class="err" ng-show="errorMsg">{{errorMsg}}</span>
 
</div>