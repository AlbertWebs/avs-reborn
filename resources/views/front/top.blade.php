<div class="header-top" style="background: linear-gradient(135deg, #1a1a1a 0%, #2d2d2d 100%); border-bottom: 1px solid rgba(255,255,255,0.1);">
    <div class="container">
        <div class="header-left" style="display: flex; align-items: center; gap: 1.5rem;">
            <a href="tel:{{$Settings->mobile_one}}" class="phone-number-primary" style="display: inline-flex; align-items: center; color: #e8e8e8; font-size: 1.2rem; font-weight: 400; text-decoration: none; transition: all 0.3s ease; padding: 0.5rem 0;">
                <i class="icon-phone" style="margin-right: 0.6rem; font-size: 1.3rem; color: #cc9966;"></i>
                <span style="font-weight: 500;">{{$Settings->mobile_one_display}}</span>
            </a>
            <span class="phone-separator" style="color: rgba(255,255,255,0.3); font-size: 1.2rem;">|</span>
            <a href="tel:{{$Settings->mobile_two}}" class="phone-number-secondary" style="display: inline-flex; align-items: center; color: #e8e8e8; font-size: 1.2rem; font-weight: 400; text-decoration: none; transition: all 0.3s ease; padding: 0.5rem 0;">
                <i class="icon-phone" style="margin-right: 0.6rem; font-size: 1.3rem; color: #cc9966;"></i>
                <span style="font-weight: 500;">{{$Settings->mobile_two_display}}</span>
            </a>
        </div><!-- End .header-left -->

        <div class="header-right" style="display: flex; align-items: center;">
            <ul class="top-menu" style="display: flex; align-items: center; gap: 2rem; list-style: none; margin: 0; padding: 0;">
                <li style="position: relative;">
                    <a href="mailto:{{$Settings->email}}" style="display: inline-flex; align-items: center; color: #ffffff; font-size: 1.2rem; font-weight: 400; text-decoration: none; transition: all 0.3s ease; padding: 0.5rem 0;">
                        <i class="icon-envelope" style="margin-right: 0.6rem; font-size: 1.3rem; color: #cc9966;"></i>
                        <span style="font-weight: 400; color: #ffffff;">{{$Settings->email}}</span>
                    </a>
                </li>
                <li style="position: relative;">
                    <a href="{{url('/')}}/find-us" style="display: inline-flex; align-items: center; color: #ffffff; font-size: 1.2rem; font-weight: 400; text-decoration: none; transition: all 0.3s ease; padding: 0.5rem 0;">
                        <i class="icon-map-marker" style="margin-right: 0.6rem; font-size: 1.3rem; color: #cc9966;"></i>
                        <span style="font-weight: 400; color: #ffffff;">{{$Settings->location}}</span>
                    </a>
                </li>
                <li class="login" style="position: relative;">
                    @if(Auth::check())
                    <a href="{{url('/')}}/dashboard" style="display: inline-flex; align-items: center; color: #ffffff; font-size: 1.2rem; font-weight: 400; text-decoration: none; transition: all 0.3s ease; padding: 0.5rem 0;">
                        <i class="icon-user" style="margin-right: 0.6rem; font-size: 1.3rem; color: #cc9966;"></i>
                        <span style="font-weight: 500; color: #ffffff;">{{Auth::user()->name}}</span>
                    </a>
                    @else
                    <a href="#signin-modal" data-toggle="modal" style="display: inline-flex; align-items: center; color: #ffffff; font-size: 1.2rem; font-weight: 400; text-decoration: none; transition: all 0.3s ease; padding: 0.5rem 0; position: relative;">
                        <i class="icon-user" style="margin-right: 0.6rem; font-size: 1.3rem; color: #cc9966;"></i>
                        <span style="font-weight: 500; color: #ffffff;">Sign in / Sign up</span>
                    </a>
                    @endif
                </li>
            </ul><!-- End .top-menu -->
        </div><!-- End .header-right -->
    </div><!-- End .container -->
</div><!-- End .header-top -->

<style>
.header-top a:hover {
    color: #cc9966 !important;
    transform: translateY(-1px);
}

.header-top a:hover span {
    color: #cc9966 !important;
}

.header-top a:hover i {
    transform: scale(1.1);
    transition: transform 0.3s ease;
}

.header-top {
    padding: 0.8rem 0;
    min-height: 42px;
}

@media (max-width: 991px) {
    .header-top .header-left,
    .header-top .header-right {
        flex-wrap: wrap;
        gap: 0.5rem;
        justify-content: center;
    }
    
    /* Hide second phone number and separator on tablets and mobile */
    .phone-separator,
    .phone-number-secondary {
        display: none !important;
    }
    
    .header-top .header-left a,
    .header-top .header-right a {
        font-size: 0.9rem;
        padding: 0.3rem 0.5rem;
        border-radius: 6px;
    }
    
    .header-top .top-menu {
        gap: 0.8rem;
        flex-wrap: wrap;
        justify-content: center;
    }
}

@media (max-width: 767px) {
    .header-top {
        padding: 0.4rem 0 !important;
    }
    
    .header-top .container {
        flex-direction: row;
        justify-content: space-between;
        align-items: center;
    }
    
    .header-top .header-left {
        flex: 1;
        justify-content: flex-start;
        gap: 0.4rem;
    }
    
    /* Hide second phone number and separator on mobile */
    .phone-separator,
    .phone-number-secondary {
        display: none !important;
    }
    
    .header-top .header-left a.phone-number-primary {
        font-size: 0.85rem;
        padding: 0.25rem 0.4rem;
    }
    
    .header-top .header-left a.phone-number-primary i {
        font-size: 1rem;
        margin-right: 0.4rem;
    }
    
    .header-top .header-right {
        flex: 0 0 auto;
    }
    
    .header-top .header-right ul.top-menu {
        gap: 0.5rem;
    }
    
    .header-top .header-right ul.top-menu li:not(.login) {
        display: none;
    }
    
    .header-top .header-right ul.top-menu li.login a {
        font-size: 0.85rem;
        padding: 0.25rem 0.4rem;
    }
    
    .header-top .header-right ul.top-menu li.login a i {
        font-size: 1rem;
        margin-right: 0.4rem;
    }
}

@media (max-width: 480px) {
    .header-top .header-left a span,
    .header-top .header-right a span {
        display: none;
    }
    
    .header-top .header-left a i,
    .header-top .header-right a i {
        margin-right: 0;
    }
}
</style>
