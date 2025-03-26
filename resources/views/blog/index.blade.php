@extends('front.master-blog')
@section('content')
<?php $Blog = DB::table('blogs')->paginate(24);  ?>
<main class="main">
    <div class="page-header text-center" style="background-image: url('{{asset('theme/assets/images/page-header-bg.jpg')}}')">
        <div class="container">
            <h1 class="page-title">{{$page_name}}<span>Amani Vehicle Sounds</span></h1>
        </div><!-- End .container -->
    </div><!-- End .page-header -->
    <nav aria-label="breadcrumb" class="breadcrumb-nav mb-2">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Blog</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{$page_name}}</li>
            </ol>
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->

    <div class="page-content">
        <div class="container">
            <nav class="blog-nav">
                <ul class="menu-cat entry-filter justify-content-center">
                    <li class="active"><a href="#" data-filter="*">All Blog Posts<span>9</span></a></li>
                    <?php $Category = DB::table('category')->get(); ?>
                    @foreach ($Category as $Cat)
                    <li><a href="#" data-filter=".filter_{{$Cat->id}}">{{$Cat->cat}}<span><?php echo count($BlogsCate = DB::table('blogs')->where('category',$Cat->id)->get());  ?></span></a></li>
                    @endforeach
                </ul><!-- End .blog-menu -->
            </nav><!-- End .blog-nav -->

            <div class="entry-container max-col-3">
               
                @foreach($Blog as $item)
                <div class="entry-item filter_{{$item->category}} shopping col-sm-6 col-lg-4">
                    <article class="entry entry-grid text-center">
                        <figure class="entry-media">
                            <a href="{{$item->link}}">
                                <img src="{{url('/')}}/uploads/blog/{{$item->image_one}}" alt="{{$item->title}}">
                            </a>
                        </figure><!-- End .entry-media -->

                        <div class="entry-body">
                            <div class="entry-meta">
                                <span class="entry-author">
                                    by <a href="#">{{$item->author}}</a>
                                </span>
                                <span class="meta-separator">|</span>
                                <a href="#"> <?php 
                                    $RawDate = $item->created_at;
                                    $FormatDate = strtotime($RawDate);
                                    $Month = date('M',$FormatDate);
                                    $Date = date('D',$FormatDate);
                                    $date = date('d',$FormatDate);
                                    $Year = date('Y',$FormatDate);
                                ?>
                                {{$Month}} {{$date}}, {{$Year}}</a>
                                <span class="meta-separator">|</span>
                                <a href="#"><?php echo count($Comments = DB::table('comments')->where('blog_id',$item->id)->get()); ?> Comments</a>
                            </div><!-- End .entry-meta -->

                            <h2 class="entry-title">
                                <a href="{{$item->link}}">{{$item->title}}</a>
                            </h2><!-- End .entry-title -->

                            <div class="entry-cats">
                                in <?php $collection = DB::table('category')->where('id',$item->category)->get() ?> @foreach ($collection as $items)<a target="new" href="{{url('/')}}/products/{{$items->slung}}"> {{$items->cat}} @endforeach</a>
                                {{-- <a href="#">Shopping</a> --}}
                            </div><!-- End .entry-cats -->
                        </div><!-- End .entry-body -->
                    </article><!-- End .entry -->
                </div><!-- End .entry-item -->
                @endforeach
            </div><!-- End .entry-container -->

            <nav aria-label="Page navigation">
                <?php echo $Blog ?>
            </nav>
        </div><!-- End .container -->
    </div><!-- End .page-content -->
</main><!-- End .main -->
@endsection