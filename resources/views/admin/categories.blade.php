@extends('admin.master')

@section('content')
<div id="wrap">
    <!-- HEADER SECTION -->
    @include('admin.top')
    <!-- END HEADER SECTION -->

    <!-- MENU SECTION -->
    @include('admin.left')
    <!--END MENU SECTION -->

    <!--PAGE CONTENT -->
    <div id="content">
        <div class="inner" style="min-height: 700px; padding: 30px;">
            
            <!-- Welcome Header -->
            <div class="row" style="margin-bottom: 30px;">
                <div class="col-lg-12">
                    <div style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); padding: 30px; border-radius: 12px; box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3); color: white;">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <div>
                                <h1 style="margin: 0 0 10px 0; font-weight: 600; font-size: 32px;">Categories Management</h1>
                                <p style="margin: 0; opacity: 0.9; font-size: 16px;">Manage and organize your product categories</p>
                            </div>
                            <a href="{{url('/admin/addCategory')}}" class="btn" style="background: rgba(255,255,255,0.2); color: white; border: 1px solid rgba(255,255,255,0.3); padding: 12px 24px; border-radius: 8px; transition: all 0.3s; text-decoration: none; font-weight: 500;">
                                <i class="icon-plus"></i> Add New Category
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Stats -->
            <div class="row" style="margin-bottom: 30px;">
                <div class="col-lg-12">
                    @include('admin.panel')
                </div>
            </div>

            <!-- Alerts -->
            <div class="row" style="margin-bottom: 20px;">
                <div class="col-lg-12">
                    @if(Session::has('message'))
                        <div class="alert alert-success" style="border-radius: 8px; border-left: 4px solid #28a745; box-shadow: 0 2px 8px rgba(40,167,69,0.2);">
                            <i class="icon-ok"></i> {{ Session::get('message') }}
                        </div>
                    @endif

                    @if(Session::has('messageError'))
                        <div class="alert alert-danger" style="border-radius: 8px; border-left: 4px solid #dc3545; box-shadow: 0 2px 8px rgba(220,53,69,0.2);">
                            <i class="icon-remove"></i> {{ Session::get('messageError') }}
                        </div>
                    @endif
                </div>
            </div>

            <!-- Categories List with Drag & Drop -->
            <div class="row">
                <div class="col-lg-12">
                    <div style="background: white; border-radius: 12px; box-shadow: 0 2px 10px rgba(0,0,0,0.08); overflow: hidden;">
                        <div style="background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%); padding: 20px; color: white;">
                            <div style="display: flex; justify-content: space-between; align-items: center;">
                                <div>
                                    <h3 style="margin: 0; font-weight: 600; font-size: 20px; display: flex; align-items: center; gap: 12px;">
                                        <i class="icon-folder-open"></i>
                                        All Categories
                                        <span style="background: rgba(255,255,255,0.2); padding: 4px 12px; border-radius: 20px; font-size: 14px; margin-left: 10px;">{{count($Category)}}</span>
                                    </h3>
                                    <p style="margin: 8px 0 0 0; opacity: 0.9; font-size: 13px;">Drag and drop to reorder categories (affects home page display order)</p>
                                </div>
                                <button type="button" id="saveOrderBtn" class="btn" style="background: rgba(255,255,255,0.2); color: white; border: 1px solid rgba(255,255,255,0.3); padding: 10px 20px; border-radius: 6px; display: none;">
                                    <i class="icon-save"></i> Save Order
                                </button>
                            </div>
                        </div>
                        <div style="padding: 20px;">
                            @if($Category->isEmpty())
                                <div style="text-align: center; padding: 60px; color: #999;">
                                    <i class="icon-folder-open" style="font-size: 64px; margin-bottom: 20px; display: block; opacity: 0.3;"></i>
                                    <h4 style="color: #666; margin-bottom: 10px;">No Categories Found</h4>
                                    <p style="color: #999;">Get started by adding your first category</p>
                                    <a href="{{url('/admin/addCategory')}}" class="btn btn-primary" style="margin-top: 20px;">
                                        <i class="icon-plus"></i> Add Category
                                    </a>
                                </div>
                            @else
                                <ul id="sortable-categories" style="list-style: none; padding: 0; margin: 0;">
                                    @foreach($Category as $value)
                                    <li data-id="{{$value->id}}" style="background: #f8f9fa; border: 1px solid #e9ecef; border-radius: 8px; padding: 15px; margin-bottom: 12px; cursor: move; transition: all 0.3s; display: flex; align-items: center; justify-content: space-between;" 
                                        onmouseover="this.style.background='#f0f4ff'; this.style.borderColor='#667eea';" 
                                        onmouseout="this.style.background='#f8f9fa'; this.style.borderColor='#e9ecef';">
                                        <div style="display: flex; align-items: center; gap: 15px; flex: 1;">
                                            <div style="width: 40px; height: 40px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 8px; display: flex; align-items: center; justify-content: center; color: white; font-weight: 600; flex-shrink: 0; cursor: move;">
                                                <i class="icon-move" style="font-size: 18px;"></i>
                                            </div>
                                            <div style="flex: 1;">
                                                <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 5px;">
                                                    <h4 style="margin: 0; font-weight: 600; color: #333; font-size: 16px;">{{$value->cat}}</h4>
                                                    <label style="margin: 0; display: flex; align-items: center; gap: 5px; cursor: pointer;">
                                                        <input type="checkbox" 
                                                               class="home-toggle" 
                                                               data-id="{{$value->id}}" 
                                                               {{($value->home ?? 0) ? 'checked' : ''}}
                                                               style="width: 18px; height: 18px; cursor: pointer;">
                                                        <span style="font-size: 12px; color: #666; font-weight: 500;">Show on Home</span>
                                                    </label>
                                                    <span style="color: #999; font-size: 13px;">Order: {{$value->order ?? 0}}</span>
                                                </div>
                                                @if($value->keywords)
                                                    <small style="color: #666; font-size: 12px;">{{$value->keywords}}</small>
                                                @endif
                                            </div>
                                        </div>
                                        <div style="display: flex; gap: 8px; align-items: center;">
                                            <a href="{{url('/admin')}}/editCategories/{{$value->id}}" 
                                               class="btn btn-sm" 
                                               style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; border: none; padding: 8px 16px; border-radius: 6px; text-decoration: none; font-size: 12px; font-weight: 500; transition: all 0.3s;"
                                               onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                                                <i class="icon-pencil"></i> Edit
                                            </a>
                                            <a href="#" 
                                               class="btn btn-sm" 
                                               data-toggle="modal" 
                                               data-target="#buttonedModal_{{$value->id}}"
                                               style="background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%); color: white; border: none; padding: 8px 16px; border-radius: 6px; text-decoration: none; font-size: 12px; font-weight: 500; transition: all 0.3s;"
                                               onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                                                <i class="icon-link"></i> Link
                                            </a>
                                            <a onclick="return confirm('Deleting this category may affect products and other dependent items. Are you sure you want to continue?')" 
                                               href="{{url('/admin')}}/deleteCategory/{{$value->id}}" 
                                               class="btn btn-sm" 
                                               style="background: linear-gradient(135deg, #ff6b6b 0%, #ee5a6f 100%); color: white; border: none; padding: 8px 16px; border-radius: 6px; text-decoration: none; font-size: 12px; font-weight: 500; transition: all 0.3s;"
                                               onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                                                <i class="icon-trash"></i> Delete
                                            </a>
                                        </div>
                                    </li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!--END PAGE CONTENT -->

    <!-- RIGHT STRIP  SECTION -->
    @include('admin.right')
    <!-- END RIGHT STRIP  SECTION -->
