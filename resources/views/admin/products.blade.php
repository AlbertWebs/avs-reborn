@extends('admin.master')

@section('content')
<div id="wrap" >
        

        <!-- HEADER SECTION -->
        @include('admin.top')
        <!-- END HEADER SECTION -->



        <!-- MENU SECTION -->
        @include('admin.left')
        <!--END MENU SECTION -->



        <!--PAGE CONTENT -->
        <div id="content">
             
            <div class="inner" style="min-height: 700px;">
                <div class="row">
                    <div class="col-lg-12">
                        
                        <center><h2> All Product </h2></center>
                        
                    </div>
                </div>
                  <hr />
                 <!--BLOCK SECTION -->
                 <div class="row">
                    <div class="col-lg-12">
                        @include('admin.panel')

                    </div>

                </div>
                  <!--END BLOCK SECTION -->
                <hr />
                 
                 <!-- COMMENT AND NOTIFICATION  SECTION -->
                   <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default" style="box-shadow: 0 2px 10px rgba(0,0,0,0.1); border-radius: 8px;">
                                <div class="panel-heading" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; border-radius: 8px 8px 0 0; padding: 15px 20px;">
                                    <div style="display: flex; justify-content: space-between; align-items: center;">
                                        <h3 style="margin: 0; font-weight: 600;"><i class="icon-th-large"></i> All Products ({{count($Product)}})</h3>
                                        <a href="{{url('/admin/addProduct')}}" class="btn btn-success" style="background: #28a745; border: none; padding: 8px 20px; border-radius: 5px;">
                                            <i class="icon-plus"></i> Add New Product
                                        </a>
                                    </div>
                                </div>
                                <div class="panel-body" style="padding: 20px;">
                                    <!-- Search and Filter Bar -->
                                    <div class="row" style="margin-bottom: 20px;">
                                        <div class="col-md-6">
                                            <div class="input-group">
                                                <span class="input-group-addon" style="background: #f8f9fa; border-right: none;"><i class="icon-search"></i></span>
                                                <input type="text" id="productSearch" class="form-control" placeholder="Search products by name, code, or brand..." style="border-left: none;">
                                            </div>
                                        </div>
                                        <div class="col-md-6 text-right">
                                            <span class="badge badge-info" style="padding: 8px 15px; font-size: 14px;">
                                                <i class="icon-list"></i> Total: {{count($Product)}}
                                            </span>
                                        </div>
                                    </div>
                                    
                                    <div class="table-responsive" style="border-radius: 8px; overflow: hidden;">
                                        <table class="table table-striped table-bordered table-hover" id="productsTable" style="margin: 0;">
                                            <thead style="background: #f8f9fa;">
                                                <tr>
                                                    <th style="width: 60px; text-align: center; font-weight: 600;">ID</th>
                                                    <th style="font-weight: 600;">Product Details</th>
                                                    <th style="width: 200px; text-align: center; font-weight: 600;">Status</th>
                                                    <th style="width: 250px; text-align: center; font-weight: 600;">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($Product as $value)
                                                <tr class="product-row" data-product-name="{{strtolower($value->name)}}" data-product-code="{{strtolower($value->code ?? '')}}" data-product-brand="{{strtolower($value->brand ?? '')}}">
                                                    <td style="text-align: center; vertical-align: middle; font-weight: 600; color: #667eea;">{{$value->id}}</td>
                                                    <td>
                                                        <div style="display: flex; align-items: center; gap: 15px;">
                                                            @if($value->thumbnail)
                                                            <div style="width: 80px; height: 80px; border-radius: 8px; overflow: hidden; border: 2px solid #e9ecef; flex-shrink: 0;">
                                                                <img src="{{url('/')}}/uploads/product/{{$value->thumbnail}}" alt="{{$value->name}}" style="width: 100%; height: 100%; object-fit: cover;">
                                                            </div>
                                                            @endif
                                                            <div style="flex: 1;">
                                                                <h4 style="margin: 0 0 8px 0; font-weight: 600; color: #333; font-size: 16px;">{{$value->name}}</h4>
                                                                <div style="display: flex; flex-wrap: wrap; gap: 15px; margin-bottom: 8px;">
                                                                    <?php
                                                                        $CatID = $value->cat;
                                                                        $TheCategory = DB::table('category')->where('id',$CatID)->first();
                                                                    ?>
                                                                    @if($TheCategory)
                                                                    <span class="badge" style="background: #667eea; padding: 4px 10px; border-radius: 4px;">
                                                                        <i class="icon-folder"></i> {{$TheCategory->cat}}
                                                                    </span>
                                                                    @endif
                                                                    @if($value->brand)
                                                                    <span class="badge" style="background: #764ba2; padding: 4px 10px; border-radius: 4px;">
                                                                        <i class="icon-tag"></i> {{$value->brand}}
                                                                    </span>
                                                                    @endif
                                                                </div>
                                                                <div style="color: #666; font-size: 13px;">
                                                                    <div><strong>Price:</strong> KES {{number_format($value->price, 2)}}</div>
                                                                    @if($value->code)
                                                                    <div><strong>Code:</strong> <code style="background: #f8f9fa; padding: 2px 6px; border-radius: 3px;">{{$value->code}}</code></div>
                                                                    @endif
                                                                    @if($value->stock)
                                                                    <div>
                                                                        <strong>Stock:</strong> 
                                                                        @if($value->stock == "In Stock")
                                                                            <span class="badge badge-success" style="background: #28a745;">In Stock</span>
                                                                        @else
                                                                            <span class="badge badge-danger" style="background: #dc3545;">Out of Stock</span>
                                                                        @endif
                                                                    </div>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td style="vertical-align: middle;">
                                                        <div style="display: flex; flex-direction: column; gap: 8px;">
                                                            <div>
                                                                <span style="display: inline-block; width: 100px; font-size: 12px; color: #666;">Trending:</span>
                                                                @if($value->trending == 1)
                                                                    <span class="badge badge-success" style="background: #28a745;">Active</span>
                                                                @else
                                                                    <span class="badge badge-secondary" style="background: #6c757d;">Inactive</span>
                                                                @endif
                                                                <a onclick="return confirm('Swap Product Trending Status?')" href="{{url('/admin')}}/swapTrending/{{$value->id}}" class="btn btn-xs btn-info" style="padding: 2px 8px; margin-left: 5px; font-size: 11px;">
                                                                    <i class="icon-exchange"></i> Swap
                                                                </a>
                                                            </div>
                                                            <div>
                                                                <span style="display: inline-block; width: 100px; font-size: 12px; color: #666;">Featured:</span>
                                                                @if($value->featured == 1)
                                                                    <span class="badge badge-success" style="background: #28a745;">Active</span>
                                                                @else
                                                                    <span class="badge badge-secondary" style="background: #6c757d;">Inactive</span>
                                                                @endif
                                                                <a onclick="return confirm('Swap Product Featured Status?')" href="{{url('/admin')}}/swapFeatured/{{$value->id}}" class="btn btn-xs btn-success" style="padding: 2px 8px; margin-left: 5px; font-size: 11px;">
                                                                    <i class="icon-exchange"></i> Swap
                                                                </a>
                                                            </div>
                                                            <div>
                                                                <span style="display: inline-block; width: 100px; font-size: 12px; color: #666;">Slider:</span>
                                                                @if($value->slider == 1)
                                                                    <span class="badge badge-success" style="background: #28a745;">Active</span>
                                                                @else
                                                                    <span class="badge badge-secondary" style="background: #6c757d;">Inactive</span>
                                                                @endif
                                                                <a onclick="return confirm('Swap Product Slider Status?')" href="{{url('/admin')}}/swapSlider/{{$value->id}}" class="btn btn-xs btn-default" style="padding: 2px 8px; margin-left: 5px; font-size: 11px;">
                                                                    <i class="icon-exchange"></i> Swap
                                                                </a>
                                                            </div>
                                                            <div>
                                                                <span style="display: inline-block; width: 100px; font-size: 12px; color: #666;">Combo:</span>
                                                                @if($value->full == 1)
                                                                    <span class="badge badge-success" style="background: #28a745;">Active</span>
                                                                @else
                                                                    <span class="badge badge-secondary" style="background: #6c757d;">Inactive</span>
                                                                @endif
                                                                <a href="{{url('/admin')}}/swap_full/{{$value->id}}" class="btn btn-xs {{$value->full == 1 ? 'btn-success' : 'btn-danger'}}" style="padding: 2px 8px; margin-left: 5px; font-size: 11px;">
                                                                    <i class="icon-exchange"></i> Swap
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td style="vertical-align: middle;">
                                                        <div style="display: flex; flex-direction: column; gap: 8px;">
                                                            <a href="{{url('/admin')}}/editProduct/{{$value->id}}" class="btn btn-info btn-sm" style="width: 100%; padding: 8px; border-radius: 5px;">
                                                                <i class="icon-pencil"></i> Edit Product
                                                            </a>
                                                            <a href="{{url('/admin')}}/editProductDetails/{{$value->id}}" class="btn btn-info btn-sm" style="width: 100%; padding: 8px; border-radius: 5px; background: #17a2b8; border-color: #17a2b8;">
                                                                <i class="icon-edit"></i> Edit Details
                                                            </a>
                                                            <a href="#" class="btn btn-success btn-sm" data-toggle="modal" data-target="#buttonedModal_{{$value->id}}" style="width: 100%; padding: 8px; border-radius: 5px;">
                                                                <i class="icon-link"></i> Get Link
                                                            </a>
                                                            <a onclick="return confirm('Are you sure you want to delete this product? This action cannot be undone.')" href="{{url('/admin')}}/deleteProduct/{{$value->id}}" class="btn btn-danger btn-sm" style="width: 100%; padding: 8px; border-radius: 5px;">
                                                                <i class="icon-trash"></i> Delete
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                
                                </div>
                            </div>
                        </div>
                    </div>
                <!-- END COMMENT AND NOTIFICATION  SECTION -->
                



                
            </div>

        </div>
        <!--END PAGE CONTENT -->

         <!-- RIGHT STRIP  SECTION -->
         @include('admin.right')
         <!-- END RIGHT STRIP  SECTION -->
    </div>
