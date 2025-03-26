<aside class="sidebar-shop sidebar-filter">
    <form action="{{url('/')}}/filter"  mothod="GET" id="filter-noaw">
       
        <div class="sidebar-filter-wrapper">
            <div class="widget widget-clean">
                <label><i class="icon-close"></i>Filters</label>
                <a href="#" class="sidebar-filter-clear">Clean All</a>
            </div><!-- End .widget -->
            <div class="widget widget-collapsible">
                <h3 class="widget-title">
                    <a data-toggle="collapse" href="#widget-1" role="button" aria-expanded="true" aria-controls="widget-1">
                        Category
                    </a>
                </h3><!-- End .widget-title -->

                <div class="collapse show" id="widget-1">
                    <div class="widget-body">
                        <div class="filter-items filter-items-count">
                            <?php $Category = DB::table('category')->get(); ?>
                            @foreach ($Category as $item)
                            <div class="filter-item">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" name="category" value="{{$item->id}}" class="custom-control-input chb" id="cat-{{$item->id}}">
                                    <label class="custom-control-label" for="cat-{{$item->id}}">{{$item->cat}}</label>
                                </div>
                                <span class="item-count"><?php echo count($ProductCount = DB::table('product')->where('cat',$item->id)->get()) ?></span>
                            </div>
                            @endforeach
                        

                        </div><!-- End .filter-items -->
                    </div><!-- End .widget-body -->
                </div><!-- End .collapse -->
            </div><!-- End .widget -->

        



            <div class="widget widget-collapsible">
                <h3 class="widget-title">
                    <a data-toggle="collapse" href="#widget-4" role="button" aria-expanded="true" aria-controls="widget-4">
                        Brand
                    </a>
                </h3><!-- End .widget-title -->

                <div class="collapse show" id="widget-4">
                    <div class="widget-body">
                        <div class="filter-items">

                            <?php $Brand = DB::table('brands')->get(); ?>
                            @foreach ($Brand as $item)
                            <div class="filter-item">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" name="brand" value="{{$item->name}}" class="custom-control-input ch" id="brand-{{$item->name}}">
                                    <label class="custom-control-label" for="brand-{{$item->name}}">{{$item->name}}</label>
                                </div><!-- End .custom-checkbox -->
                            </div><!-- End .filter-item -->
                            @endforeach
                            
                        </div><!-- End .filter-items -->
                    </div><!-- End .widget-body -->
                </div><!-- End .collapse -->
            </div><!-- End .widget -->

            {{-- <div class="widget widget-collapsible">
                <h3 class="widget-title">
                    <a data-toggle="collapse" href="#widget-5" role="button" aria-expanded="true" aria-controls="widget-5">
                        Price
                    </a>
                </h3>

                <div class="collapse show" id="widget-5">
                    <div class="widget-body">
                        <div class="filter-price">
                            <div class="filter-price-text">
                                Price Range:
                                <span id="filter-price-range"></span>
                            </div>

                            <div id="price-slider"></div>
                        </div>
                    </div>
                </div>
            </div> --}}

        </div>
        <div style="text-align: center; ">
          <button type="submit" class="btn btn-primary btn-round">Filter Now  <img class="loading-images" width="22" src="{{url('/')}}/uploads/preloaders/loading.gif" alt="Amani vehicle Sound Loading"></button>
        </div>
        <br><br>
        
    </form>
</aside><!-- End .sidebar-filter -->
