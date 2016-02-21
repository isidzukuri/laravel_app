@section('js')
<script src='/js/lib/ng-file-upload-shim.min.js'></script>
<script src='/js/lib/ng-file-upload.min.js'></script>
@append

@section('js_footer')
<script src='/js/angular/admin/fileupload_controller.js'></script>
@append

@section('plain_js')
	angular_dependencies.push('ngFileUpload');
	window.admin_data.fileupload_settings = {
		url: "<% $action_path %>/upload_file",
	}
@append


<div ng-controller="FileuploadController">
  <button ngf-select="uploadFiles($files, $invalidFiles)" multiple
         	 ngf-max-height="1000" ngf-max-size="1MB">
     		<% trans("admin.select_files") %>
  </button>
  <br><br>
  <% trans("admin.Files") %>:
    <div ng-repeat="f in files" style="font:smaller">
      <div class="progress adm_progress" ng-show="f.progress >= 0">
        <div class="progress-bar" role="progressbar" ng-bind="f.progress + '% ' + f.name" aria-valuenow="{{f.progress}}" aria-valuemin="0" aria-valuemax="100" style="width: {{f.progress}}%;">
	    	<span class="sr-only">{{f.name}} {{f.$errorParam}} {{f.progress}}% Complete</span>
	  	</div>
      </div>
    </div>
    <div ng-repeat="f in errFiles" style="font:smaller">{{f.name}} {{f.$error}} {{f.$errorParam}}</div> 
  <input type="hidden" name="uploaded_files[]" ng-repeat="f in files" value="{{f.result.file_name}}" />{{f.result.path}} {{f.result.$file_name}} 
  {{errorMsg}}
</div>