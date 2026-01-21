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
                            <div style="display: flex; gap: 10px;">
                                <a href="{{url('/admin/updateCategorySlugs')}}" class="btn" style="background: rgba(255,255,255,0.1); color: white; border: 1px solid rgba(255,255,255,0.2); padding: 12px 24px; border-radius: 8px; transition: all 0.3s; text-decoration: none; font-weight: 500;">
                                    <i class="icon-refresh"></i> Update Category Slugs
                                </a>
                                <a href="{{url('/admin/updateProductSlugs')}}" class="btn" style="background: rgba(255,255,255,0.1); color: white; border: 1px solid rgba(255,255,255,0.2); padding: 12px 24px; border-radius: 8px; transition: all 0.3s; text-decoration: none; font-weight: 500;">
                                    <i class="icon-refresh"></i> Update Product Slugs
                                </a>
                                <a href="{{url('/admin/addCategory')}}" class="btn" style="background: rgba(255,255,255,0.2); color: white; border: 1px solid rgba(255,255,255,0.3); padding: 12px 24px; border-radius: 8px; transition: all 0.3s; text-decoration: none; font-weight: 500;">
                                    <i class="icon-plus"></i> Add New Category
                                </a>
                            </div>
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
                                    <li data-id="{{$value->id}}" style="background: {{($value->status ?? 1) ? '#f8f9fa' : '#f0f0f0'}}; border: 1px solid #e9ecef; border-radius: 8px; padding: 15px; margin-bottom: 12px; cursor: move; transition: all 0.3s; display: flex; align-items: center; justify-content: space-between; opacity: {{($value->status ?? 1) ? '1' : '0.6'}};" 
                                        onmouseover="this.style.background='#f0f4ff'; this.style.borderColor='#667eea';" 
                                        onmouseout="this.style.background='{{($value->status ?? 1) ? '#f8f9fa' : '#f0f0f0'}}'; this.style.borderColor='#e9ecef';">
                                        <div style="display: flex; align-items: center; gap: 15px; flex: 1;">
                                            <div style="width: 40px; height: 40px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 8px; display: flex; align-items: center; justify-content: center; color: white; font-weight: 600; flex-shrink: 0; cursor: move;">
                                                <i class="icon-move" style="font-size: 18px;"></i>
                                            </div>
                                            <div style="flex: 1;">
                                                <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 5px;">
                                                    <h4 style="margin: 0; font-weight: 600; color: #333; font-size: 16px;">{{$value->cat}}</h4>
                                                    @if(($value->home ?? 0))
                                                    <span class="home-badge" style="background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%); color: white; padding: 2px 8px; border-radius: 12px; font-size: 11px; font-weight: 600; margin-left: 8px;">Home</span>
                                                    @endif
                                                    @if(!($value->status ?? 1))
                                                    <span class="status-badge-inactive" style="background: #ff6b6b; color: white; padding: 2px 8px; border-radius: 12px; font-size: 11px; font-weight: 600; margin-left: 8px;">Inactive</span>
                                                    @endif
                                                    <label style="margin: 0; display: flex; align-items: center; gap: 5px; cursor: pointer;" onclick="event.stopPropagation();">
                                                        <input type="checkbox" 
                                                               class="home-toggle" 
                                                               data-id="{{$value->id}}" 
                                                               id="home-toggle-{{$value->id}}"
                                                               {{($value->home ?? 0) ? 'checked' : ''}}
                                                               style="width: 18px; height: 18px; cursor: pointer;">
                                                        <span style="font-size: 12px; color: #666; font-weight: 500;">Show on Home</span>
                                                    </label>
                                                    <label style="margin: 0; display: flex; align-items: center; gap: 5px; cursor: pointer; margin-left: 10px;">
                                                        <input type="checkbox" 
                                                               class="status-toggle" 
                                                               data-id="{{$value->id}}" 
                                                               {{($value->status ?? 1) ? 'checked' : ''}}
                                                               style="width: 18px; height: 18px; cursor: pointer;">
                                                        <span style="font-size: 12px; color: #666; font-weight: 500;">Active</span>
                                                    </label>
                                                    <div style="display: flex; align-items: center; gap: 5px;">
                                                        <span style="color: #999; font-size: 13px;">Order:</span>
                                                        <input type="number" 
                                                               class="order-input" 
                                                               data-id="{{$value->id}}" 
                                                               value="{{$value->order ?? 0}}" 
                                                               style="width: 50px; height: 24px; padding: 2px 5px; border: 1px solid #ddd; border-radius: 4px; font-size: 12px; text-align: center;">
                                                    </div>
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
<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/ui-lightness/jquery-ui.css">

