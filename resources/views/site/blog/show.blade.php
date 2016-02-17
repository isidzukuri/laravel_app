@extends('layouts.site')

@section('content')
<div class="container">
        <img src="/images/post/<% $item['id'] %>/500_450_original.<% $item['img_ext'] %>" title="<% $item['title'] %>" />

        <div>
            @foreach ($item['tags'] as $tag)
                <a href="/blog/tag/<% $tag['seo'] %>"># <% $tag['title'] %></a>
            @endforeach
        </div>

        <%% $item['text'] %%>


</div>
@endsection