</div>

<!-- Modals for Links -->
@foreach($Category as $value)
<div class="modal fade" id="buttonedModal_{{$value->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white;">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="color: white; opacity: 0.8;">&times;</button>
                <h4 class="modal-title">{{$value->cat}}</h4>
            </div>
            <div class="modal-body">
                <?php $final = preg_replace('#[ -]+#', '-', $value->cat); ?>
                <label style="font-weight: 600; margin-bottom: 8px; display: block;">Category URL:</label>
                <input type="text" class="form-control" value="{{url('/')}}/products/{{$value->slung}}" readonly style="background: #f8f9fa; border: 1px solid #ddd; padding: 10px; border-radius: 6px; font-family: monospace;">
                <small style="color: #666; margin-top: 5px; display: block;">Copy this link to share the category</small>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endforeach

<!-- jQuery UI for Sortable -->
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/ui-lightness/jquery-ui.css">

<script>
$(document).ready(function() {
    // Initialize sortable
    $("#sortable-categories").sortable({
        handle: '.icon-move',
        placeholder: "ui-state-highlight",
        tolerance: "pointer",
        cursor: "move",
        opacity: 0.8,
        update: function(event, ui) {
            // Show save button when order changes
            $('#saveOrderBtn').fadeIn();
        }
    });
    
    // Save order
    $('#saveOrderBtn').on('click', function() {
        var order = [];
        $('#sortable-categories li').each(function() {
            order.push($(this).data('id'));
        });
        
        $(this).html('<i class="icon-spinner icon-spin"></i> Saving...').prop('disabled', true);
        
        $.ajax({
            url: '{{url("/admin/updateCategoryOrder")}}',
            method: 'POST',
            data: {
                orders: order,
                _token: '{{csrf_token()}}'
            },
            success: function(response) {
                $('#saveOrderBtn').html('<i class="icon-ok"></i> Order Saved!').css('background', 'linear-gradient(135deg, #43e97b 0%, #38f9d7 100%)');
                setTimeout(function() {
                    $('#saveOrderBtn').fadeOut();
                    location.reload();
                }, 1500);
            },
            error: function() {
                $('#saveOrderBtn').html('<i class="icon-remove"></i> Error').css('background', 'linear-gradient(135deg, #ff6b6b 0%, #ee5a6f 100%)').prop('disabled', false);
                alert('Error saving order. Please try again.');
            }
        });
    });
    
    // Toggle home display
    $('.home-toggle').on('change', function() {
        var categoryId = $(this).data('id');
        var isHome = $(this).is(':checked') ? 1 : 0;
        var $checkbox = $(this);
        
        $.ajax({
            url: '{{url("/admin/toggleCategoryHome")}}',
            method: 'POST',
            data: {
                id: categoryId,
                home: isHome,
                _token: '{{csrf_token()}}'
            },
            success: function(response) {
                // Visual feedback
                if (isHome) {
                    $checkbox.closest('li').find('h4').after('<span class="home-badge" style="background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%); color: white; padding: 2px 8px; border-radius: 12px; font-size: 11px; font-weight: 600; margin-left: 8px;">Home</span>');
                } else {
                    $checkbox.closest('li').find('.home-badge').remove();
                }
            },
            error: function() {
                $checkbox.prop('checked', !isHome);
                alert('Error updating category. Please try again.');
            }
        });
    });
});
</script>

<style>
.ui-state-highlight {
    height: 60px;
    background: linear-gradient(135deg, #f0f4ff 0%, #e0e7ff 100%) !important;
    border: 2px dashed #667eea !important;
    border-radius: 8px;
}
#sortable-categories li.ui-sortable-helper {
    box-shadow: 0 8px 20px rgba(102, 126, 234, 0.3);
    transform: rotate(2deg);
}
</style>

@endsection
