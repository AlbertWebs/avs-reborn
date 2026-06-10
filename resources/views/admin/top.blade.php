<div id="top">
    <?php 
        $SiteSettings = DB::table('sitesettings')->get();
        $Messages = DB::table('messages')->where('status',0)->get(); 
        $MessageCount = count($Messages);
        $Admin = Auth::user();
    ?>
    
    <nav class="modern-admin-navbar" id="adminNavbar">
        <div class="navbar-container">
            <!-- Mobile Menu Toggle -->
            <button class="mobile-menu-toggle visible-xs" id="menu-toggle" data-toggle="collapse" href="#menu" aria-label="Toggle menu">
                <i class="icon-align-justify"></i>
            </button>

            <!-- Logo Section -->
            <div class="navbar-brand-section">
                <a href="{{url('/admin')}}" class="navbar-brand-link">
                    @foreach($SiteSettings as $Settings)
                        @if($Settings->logo)
                            <img src="{{url('/')}}/uploads/logo/{{$Settings->logo}}" alt="{{$Settings->sitename ?? 'Admin Panel'}}" class="navbar-logo">
                        @else
                            <div class="navbar-logo-text">
                                <span class="logo-text-main">{{$Settings->sitename ?? 'Admin'}}</span>
                                <span class="logo-text-sub">Panel</span>
                            </div>
                        @endif
                    @endforeach
                </a>
            </div>

            <!-- Right Side Actions -->
            <div class="navbar-actions">
                <ul class="navbar-nav-right">
                    <!-- Preview Website -->
                    <li class="nav-item">
                        <a href="{{url('/')}}" target="_blank" class="nav-link-icon" title="Preview Website" data-tooltip="View Website">
                            <i class="icon-globe"></i>
                            <span class="nav-link-label">Website</span>
                        </a>
                    </li>

                    <!-- Messages Dropdown -->
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link-icon dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" title="Messages">
                            <i class="icon-envelope-alt"></i>
                            @if($MessageCount > 0)
                                <span class="notification-badge">{{$MessageCount}}</span>
                            @endif
                            <span class="nav-link-label">Messages</span>
                        </a>
                        <div class="dropdown-menu dropdown-messages-modern">
                            @if($MessageCount > 0)
                                <div class="dropdown-header">
                                    <strong>New Messages ({{$MessageCount}})</strong>
                                </div>
                                <div class="messages-list">
                                    @foreach($Messages->take(5) as $Message)
                                        <a href="{{url('admin/read')}}/{{$Message->id}}" class="message-item">
                                            <div class="message-avatar">
                                                <i class="icon-user"></i>
                                            </div>
                                            <div class="message-content">
                                                <div class="message-header">
                                                    <strong class="message-sender">{{$Message->name}}</strong>
                                                    <span class="message-time">Just now</span>
                                                </div>
                                                <p class="message-preview">{{ strlen($Message->content) > 50 ? substr($Message->content, 0, 50) . '...' : $Message->content }}</p>
                                            </div>
                                        </a>
                                    @endforeach
                                </div>
                                <div class="dropdown-footer">
                                    <a href="{{url('/admin/allMessages')}}" class="view-all-link">
                                        <strong>View All Messages</strong>
                                        <i class="icon-angle-right"></i>
                                    </a>
                                </div>
                            @else
                                <div class="empty-messages">
                                    <i class="icon-inbox"></i>
                                    <p>No new messages</p>
                                </div>
                            @endif
                        </div>
                    </li>

                    <!-- Admin Profile Dropdown -->
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link-profile dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <div class="profile-avatar">
                                @if($Admin->image)
                                    <img src="{{url('/')}}/uploads/admins/{{$Admin->image}}" alt="{{$Admin->name}}">
                                @else
                                    <span class="avatar-initials">{{ substr($Admin->name, 0, 1) }}</span>
                                @endif
                            </div>
                            <div class="profile-info">
                                <span class="profile-name">{{$Admin->name}}</span>
                                <span class="profile-role">Administrator</span>
                            </div>
                            <i class="icon-chevron-down dropdown-arrow"></i>
                        </a>
                        <div class="dropdown-menu dropdown-profile-modern">
                            <div class="dropdown-profile-header">
                                <div class="profile-avatar-large">
                                    @if($Admin->image)
                                        <img src="{{url('/')}}/uploads/admins/{{$Admin->image}}" alt="{{$Admin->name}}">
                                    @else
                                        <span class="avatar-initials-large">{{ substr($Admin->name, 0, 1) }}</span>
                                    @endif
                                </div>
                                <div class="profile-details">
                                    <strong>{{$Admin->name}}</strong>
                                    <span>{{$Admin->email}}</span>
                                </div>
                            </div>
                            <div class="dropdown-divider"></div>
                            <a href="{{url('/admin/editAdmin')}}/{{$Admin->id}}" class="dropdown-item-modern">
                                <i class="icon-user-md"></i>
                                <span>User Profile</span>
                            </a>
                            <a href="{{url('/admin/sitesettings')}}" class="dropdown-item-modern">
                                <i class="icon-gear"></i>
                                <span>Settings</span>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="{{url('/admin/logout')}}" class="dropdown-item-modern dropdown-item-danger">
                                <i class="icon-signout"></i>
                                <span>Logout</span>
                            </a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</div>

