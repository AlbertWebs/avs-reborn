@extends('front.master-pages')
@section('content')
@foreach ($SiteSettings as $Settings)
<main class="main">
    <!-- Modern Page Header -->
    <div class="page-header" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); padding: 80px 0 60px; position: relative; overflow: hidden;">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8 mx-auto text-center" style="position: relative; z-index: 2;">
                    <h1 class="page-title" style="color: white; font-size: 48px; font-weight: 700; margin-bottom: 15px; text-shadow: 0 2px 10px rgba(0,0,0,0.2);">
                        Find Us
                    </h1>
                    <p class="lead" style="color: rgba(255,255,255,0.95); font-size: 20px; margin-bottom: 0;">
                        Visit our store or get in touch with us
                    </p>
                </div>
            </div>
        </div>
        <!-- Decorative Elements -->
        <div style="position: absolute; top: -50px; right: -50px; width: 300px; height: 300px; background: rgba(255,255,255,0.1); border-radius: 50%; z-index: 1;"></div>
        <div style="position: absolute; bottom: -30px; left: -30px; width: 200px; height: 200px; background: rgba(255,255,255,0.1); border-radius: 50%; z-index: 1;"></div>
    </div>

    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="breadcrumb-nav border-0 mb-0" style="background: #f8f9fa;">
        <div class="container">
            <ol class="breadcrumb" style="padding: 15px 0;">
                <li class="breadcrumb-item"><a href="{{url('/')}}" style="color: #667eea;">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page" style="color: #666;">Find Us</li>
            </ol>
        </div>
    </nav>

    <div class="page-content" style="padding: 60px 0;">
        <!-- Map Section -->
        <div class="container-fluid" style="padding: 0; margin-bottom: 60px;">
            <div id="map" style="width: 100%; height: 500px; border-radius: 0; overflow: hidden; box-shadow: 0 4px 20px rgba(0,0,0,0.1);">
                <iframe 
                    src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d249.30100549775818!2d36.8278346!3d-1.2842642!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x677ac7d99a0ff352!2sAmani+Vehicle+Sounds+%26+Accessories!5e0!3m2!1sen!2ske!4v1557146026043!5m2!1sen!2ske" 
                    width="100%" 
                    height="100%" 
                    frameborder="0" 
                    style="border:0" 
                    allowfullscreen
                    loading="lazy">
                </iframe>
            </div>
        </div>

        <!-- Contact Information Cards -->
        <div class="container">
            <div class="row" style="margin-bottom: 60px;">
                <!-- Office Location Card -->
                <div class="col-md-4 mb-4">
                    <div class="contact-card" style="background: white; border-radius: 16px; padding: 40px 30px; text-align: center; height: 100%; box-shadow: 0 4px 20px rgba(0,0,0,0.08); transition: all 0.3s ease; border: 1px solid #f0f0f0;">
                        <div class="contact-icon" style="width: 80px; height: 80px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 25px; box-shadow: 0 8px 20px rgba(102, 126, 234, 0.3);">
                            <i class="icon-map-marker" style="font-size: 36px; color: white;"></i>
                        </div>
                        <h3 style="font-size: 22px; font-weight: 600; color: #333; margin-bottom: 20px;">Our Location</h3>
                        <address style="font-style: normal; color: #666; line-height: 1.8; margin: 0;">
                            <strong style="color: #333; display: block; margin-bottom: 8px;">{{$Settings->location ?? 'Nairobi, Kenya'}}</strong>
                            {{$Settings->address ?? 'Visit our store for the best car audio experience'}}
                        </address>
                        <a href="https://www.google.com/maps/search/?api=1&query={{urlencode($Settings->location ?? 'Nairobi, Kenya')}}" 
                           target="_blank" 
                           class="btn btn-sm" 
                           style="margin-top: 20px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; border: none; padding: 10px 24px; border-radius: 25px; font-weight: 600; text-decoration: none; display: inline-block; transition: all 0.3s;">
                            <i class="icon-external-link"></i> Get Directions
                        </a>
                    </div>
                </div>

                <!-- Contact Information Card -->
                <div class="col-md-4 mb-4">
                    <div class="contact-card" style="background: white; border-radius: 16px; padding: 40px 30px; text-align: center; height: 100%; box-shadow: 0 4px 20px rgba(0,0,0,0.08); transition: all 0.3s ease; border: 1px solid #f0f0f0;">
                        <div class="contact-icon" style="width: 80px; height: 80px; background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 25px; box-shadow: 0 8px 20px rgba(240, 147, 251, 0.3);">
                            <i class="icon-phone" style="font-size: 36px; color: white;"></i>
                        </div>
                        <h3 style="font-size: 22px; font-weight: 600; color: #333; margin-bottom: 20px;">Contact Us</h3>
                        <div style="color: #666; line-height: 2.2;">
                            <div style="margin-bottom: 15px;">
                                <i class="icon-envelope" style="color: #667eea; margin-right: 8px;"></i>
                                <a href="mailto:{{$Settings->email ?? 'info@amanivehiclesounds.co.ke'}}" 
                                   style="color: #667eea; text-decoration: none; font-weight: 500;">
                                    {{$Settings->email ?? 'info@amanivehiclesounds.co.ke'}}
                                </a>
                            </div>
                            @if($Settings->email_one)
                            <div style="margin-bottom: 15px;">
                                <i class="icon-envelope" style="color: #667eea; margin-right: 8px;"></i>
                                <a href="mailto:{{$Settings->email_one}}" 
                                   style="color: #667eea; text-decoration: none; font-weight: 500;">
                                    {{$Settings->email_one}}
                                </a>
                            </div>
                            @endif
                            @if($Settings->mobile_one)
                            <div style="margin-bottom: 15px;">
                                <i class="icon-phone" style="color: #667eea; margin-right: 8px;"></i>
                                <a href="tel:{{$Settings->mobile_one}}" 
                                   style="color: #333; text-decoration: none; font-weight: 600;">
                                    {{$Settings->mobile_one_display ?? $Settings->mobile_one}}
                                </a>
                            </div>
                            @endif
                            @if($Settings->mobile_two)
                            <div>
                                <i class="icon-phone" style="color: #667eea; margin-right: 8px;"></i>
                                <a href="tel:{{$Settings->mobile_two}}" 
                                   style="color: #333; text-decoration: none; font-weight: 600;">
                                    {{$Settings->mobile_two_display ?? $Settings->mobile_two}}
                                </a>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Social Media Card -->
                <div class="col-md-4 mb-4">
                    <div class="contact-card" style="background: white; border-radius: 16px; padding: 40px 30px; text-align: center; height: 100%; box-shadow: 0 4px 20px rgba(0,0,0,0.08); transition: all 0.3s ease; border: 1px solid #f0f0f0;">
                        <div class="contact-icon" style="width: 80px; height: 80px; background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 25px; box-shadow: 0 8px 20px rgba(79, 172, 254, 0.3);">
                            <i class="icon-share-alt" style="font-size: 36px; color: white;"></i>
                        </div>
                        <h3 style="font-size: 22px; font-weight: 600; color: #333; margin-bottom: 20px;">Follow Us</h3>
                        <p style="color: #666; margin-bottom: 25px;">Stay connected with us on social media</p>
                        <div class="social-icons" style="display: flex; justify-content: center; gap: 15px; flex-wrap: wrap;">
                            @if($Settings->facebook)
                            <a href="{{$Settings->facebook}}" 
                               class="social-icon" 
                               target="_blank" 
                               style="width: 50px; height: 50px; background: #1877f2; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; text-decoration: none; transition: all 0.3s; box-shadow: 0 4px 10px rgba(24, 119, 242, 0.3);"
                               onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='0 6px 15px rgba(24, 119, 242, 0.4)'"
                               onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 10px rgba(24, 119, 242, 0.3)'">
                                <i class="icon-facebook-f" style="font-size: 20px;"></i>
                            </a>
                            @endif
                            @if($Settings->twitter)
                            <a href="{{$Settings->twitter}}" 
                               class="social-icon" 
                               target="_blank" 
                               style="width: 50px; height: 50px; background: #1da1f2; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; text-decoration: none; transition: all 0.3s; box-shadow: 0 4px 10px rgba(29, 161, 242, 0.3);"
                               onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='0 6px 15px rgba(29, 161, 242, 0.4)'"
                               onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 10px rgba(29, 161, 242, 0.3)'">
                                <i class="icon-twitter" style="font-size: 20px;"></i>
                            </a>
                            @endif
                            @if($Settings->instagram)
                            <a href="{{$Settings->instagram}}" 
                               class="social-icon" 
                               target="_blank" 
                               style="width: 50px; height: 50px; background: linear-gradient(45deg, #f09433 0%, #e6683c 25%, #dc2743 50%, #cc2366 75%, #bc1888 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; text-decoration: none; transition: all 0.3s; box-shadow: 0 4px 10px rgba(188, 24, 136, 0.3);"
                               onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='0 6px 15px rgba(188, 24, 136, 0.4)'"
                               onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 10px rgba(188, 24, 136, 0.3)'">
                                <i class="icon-instagram" style="font-size: 20px;"></i>
                            </a>
                            @endif
                            @if($Settings->youtube)
                            <a href="{{$Settings->youtube}}" 
                               class="social-icon" 
                               target="_blank" 
                               style="width: 50px; height: 50px; background: #ff0000; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; text-decoration: none; transition: all 0.3s; box-shadow: 0 4px 10px rgba(255, 0, 0, 0.3);"
                               onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='0 6px 15px rgba(255, 0, 0, 0.4)'"
                               onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 10px rgba(255, 0, 0, 0.3)'">
                                <i class="icon-youtube" style="font-size: 20px;"></i>
                            </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Why Choose Us Section -->
            <div class="row" style="margin-top: 60px;">
                <div class="col-lg-10 mx-auto">
                    <div style="background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%); border-radius: 20px; padding: 50px 40px; text-align: center; box-shadow: 0 4px 20px rgba(0,0,0,0.08); border: 1px solid #e9ecef;">
                        <h2 class="title" style="font-size: 36px; font-weight: 700; color: #333; margin-bottom: 20px; position: relative; display: inline-block;">
                            Why Choose Us
                            <span style="position: absolute; bottom: -10px; left: 50%; transform: translateX(-50%); width: 60px; height: 4px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 2px;"></span>
                        </h2>
                        <p class="lead" style="color: #666; font-size: 18px; line-height: 1.8; margin-top: 30px; max-width: 800px; margin-left: auto; margin-right: auto;">
                            {!!html_entity_decode($Settings->welcome ?? 'Welcome to Amani Vehicle Sounds - Your trusted partner for premium car audio systems and accessories.')!!}
                        </p>
                        
                        <!-- Features Grid -->
                        <div class="row" style="margin-top: 50px;">
                            <div class="col-md-4 mb-4">
                                <div style="padding: 30px 20px;">
                                    <div style="width: 60px; height: 60px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 12px; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px; box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);">
                                        <i class="icon-check" style="font-size: 28px; color: white;"></i>
                                    </div>
                                    <h4 style="font-size: 18px; font-weight: 600; color: #333; margin-bottom: 10px;">Expert Installation</h4>
                                    <p style="color: #666; font-size: 14px; line-height: 1.6; margin: 0;">Professional installation by certified technicians</p>
                                </div>
                            </div>
                            <div class="col-md-4 mb-4">
                                <div style="padding: 30px 20px;">
                                    <div style="width: 60px; height: 60px; background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); border-radius: 12px; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px; box-shadow: 0 4px 15px rgba(240, 147, 251, 0.3);">
                                        <i class="icon-star" style="font-size: 28px; color: white;"></i>
                                    </div>
                                    <h4 style="font-size: 18px; font-weight: 600; color: #333; margin-bottom: 10px;">Premium Products</h4>
                                    <p style="color: #666; font-size: 14px; line-height: 1.6; margin: 0;">Top-quality brands and genuine products</p>
                                </div>
                            </div>
                            <div class="col-md-4 mb-4">
                                <div style="padding: 30px 20px;">
                                    <div style="width: 60px; height: 60px; background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); border-radius: 12px; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px; box-shadow: 0 4px 15px rgba(79, 172, 254, 0.3);">
                                        <i class="icon-headphones" style="font-size: 28px; color: white;"></i>
                                    </div>
                                    <h4 style="font-size: 18px; font-weight: 600; color: #333; margin-bottom: 10px;">Customer Support</h4>
                                    <p style="color: #666; font-size: 14px; line-height: 1.6; margin: 0;">Dedicated support team ready to help</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Business Hours Section (if available) -->
            @if($Settings->till || $Settings->mobile)
            <div class="row" style="margin-top: 60px;">
                <div class="col-lg-8 mx-auto">
                    <div style="background: white; border-radius: 16px; padding: 40px; box-shadow: 0 4px 20px rgba(0,0,0,0.08); border: 1px solid #e9ecef;">
                        <h3 style="font-size: 24px; font-weight: 600; color: #333; margin-bottom: 25px; text-align: center;">
                            <i class="icon-clock-o" style="color: #667eea; margin-right: 10px;"></i>
                            Additional Information
                        </h3>
                        <div class="row">
                            @if($Settings->till)
                            <div class="col-md-6 mb-3">
                                <div style="display: flex; align-items: center; padding: 15px; background: #f8f9fa; border-radius: 10px;">
                                    <div style="width: 50px; height: 50px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 10px; display: flex; align-items: center; justify-content: center; margin-right: 15px;">
                                        <i class="icon-credit-card" style="color: white; font-size: 20px;"></i>
                                    </div>
                                    <div>
                                        <strong style="color: #333; display: block; margin-bottom: 5px;">M-PESA Till</strong>
                                        <span style="color: #667eea; font-weight: 600; font-size: 16px;">{{$Settings->till}}</span>
                                    </div>
                                </div>
                            </div>
                            @endif
                            @if($Settings->mobile)
                            <div class="col-md-6 mb-3">
                                <div style="display: flex; align-items: center; padding: 15px; background: #f8f9fa; border-radius: 10px;">
                                    <div style="width: 50px; height: 50px; background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); border-radius: 10px; display: flex; align-items: center; justify-content: center; margin-right: 15px;">
                                        <i class="icon-phone" style="color: white; font-size: 20px;"></i>
                                    </div>
                                    <div>
                                        <strong style="color: #333; display: block; margin-bottom: 5px;">Main Phone</strong>
                                        <a href="tel:{{$Settings->mobile}}" style="color: #667eea; font-weight: 600; font-size: 16px; text-decoration: none;">{{$Settings->mobile}}</a>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</main>

<style>
/* Contact Card Hover Effects */
.contact-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 30px rgba(0,0,0,0.12) !important;
}

/* Responsive Design */
@media (max-width: 768px) {
    .page-header h1 {
        font-size: 32px !important;
    }
    
    #map {
        height: 350px !important;
    }
    
    .contact-card {
        margin-bottom: 30px !important;
    }
}

/* Smooth Animations */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.contact-card {
    animation: fadeInUp 0.6s ease-out;
}

.contact-card:nth-child(1) {
    animation-delay: 0.1s;
}

.contact-card:nth-child(2) {
    animation-delay: 0.2s;
}

.contact-card:nth-child(3) {
    animation-delay: 0.3s;
}
</style>

@endforeach
@endsection
