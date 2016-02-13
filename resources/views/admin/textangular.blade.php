@section('js')
<script src='/js/lib/textangular/textAngular-rangy.min.js'></script>
<script src='/js/lib/textangular/textAngular-sanitize.min.js'></script>
<script src='/js/lib/textangular/textAngular.min.js'></script>
@append

@section('js_footer')
<script src='/js/angular/admin/text_editor_controller.js'></script>
@append

@section('css')
<link href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css" rel="stylesheet" >
<link href="/js/lib/textangular/textAngular.css" rel="stylesheet" >
@append

@section('plain_js')
	window.admin_data.text_editor = <%% isset($item) ? json_encode($item->text) : "''" %%>;
	angular_dependencies.push('textAngular');
@append