<style>
/* Modern Admin Navbar Styles */
:root {
    --admin-navbar-height: 76px;
    --admin-nav-control-size: 52px;
    --admin-font-base: 14px;
    --admin-font-sm: 12px;
    --admin-font-md: 14px;
    --admin-font-lg: 16px;
}

/* Keep page content below the fixed navbar — body only, not #top (avoids double gap) */
body.padTop53 {
    padding-top: var(--admin-navbar-height);
}

body.padTop53 #left #menu.affix {
    top: var(--admin-navbar-height);
}

#top {
    height: 0;
    margin: 0;
    padding: 0;
    overflow: visible;
}

.modern-admin-navbar {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    height: var(--admin-navbar-height);
    background: #f8f9fa;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
    border-bottom: 1px solid #e9ecef;
    z-index: 1000;
    padding: 0;
    border: none;
}

.navbar-container {
    display: flex;
    align-items: center;
    justify-content: space-between;
    height: 100%;
    padding: 0 2rem;
    max-width: 100%;
}

/* Mobile Menu Toggle */
.mobile-menu-toggle {
    display: none;
    background: #fff;
    border: 1px solid #e9ecef;
    color: #333;
    padding: 0.5rem 0.75rem;
    border-radius: 8px;
    cursor: pointer;
    transition: all 0.3s ease;
    margin-right: 1rem;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
}

.mobile-menu-toggle:hover {
    background: #f0f0f0;
    border-color: #ddd;
}

.mobile-menu-toggle i {
    font-size: 1.25rem;
}

/* Logo Section */
.navbar-brand-section {
    display: flex;
    align-items: center;
    flex-shrink: 0;
}

.navbar-brand-link {
    display: flex;
    align-items: center;
    text-decoration: none;
    transition: opacity 0.3s ease;
}

.navbar-brand-link:hover {
    opacity: 0.9;
}

.navbar-logo {
    max-height: 48px;
    width: auto;
    object-fit: contain;
}

.navbar-logo-text {
    display: flex;
    flex-direction: column;
    line-height: 1.2;
}

.logo-text-main {
    font-size: 1.35rem;
    font-weight: 700;
    color: #333;
    letter-spacing: -0.02em;
}

.logo-text-sub {
    font-size: 0.8rem;
    font-weight: 500;
    color: #666;
    text-transform: uppercase;
    letter-spacing: 1px;
}

/* Navbar Actions */
.navbar-actions {
    display: flex;
    align-items: center;
    flex: 1;
    justify-content: flex-end;
}

.navbar-nav-right {
    display: flex;
    align-items: center;
    list-style: none;
    margin: 0;
    padding: 0;
    gap: 0.5rem;
}

.nav-item {
    position: relative;
    display: flex;
    align-items: center;
}

/* Nav Link Icons */
.nav-link-icon {
    display: flex;
    align-items: center;
    justify-content: center;
    width: var(--admin-nav-control-size);
    height: var(--admin-nav-control-size);
    color: #666;
    text-decoration: none;
    border-radius: 12px;
    transition: all 0.3s ease;
    position: relative;
    background: #fff;
    border: 1px solid #e9ecef;
}

