@extends('front.master-pages')
@section('content')
<br><br>

@if($Copyright->isEmpty())
<center>
  No copyrights Added
</center>
@else
  <div id="blog-page-contain">
    <div class="container">
      <div class="row">
        <div class="col-md-12 col-sm-8"> 
        
          <!-- left block Start  -->
          <div id="left">
          @foreach($Copyright as $terms)
            <div class="single-post-item">
              
              <div class="single-post-details">
                <div class="post-title">
                  <h4><a href="#">Copyright Statement</a></h4>
                </div>
                <div class="description">

                  <p>{!!html_entity_decode($terms->content)!!}</p>
       
                </div>
              </div>
            </div>
          @endforeach
           
           
         
          </div>
          <!-- left block end  --> 
        </div>
       
      </div>
    </div>
  </div>
  @endif
@endsection