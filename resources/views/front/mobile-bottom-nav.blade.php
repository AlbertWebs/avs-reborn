<!-- Mobile Bottom Navigation -->
<nav class="mobile-bottom-nav" id="mobileBottomNav">
    <div class="mobile-bottom-nav-container">
        <a href="{{url('/')}}" class="mobile-nav-item {{ Request::is('/') ? 'active' : '' }}" data-tooltip="Home">
            <i class="icon-home"></i>
            <span class="mobile-nav-label">Home</span>
        </a>
        
        <a href="#" class="mobile-nav-item mobile-nav-categories" data-tooltip="Categories" onclick="event.preventDefault(); document.querySelector('.mobile-menu-toggler').click(); document.getElementById('mobile-cats-link').click();">
            <i class="icon-list"></i>
            <span class="mobile-nav-label">Categories</span>
        </a>
        
        <a href="#" class="mobile-nav-item mobile-nav-search" data-tooltip="Search" onclick="event.preventDefault(); document.querySelector('.mobile-menu-toggler').click();">
            <i class="icon-search"></i>
            <span class="mobile-nav-label">Search</span>
        </a>
        
        <a href="{{url('/shopping-cart')}}" class="mobile-nav-item {{ Request::is('shopping-cart*') ? 'active' : '' }}" data-tooltip="Cart">
            <i class="icon-shopping-cart"></i>
            <span class="mobile-nav-label">Cart</span>
            <?php 
                $CartCount = \Gloudemans\Shoppingcart\Facades\Cart::count();
            ?>
            @if($CartCount > 0)
                <span class="mobile-nav-badge" id="mobileCartBadge">{{$CartCount}}</span>
            @endif
        </a>
        
        <a href="#" class="mobile-nav-item mobile-nav-menu" data-tooltip="Menu" onclick="event.preventDefault(); document.querySelector('.mobile-menu-toggler').click();">
            <i class="icon-bars"></i>
            <span class="mobile-nav-label">Menu</span>
        </a>
    </div>
</nav>

<style>
/* Mobile Bottom Navigation Styles */
.mobile-bottom-nav {
    position: fixed;
    bottom: 0;
    left: 0;
    right: 0;
    background: #fff;
    border-top: 1px solid #e9ecef;
    box-shadow: 0 -2px 10px rgba(0,0,0,0.1);
    z-index: 9999;
    display: none; /* Hidden by default, shown on mobile */
    padding: 8px 0 calc(8px + env(safe-area-inset-bottom));
}

.mobile-bottom-nav-container {
    display: flex;
    justify-content: space-around;
    align-items: center;
    max-width: 100%;
    margin: 0 auto;
    padding: 0 10px;
}

.mobile-nav-item {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    flex: 1;
    padding: 8px 4px;
    text-decoration: none;
    color: #666;
    transition: all 0.3s ease;
    position: relative;
    min-height: 60px;
    border-radius: 8px;
    margin: 0 2px;
}

.mobile-nav-item i {
    font-size: 22px;
    margin-bottom: 4px;
    transition: all 0.3s ease;
}

.mobile-nav-label {
    font-size: 11px;
    font-weight: 500;
    color: #666;
    transition: all 0.3s ease;
}

.mobile-nav-item.active {
    color: #667eea;
    background: rgba(102, 126, 234, 0.1);
}

.mobile-nav-item.active i,
.mobile-nav-item.active .mobile-nav-label {
    color: #667eea;
}

.mobile-nav-item:active {
    transform: scale(0.95);
    background: rgba(102, 126, 234, 0.15);
}

.mobile-nav-badge {
    position: absolute;
    top: 6px;
    right: 8px;
    background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
    color: white;
    border-radius: 10px;
    padding: 2px 6px;
    font-size: 10px;
    font-weight: 600;
    min-width: 18px;
    text-align: center;
    line-height: 1.2;
}

/* Show on mobile devices only */
@media (max-width: 991px) {
    .mobile-bottom-nav {
        display: block;
    }
    
    /* Add padding to body to prevent content from being hidden behind nav */
    body {
        padding-bottom: 70px;
    }
}

/* Hide on desktop */
@media (min-width: 992px) {
    .mobile-bottom-nav {
        display: none !important;
    }
    
    body {
        padding-bottom: 0;
    }
}

/* Active state animation */
.mobile-nav-item.active i {
    transform: scale(1.1);
}

/* Hover effect for devices that support it */
@media (hover: hover) {
    .mobile-nav-item:hover {
        color: #667eea;
        background: rgba(102, 126, 234, 0.05);
    }
    
    .mobile-nav-item:hover i,
    .mobile-nav-item:hover .mobile-nav-label {
        color: #667eea;
    }
}
</style>

<script>
// Add active state management
document.addEventListener('DOMContentLoaded', function() {
    const navItems = document.querySelectorAll('.mobile-nav-item');
    const currentPath = window.location.pathname;
    
    navItems.forEach(item => {
        const href = item.getAttribute('href');
        if (href && href !== '#' && currentPath === href) {
            item.classList.add('active');
        }
    });
    
    // Update cart badge when cart changes (listen for custom events)
    document.addEventListener('cartUpdated', function(e) {
        const badge = document.getElementById('mobileCartBadge');
        const cartCount = e.detail?.count || 0;
        
        if (cartCount > 0) {
            if (!badge) {
                const cartLink = document.querySelector('.mobile-nav-item[href*="shopping-cart"]');
                const badgeEl = document.createElement('span');
                badgeEl.className = 'mobile-nav-badge';
                badgeEl.id = 'mobileCartBadge';
                badgeEl.textContent = cartCount;
                cartLink.appendChild(badgeEl);
            } else {
                badge.textContent = cartCount;
            }
        } else if (badge) {
            badge.remove();
        }
    });
    
    // Smooth scroll to top when clicking home
    document.querySelector('.mobile-nav-item[href="{{url("/")}}"]')?.addEventListener('click', function(e) {
        if (window.location.pathname === '/') {
            e.preventDefault();
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }
    });
});
</script>