.nav-link-icon:hover {
    background: #f0f0f0;
    transform: translateY(-2px);
    color: #667eea;
    border-color: #667eea;
    box-shadow: 0 4px 8px rgba(102, 126, 234, 0.15);
}

.nav-link-icon i {
    font-size: 1.35rem;
}

.nav-link-label {
    display: none;
}

/* Notification Badge */
.notification-badge {
    position: absolute;
    top: -2px;
    right: -2px;
    background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
    color: white;
    border-radius: 10px;
    padding: 2px 7px;
    font-size: 0.75rem;
    font-weight: 700;
    min-width: 18px;
    text-align: center;
    line-height: 1.4;
    box-shadow: 0 2px 8px rgba(245, 87, 108, 0.4);
    animation: pulse 2s infinite;
}

@keyframes pulse {
    0%, 100% {
        transform: scale(1);
    }
    50% {
        transform: scale(1.1);
    }
}

/* Profile Link */
.nav-link-profile {
    display: flex;
    align-items: center;
    gap: 0.6rem;
    padding: 0.35rem 0.85rem 0.35rem 0.45rem;
    color: #333;
    text-decoration: none;
    border-radius: 12px;
    transition: all 0.3s ease;
    background: #fff;
    border: 1px solid #e9ecef;
    min-height: var(--admin-nav-control-size);
    max-height: var(--admin-nav-control-size);
    max-width: 220px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
    line-height: 1.2;
}

.nav-link-profile:hover {
    background: #f0f0f0;
    color: #333;
    border-color: #ddd;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.profile-avatar {
    width: 40px;
    height: 40px;
    flex-shrink: 0;
    border-radius: 50%;
    overflow: hidden;
    background: #e9ecef;
    display: flex;
    align-items: center;
    justify-content: center;
    border: 2px solid #fff;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.profile-avatar img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.avatar-initials {
    color: #667eea;
    font-weight: 700;
    font-size: 1.05rem;
}

.profile-info {
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    min-width: 0;
    flex: 1;
}

