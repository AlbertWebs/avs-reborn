<div class="toolbox">
    <div class="toolbox-left">
        <a href="#" class="sidebar-toggler"><i class="icon-bars"></i>Filters</a>
    </div><!-- End .toolbox-left -->

    <div class="toolbox-center">
        <h1 style="font-size:30px">{{$page_name}}</h1>
    </div><!-- End .toolbox-center -->

    <div class="toolbox-right">
        <div class="toolbox-info">
            Showing <span>Page {{$Products->currentPage()}} | {{$Products->perPage()}} of {{$Products->total()}}</span> Products
        </div><!-- End .toolbox-info -->
    </div><!-- End .toolbox-right -->
</div><!-- End .toolbox -->