@foreach($Product as $value)
<!-- Modal links  -->
<div class="modal fade" id="buttonedModal_{{$value->id}}" tabindex="-1" role="dialog" aria-labelledby="productLinkModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius: 8px; box-shadow: 0 5px 20px rgba(0,0,0,0.2);">
            <div class="modal-header" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; border-radius: 8px 8px 0 0;">
                <h4 class="modal-title" id="H1" style="font-weight: 600;">
                    <i class="icon-link"></i> Product Link
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="color: white; opacity: 0.8;">&times;</button>
            </div>
            <div class="modal-body" style="padding: 25px;">
                <p style="margin-bottom: 15px; color: #666;"><strong>{{$value->name}}</strong></p>
                <div class="input-group">
                    <input type="text" id="productLink_{{$value->id}}" class="form-control" value="{{url('/product')}}/{{$value->slung}}" readonly style="border-radius: 5px 0 0 5px;">
                    <span class="input-group-btn">
                        <button class="btn btn-success" type="button" onclick="copyLink({{$value->id}})" style="border-radius: 0 5px 5px 0;">
                            <i class="icon-copy"></i> Copy
                        </button>
                    </span>
                </div>
                <small class="text-muted" style="display: block; margin-top: 10px;">
                    <i class="icon-info-sign"></i> Click the copy button to copy the product link to your clipboard
                </small>
            </div>
            <div class="modal-footer" style="border-top: 1px solid #e9ecef; padding: 15px 25px;">
                <button type="button" class="btn btn-default" data-dismiss="modal" style="border-radius: 5px;">
                    <i class="icon-remove"></i> Close
                </button>
            </div>
        </div>
    </div>
