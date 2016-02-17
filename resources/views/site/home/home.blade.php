@extends('layouts.site')

@section('content')
<div class="container">
        @foreach ($last_posts as $key => $row)
            <div class="row post_in_list">

                <a class="pull-left" href="/blog/post/<% $row['seo'] %>"><img src="/images/post/<% $row['id'] %>/225_200_original.<% $row['img_ext'] %>" title="<% $row['title'] %>" /></a>

                <div class="pull-left post_in_list_description">
                    <a href="/blog/post/<% $row['seo'] %>"><h3><% $row['title'] %></h3></a>
                    <div><% $row['description'] %></div>
                </div>
                <div class="clearfix"></div>
            </div>
        @endforeach
</div>
@endsection
