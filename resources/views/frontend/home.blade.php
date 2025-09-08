@extends('layouts.frontend.app')
@section('main-container')
    <!-- Main Section-->
    <section class="mt-0 ">
        <!-- Page Content Goes Here -->
        {{-- {{ dd($allProducts); }} --}}
        <!-- / Hero Section -->
        <section class="vh-100 position-relative bg-overlay-dark ">
            <div class="container d-flex h-100 justify-content-center align-items-center position-relative z-index-10">
                <div class="d-flex justify-content-center align-items-center h-100 position-relative z-index-10 text-white">
                    <div>
                        <h1 class="display-1 fw-bold px-2 px-md-5 text-center mx-auto col-lg-8 mt-md-0" data-aos="fade-up"
                            data-aos-delay="1000">Where will your next adventure take you?</h1>
                        <div data-aos="fade-in" data-aos-delay="2000">
                            <div class="d-md-flex justify-content-center mt-4 mb-3 my-md-5">
                                <a href="{{ route('menswear.product.list') }}"
                                    class="btn btn-skew-left btn-orange btn-orange-chunky text-white mx-1 w-100 w-md-auto mb-2 mb-md-0"><span>Shop
                                        Menswear <i class="ri-arrow-right-line align-middle fw-bold"></i></span></a>
                                <a href="{{ route('womenswear.product.list') }}"
                                    class="btn btn-skew-left btn-orange btn-orange-chunky text-white mx-1 w-100 w-md-auto mb-2 mb-md-0"><span>Shop
                                        Womenswear <i class="ri-arrow-right-line align-middle fw-bold"></i></span></a>
                            </div>
                            <i class="ri-mouse-line d-block text-center animation-float ri-2x transition-all opacity-50-hover text-white"
                                data-pixr-scrollto data-target=".brand-section" data-aos="fade-up" data-aos-delay="700"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="position-absolute z-index-1 top-0 bottom-0 start-0 end-0">
                <!-- Swiper Info -->
                <div class="swiper-container overflow-hidden bg-light w-100 h-100" data-swiper
                    data-options='{
                    "slidesPerView": 1,
                    "speed": 1500,
                    "loop": true,
                    "effect": "fade",
                    "autoplay": {
                      "delay": 5000
                    }
                  }'>
                    <div class="swiper-wrapper">
                        <div class="swiper-slide position-relative">
                            <div class="w-100 h-100 bg-img-cover animation-move bg-pos-center-center"
                                style="background-image: url(./assets/images/slideshows/slideshow-1.jpg);">
                            </div>
                        </div>
                        <div class="swiper-slide position-relative">
                            <div class="w-100 h-100 bg-img-cover animation-move bg-pos-center-center"
                                style="background-image: url(./assets/images/slideshows/slideshow-2.jpg);">
                            </div>
                        </div>
                        <div class="swiper-slide position-relative">
                            <div class="w-100 h-100 bg-img-cover animation-move bg-pos-center-center"
                                style="background-image: url(./assets/images/slideshows/slideshow-3.jpg);">
                            </div>
                        </div>
                    </div>

                </div>
                <!-- / Swiper Info-->
            </div>
        </section>
        <!--/ Hero Section-->

        <!-- Featured Brands-->
        <div class="mb-lg-7 bg-light py-4" data-aos="fade-in">
            <div class="container">
                <div class="row gx-3 align-items-center">
                    <div
                        class="col-12 justify-content-center justify-content-md-between align-items-center d-flex flex-wrap">
                        <div class="me-2 f-w-20 m-4 ms-md-0 mt-md-0 mb-md-0">
                            <a class="d-block" href="#" data-bs-toggle="tooltip" data-bs-placement="top"
                                title="Shop Kathmandu">
                                <img class="img-fluid d-table mx-auto" src="./assets/images/logos/logo-1.svg"
                                    alt="Bootstrap 5 Template by Pixel Rocket">
                            </a>
                        </div>
                        <div class="me-2 f-w-20 m-4 ms-md-0 mt-md-0 mb-md-0">
                            <a class="d-block" href="#" data-bs-toggle="tooltip" data-bs-placement="top"
                                title="Shop Billabong">
                                <img class="img-fluid d-table mx-auto" src="./assets/images/logos/logo-2.svg"
                                    alt="Bootstrap 5 Template by Pixel Rocket">
                            </a>
                        </div>
                        <div class="me-2 f-w-20 m-4 ms-md-0 mt-md-0 mb-md-0">
                            <a class="d-block" href="#" data-bs-toggle="tooltip" data-bs-placement="top"
                                title="Shop Oakley">
                                <img class="img-fluid d-table mx-auto" src="./assets/images/logos/logo-9.svg"
                                    alt="Bootstrap 5 Template by Pixel Rocket">
                            </a>
                        </div>
                        <div class="me-2 f-w-20 m-4 ms-md-0 mt-md-0 mb-md-0">
                            <a class="d-block" href="#" data-bs-toggle="tooltip" data-bs-placement="top"
                                title="Shop Patagonia">
                                <img class="img-fluid d-table mx-auto" src="./assets/images/logos/logo-4.svg"
                                    alt="Bootstrap 5 Template by Pixel Rocket">
                            </a>
                        </div>
                        <div class="me-2 f-w-20 m-4 ms-md-0 mt-md-0 mb-md-0">
                            <a class="d-block" href="#" data-bs-toggle="tooltip" data-bs-placement="top"
                                title="Shop North Face">
                                <img class="img-fluid d-table mx-auto" src="./assets/images/logos/logo-5.svg"
                                    alt="Bootstrap 5 Template by Pixel Rocket">
                            </a>
                        </div>
                        <div class="me-2 f-w-20 m-4 ms-md-0 mt-md-0 mb-md-0">
                            <a class="d-block" href="#" data-bs-toggle="tooltip" data-bs-placement="top"
                                title="Shop Salomon">
                                <img class="img-fluid d-table mx-auto" src="./assets/images/logos/logo-7.svg"
                                    alt="Bootstrap 5 Template by Pixel Rocket">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/ Featured Brands-->

        <!-- Staff Picks-->
        <section class="mb-9 mt-5" data-aos="fade-up">
            <div class="container">
                <div class="w-md-50 mb-5">
                    <p class="small fw-bolder text-uppercase tracking-wider mb-2 text-muted">Summer Favourites</p>
                    <h2 class="display-5 fw-bold mb-3">Staff Picks</h2>
                    <p class="lead">We've sorted through our feed to put together a collection of our products perfect
                        for a summer outdoors.</p>

                </div>
                <!-- Swiper Latest -->
                <div class="swiper-container overflow-visible" data-swiper
                    data-options='{
                    "spaceBetween": 25,
                    "cssMode": true,
                    "roundLengths": true,
                    "scrollbar": {
                      "el": ".swiper-scrollbar",
                      "hide": false,
                      "draggable": true
                    },      
                    "navigation": {
                      "nextEl": ".swiper-next",
                      "prevEl": ".swiper-prev"
                    },  
                    "breakpoints": {
                      "576": {
                        "slidesPerView": 1
                      },
                      "768": {
                        "slidesPerView": 2
                      },
                      "992": {
                        "slidesPerView": 3
                      },
                      "1200": {
                        "slidesPerView": 4
                      }            
                    }
                  }'>
                    <div class="swiper-wrapper pb-5 pe-1">
                        @foreach ($allProducts as $product)
                            <div class="swiper-slide d-flex h-auto">
                                <!-- Card Product-->
                                <div class="card position-relative h-100 card-listing hover-trigger">
                                    <div class="card-header">
                                        @php
                                            $img = $product->firstVariantImage?->name;
                                            $imgPath =
                                                $img && file_exists(public_path('variantThumbnail/' . $img))
                                                    ? url('variantThumbnail/' . $img)
                                                    : asset('images/no-image.jpg');
                                        @endphp
                                        <picture class="position-relative overflow-hidden d-block bg-light">
                                            <img class="w-100 img-fluid position-relative z-index-10" title=""
                                                src="{{ $imgPath }}" alt="">
                                        </picture>
                                        {{-- <picture class="position-absolute z-index-20 start-0 top-0 hover-show bg-light">
                                            <img class="w-100 img-fluid" title=""
                                                src="./assets/images/products/product-1b.jpg" alt="">
                                        </picture> --}}
                                        {{-- quick add button --}}
                                        {{-- <div class="card-actions" id="quickadd">
                                            <button type="button" class="btn btn-link p-0 quickadd-btn"
                                                data-product-id="{{ $product->id }}">
                                                <span
                                                    class="small text-uppercase tracking-wide fw-bolder text-center d-block">
                                                    Quick Add
                                                </span>
                                            </button>
                                        </div> --}}
                                        {{-- quick add button ends here  --}}
                                    </div>
                                    <div class="card-body px-0 text-center">
                                        <div class="d-flex justify-content-center align-items-center mx-auto mb-1">
                                            <!-- Review Stars Small-->
                                            <div class="rating position-relative d-table">
                                                <div class="position-absolute stars" style="width: 90%">
                                                    <i class="ri-star-fill text-dark mr-1"></i>
                                                    <i class="ri-star-fill text-dark mr-1"></i>
                                                    <i class="ri-star-fill text-dark mr-1"></i>
                                                    <i class="ri-star-fill text-dark mr-1"></i>
                                                    <i class="ri-star-fill text-dark mr-1"></i>
                                                </div>
                                                <div class="stars">
                                                    <i class="ri-star-fill mr-1 text-muted opacity-25"></i>
                                                    <i class="ri-star-fill mr-1 text-muted opacity-25"></i>
                                                    <i class="ri-star-fill mr-1 text-muted opacity-25"></i>
                                                    <i class="ri-star-fill mr-1 text-muted opacity-25"></i>
                                                    <i class="ri-star-fill mr-1 text-muted opacity-25"></i>
                                                </div>
                                            </div> <span class="small fw-bolder ms-2 text-muted"> 4.7 (456)</span>
                                        </div>
                                        <a class="mb-0 mx-2 mx-md-4 fs-p link-cover text-decoration-none d-block text-center"
                                            href="{{ route('product.details', [
                                                'product_id' => $product->id,
                                                'color_id' => $product->firstVariant?->color_id,
                                            ]) }}">
                                            {{ $product->name }}</a>
                                        @php
                                            $saved =
                                                (float) $product->firstVariant->price -
                                                (float) $product->firstVariant->discountedPrice;
                                        @endphp
                                        <p class="lead fw-bolder m-0 fs-3 lh-1 text-danger me-2">Rs.
                                            {{ $saved }}
                                        </p>
                                        <s class="lh-1 me-2"><span class="fw-bolder m-0">Rs.
                                                {{ $product->firstVariant->price }}</span></s>
                                        (<span>{{ $product->firstVariant->discount }}% off</span>)
                                        <p class="lead fw-bolder m-0 fs-6 lh-1 text-success">Discount ammount Rs.
                                            {{ $product->firstVariant->discountedPrice }}
                                        </p>
                                        {{-- <p class="fw-bolder m-0 mt-2">Rs. {{ $product->actualPrice }}</p> --}}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        {{-- pop up for product variants  --}}
                        {{-- <div class="modal fade" id="addedToCartModal" tabindex="-1"
                            aria-labelledby="addedToCartModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="addedToCartModalLabel">Select Variant & Add to Cart
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>

                                    <div class="modal-body">
                                        <div class="row">
                                            <!-- Product Image -->
                                            <div class="col-md-5 text-center">
                                                <img id="modal-product-image" src="" class="img-fluid rounded"
                                                    style="max-height: 250px;">
                                            </div>

                                            <!-- Product Details -->
                                            <div class="col-md-7">
                                                <h5 id="modal-product-name"></h5>
                                                <p id="modal-product-price" class="fw-bold text-success mb-1"></p>
                                                <p id="modal-product-discount" class="text-danger mb-1"></p>
                                                <p id="modal-product-actualprice"
                                                    class="text-muted text-decoration-line-through"></p>

                                                <!-- Color Options -->
                                                <div class="mb-3">
                                                    <label class="fw-bold">Choose Color:</label>
                                                    <div id="variant-colors" class="d-flex flex-wrap gap-2"></div>
                                                </div>

                                                <!-- Size Options -->
                                                <div class="mb-3">
                                                    <label class="fw-bold">Choose Size:</label>
                                                    <select id="variant-size" class="form-select w-auto">
                                                        <option value="">Select size</option>
                                                    </select>
                                                </div>

                                                <button id="add-to-cart-btn" class="btn btn-primary mt-2">Add to
                                                    Cart</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                        {{-- pop up modal ends here  --}}
                        {{-- jquery instertion --}}
                        {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

                        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
                            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
                        </script> --}}
                        {{-- bootstrap cdn link --}}
                        {{-- <script>
                            $(document).ready(function() {
                                let selectedColor = null;
                                let selectedSize = null;
                                let productId = null;

                                // Change from direct binding to event delegation
                                // Instead of: $('.quickadd-btn').on('click', function() {
                                // Use this:
                                $(document).on('click', '.quickadd-btn', function(e) {
                                    e.preventDefault();
                                    productId = $(this).data('product-id');

                                    console.log('Quick Add clicked for product:', productId);

                                    $.ajax({
                                        url: '/quick-add/' + productId,
                                        type: 'GET',
                                        dataType: 'json',
                                        success: function(response) {
                                            console.log("Quick Add Response:", response);

                                            if (response.success) {
                                                let product = response.product_details;

                                                // Fill modal product info
                                                $('#modal-product-name').text(product.name);
                                                $('#modal-product-image').attr('src', product.image);
                                                $('#modal-product-price').text("₹: " + product.price);
                                                $('#modal-product-discount').text("Discount: " + product.discount +
                                                    "%");
                                                $('#modal-product-actualprice').text("₹" + product.actualprice);

                                                // Fill color options
                                                $('#variant-colors').empty();
                                                if (product.variants && product.variants.length > 0) {
                                                    product.variants.forEach(function(variant) {
                                                        $('#variant-colors').append(`
                                <div class="color-option" 
                                    data-color-id="${variant.color_id}" 
                                    data-color-name="${variant.color_name}" 
                                    data-color-code="${variant.color_code}" 
                                    data-image="${variant.image}" 
                                    data-sizes='${JSON.stringify(variant.sizes)}'
                                    style="width:30px;height:30px;border-radius:50%;background:${variant.color_code};cursor:pointer;border:2px solid #ccc;">
                                </div>
                            `);
                                                    });
                                                }

                                                // Reset size dropdown
                                                $('#variant-size').empty().append(
                                                    '<option value="">Select size</option>');

                                                // Auto-select first color if available
                                                let firstColor = $('.color-option').first();
                                                if (firstColor.length) {
                                                    firstColor.trigger('click');
                                                }

                                                // Show modal
                                                let addedToCartModal = new bootstrap.Modal(document.getElementById(
                                                    'addedToCartModal'));
                                                addedToCartModal.show();
                                            } else {
                                                alert('Error loading product details');
                                            }
                                        },
                                        error: function(xhr, status, error) {
                                            console.log('AJAX Error:', error, xhr.responseText);
                                            alert('Error loading product details');
                                        }
                                    });
                                });

                                // Also update other event handlers to use delegation:
                                $(document).on('click', '.color-option', function() {
                                    selectedColor = $(this).data('color-id');
                                    let image = $(this).data('image');
                                    let sizes = JSON.parse($(this).attr('data-sizes'));

                                    $('#modal-product-image').attr('src', image);
                                    $('#variant-size').empty().append('<option value="">Select size</option>');

                                    sizes.forEach(function(size) {
                                        $('#variant-size').append(`<option value="${size}">${size}</option>`);
                                    });

                                    if (sizes.length > 0) {
                                        $('#variant-size').val(sizes[0]).trigger('change');
                                    }

                                    $('.color-option').css('border', '2px solid #ccc');
                                    $(this).css('border', '2px solid black');
                                });

                                $(document).on('change', '#variant-size', function() {
                                    selectedSize = $(this).val();
                                });

                                $(document).on('click', '#add-to-cart-btn', function() {
                                    if (!selectedColor || !selectedSize) {
                                        alert("Please select a color and size.");
                                        return;
                                    }

                                    let url = `/add-to-cart/${productId}/${selectedColor}/${selectedSize}`;

                                    $.ajax({
                                        url: url,
                                        type: 'GET',
                                        success: function(response) {
                                            if (response.success) {
                                                alert("Added to cart successfully!");
                                                $('.cart-count').text(response.cart_count);
                                                $('#offcanvasbody').load(location.href + ' #offcanvasbody > *');
                                            } else {
                                                alert("Error: " + response.message);
                                            }
                                        },
                                        error: function() {
                                            alert("Something went wrong, please try again.");
                                        }
                                    });
                                });
                            });
                        </script> --}}
                        {{-- Script for working for quick add functionality  --}}

                        {{-- scripts ends here --}}
                        <div class="swiper-slide d-flex h-auto justify-content-center align-items-center">
                            <a href="{{ route('product.list') }}"
                                class="d-flex text-decoration-none flex-column justify-content-center align-items-center">
                                <span class="btn btn-dark btn-icon mb-3"><i
                                        class="ri-arrow-right-line ri-lg lh-1"></i></span>
                                <span class="lead fw-bolder">See All</span>
                            </a>
                        </div>
                    </div>

                    <!-- Buttons-->
                    <div
                        class="swiper-btn swiper-disabled-hide swiper-prev swiper-btn-side btn-icon bg-dark text-white ms-3 shadow-lg mt-n5 ms-n4">
                        <i class="ri-arrow-left-s-line ri-lg"></i>
                    </div>
                    <div
                        class="swiper-btn swiper-disabled-hide swiper-next swiper-btn-side swiper-btn-side-right btn-icon bg-dark text-white me-n4 shadow-lg mt-n5">
                        <i class="ri-arrow-right-s-line ri-lg"></i>
                    </div>

                    <!-- Add Scrollbar -->
                    <div class="swiper-scrollbar"></div>

                </div>
                <!-- / Swiper Latest-->
            </div>
        </section>
        <!-- / Staff Picks-->

        <!-- Image Hotspot Banner-->
        <section class="my-10 position-relative">
            <!-- SVG Shape Divider-->
            <div class="position-absolute z-index-50 text-white top-0 start-0 end-0">
                <svg class="align-self-start d-flex" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1283 53.25">
                    <polygon fill="currentColor" points="1283 0 0 0 0 53.25 1283 0" />
                </svg>
            </div>
            <!-- /SVG Shape Divider-->

            <div class="w-100 h-100 bg-img-cover bg-pos-center-center hotspot-container py-5 py-md-7 py-lg-10"
                style="background-image: url(https://images.unsplash.com/photo-1508746829417-e6f548d8d6ed?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80);">
                <div class="hotspot d-none d-lg-block"
                    data-options='{
                    "placement": {
                        "left": "68%",
                        "bottom": "40%"
                    },
                    "alwaysVisible": true,
                    "alwaysAnimate": true,
                    "contentTarget": "#hotspot-one",
                    "trigger": "mouseenter"
                }'>
                </div>
                <div class="hotspot d-none d-lg-block"
                    data-options='{
                    "placement": {
                        "left": "53%",
                        "top": "40%"
                    },
                    "alwaysVisible": true,
                    "alwaysAnimate": true,
                    "contentTarget": "#hotspot-one"
                }'>
                </div>
                <div class="container py-lg-8 position-relative z-index-10 d-flex align-items-center"
                    data-aos="fade-left">
                    <div
                        class="py-8 d-flex justify-content-end align-items-start align-items-lg-end flex-column col-lg-4 text-lg-end">
                        <p class="small fw-bolder text-uppercase tracking-wider mb-2 text-muted">Extreme Performance</p>
                        <h2 class="display-5 fw-bold mb-3">The North Face</h2>
                        <p class="lead d-none d-lg-block">Be ready all year round with our selection of North Face outdoor
                            jackets — perfect for any time of the year and year round. Choose from a variety of colour
                            shades and styles to warm you up in cold conditions.</p>
                        <a class="text-decoration-none fw-bolder" href="#">Shop The North Face &rarr;</a>
                    </div>
                </div>

                <!-- Example Hotspot HTML Content -->
                <div id="hotspot-one" class="d-none">
                    <div class="m-n2 rounded overflow-hidden">

                        @php
                            $img = $singleProduct->firstVariantImage?->name;
                            $imgPath =
                                $img && file_exists(public_path('variantThumbnail/' . $img))
                                    ? url('variantThumbnail/' . $img)
                                    : asset('images/no-image.jpg');
                        @endphp
                        <div class="mb-1 bg-light d-flex justify-content-center">
                            <div class="f-w-48 px-3 pt-3">
                                <img class="img-fluid" src="{{ $imgPath }}"
                                    alt="Bootstrap 5 Template by Pixel Rocket">
                            </div>
                        </div>
                        <div class="px-4 py-4 text-center">
                            <div class="d-flex justify-content-center align-items-center mx-auto mb-1">
                                <!-- Review Stars Small-->
                                <div class="rating position-relative d-table">
                                    <div class="position-absolute stars" style="width: 80%">
                                        <i class="ri-star-fill text-dark mr-1"></i>
                                        <i class="ri-star-fill text-dark mr-1"></i>
                                        <i class="ri-star-fill text-dark mr-1"></i>
                                        <i class="ri-star-fill text-dark mr-1"></i>
                                        <i class="ri-star-fill text-dark mr-1"></i>
                                    </div>
                                    <div class="stars">
                                        <i class="ri-star-fill mr-1 text-muted opacity-25"></i>
                                        <i class="ri-star-fill mr-1 text-muted opacity-25"></i>
                                        <i class="ri-star-fill mr-1 text-muted opacity-25"></i>
                                        <i class="ri-star-fill mr-1 text-muted opacity-25"></i>
                                        <i class="ri-star-fill mr-1 text-muted opacity-25"></i>
                                    </div>
                                </div> <span class="small fw-bolder ms-2 text-muted"> 4.4 (1289)</span>
                            </div>
                            <p class="mb-0 mx-4">{{ $singleProduct->name }}</p>
                            <p class="lead lh-1 m-0 fw-bolder text-success mt-2 mb-3">
                                Rs.{{ $singleProduct->firstVariant->price }}</p>
                            <a href="{{ route('product.details', $singleProduct->id) }}"
                                class="fw-bolder text-link-border pb-1 fs-6">Full details <i
                                    class="ri-arrow-right-line align-bottom"></i></a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- SVG Shape Divider-->
            <div class="position-absolute z-index-50 text-white bottom-0 start-0 end-0">
                <svg class="align-self-end d-flex" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1283 53.25">
                    <polygon fill="currentColor" points="0 53.25 1283 53.25 1283 0 0 53.25" />
                </svg>
            </div>
            <!-- /SVG Shape Divider-->
        </section>
        <!-- / Image Hotspot Banner-->


        <!-- Linked Product Carousels-->
        <section class="py-5" data-aos="fade-in">
            <div class="container">
                <div class="row g-5">
                    <div class="col-12 col-md-7" data-aos="fade-right">
                        <div class="m-0">
                            <p class="small fw-bolder text-uppercase tracking-wider mb-2 text-muted">Hiking Essentials
                            </p>
                            <h2 class="display-5 fw-bold mb-6">Our Latest Must-Have Products</h2>
                            <div class="px-8 position-relative">

                                <!-- Swiper-->
                                <div class="swiper-container swiper-linked-carousel-small">

                                    <!-- Add Pagination -->
                                    <div class="swiper-pagination-blocks mb-4">
                                        <div class="swiper-pagination-custom"></div>
                                    </div>

                                    <div class="swiper-wrapper">

                                        @foreach ($allProducts->take(3) as $product)
                                            <div class="swiper-slide d-flex h-auto">
                                                <!-- Card Product-->
                                                <div class="card position-relative h-100 card-listing hover-trigger">
                                                    <div class="card-header">
                                                        @php
                                                            $img = $product->firstVariantImage?->name;
                                                            $imgPath =
                                                                $img &&
                                                                file_exists(public_path('variantThumbnail/' . $img))
                                                                    ? url('variantThumbnail/' . $img)
                                                                    : asset('images/no-image.jpg');
                                                        @endphp

                                                        {{-- <picture class="position-relative overflow-hidden d-block bg-light">
                                            <img class="w-100 img-fluid position-relative z-index-10"
                                                src="{{ $imgPath }}">
                                        </picture> --}}
                                                        <picture
                                                            class="position-relative overflow-hidden d-block bg-light">
                                                            <img class="w-100 img-fluid position-relative z-index-10"
                                                                title="" src="{{ $imgPath }}" alt="">
                                                        </picture>
                                                        <picture
                                                            class="position-absolute z-index-20 start-0 top-0 hover-show bg-light">
                                                            <img class="w-100 img-fluid" title=""
                                                                src="./assets/images/products/product-1b.jpg"
                                                                alt="">
                                                        </picture>
                                                        {{-- <div class="card-actions">
                                                            <span
                                                                class="small text-uppercase tracking-wide fw-bolder text-center d-block">Quick
                                                                Add</span>
                                                            <div
                                                                class="d-flex justify-content-center align-items-center flex-wrap mt-3">
                                                                <button class="btn btn-outline-dark btn-sm mx-2">S</button>
                                                                <button class="btn btn-outline-dark btn-sm mx-2">M</button>
                                                                <button class="btn btn-outline-dark btn-sm mx-2">L</button>
                                                            </div>
                                                        </div> --}}
                                                    </div>
                                                    <div class="card-body px-0 text-center">
                                                        <div
                                                            class="d-flex justify-content-center align-items-center mx-auto mb-1">
                                                            <!-- Review Stars Small-->
                                                            <div class="rating position-relative d-table">
                                                                <div class="position-absolute stars" style="width: 90%">
                                                                    <i class="ri-star-fill text-dark mr-1"></i>
                                                                    <i class="ri-star-fill text-dark mr-1"></i>
                                                                    <i class="ri-star-fill text-dark mr-1"></i>
                                                                    <i class="ri-star-fill text-dark mr-1"></i>
                                                                    <i class="ri-star-fill text-dark mr-1"></i>
                                                                </div>
                                                                <div class="stars">
                                                                    <i class="ri-star-fill mr-1 text-muted opacity-25"></i>
                                                                    <i class="ri-star-fill mr-1 text-muted opacity-25"></i>
                                                                    <i class="ri-star-fill mr-1 text-muted opacity-25"></i>
                                                                    <i class="ri-star-fill mr-1 text-muted opacity-25"></i>
                                                                    <i class="ri-star-fill mr-1 text-muted opacity-25"></i>
                                                                </div>
                                                            </div> <span class="small fw-bolder ms-2 text-muted"> 4.7
                                                                (456)
                                                            </span>
                                                        </div>
                                                        <a class="mb-0 mx-2 mx-md-4 fs-p link-cover text-decoration-none d-block text-center"
                                                            href="{{ route('product.details', $product->id) }}">{{ $product->name }}</a>
                                                        @php
                                                            $saved =
                                                                (float) $product->firstVariant->price -
                                                                (float) $product->firstVariant->discountedPrice;
                                                        @endphp
                                                        <p class="lead fw-bolder m-0 fs-3 lh-1 text-danger me-2">Rs.
                                                            {{ $saved }}
                                                        </p>
                                                        <s class="lh-1 me-2"><span class="fw-bolder m-0">Rs.
                                                                {{ $product->firstVariant->price }}</span></s>
                                                        (<span>{{ $product->firstVariant->discount }}% off</span>)
                                                        <p class="lead fw-bolder m-0 fs-6 lh-1 text-success">Discount
                                                            ammount Rs.
                                                            {{ $product->firstVariant->discountedPrice }}
                                                        </p>
                                                        {{-- <p class="fw-bolder m-0 mt-2">Rs. {{ $product->actualPrice }}</p> --}}
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach


                                    </div>
                                </div> <!-- /Swiper-->

                                <!-- Swiper Arrows -->
                                <div
                                    class="swiper-prev-linked position-absolute top-50 start-0 mt-n8 cursor-pointer transition-all opacity-50-hover">
                                    <i class="ri-arrow-left-s-line ri-2x"></i>
                                </div>
                                <div
                                    class="swiper-next-linked position-absolute top-50 end-0 me-3 mt-n8 cursor-pointer transition-all opacity-50-hover">
                                    <i class="ri-arrow-right-s-line ri-2x"></i>
                                </div>
                                <!-- / Swiper Arrows-->

                            </div>
                        </div>
                    </div>
                    <div class="col-md-5 d-none d-md-flex" data-aos="fade-left">
                        <div class="w-100 h-100">

                            <!-- Swiper-->
                            <div class="swiper-container h-100 swiper-linked-carousel-large">

                                <div class="swiper-wrapper h-100">

                                    <!-- Swiper Slide-->
                                    <div class="swiper-slide">
                                        <div class="row g-3">
                                            @foreach ($allProducts->take(4) as $products)
                                                <div class="col-12 col-md-6">
                                                    <!-- Card Product-->
                                                    <div class="card position-relative h-100 card-listing hover-trigger">
                                                        <div class="card-header">
                                                            @php
                                                                $img = $product->firstVariantImage?->name;
                                                                $imgPath =
                                                                    $img &&
                                                                    file_exists(public_path('variantThumbnail/' . $img))
                                                                        ? url('variantThumbnail/' . $img)
                                                                        : asset('images/no-image.jpg');
                                                            @endphp
                                                            <picture
                                                                class="position-relative overflow-hidden d-block bg-light">
                                                                <img class="w-100 img-fluid position-relative z-index-10"
                                                                    title="" src="{{ $imgPath }}"
                                                                    alt="Bootstrap 5 Template by Pixel Rocket">
                                                            </picture>
                                                            {{-- <div class="card-actions">
                                                                <span
                                                                    class="small text-uppercase tracking-wide fw-bolder text-center d-block">Quick
                                                                    Add</span>
                                                                <div
                                                                    class="d-flex justify-content-center align-items-center flex-wrap mt-3">
                                                                    <button
                                                                        class="btn btn-outline-dark btn-sm mx-2">S</button>
                                                                    <button
                                                                        class="btn btn-outline-dark btn-sm mx-2">M</button>
                                                                    <button
                                                                        class="btn btn-outline-dark btn-sm mx-2">L</button>
                                                                </div>
                                                            </div> --}}
                                                        </div>
                                                        <div class="card-body px-0 text-center">
                                                            <div
                                                                class="d-flex justify-content-center align-items-center mx-auto mb-1">
                                                                <!-- Review Stars Small-->
                                                                <div class="rating position-relative d-table">
                                                                    <div class="position-absolute stars"
                                                                        style="width: 80%">
                                                                        <i class="ri-star-fill text-dark mr-1"></i>
                                                                        <i class="ri-star-fill text-dark mr-1"></i>
                                                                        <i class="ri-star-fill text-dark mr-1"></i>
                                                                        <i class="ri-star-fill text-dark mr-1"></i>
                                                                        <i class="ri-star-fill text-dark mr-1"></i>
                                                                    </div>
                                                                    <div class="stars">
                                                                        <i
                                                                            class="ri-star-fill mr-1 text-muted opacity-25"></i>
                                                                        <i
                                                                            class="ri-star-fill mr-1 text-muted opacity-25"></i>
                                                                        <i
                                                                            class="ri-star-fill mr-1 text-muted opacity-25"></i>
                                                                        <i
                                                                            class="ri-star-fill mr-1 text-muted opacity-25"></i>
                                                                        <i
                                                                            class="ri-star-fill mr-1 text-muted opacity-25"></i>
                                                                    </div>
                                                                </div> <span class="small fw-bolder ms-2 text-muted"> 4.7
                                                                    (1669)
                                                                </span>
                                                            </div>
                                                            <a class="mb-0 mx-2 mx-md-4 fs-p link-cover text-decoration-none d-block text-center"
                                                                href="{{ route('product.details', $product->id) }}">{{ $product->name }}</a>
                                                            <p class="fw-bolder m-0 mt-2">Rs.{{ $product->actualPrice }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <!--/ Card Product-->
                                                </div>
                                            @endforeach

                                        </div>
                                    </div>


                                </div>
                            </div> <!-- / Swiper-->

                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- / Linked Product Carousels-->


        <!-- Sale Banner -->
        <section class="position-relative my-5 my-md-7 my-lg-9 bg-dark" data-aos="fade-in">
            <!-- SVG Shape Divider-->
            <div class="position-absolute text-white z-index-50 top-0 end-0 start-0">
                <svg class="align-self-start d-flex" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1283 53.25">
                    <polygon fill="currentColor" points="1283 0 0 0 0 53.25 1283 0" />
                </svg>
            </div>
            <!-- /SVG Shape Divider-->

            <div class="py-7 py-lg-10">
                <div class="container text-white py-4 py-md-6">
                    <div class="row g-5 align-items-center">
                        <div class="col-12 col-lg-4 justify-content-center d-flex justify-content-lg-start"
                            data-aos="fade-right" data-aos-delay="250">
                            <h3 class="fs-1 fw-bold mb-0 lh-1"><i class="ri-timer-flash-line align-bottom"></i> Sale
                                Extended</h3>
                        </div>
                        <div class="col-12 col-lg-4 d-flex justify-content-center flex-column" data-aos="fade-up"
                            data-aos-delay="250">
                            <a href="{{ route('menswear.product.list') }}"
                                class="btn btn-orange btn-orange-chunky text-white my-1"><span>Shop
                                    Menswear</span></a>
                            <a href="{{ route('womenswear.product.list') }}"
                                class="btn btn-orange btn-orange-chunky text-white my-1"><span>Shop
                                    Womenswear</span></a>
                            <a href="{{ route('kidswear.product.list') }}"
                                class="btn btn-orange btn-orange-chunky text-white my-1"><span>Shop
                                    Kidswear</span></a>
                            <a href="{{ route('accessories.product.list') }}"
                                class="btn btn-orange btn-orange-chunky text-white my-1"><span>Shop
                                    Accessories</span></a>
                        </div>
                        <div class="col-12 col-lg-4 text-center text-lg-end" data-aos="fade-left" data-aos-delay="250">
                            <p class="lead fw-bolder">Discount applied to products at checkout.</p>
                            {{-- <a class="text-white fw-bolder text-link-border border-2 border-white align-self-start pb-1 transition-all opacity-50-hover"
                                href="#">Exclusions apply. Learn more <i
                                    class="ri-arrow-right-line align-bottom"></i></a> --}}
                        </div>
                    </div>
                </div>
            </div>

            <!-- SVG Shape Divider-->
            <div class="position-absolute z-index-50 text-white bottom-0 start-0 end-0">
                <svg class="align-self-end d-flex" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1283 53.25">
                    <polygon fill="currentColor" points="0 53.25 1283 53.25 1283 0 0 53.25" />
                </svg>
            </div>
            <!-- /SVG Shape Divider-->
        </section>
        <!-- /Sale Banner -->

        <!-- Reviews-->
        <section>
            <div class="container" data-aos="fade-in">
                <h2 class="fs-1 fw-bold mb-3 text-center mb-5">Customer Reviews</h2>
                <div class="row g-3">
                    <div class="col-12 col-lg-4" data-aos="fade-left">
                        <div
                            class="bg-light p-4 d-flex h-100 justify-content-start align-items-center flex-column text-center">
                            <p class="fw-bolder lead">Amazing Service!</p>
                            <p class="mb-3">I have shopped with them for a few years now. Very easy to select items,
                                items always as
                                described. Never had to return any item. Good value.</p>
                            <small class="text-muted d-block mb-2 fw-bolder">John Doe, London</small>
                            <!-- Review Stars Small-->
                            <div class="rating position-relative d-table">
                                <div class="position-absolute stars" style="width: 75%">
                                    <i class="ri-star-fill text-dark mr-1"></i>
                                    <i class="ri-star-fill text-dark mr-1"></i>
                                    <i class="ri-star-fill text-dark mr-1"></i>
                                    <i class="ri-star-fill text-dark mr-1"></i>
                                    <i class="ri-star-fill text-dark mr-1"></i>
                                </div>
                                <div class="stars">
                                    <i class="ri-star-fill mr-1 text-muted opacity-25"></i>
                                    <i class="ri-star-fill mr-1 text-muted opacity-25"></i>
                                    <i class="ri-star-fill mr-1 text-muted opacity-25"></i>
                                    <i class="ri-star-fill mr-1 text-muted opacity-25"></i>
                                    <i class="ri-star-fill mr-1 text-muted opacity-25"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-4" data-aos="fade-left" data-aos-delay="150">
                        <div
                            class="bg-light p-4 d-flex h-100 justify-content-start align-items-center flex-column text-center">
                            <p class="fw-bolder lead">Great Prices</p>
                            <p class="mb-3">Always find these guys competitive,and with a huge range of products,coupled
                                with great
                                marketing,its difficult not to buy something.</p>
                            <small class="text-muted d-block mb-2 fw-bolder">Sally Smith, Dublin</small>
                            <!-- Review Stars Small-->
                            <div class="rating position-relative d-table">
                                <div class="position-absolute stars" style="width: 75%">
                                    <i class="ri-star-fill text-dark mr-1"></i>
                                    <i class="ri-star-fill text-dark mr-1"></i>
                                    <i class="ri-star-fill text-dark mr-1"></i>
                                    <i class="ri-star-fill text-dark mr-1"></i>
                                    <i class="ri-star-fill text-dark mr-1"></i>
                                </div>
                                <div class="stars">
                                    <i class="ri-star-fill mr-1 text-muted opacity-25"></i>
                                    <i class="ri-star-fill mr-1 text-muted opacity-25"></i>
                                    <i class="ri-star-fill mr-1 text-muted opacity-25"></i>
                                    <i class="ri-star-fill mr-1 text-muted opacity-25"></i>
                                    <i class="ri-star-fill mr-1 text-muted opacity-25"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-4" data-aos="fade-left" data-aos-delay="300">
                        <div
                            class="bg-light p-4 d-flex h-100 justify-content-start align-items-center flex-column text-center">
                            <p class="fw-bolder lead">Fantastic Website</p>
                            <p class="mb-3">My package was missing an item but customer services resolved it immediately
                                and i got
                                another delivery quite promptly.
                                Also the product was absolutely lovely</p>
                            <small class="text-muted d-block mb-2 fw-bolder">John Patrick, London</small>
                            <!-- Review Stars Small-->
                            <div class="rating position-relative d-table">
                                <div class="position-absolute stars" style="width: 75%">
                                    <i class="ri-star-fill text-dark mr-1"></i>
                                    <i class="ri-star-fill text-dark mr-1"></i>
                                    <i class="ri-star-fill text-dark mr-1"></i>
                                    <i class="ri-star-fill text-dark mr-1"></i>
                                    <i class="ri-star-fill text-dark mr-1"></i>
                                </div>
                                <div class="stars">
                                    <i class="ri-star-fill mr-1 text-muted opacity-25"></i>
                                    <i class="ri-star-fill mr-1 text-muted opacity-25"></i>
                                    <i class="ri-star-fill mr-1 text-muted opacity-25"></i>
                                    <i class="ri-star-fill mr-1 text-muted opacity-25"></i>
                                    <i class="ri-star-fill mr-1 text-muted opacity-25"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-center flex-column mt-7 align-items-center">
                    <h3 class="mb-4 fw-bold fs-4">Ratings says it all</h3>
                    <div class="d-flex justify-content-center align-items-center">
                        <span class="fs-3 fw-bold me-4">4.85 / 5</span>
                        <!-- Review Stars Medium-->
                        <div class="rating position-relative d-table">
                            <div class="position-absolute stars" style="width: 88%">
                                <i class="ri-star-fill text-dark ri-2x mr-1"></i>
                                <i class="ri-star-fill text-dark ri-2x mr-1"></i>
                                <i class="ri-star-fill text-dark ri-2x mr-1"></i>
                                <i class="ri-star-fill text-dark ri-2x mr-1"></i>
                                <i class="ri-star-fill text-dark ri-2x mr-1"></i>
                            </div>
                            <div class="stars">
                                <i class="ri-star-fill ri-2x mr-1 text-muted"></i>
                                <i class="ri-star-fill ri-2x mr-1 text-muted"></i>
                                <i class="ri-star-fill ri-2x mr-1 text-muted"></i>
                                <i class="ri-star-fill ri-2x mr-1 text-muted"></i>
                                <i class="ri-star-fill ri-2x mr-1 text-muted"></i>
                            </div>
                        </div>
                    </div>
                    {{-- <p class="btn btn-dark rounded-0 mt-4">Read 4,215 more reviews</p> --}}
                </div>
            </div>
        </section>
        <!-- /Reviews-->

        <!-- /Page Content -->
    </section>
    <!-- / Main Section-->
@endsection
