<div class="header-center">
    <div class="header-search header-search-extended header-search-visible header-search-no-radius d-none d-lg-block">
        <a href="#" class="search-toggle" role="button"><i class="icon-search"></i></a>
        <form action="{{url('/search-results')}}" method="get">
            {{-- @csrf --}}
            <div class="header-search-wrapper search-wrapper-wide">
            
                <label for="q" class="sr-only">Search</label>
                <input autocomplete="off" type="search" class="form-control" name="keyword" id="search" placeholder="Search Product, Brand or Category" required>
                <button class="btn btn-primary" type="submit"><i class="icon-search"></i><img class="loading-image" width="22" src="{{url('/')}}/uploads/preloaders/loading.gif" alt="Amani vehicle Sound Loading"></button>
            </div><!-- End .header-search-wrapper -->
        </form>
        {{--  --}}
        <!-- Livesearch Results -->
        {{-- <div style="background-image: url('{{url('/')}}/uploads/preloaders/preloader.gif');" class="text-center" id="loading-image">Loading.....</div> --}}
        <table class="table  table-hover" style="position:absolute; background-color:rgba(255,255,255,0.9); color:#000;  z-index: 1000; max-width: 638px;">
        <thead>
        
        </thead>
        <tbody>
        </tbody>
        </table>
        <!-- Live seach Results -->
        {{--  --}}
    </div><!-- End .header-search -->
</div>