<script>
// Wait for jQuery AND jQuery UI to be loaded (jQuery is loaded in master.blade.php at bottom)
(function() {
    function loadjQueryUI() {
        // Check if jQuery UI is already loaded
        if (typeof jQuery !== 'undefined' && typeof jQuery.ui !== 'undefined') {
            initCategoriesScript();
            return;
        }
        
        // Check if jQuery is available first
        if (typeof jQuery === 'undefined') {
            console.log('Waiting for jQuery...');
            setTimeout(loadjQueryUI, 100);
            return;
        }
        
        // jQuery is loaded, now load jQuery UI
        if (typeof jQuery.ui === 'undefined') {
            console.log('Loading jQuery UI...');
            var script = document.createElement('script');
            script.src = 'https://code.jquery.com/ui/1.13.2/jquery-ui.min.js';
            script.onload = function() {
                console.log('jQuery UI loaded successfully');
                initCategoriesScript();
            };
            script.onerror = function() {
                console.error('Failed to load jQuery UI');
            };
            document.head.appendChild(script);
            return;
        }
        
        initCategoriesScript();
    }
    
    function initCategoriesScript() {
        // Check if jQuery is available
        if (typeof jQuery === 'undefined') {
            console.error('jQuery is not loaded! Retrying in 100ms...');
            setTimeout(loadjQueryUI, 100);
            return;
        }
        
        var $ = jQuery;
        console.log('jQuery version:', $.fn.jquery);
        
        // Check if jQuery UI is available
        if (typeof $.ui === 'undefined') {
            console.error('jQuery UI is not loaded!');
            setTimeout(loadjQueryUI, 100);
            return;
        }
        
        console.log('jQuery UI version:', $.ui.version);
        console.log('Categories page script initializing...');
        
        // Test if checkboxes exist
        var homeCheckboxes = $('.home-toggle');
        console.log('Found', homeCheckboxes.length, 'home checkboxes');
        
        if (homeCheckboxes.length === 0) {
            console.warn('WARNING: No home checkboxes found!');
        }
        
        // Show save button when order input changes
        $(document).on('change', '.order-input', function() {
            var $input = $(this);
            var categoryId = $input.data('id');
            var newOrder = $input.val();
            
            $input.css('background', '#fff3cd');
            
            $.ajax({
                url: '{{url("/admin/updateSingleCategoryOrder")}}',
                method: 'POST',
                data: {
                    id: categoryId,
                    order: newOrder,
                    _token: '{{csrf_token()}}'
                },
                success: function(response) {
                    $input.css('background', '#d4edda');
                    setTimeout(function() {
                        $input.css('background', '#fff');
                    }, 1000);
                },
                error: function() {
                    $input.css('background', '#f8d7da');
                    alert('Error updating order');
                }
            });
        });
        
        // Initialize sortable (only if jQuery UI is loaded)
        if (typeof $.fn.sortable !== 'undefined') {
            $("#sortable-categories").sortable({
                handle: '.icon-move',
                placeholder: "ui-state-highlight",
                tolerance: "pointer",
                cursor: "move",
                opacity: 0.8,
                update: function(event, ui) {
                    $('#saveOrderBtn').fadeIn();
                }
            });
        } else {
            console.warn('jQuery UI sortable not available - drag and drop disabled');
        }
        
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
        
        // Function to handle home toggle
        function handleHomeToggle(checkbox) {
            var categoryId = $(checkbox).data('id');
            var isHome = $(checkbox).is(':checked') ? 1 : 0;
            var $checkbox = $(checkbox);
            var $li = $checkbox.closest('li');
            
            if (!categoryId) {
                console.error('No category ID found!');
                return;
            }
            
            // Disable checkbox during request
            $checkbox.prop('disabled', true);
            
            console.log('=== TOGGLE HOME ===');
            console.log('Category ID:', categoryId);
            console.log('Is Home:', isHome);
            console.log('Checkbox element:', $checkbox[0]);
            console.log('URL:', '{{url("/admin/toggleCategoryHome")}}');
            console.log('CSRF Token:', '{{csrf_token()}}');
            
            // Get CSRF token from meta tag or use the one from blade
            var csrfToken = $('meta[name="csrf-token"]').attr('content') || '{{csrf_token()}}';
            
            var requestData = {
                id: categoryId,
                home: isHome,
                _token: csrfToken
            };
            
            console.log('Sending AJAX request with data:', requestData);
            console.log('Full URL:', '{{url("/admin/toggleCategoryHome")}}');
            console.log('CSRF Token:', csrfToken);
            
            // Setup AJAX defaults for CSRF
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                }
            });
            
            $.ajax({
                url: '{{url("/admin/toggleCategoryHome")}}',
                method: 'POST',
                data: requestData,
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'X-Requested-With': 'XMLHttpRequest'
                },
                beforeSend: function(xhr) {
                    console.log('Request being sent...');
                },
                success: function(response) {
                    console.log('SUCCESS RESPONSE:', response);
                    if (response.success) {
                        // Visual feedback
                        if (isHome) {
                            if ($li.find('.home-badge').length === 0) {
                                $li.find('h4').after('<span class="home-badge" style="background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%); color: white; padding: 2px 8px; border-radius: 12px; font-size: 11px; font-weight: 600; margin-left: 8px;">Home</span>');
                            }
                        } else {
                            $li.find('.home-badge').remove();
                        }
                        console.log('Database updated successfully! Category ID:', response.id, 'Home:', response.home);
                    } else {
                        alert('Error: ' + (response.message || 'Unknown error'));
                        $checkbox.prop('checked', !isHome);
                    }
                    $checkbox.prop('disabled', false);
                },
                error: function(xhr, status, error) {
                    console.error('AJAX ERROR DETAILS:');
                    console.error('Status:', status);
                    console.error('Error:', error);
                    console.error('Response Text:', xhr.responseText);
                    console.error('Status Code:', xhr.status);
                    console.error('Response Headers:', xhr.getAllResponseHeaders());
                    
                    var errorMsg = 'Error updating category. ';
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        errorMsg += xhr.responseJSON.message;
                    } else if (xhr.responseText) {
                        errorMsg += xhr.responseText;
                    } else {
                        errorMsg += 'Status: ' + xhr.status + ' - ' + error;
                    }
                    
                    alert(errorMsg);
                    $checkbox.prop('checked', !isHome);
                    $checkbox.prop('disabled', false);
                }
            });
        }
        
        // Toggle home display - attach to both change and click events
        function attachHomeToggleHandlers() {
            // Remove any existing handlers to prevent duplicates
            $('.home-toggle').off('change.homeToggle click.homeToggle');
            
            // Attach change handler
            $(document).on('change.homeToggle', '.home-toggle', function(e) {
                e.stopPropagation();
                e.preventDefault();
                console.log('Change event fired on checkbox:', this);
                handleHomeToggle(this);
            });
            
            // Also attach click handler as backup (fires before change)
            $(document).on('click.homeToggle', '.home-toggle', function(e) {
                e.stopPropagation();
                var self = this;
                // Wait a tiny bit for checkbox state to update
                setTimeout(function() {
                    console.log('Click event fired on checkbox:', self);
                    handleHomeToggle(self);
                }, 50);
            });
            
            // Direct binding to existing checkboxes
            $('.home-toggle').each(function(index) {
                var $cb = $(this);
                console.log('Binding to checkbox', index + 1, 'ID:', $cb.data('id'));
                
                $cb.on('change', function(e) {
                    e.stopPropagation();
                    console.log('Direct change handler fired!');
                    handleHomeToggle(this);
                });
            });
        }
        
        // Attach handlers
        attachHomeToggleHandlers();
        
        // Toggle status (active/inactive)
        $(document).on('change', '.status-toggle', function() {
            var categoryId = $(this).data('id');
            var isActive = $(this).is(':checked') ? 1 : 0;
            var $checkbox = $(this);
            var $li = $checkbox.closest('li');
            
            $checkbox.prop('disabled', true);
            
            console.log('Toggling status for category:', categoryId, 'to:', isActive);
            
            $.ajax({
                url: '{{url("/admin/toggleCategoryStatus")}}',
                method: 'POST',
                data: {
                    id: categoryId,
                    status: isActive,
                    _token: '{{csrf_token()}}'
                },
                success: function(response) {
                    console.log('Status update success:', response);
                    if (isActive) {
                        $li.css('opacity', '1').css('background', '#f8f9fa');
                        $li.find('.status-badge-inactive').remove();
                    } else {
                        $li.css('opacity', '0.6').css('background', '#f0f0f0');
                        if ($li.find('.status-badge-inactive').length === 0) {
                            $li.find('h4').after('<span class="status-badge-inactive" style="background: #ff6b6b; color: white; padding: 2px 8px; border-radius: 12px; font-size: 11px; font-weight: 600; margin-left: 8px;">Inactive</span>');
                        }
                    }
                    $checkbox.prop('disabled', false);
                },
                error: function(xhr, status, error) {
                    console.error('Status update error:', xhr.responseText, status, error);
                    $checkbox.prop('checked', !isActive);
                    $checkbox.prop('disabled', false);
                    alert('Error updating category status. Please try again.');
                }
            });
        });
        
        console.log('All event handlers attached successfully!');
    }
    
    // Wait for DOM to be ready, then load jQuery UI (jQuery is loaded at bottom of master.blade.php)
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', function() {
            // Wait a bit for jQuery to load from master.blade.php
            setTimeout(loadjQueryUI, 200);
        });
    } else {
        // DOM already ready, wait for jQuery
        setTimeout(loadjQueryUI, 200);
    }
})();
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
