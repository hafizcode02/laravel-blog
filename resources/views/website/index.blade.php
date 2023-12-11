@extends('website.template.master')

@section('content')
<!-- Page Header -->
<<<<<<< HEAD
<header class="masthead" style="background-image: url({{asset('website/img/background-palm.jpg')}})">
=======
<header class="masthead" style="background-image: url({{asset('website/img/home-bg.jpg')}})">
>>>>>>> a909f378580ecd2abf7da068aa71bfac720fb0d2
    <div class="overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
                <div class="site-heading">
<<<<<<< HEAD
                    <h1>Palomade</h1>
                    <span class="subheading">Your Palm Oil Detection Partner</span>
=======
                    <h1>Clean Blog</h1>
                    <span class="subheading">A Blog Theme by Start Bootstrap</span>
>>>>>>> a909f378580ecd2abf7da068aa71bfac720fb0d2
                </div>
            </div>
        </div>
    </div>
</header>

<!-- Main Content -->
<div class="container">
    <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
            @foreach ($posts as $post)
            <div class="post-preview">
                <a href="{{ url('post/'. $post->slug) }}">
                    <h2 class="post-title">
                        {{ $post->title }}
                    </h2>
                    <h3 class="post-subtitle">
                        {{ $post->sub_title }}
                    </h3>
                </a>
                <p class="post-meta">Posted by
                    <a href="#">{{ $post->user->name }}</a>
                    on {{ date('M d, Y', strtotime($post->created_at)) }}
                    @if (count($post->categories) > 0)
                    <span class="post-category">
                        Category :
                        @foreach ($post->categories as $category)
                        <a href="{{ url('category/'. $category->slug) }}">{{ $category->name.',' }}</a>
                        @endforeach
                    </span>
                    @endif
                </p>
            </div>
            <hr>
            @endforeach
            <!-- Pager -->
            <div class="clearfix mt-4">
                {{ $posts->links('pagination::bootstrap-4') }}
            </div>
        </div>
        <div class="col-lg-4 col-md-4">
            <div class="category">
                <h2 class="category-title">Category</h2>
                <ul class="category-list">
                    @foreach ($categories as $category)
                    <li><a href="{{ url('category/'. $category->slug) }}">{{ $category->name }}</a></li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection()
