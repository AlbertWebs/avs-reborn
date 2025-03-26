@extends('front.master-pages')
@section('content')
<br><br>
<div id="blog-page-contain">
    <div class="container">
      <div class="row">
        <div class="col-md-12 col-sm-8"> 
        @if($Privacy->isEmpty())
        <center>
          
        </center>
        @else
          <!-- left block Start  -->
          <div id="left">
          @foreach($Privacy as $terms)
            <div class="single-post-item">
              
              <div class="single-post-details">
                <div class="post-title">
                  <h4><a href="#">{{$terms->title}}</a></h4>
                </div>
                <div class="description">
                  <p>{!!html_entity_decode($terms->content)!!}</p>
                 
                </div>
              </div>
            </div>

          @endforeach
       
            
          </div>
          <!-- left block end  --> 
        @endif
        </div>
      
      </div>
    </div>
  </div>
@endsection