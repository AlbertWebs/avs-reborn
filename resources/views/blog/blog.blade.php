@extends('front.master-blog')
@section('content')
@foreach ($Blog as $blog)
<main class="main">
    <nav aria-label="breadcrumb" class="breadcrumb-nav border-0 mb-0">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Blog</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{$blog->title}}</li>
            </ol>
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->

    <div class="page-content">
        <figure class="entry-media">
            <img src="{{url('/')}}/uploads/blog/{{$blog->image_one}}" alt="{{$blog->title}}" >
        </figure><!-- End .entry-media -->
        <div class="container">
            <article class="entry single-entry entry-fullwidth">
                <div class="row">
                    <div class="col-lg-11">
                        <div class="entry-body">
                            <div class="entry-meta">
                                <span class="entry-author">
                                    by <a href="#">{{$blog->author}}</a>
                                </span>
                                <span class="meta-separator">|</span>
                                <a href="#"> <?php 
                                    $RawDate = $blog->created_at;
                                    $FormatDate = strtotime($RawDate);
                                    $Month = date('M',$FormatDate);
                                    $Date = date('D',$FormatDate);
                                    $date = date('d',$FormatDate);
                                    $Year = date('Y',$FormatDate);
                                ?>
                                {{$Month}} {{$date}}, {{$Year}}</a>
                                <span class="meta-separator">|</span>
                                <a href="#"><?php echo count($Comments = DB::table('comments')->where('blog_id',$blog->id)->get()); ?>  Comments</a>
                            </div><!-- End .entry-meta -->

                            <h2 class="entry-title entry-title-big">
                                {{$blog->title}}
                            </h2><!-- End .entry-title -->

                            <div class="entry-cats">
                                in <?php $collection = DB::table('category')->where('id',$blog->category)->get() ?> @foreach ($collection as $blogs)<a target="new" href="{{url('/')}}/products/{{$blogs->slung}}"> {{$blogs->cat}} @endforeach</a>
                            </div><!-- End .entry-cats -->

                            <div class="entry-content editor-content">
                                {!!html_entity_decode($blog->content)!!}

                                <div class="pb-1"></div><!-- End .pb-1 -->

                                <img src="{{url('/')}}/uploads/blog/{{$blog->image_two}}" alt="{{$blog->title}}" >

                                <div class="pb-1"></div><!-- End .pb-1 -->

                                
                                <div class="pb-1"></div><!-- End .pb-1 -->

                            </div><!-- End .entry-content -->

                           
                        </div><!-- End .entry-body -->
                    </div><!-- End .col-lg-11 -->

                    <div class="col-lg-1 order-lg-first mb-2 mb-lg-0">
                        <div class="sticky-content">
                            <div class="social-icons social-icons-colored social-icons-vertical">
                                <span class="social-label">SHARE:</span>
                                <a href="https://www.facebook.com/sharer/sharer.php?u={{url('/')}}/blog-posts/{{$blog->slung}}" class="social-icon social-facebook" title="Facebook" target="_blank"><i class="icon-facebook-f"></i></a>
                                <a href="#" class="social-icon social-twitter" title="Twitter" target="_blank"><i class="icon-twitter"></i></a>
                                <a href="#" class="social-icon social-pinterest" title="Pinterest" target="_blank"><i class="icon-pinterest"></i></a>
                                <a href="#" class="social-icon social-linkedin" title="Linkedin" target="_blank"><i class="icon-linkedin"></i></a>
                            </div><!-- End .soial-icons -->
                        </div><!-- End .sticky-content -->
                    </div><!-- End .col-lg-1 -->
                </div><!-- End .row -->

                {{-- <div class="entry-author-details">
                    <figure class="author-media">
                        <a href="#">
                            <?php $User = DB::table('users')->where('name',$blog->author)->get(); ?>
                            @foreach ($User as $user)
                            <img src="{{url('/')}}/uploads/users/{{$user->image}}" alt="{{$user->name}}">
                            @endforeach
                        </a>
                    </figure>
                    <div class="author-body">
                        <div class="author-header row no-gutters flex-column flex-md-row">
                            <div class="col">
                                <h4><a href="#">{{$blog->author}}</a></h4>
                            </div><!-- End .col -->
                            <div class="col-auto mt-1 mt-md-0">
                                <a href="#" class="author-link">View all posts by John Doe <i class="icon-long-arrow-right"></i></a>
                            </div><!-- End .col -->
                        </div><!-- End .row -->

                        <div class="author-content">
                            <p>Praesent dapibus, neque id cursus faucibus, tortor neque egestas auguae, eu vulputate magna eros eu erat. Aliquam erat volutpat. </p>
                        </div><!-- End .author-content -->
                    </div><!-- End .author-body -->
                </div><!-- End .entry-author-details--> --}}
            </article><!-- End .entry -->

            <?php 
                $CurrentID = $blog->id;
                $Next = $CurrentID+1;
                $Previous = $CurrentID-1;
                $NextProduct = \App\Models\Blog::find($Next);
                $PreviousProduct = \App\Models\Blog::find($Previous);
               
             ?>

            <nav class="pager-nav" aria-label="Page navigation">
                @if($PreviousProduct==null)

                @else
                <a class="pager-link pager-link-prev" href="{{url('/')}}/blog-posts/{{$PreviousProduct->slung}}" aria-label="Previous" tabindex="-1">
                    Previous Post
                    <span class="pager-link-title">{{$PreviousProduct->title}}</span>
                </a>
                @endif

                @if($NextProduct==null)

                @else

                <a class="pager-link pager-link-next" href="{{url('/')}}/blog-posts/{{$NextProduct->slung}}" aria-label="Next" tabindex="-1">
                    Next Post
                    <span class="pager-link-title">{{$NextProduct->title}}</span>
                </a>
                @endif
            </nav><!-- End .pager-nav -->

            <div class="related-posts">
                <h3 class="title">Related Posts</h3><!-- End .title -->
                
                <div class="owl-carousel owl-simple" data-toggle="owl" 
                    data-owl-options='{
                        "nav": false, 
                        "dots": true,
                        "margin": 20,
                        "loop": false,
                        "responsive": {
                            "0": {
                                "items":1
                            },
                            "480": {
                                "items":2
                            },
                            "768": {
                                "items":3
                            },
                            "992": {
                                "items":4
                            }
                        }
                    }'>

                    <?php $RelatedBlogs = DB::table('blogs')->where('category',$blog->category)->get(); ?>
                    @foreach ($RelatedBlogs as $item)
                    <article class="entry entry-grid">
                        <figure class="entry-media">
                            <a href="{{url('/')}}/blog-posts/{{$item->slung}}">
                                <img src="{{url('/')}}/uploads/blog/{{$item->image_one}}" alt="{{$item->title}}">
                            </a>
                        </figure><!-- End .entry-media -->

                        <div class="entry-body">
                            <div class="entry-meta">
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
                                <a href="#"><?php echo count($Comments = DB::table('comments')->where('blog_id',$item->id)->get()); ?>  Comments</a>
                            </div><!-- End .entry-meta -->

                            <h2 class="entry-title">
                                <a href="{{url('/')}}/blog-posts/{{$item->slung}}">{{$item->title}}</a>
                            </h2><!-- End .entry-title -->

                            <div class="entry-cats">
                                in <?php $collection = DB::table('category')->where('id',$item->category)->get() ?> @foreach ($collection as $items)<a target="new" href="{{url('/')}}/products/{{$items->slung}}"> {{$items->cat}} @endforeach</a>
                            </div><!-- End .entry-cats -->
                        </div><!-- End .entry-body -->
                    </article><!-- End .entry -->
                    @endforeach
                </div><!-- End .owl-carousel -->
            </div><!-- End .related-posts -->

            <div class="comments">
                <h3 class="title">0 Comment</h3><!-- End .title -->
            </div><!-- End .comments -->
            <div class="reply">
                <div class="heading">
                    <h3 class="title">Leave A Reply</h3><!-- End .title -->
                    <p class="title-desc">Your email address will not be published. Required fields are marked *</p>
                </div><!-- End .heading -->

                <form action="#">
                    <label for="reply-message" class="sr-only">Comment</label>
                    <textarea name="reply-message" id="reply-message" cols="30" rows="4" class="form-control" required placeholder="Comment *"></textarea>
                    <input type="hidden" name="product_id" value="{{$blog->id}}">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="reply-name" class="sr-only">Name</label>
                            <input type="text" class="form-control" id="reply-name" name="reply-name" required placeholder="Name *">
                        </div><!-- End .col-md-6 -->

                        <div class="col-md-6">
                            <label for="reply-email" class="sr-only">Email</label>
                            <input type="email" class="form-control" id="reply-email" name="reply-email" required placeholder="Email *">
                        </div><!-- End .col-md-6 -->
                    </div><!-- End .row -->

                    <button type="submit" class="btn btn-outline-primary-2">
                        <span>POST COMMENT</span>
                        <i class="icon-long-arrow-right"></i>
                    </button>
                </form>
            </div><!-- End .reply -->
        </div><!-- End .container -->
    </div><!-- End .page-content -->
</main><!-- End .main -->
@endforeach
@endsection