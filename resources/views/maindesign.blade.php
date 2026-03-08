<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="shortcut icon" href="frontend/images/favicon.png" type="image/x-icon">

    <title>Giftos | Modern Gifting</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link rel="stylesheet" type="text/css" href="frontend/css/bootstrap.css" />

    <style>
        :root {
            --primary-color: #f89494; /* Soft Rose */
            --dark-text: #2d3436;
            --light-bg: #fff9f9;
            --accent: #6366f1;
        }

        body { font-family: 'Inter', sans-serif; color: var(--dark-text); background-color: #fff; }
        h1, h2, h3 { font-family: 'Playfair Display', serif; }

        /* Navbar Styling */
        .header_section { padding: 15px 0; background: #fff; border-bottom: 1px solid #eee; }
        .navbar-brand span { font-weight: 700; font-size: 28px; color: var(--primary-color); text-transform: uppercase; letter-spacing: 2px; }
        .nav-link { font-weight: 500; margin: 0 10px; transition: 0.3s; }
        .nav-link:hover { color: var(--primary-color) !important; }

        .user_option { display: flex; align-items: center; gap: 20px; }
        .cart-icon { position: relative; color: var(--dark-text); font-size: 20px; }
        .cart-badge { position: absolute; top: -10px; right: -12px; background: var(--primary-color); color: white; border-radius: 50%; padding: 2px 6px; font-size: 10px; }

        /* Hero Section */
        .hero_area { background: var(--light-bg); padding: 80px 0; position: relative; overflow: hidden; }
        .detail-box h1 { font-size: 4rem; line-height: 1.1; margin-bottom: 25px; color: var(--dark-text); }
        .detail-box p { color: #636e72; font-size: 1.1rem; line-height: 1.8; max-width: 500px; }
        .btn-hero { background: var(--primary-color); color: white; padding: 12px 35px; border-radius: 50px; text-decoration: none; display: inline-block; margin-top: 30px; transition: 0.3s; font-weight: 600; box-shadow: 0 10px 20px rgba(248, 148, 148, 0.3); }
        .btn-hero:hover { background: var(--dark-text); transform: translateY(-3px); color: white; }

        .img-box img { border-radius: 20px; box-shadow: 20px 20px 0px rgba(248, 148, 148, 0.1); transition: 0.5s; }
        .img-box img:hover { transform: scale(1.02); }

        /* Contact Section */
        .contact_section { padding: 90px 0; background: #fff; }
        .heading_container h2 { font-size: 3rem; text-align: center; margin-bottom: 50px; }
        .contact-form-wrapper { background: #fff; padding: 40px; border-radius: 20px; box-shadow: 0 15px 50px rgba(0,0,0,0.05); }
        .contact-form-wrapper input { border: 1px solid #eee; padding: 15px; margin-bottom: 20px; border-radius: 10px; width: 100%; outline: none; transition: 0.3s; }
        .contact-form-wrapper input:focus { border-color: var(--primary-color); }
        .btn-send { background: var(--dark-text); color: white; width: 100%; border: none; padding: 15px; border-radius: 10px; font-weight: 600; transition: 0.3s; }
        .btn-send:hover { background: var(--primary-color); }

        /* Info/Footer */
        .info_section { background: #2d3436; color: white; padding: 80px 0 30px; }
        .info_section h6 { color: var(--primary-color); letter-spacing: 2px; margin-bottom: 25px; }
        .social_box a { color: white; margin-right: 15px; font-size: 20px; transition: 0.3s; }
        .social_box a:hover { color: var(--primary-color); }
        .info_form input { background: rgba(255,255,255,0.1); border: none; padding: 12px; color: white; width: 100%; border-radius: 5px; }
        /* 1. Create the fixed-size container */
        .product-img-container {
            width: 100%;
            height: 300px;       /* You decide the height here */
            overflow: hidden;    /* Hides anything that spills out */
            background: #f4f4f4; /* Fills empty space if image is too small */
            border-radius: 10px;
        }

        /* 2. Force the image to behave */
        .product-img-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;   /* THIS IS THE MAGIC: It fills the box without stretching */
            object-position: center; /* Keeps the middle of the photo visible */
        }
    </style>
</head>

<body>
<header class="header_section">
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light">
            <a class="navbar-brand" href="">
                <span>Giftos</span>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navContent">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navContent">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item active"><a class="nav-link" href="index.html">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="shop.html">Shop</a></li>
                    <li class="nav-item"><a class="nav-link" href="why.html">Why Us</a></li>
                    <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
                </ul>

                <div class="user_option">
                    @if(Auth::check())
                        {{-- If the user is logged in, show Dashboard and Logout --}}
                        <a href="{{ route('dashboard') }}" class="text-dark me-2" title="Dashboard">
                            <i class="fa fa-th-large"></i>
                        </a>
                    @else
                        {{-- If the user is a guest, show Login and Register --}}
                        <div class="auth-links d-flex align-items-center gap-3">
                            <a href="{{ route('login') }}" class="small text-dark font-weight-bold text-decoration-none hover-rose">
                                Login
                            </a>
                            <span class="text-muted" style="font-size: 0.8rem;">|</span>
                            <a href="{{ route('register') }}" class="small text-dark font-weight-bold text-decoration-none hover-rose">
                                Register
                            </a>
                        </div>
                    @endif

                    {{-- Cart Icon --}}
                    <a href="{{ route('view_cart') }}" class="cart-icon ms-2">
                        <i class="fa fa-shopping-basket"></i>
                        <span class="cart-badge">{{ $totalItemsInCart }}</span>
                    </a>

                    {{-- Search Icon --}}
                    <a href="#" class="text-dark ms-2"><i class="fa fa-search"></i></a>
                </div>
            </div>
        </nav>
    </div>
</header>

<section class="hero_area">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="detail-box">
                    <h1>Thoughtful Gifts <br>for Every Moment</h1>
                    <p>From handmade treasures to luxury keepsakes, find the perfect way to say you care. We curate the best gifts so you don't have to.</p>
                    <a href="{{ route('all_products') }}" class="btn-hero">Explore Collection</a>
                </div>
            </div>
            <div class="col-md-6">
                <div class="img-box">
                    <img src="frontend/images/image3.jpeg" class="img-fluid" alt="Gift Image" />
                </div>
            </div>
        </div>
    </div>
</section>

<div class="container">
    <section class="shop_section py-5">
        @yield('index')
        @yield('product_details')
        @yield('all_products')
        @yield('view_cart')
    </section>
</div>

<section id="contact" class="contact_section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <div class="map_container rounded shadow-sm overflow-hidden" style="height: 450px;">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d158858.4733933221!2d-0.1015987!3d51.5286416!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2suk!4v1620000000000!5m2!1sen!2suk" width="100%" height="100%" frameborder="0" style="border:0;" allowfullscreen></iframe>
                </div>
            </div>
            <div class="col-lg-5 offset-lg-1">
                <div class="contact-form-wrapper">
                    <h2 class="mb-4">Get in Touch</h2>
                    <form action="#">
                        <input type="text" placeholder="Your Name" />
                        <input type="email" placeholder="Email Address" />
                        <input type="text" placeholder="Phone Number" />
                        <textarea placeholder="How can we help?" class="form-control mb-4 border-0 bg-light" rows="4" style="border-radius:10px;"></textarea>
                        <button class="btn-send">SEND MESSAGE</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="info_section">
    <div class="container">
        <div class="row">
            <div class="col-md-4 mb-5">
                <h6>GIFTOS</h6>
                <p class="small pr-md-5">We are a boutique gift shop dedicated to providing high-quality, unique gifts that make every occasion special.</p>
                <div class="social_box mt-4">
                    <a href="#"><i class="fa fa-facebook"></i></a>
                    <a href="#"><i class="fa fa-instagram"></i></a>
                    <a href="#"><i class="fa fa-pinterest"></i></a>
                </div>
            </div>
            <div class="col-md-4 mb-5">
                <h6>NEWSLETTER</h6>
                <p class="small">Join our list for exclusive offers and gift guides.</p>
                <form action="#" class="info_form mt-3">
                    <input type="email" placeholder="Your email address" class="mb-2">
                    <button class="btn btn-hero btn-sm w-100 mt-2">Subscribe</button>
                </form>
            </div>
            <div class="col-md-4 mb-5">
                <h6>CONTACT</h6>
                <div class="small">
                    <p><i class="fa fa-map-marker mr-2"></i> 123 London Road, London UK</p>
                    <p><i class="fa fa-phone mr-2"></i> +01 1234567890</p>
                    <p><i class="fa fa-envelope mr-2"></i> hello@giftos.com</p>
                </div>
            </div>
        </div>
        <hr style="border-color: rgba(255,255,255,0.1);">
        <p class="text-center small mb-0 mt-4 opacity-50">&copy; 2026 Giftos Gifting Services.</p>
    </div>
</section>

<script src="frontend/js/jquery-3.4.1.min.js"></script>
<script src="frontend/js/bootstrap.js"></script>
</body>

</html>