</div>
@endforeach

<style>
    .product-row:hover {
        background-color: #f8f9fa !important;
        transition: background-color 0.2s ease;
    }
    
    .table th {
        border-bottom: 2px solid #667eea !important;
    }
    
    .btn {
        transition: all 0.3s ease;
    }
    
    .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.15);
    }
    
    .badge {
        font-weight: 500;
    }
    
    #productSearch:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
    }
    
    @media (max-width: 768px) {
        .table-responsive {
            overflow-x: auto;
        }
        
        .table td, .table th {
            white-space: nowrap;
        }
    }
</style>

<script>
    // Product search functionality
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('productSearch');
        const productRows = document.querySelectorAll('.product-row');
        
        if (searchInput) {
            searchInput.addEventListener('keyup', function() {
                const searchTerm = this.value.toLowerCase().trim();
                
                productRows.forEach(function(row) {
                    const productName = row.getAttribute('data-product-name') || '';
                    const productCode = row.getAttribute('data-product-code') || '';
                    const productBrand = row.getAttribute('data-product-brand') || '';
                    
                    if (productName.includes(searchTerm) || 
                        productCode.includes(searchTerm) || 
                        productBrand.includes(searchTerm)) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            });
        }
    });
    
    // Copy link functionality
    function copyLink(productId) {
        const linkInput = document.getElementById('productLink_' + productId);
        linkInput.select();
        linkInput.setSelectionRange(0, 99999); // For mobile devices
        
        try {
            document.execCommand('copy');
            
            // Show success message
            const btn = event.target.closest('button');
            const originalText = btn.innerHTML;
            btn.innerHTML = '<i class="icon-ok"></i> Copied!';
            btn.classList.add('btn-success');
            
            setTimeout(function() {
                btn.innerHTML = originalText;
            }, 2000);
        } catch (err) {
            alert('Failed to copy link. Please copy manually.');
        }
    }
</script>

@endsection