.profile-name {
    font-size: var(--admin-font-md);
    font-weight: 600;
    color: #333;
    line-height: 1.2;
    max-width: 120px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.profile-role {
    font-size: var(--admin-font-sm);
    color: #666;
    line-height: 1.2;
}

.dropdown-arrow {
    font-size: 0.8rem;
    color: #666;
    transition: transform 0.3s ease;
    flex-shrink: 0;
    margin-left: 0.15rem;
}

.dropdown-toggle[aria-expanded="true"] .dropdown-arrow {
    transform: rotate(180deg);
}

/* Dropdown Menus */
.dropdown-menu {
    position: absolute;
    top: calc(100% + 10px);
    right: 0;
    min-width: 280px;
    max-width: calc(100vw - 2rem);
    background: white;
    border-radius: 16px;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
    border: none;
    padding: 0;
    margin-top: 0.5rem;
    animation: dropdownFadeIn 0.3s ease;
    z-index: 1001;
    transform-origin: top right;
}

/* Ensure dropdown stays within viewport */
.nav-item.dropdown:last-child .dropdown-menu {
    right: 0;
    left: auto;
}

@media (max-width: 991px) {
    .dropdown-menu {
        right: 0.5rem !important;
        left: auto !important;
        max-width: calc(100vw - 1rem);
        min-width: auto;
        width: calc(100vw - 2rem);
    }
}

@keyframes dropdownFadeIn {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Messages Dropdown */
.dropdown-messages-modern {
    max-height: 400px;
    overflow-y: auto;
}

.dropdown-header {
    padding: 1rem 1.25rem;
    border-bottom: 1px solid #e9ecef;
    background: #f8f9fa;
    color: #333;
    border-radius: 16px 16px 0 0;
}

.dropdown-header strong {
    font-size: 0.9rem;
    font-weight: 600;
}

.messages-list {
    padding: 0.5rem 0;
    max-height: 300px;
    overflow-y: auto;
}

.message-item {
    display: flex;
    align-items: flex-start;
    gap: 1rem;
    padding: 1rem 1.25rem;
    text-decoration: none;
    color: #333;
    transition: background 0.3s ease;
    border-bottom: 1px solid #f8f9fa;
}

.message-item:hover {
    background: #f8f9fa;
    color: #333;
}

.message-item:last-child {
    border-bottom: none;
}

.message-avatar {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    flex-shrink: 0;
}

.message-avatar i {
    font-size: 1.1rem;
}

.message-content {
    flex: 1;
    min-width: 0;
}

.message-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 0.25rem;
}

.message-sender {
    font-size: 0.9rem;
    font-weight: 600;
    color: #333;
}

.message-time {
    font-size: 0.75rem;
    color: #999;
}

.message-preview {
    font-size: 0.85rem;
    color: #666;
    margin: 0;
    line-height: 1.4;
}

.dropdown-footer {
    padding: 0.75rem 1.25rem;
    border-top: 1px solid #f0f0f0;
    background: #f8f9fa;
    border-radius: 0 0 16px 16px;
}

.view-all-link {
    display: flex;
    align-items: center;
    justify-content: space-between;
    color: #667eea;
    text-decoration: none;
    font-weight: 600;
    font-size: 0.9rem;
    transition: color 0.3s ease;
}

.view-all-link:hover {
    color: #764ba2;
}

.view-all-link i {
    font-size: 0.85rem;
}

.empty-messages {
    padding: 2rem 1.25rem;
    text-align: center;
    color: #999;
}

.empty-messages i {
    font-size: 2.5rem;
    color: #ddd;
    margin-bottom: 0.5rem;
}

.empty-messages p {
    margin: 0;
    font-size: 0.9rem;
}

/* Profile Dropdown */
.dropdown-profile-modern {
    min-width: 280px;
    max-width: calc(100vw - 2rem);
}

.dropdown-profile-header {
    padding: 1.5rem 1.25rem;
    background: #f8f9fa;
    color: #333;
    border-radius: 16px 16px 0 0;
    display: flex;
    align-items: center;
    gap: 1rem;
    border-bottom: 1px solid #e9ecef;
}

.profile-avatar-large {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    overflow: hidden;
    background: #e9ecef;
    display: flex;
    align-items: center;
    justify-content: center;
    border: 3px solid #fff;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    flex-shrink: 0;
}

.profile-avatar-large img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.avatar-initials-large {
    color: #667eea;
    font-weight: 700;
    font-size: 1.5rem;
}

.profile-details {
    display: flex;
    flex-direction: column;
    flex: 1;
    min-width: 0;
}

.profile-details strong {
    font-size: var(--admin-font-lg);
    font-weight: 600;
    color: #333;
    margin-bottom: 0.25rem;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.profile-details span {
    font-size: var(--admin-font-md);
    color: #666;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.dropdown-divider {
    height: 1px;
    background: #f0f0f0;
    margin: 0.5rem 0;
}

.dropdown-item-modern {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    padding: 0.875rem 1.25rem;
    color: #333;
    text-decoration: none;
    font-size: var(--admin-font-md);
    transition: all 0.3s ease;
}

.dropdown-item-modern:hover {
    background: #f8f9fa;
    color: #667eea;
    padding-left: 1.5rem;
}

.dropdown-item-modern i {
    width: 20px;
    color: #667eea;
    font-size: 1rem;
}

.dropdown-item-danger {
    color: #f5576c;
}

.dropdown-item-danger:hover {
    background: #fff5f5;
    color: #f5576c;
}

.dropdown-item-danger i {
    color: #f5576c;
}

/* Responsive Design */
@media (max-width: 991px) {
    .navbar-container {
        padding: 0 1rem;
    }

    .mobile-menu-toggle {
        display: block;
    }

    .profile-info {
        display: none;
    }

    .nav-link-label {
        display: none;
    }

    .navbar-logo-text .logo-text-sub {
        display: none;
    }

    .dropdown-menu {
        right: 0.5rem !important;
        left: auto !important;
        min-width: auto;
        width: calc(100vw - 1rem);
        max-width: calc(100vw - 1rem);
    }
    
    .dropdown-profile-modern {
        width: calc(100vw - 1rem);
        max-width: calc(100vw - 1rem);
    }
}

@media (max-width: 576px) {
    .navbar-container {
        padding: 0 0.75rem;
    }

    .navbar-logo {
        max-height: 35px;
    }

    .logo-text-main {
        font-size: 1.25rem;
    }

    .nav-link-icon {
        width: 44px;
        height: 44px;
    }

    .nav-link-profile {
        padding: 0.35rem;
        max-width: none;
    }

    .profile-avatar {
        width: 36px;
        height: 36px;
    }
}

/* Scrollbar Styling for Dropdowns */
.messages-list::-webkit-scrollbar {
    width: 6px;
}

.messages-list::-webkit-scrollbar-track {
    background: #f8f9fa;
}

.messages-list::-webkit-scrollbar-thumb {
    background: #ddd;
    border-radius: 3px;
}

.messages-list::-webkit-scrollbar-thumb:hover {
    background: #ccc;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Close dropdowns when clicking outside
    document.addEventListener('click', function(event) {
        const dropdowns = document.querySelectorAll('.dropdown');
        dropdowns.forEach(function(dropdown) {
            const toggle = dropdown.querySelector('.dropdown-toggle');
            const menu = dropdown.querySelector('.dropdown-menu');
            
            if (toggle && menu && !dropdown.contains(event.target)) {
                toggle.setAttribute('aria-expanded', 'false');
                menu.style.display = 'none';
            }
        });
    });

    // Handle dropdown toggle
    const dropdownToggles = document.querySelectorAll('.dropdown-toggle');
    dropdownToggles.forEach(function(toggle) {
        toggle.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            
            const dropdown = this.closest('.dropdown');
            const menu = dropdown.querySelector('.dropdown-menu');
            const isExpanded = this.getAttribute('aria-expanded') === 'true';
            
            // Close all other dropdowns
            document.querySelectorAll('.dropdown-toggle').forEach(function(otherToggle) {
                if (otherToggle !== toggle) {
                    otherToggle.setAttribute('aria-expanded', 'false');
                    const otherMenu = otherToggle.closest('.dropdown').querySelector('.dropdown-menu');
                    if (otherMenu) otherMenu.style.display = 'none';
                }
            });
            
            // Toggle current dropdown
            this.setAttribute('aria-expanded', !isExpanded);
            if (menu) {
                if (!isExpanded) {
                    menu.style.display = 'block';
                    // Adjust position to stay within viewport
                    adjustDropdownPosition(menu, dropdown);
                } else {
                    menu.style.display = 'none';
                }
            }
        });
    });

    // Function to adjust dropdown position to stay within viewport
    function adjustDropdownPosition(menu, dropdown) {
        const rect = menu.getBoundingClientRect();
        const viewportWidth = window.innerWidth;
        const viewportHeight = window.innerHeight;
        
        // Reset any previous transforms
        menu.style.transform = '';
        menu.style.right = '';
        menu.style.left = '';
        
        // Check if dropdown goes off the right edge
        if (rect.right > viewportWidth) {
            const overflow = rect.right - viewportWidth;
            menu.style.right = '0';
            menu.style.transform = `translateX(-${overflow + 10}px)`;
        }
        
        // Check if dropdown goes off the left edge
        if (rect.left < 0) {
            menu.style.right = 'auto';
            menu.style.left = '0';
            menu.style.transform = '';
        }
        
        // Check if dropdown goes off the bottom edge
        if (rect.bottom > viewportHeight) {
            const overflow = rect.bottom - viewportHeight;
            menu.style.top = 'auto';
            menu.style.bottom = '100%';
            menu.style.marginTop = '0';
            menu.style.marginBottom = '10px';
        }
    }

    // Adjust dropdown position on window resize
    window.addEventListener('resize', function() {
        document.querySelectorAll('.dropdown-menu[style*="display: block"]').forEach(function(menu) {
            const dropdown = menu.closest('.dropdown');
            if (dropdown) {
                adjustDropdownPosition(menu, dropdown);
            }
        });
    });
});
</script>
