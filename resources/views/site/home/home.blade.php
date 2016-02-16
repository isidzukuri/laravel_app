@extends('layouts.site')

@section('content')
<div class="container">
        @foreach ($last_posts as $key => $row)
            <div class="row" ng-click="open_item()">
                <a href="/blog/post/<% $row['seo'] %>"><img src="/images/post/<% $row['id'] %>/original.<% $row['img_ext'] %>" title="<% $row['title'] %>" /></a>
                <a href="/blog/post/<% $row['seo'] %>"><% $row['title'] %></a>
                <div><% $row['description'] %></div>
            </div>
        @endforeach
</div>
@endsection
