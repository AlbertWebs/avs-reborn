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
/* Mobile Bottom Navigation - Enhanced UX/UI */
.mobile-bottom-nav {
    position: fixed;
    bottom: 0;
    left: 0;
    right: 0;
    background: linear-gradient(to top, #ffffff 0%, #f8f9fa 100%);
    border-top: 1px solid rgba(0, 0, 0, 0.08);
    box-shadow: 0 -4px 20px rgba(0, 0, 0, 0.08), 0 -1px 0 rgba(0, 0, 0, 0.05);
    z-index: 9999;
    display: none;
    padding: 10px 0 calc(10px + env(safe-area-inset-bottom));
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
}

.mobile-bottom-nav-container {
    display: flex;
    justify-content: space-around;
    align-items: center;
    max-width: 100%;
    margin: 0 auto;
    padding: 0 8px;
    gap: 4px;
}

.mobile-nav-item {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    flex: 1;
    padding: 10px 8px;
    text-decoration: none;
    color: #6c757d;
    transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
    position: relative;
    min-height: 64px;
    border-radius: 12px;
    margin: 0 2px;
    -webkit-tap-highlight-color: transparent;
    touch-action: manipulation;
}

.mobile-nav-item i {
    font-size: 24px;
    margin-bottom: 4px;
    transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
    display: block;
    line-height: 1;
}

.mobile-nav-label {
    font-size: 11px;
    font-weight: 600;
    color: #6c757d;
    transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
    letter-spacing: 0.2px;
    text-transform: uppercase;
    opacity: 0.85;
}

/* Active State - Enhanced */
.mobile-nav-item.active {
    color: rgb(102, 19, 155);
    background: linear-gradient(135deg, rgba(102, 19, 155, 0.12) 0%, rgba(102, 19, 155, 0.08) 100%);
    transform: translateY(-2px);
}

.mobile-nav-item.active i {
    color: rgb(102, 19, 155);
    transform: scale(1.15);
    filter: drop-shadow(0 2px 4px rgba(102, 19, 155, 0.2));
}

.mobile-nav-item.active .mobile-nav-label {
    color: rgb(102, 19, 155);
    opacity: 1;
    font-weight: 700;
}

/* Press/Tap Animation */
.mobile-nav-item:active {
    transform: scale(0.92) translateY(0);
    transition: transform 0.1s ease;
}

.mobile-nav-item.active:active {
    transform: scale(0.92) translateY(-1px);
}

/* Badge - Enhanced Design */
.mobile-nav-badge {
    position: absolute;
    top: 8px;
    right: 12px;
    background: linear-gradient(135deg, #f5576c 0%, #f093fb 100%);
    color: white;
    border-radius: 12px;
    padding: 3px 7px;
    font-size: 10px;
    font-weight: 700;
    min-width: 20px;
    height: 20px;
    text-align: center;
    line-height: 14px;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 2px 8px rgba(245, 87, 108, 0.4), 0 0 0 2px #fff;
    animation: badgePulse 2s ease-in-out infinite;
}

@keyframes badgePulse {
    0%, 100% {
        transform: scale(1);
        box-shadow: 0 2px 8px rgba(245, 87, 108, 0.4), 0 0 0 2px #fff;
    }
    50% {
        transform: scale(1.1);
        box-shadow: 0 3px 12px rgba(245, 87, 108, 0.6), 0 0 0 2px #fff;
    }
}

/* Show on mobile devices only */
@media (max-width: 991px) {
    .mobile-bottom-nav {
        display: block;
    }
    
    body {
        padding-bottom: 75px;
    }
}

/* Responsive adjustments */
@media (max-width: 576px) {
    .mobile-nav-item {
        padding: 8px 6px;
        min-height: 60px;
    }
    
    .mobile-nav-item i {
        font-size: 22px;
        margin-bottom: 3px;
    }
    
    .mobile-nav-label {
        font-size: 10px;
    }
    
    .mobile-nav-badge {
        top: 6px;
        right: 10px;
        font-size: 9px;
        min-width: 18px;
        height: 18px;
        line-height: 12px;
        padding: 2px 6px;
    }
    
    body {
        padding-bottom: 70px;
    }
}

@media (max-width: 480px) {
    .mobile-bottom-nav-container {
        padding: 0 4px;
        gap: 2px;
    }
    
    .mobile-nav-item {
        padding: 8px 4px;
        margin: 0 1px;
    }
    
    .mobile-nav-item i {
        font-size: 20px;
    }
    
    .mobile-nav-label {
        font-size: 9px;
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

/* Hover effect for devices that support it */
@media (hover: hover) {
    .mobile-nav-item:hover:not(.active) {
        color: rgb(102, 19, 155);
        background: rgba(102, 19, 155, 0.06);
        transform: translateY(-1px);
    }
    
    .mobile-nav-item:hover:not(.active) i,
    .mobile-nav-item:hover:not(.active) .mobile-nav-label {
        color: rgb(102, 19, 155);
    }
}

/* Accessibility improvements */
.mobile-nav-item:focus {
    outline: 2px solid rgba(102, 19, 155, 0.5);
    outline-offset: 2px;
}

/* Smooth entrance animation */
@keyframes slideUp {
    from {
        transform: translateY(100%);
        opacity: 0;
    }
    to {
        transform: translateY(0);
        opacity: 1;
    }
}

.mobile-bottom-nav {
    animation: slideUp 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}
</style>

<script>
// Enhanced Mobile Bottom Navigation UX
document.addEventListener('DOMContentLoaded', function() {
    const navItems = document.querySelectorAll('.mobile-nav-item');
    const currentPath = window.location.pathname;
    
    // Set active state based on current path
    navItems.forEach(item => {
        const href = item.getAttribute('href');
        if (href && href !== '#') {
            // Check if current path matches or starts with href
            if (currentPath === href || (href !== '{{url("/")}}' && currentPath.startsWith(href))) {
                item.classList.add('active');
            }
        }
    });
    
    // Add haptic feedback simulation (visual feedback)
    navItems.forEach(item => {
        item.addEventListener('touchstart', function() {
            this.style.transform = 'scale(0.95)';
        }, { passive: true });
        
        item.addEventListener('touchend', function() {
            setTimeout(() => {
                if (this.classList.contains('active')) {
                    this.style.transform = 'translateY(-2px)';
                } else {
                    this.style.transform = '';
                }
            }, 100);
        }, { passive: true });
    });
    
    // Update cart badge when cart changes
    function updateCartBadge(count) {
        const cartLink = document.querySelector('.mobile-nav-item[href*="shopping-cart"]');
        if (!cartLink) return;
        
        let badge = document.getElementById('mobileCartBadge');
        
        if (count > 0) {
            if (!badge) {
                badge = document.createElement('span');
                badge.className = 'mobile-nav-badge';
                badge.id = 'mobileCartBadge';
                cartLink.appendChild(badge);
            }
            badge.textContent = count > 99 ? '99+' : count;
            badge.style.animation = 'none';
            setTimeout(() => {
                badge.style.animation = '';
            }, 10);
        } else if (badge) {
            badge.remove();
        }
    }
    
    // Listen for cart updates
    document.addEventListener('cartUpdated', function(e) {
        const cartCount = e.detail?.count || 0;
        updateCartBadge(cartCount);
    });
    
    // Check cart count on page load
    <?php $CartCount = \Gloudemans\Shoppingcart\Facades\Cart::count(); ?>
    const cartCount = {{ $CartCount }};
    updateCartBadge(cartCount);
    
    // Smooth scroll to top when clicking home
    const homeLink = document.querySelector('.mobile-nav-item[href="{{url("/")}}"]');
    if (homeLink) {
        homeLink.addEventListener('click', function(e) {
            if (window.location.pathname === '/' || window.location.pathname === '{{url("/")}}') {
                e.preventDefault();
                window.scrollTo({ top: 0, behavior: 'smooth' });
                // Add visual feedback
                this.style.transform = 'scale(0.9)';
                setTimeout(() => {
                    this.style.transform = '';
                }, 200);
            }
        });
    }
    
    // Prevent double-tap zoom on iOS
    let lastTouchEnd = 0;
    document.addEventListener('touchend', function(e) {
        const now = Date.now();
        if (now - lastTouchEnd <= 300) {
            e.preventDefault();
        }
        lastTouchEnd = now;
    }, false);
    
    // Add ripple effect on tap
    navItems.forEach(item => {
        item.addEventListener('click', function(e) {
            const ripple = document.createElement('span');
            const rect = this.getBoundingClientRect();
            const size = Math.max(rect.width, rect.height);
            const x = e.clientX - rect.left - size / 2;
            const y = e.clientY - rect.top - size / 2;
            
            ripple.style.width = ripple.style.height = size + 'px';
            ripple.style.left = x + 'px';
            ripple.style.top = y + 'px';
            ripple.style.position = 'absolute';
            ripple.style.borderRadius = '50%';
            ripple.style.background = 'rgba(102, 19, 155, 0.2)';
            ripple.style.transform = 'scale(0)';
            ripple.style.animation = 'ripple 0.6s ease-out';
            ripple.style.pointerEvents = 'none';
            
            this.style.position = 'relative';
            this.style.overflow = 'hidden';
            this.appendChild(ripple);
            
            setTimeout(() => {
                ripple.remove();
            }, 600);
        });
    });
});

// Ripple animation
const style = document.createElement('style');
style.textContent = `
    @keyframes ripple {
        to {
            transform: scale(2);
            opacity: 0;
        }
    }
`;
document.head.appendChild(style);
</script>
