@extends('layouts.frontend.productpage.indexProductdetail')

@section('main-container')
    <!-- Main Section-->
    <div class="container">
        <section class="mt-0">
            <!-- Page Content Goes Here -->

            <!-- Product Top-->
            <section class="container">
                {{-- {{ dd($selectedColor); }} --}}
                {{-- {{ dd($selectedVariant); }} --}}
                <!-- Breadcrumbs-->
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Activities</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Clothing</li>
                    </ol>
                </nav> <!-- /Breadcrumbs-->

                <div class="row g-5">

                    <!-- Images Section-->
                    <div class="col-12 col-lg-7">
                        <div class="row g-1">
                            <!-- Thumbnails -->
                            <div class="swiper-container gallery-thumbs-vertical col-2 pb-4">
                                <div class="swiper-wrapper">
                                    @foreach ($variantImage as $item)
                                        @if ($item && isset($item->name))
                                            <div class="swiper-slide bg-light h-auto">
                                                <picture>
                                                    <img class="img-fluid mx-auto d-table"
                                                        src="{{ url('variantThumbnail/' . $item->name) }}"
                                                        alt="{{ $item->name }}">
                                                </picture>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>

                            <!-- Main Images -->
                            <div class="swiper-container gallery-top-vertical col-10">
                                <div class="swiper-wrapper">
                                    @foreach ($variantImage as $item)
                                        @if ($item && isset($item->name))
                                            <div class="swiper-slide bg-white h-auto">
                                                <picture>
                                                    <img class="img-fluid d-table mx-auto"
                                                        src="{{ url('variantThumbnail/' . $item->name) }}"
                                                        alt="{{ $item->name }}" data-zoomable>
                                                </picture>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- /Images Section-->

                    <!-- Product Info Section-->
                    <div class="col-12 col-lg-5">
                        <div class="pb-3">

                            <!-- Product Name, Review, Brand, Price-->
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <p class="small fw-bolder text-uppercase tracking-wider text-muted mb-0 lh-1">Trending
                                    Collection</p>
                                <div class="d-flex justify-content-start align-items-center">
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
                                    </div> <small class="text-muted d-inline-block ms-2 fs-bolder">(1288)</small>
                                </div>
                            </div>
                            <h1 class="mb-2 fs-2 fw-bold">{{ $product->name }}</h1>
                            @php
                                $selectedVariant = $variantdata->firstWhere('color_id', $color_id);
                                // dd($selectedVariant);
                            @endphp
                            {{-- @php
                                $selectedVariant = $variantdata->first(function ($variant) use (
                                    $color_id,
                                    $selectedSize,
                                ) {
                                    return $variant->color_id == $color_id && $variant->size == $selectedSize;
                                });

                            @endphp --}}

                            @if ($selectedVariant)
                                {{-- @foreach ($selectedColor as $price)
                                @endforeach --}}
                                <div class="d-flex flex-wrap align-items-center">
                                    <p class="lead fw-bolder m-0 fs-3 text-danger me-2">
                                        Rs.
                                        {{ (float) $selectedVariant->price - (float) $selectedVariant->discountedPrice }}
                                    </p>
                                    <s class="me-2">
                                        <span class="fw-bolder">Rs. {{ $selectedVariant->price }}</span>
                                    </s>
                                    <span class="me-2">({{ $selectedVariant->discount }}% off)</span>
                                    <p class="lead fw-bolder m-0 fs-6 text-success me-2">
                                        Discount: Rs. {{ $selectedVariant->discountedPrice }}
                                    </p>
                                </div>
                            @else
                                <div class="text-muted">Please select a color to see the price.</div>
                            @endif

                            <!-- /Product Name, Review, Brand, Price-->

                            <!-- Product Views-->
                            <div class="d-flex justify-content-start mt-3">
                                <div class="alert bg-light rounded py-1 px-2 d-table m-0">
                                    <div class="d-flex justify-content-start align-items-center">
                                        <i class="ri-fire-fill lh-1 text-orange"></i>
                                        <div class="ms-2">
                                            <small class="opacity-75 fw-bolder lh-1">Trending Today</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /Product Views-->

                            <!-- Product Options-->

                            <div>
                                <small class="text-uppercase d-block fw-bolder mb-2 mt-2">
                                    Colour : <span
                                        class="selected-option fw-bold">{{ $selectedColor->color->name ?? '' }}</span>
                                </small>

                            </div>

                            {{-- <div class="d-flex justify-content-start flex-wrap">
                                @php
                                    $displayedColors = [];
                                @endphp

                                @foreach ($variantdata as $key => $variant)
                                    @if (!in_array($variant->color->id, $displayedColors))
                                        @php
                                            $displayedColors[] = $variant->color->id;
                                        @endphp
                                        <label class="color-box m-1" for="option-colour-{{ $key }}"
                                            style="background-color: {{ $variant->color->colorCode }};">
                                            
                                            <input type="radio" class="form-check-color-input"
                                                id="option-colour-{{ $key }}" name="option-colour"
                                                value="{{ $variant->color->name }}" data-product-id="{{ $product->id }}"
                                                data-color-id="{{ $variant->color->id }}">

                                        </label>
                                    @endif
                                @endforeach
                            </div> --}}
                            <div class="d-flex justify-content-start flex-wrap">
                                @php
                                    $displayedColors = [];
                                @endphp

                                @foreach ($variantdata as $key => $variant)
                                    @if (!in_array($variant->color->id, $displayedColors))
                                        @php
                                            $displayedColors[] = $variant->color->id;
                                        @endphp
                                        <label class="color-box m-1" for="option-colour-{{ $key }}"
                                            style="background-color: {{ $variant->color->colorCode }};">
                                            <input type="radio" class="form-check-color-input"
                                                id="option-colour-{{ $key }}" name="option-colour"
                                                value="{{ $variant->color->name }}" data-product-id="{{ $product->id }}"
                                                data-color-id="{{ $variant->color->id }}"
                                                @if ($variant->color->id == $color_id) checked @endif>
                                        </label>
                                    @endif
                                @endforeach
                            </div>

                            <div class="product-option">
                                <small class="text-uppercase d-block fw-bolder mb-2">
                                    Size (UK) : <span class="selected-option fw-bold"></span>
                                </small>
                                <div class="form-group">
                                    {{-- <select name="selectSize" id="selectSize" class="form-control" data-choices>
                                        <option value="">Please Select Size</option>
                                        @foreach ($sizedata as $data)
                                            <option value="{{ $data }}">{{ $data }}</option>
                                        @endforeach

                                    </select> --}}
                                    <select id="selectSize" name="selectSize" class="form-control" data-choices>
                                        <option value="">Please Select Size</option>
                                        @foreach ($sizedata as $data)
                                            <option value="{{ $data }}">{{ $data }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <style>
                                /* Hide radio button */
                                .form-check-color-input {
                                    display: none;
                                }

                                /* Full clickable color tab */
                                .color-box {
                                    width: 40px;
                                    /* Bigger swatch */
                                    height: 40px;
                                    /* Bigger swatch */
                                    border-radius: 6px;
                                    /* Rounded edges */
                                    cursor: pointer;
                                    display: flex;
                                    /* For full clickable area */
                                    align-items: center;
                                    justify-content: center;
                                    border: 1px solid transparent;
                                    transition: transform 0.2s ease, border 0.2s ease;
                                }

                                /* Selected state */
                                .form-check-color-input:checked+.color-box,
                                .color-box:has(.form-check-color-input:checked) {
                                    border: 2px solid #000;
                                    transform: scale(1.05);
                                }

                                /* Remove focus outline */
                                .color-box:focus-within {
                                    outline: none;
                                    box-shadow: none;
                                }
                            </style>




                            <!-- /Product Options-->

                            <!-- Add To Cart-->
                            {{-- <div class="d-flex justify-content-between mt-3">
                                <a href="{{ route('add.to.cart',[
                                'product_id'=>$product->id,
                                'color_id'=>$selectedColor->color->id,
                                'size'=>$selectedColor->size
                                ]) }}"
                                 class="btn btn-dark btn-dark-chunky flex-grow-1 me-2 text-white">Add To
                                    Cart</a>
                                <button class="btn btn-orange btn-orange-chunky"><i class="ri-heart-line"></i></button>
                            </div> --}}

                            <a id="addToCartBtn" href="#"
                                class="btn btn-dark btn-dark-chunky flex-grow-1 me-2 text-white">
                                Add To Cart
                            </a>




                            <!-- /Add To Cart-->





                            <!-- Socials-->
                            <div class="my-4">
                                <div class="d-flex justify-content-start align-items-center">
                                    <p class="fw-bolder lh-1 mb-0 me-3">Share</p>
                                    <ul
                                        class="list-unstyled p-0 m-0 d-flex justify-content-start lh-1 align-items-center mt-1">
                                        <li class="me-2"><a class="text-decoration-none" href="#" role="button"><i
                                                    class="ri-facebook-box-fill"></i></a></li>
                                        <li class="me-2"><a class="text-decoration-none" href="#" role="button"><i
                                                    class="ri-instagram-fill"></i></a></li>
                                        <li class="me-2"><a class="text-decoration-none" href="#"
                                                role="button"><i class="ri-pinterest-fill"></i></a></li>
                                        <li class="me-2"><a class="text-decoration-none" href="#"
                                                role="button"><i class="ri-twitter-fill"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <!-- Socials-->

                            <!-- Special Offers-->
                            <div class="bg-light rounded py-2 px-3">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item d-flex border-0 px-0 bg-transparent">
                                        <i class="ri-truck-line"></i>
                                        <span class="fs-6 ms-3">Standard delivery free for orders over Rs.500 Next day
                                            delivery on orders above Rs.1200</span>
                                    </li>
                                </ul>
                            </div>
                            <!-- /Special Offers-->

                        </div>
                    </div>
                    <!-- / Product Info Section-->
                </div>
            </section>
            <!-- / Product Top-->

            <section>

                <!-- Product Tabs-->
                <div class="mt-7 pt-5 border-top">
                    <div class="container">
                        <!-- Tab Nav-->
                        <ul class="nav justify-content-center nav-tabs nav-tabs-border mb-4" id="myTab"
                            role="tablist">
                            <li class="nav-item w-100 mb-2 mb-sm-0 w-sm-auto mx-sm-3" role="presentation">
                                <a class="nav-link fs-5 fw-bolder nav-link-underline mx-sm-3 px-0 active" id="details-tab"
                                    data-bs-toggle="tab" href="#details" role="tab" aria-controls="details"
                                    aria-selected="true">The Details</a>
                            </li>
                            <li class="nav-item w-100 mb-2 mb-sm-0 w-sm-auto mx-sm-3" role="presentation">
                                <a class="nav-link fs-5 fw-bolder nav-link-underline mx-sm-3 px-0" id="reviews-tab"
                                    data-bs-toggle="tab" href="#reviews" role="tab" aria-controls="reviews"
                                    aria-selected="false">Reviews</a>
                            </li>
                            <li class="nav-item w-100 mb-2 mb-sm-0 w-sm-auto mx-sm-3" role="presentation">
                                <a class="nav-link fs-5 fw-bolder nav-link-underline mx-sm-3 px-0" id="delivery-tab"
                                    data-bs-toggle="tab" href="#delivery" role="tab" aria-controls="delivery"
                                    aria-selected="false">Delivery</a>
                            </li>
                            <li class="nav-item w-100 mb-2 mb-sm-0 w-sm-auto mx-sm-3" role="presentation">
                                <a class="nav-link fs-5 fw-bolder nav-link-underline mx-sm-3 px-0" id="returns-tab"
                                    data-bs-toggle="tab" href="#returns" role="tab" aria-controls="returns"
                                    aria-selected="false">Returns</a>
                            </li>
                        </ul>
                        <!-- / Tab Nav-->

                        <!-- Tab Content-->
                        <div class="tab-content" id="myTabContent">

                            <!-- Tab Details Content-->
                            <div class="tab-pane fade show active py-5" id="details" role="tabpanel"
                                aria-labelledby="details-tab">
                                <div class="col-12 col-lg-10 mx-auto">
                                    <div class="row g-5">
                                        <div class="col-12 col-md-6">
                                            <p>Soft, stretchy - the most flattering product of the season! What could be
                                                easier? Beautifully soft and
                                                light cotton-modal jersey, with the extra advantage of stretch, cut in an
                                                A-line - the universally
                                                flattering shape for every body. We promise you, once you've tried these
                                                lovely products - you'll be
                                                hooked..</p>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <ul>
                                                <li>Stretchy cotton-modal jersey stripe</li>
                                                <li>Garment washed</li>
                                                <li>Flat, covered elastic waistband</li>
                                                <li>58% pima cotton/38% viscose </li>
                                                <li>Modal/4% Lycra® elastane</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Tab Details Content-->

                            <!-- Review Tab Content-->
                            <div class="tab-pane fade py-5" id="reviews" role="tabpanel"
                                aria-labelledby="reviews-tab">
                                <!-- Customer Reviews-->
                                <section class="reviews">
                                    <div class="col-lg-12 text-center pb-5">

                                        <h2 class="fs-1 fw-bold d-flex align-items-center justify-content-center">4.88
                                            <small class="text-muted fw-bolder ms-3 fw-bolder fs-6">(1288 reviews)</small>
                                        </h2>
                                        <div class="d-flex justify-content-center">
                                            <!-- Review Stars Medium-->
                                            <div class="rating position-relative d-table">
                                                <div class="position-absolute stars" style="width: 80%">
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


                                        <div class="bg-light rounded py-3 px-4 mt-3 col-12 col-md-6 col-lg-5 mx-auto">
                                            <ul class="list-group list-group-flush">
                                                <li
                                                    class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 bg-transparent">
                                                    <span class="fw-bolder">Fit</span>
                                                    <!-- Review Stars Small-->
                                                    <div class="rating position-relative d-table">
                                                        <div class="position-absolute stars" style="width: 25%">
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
                                                </li>
                                                <li
                                                    class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 bg-transparent">
                                                    <span class="fw-bolder">Value for money</span>
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
                                                </li>
                                                <li
                                                    class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 bg-transparent">
                                                    <span class="fw-bolder">Build quality</span>
                                                    <!-- Review Stars Small-->
                                                    <div class="rating position-relative d-table">
                                                        <div class="position-absolute stars" style="width: 65%">
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
                                                </li>
                                                <li
                                                    class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 bg-transparent">
                                                    <span class="fw-bolder">Style</span>
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
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>

                                        <!-- Review Modal-->
                                        <button type="button"
                                            class="btn btn-dark mt-4 hover-lift-sm hover-boxshadow disable-child-pointer"
                                            data-bs-toggle="offcanvas" data-bs-target="#offcanvasReview"
                                            aria-controls="offcanvasReview">
                                            Write A Review <i class="ri-discuss-line align-bottom ms-1"></i>
                                        </button>
                                        <!-- / Review Modal Button-->

                                    </div>

                                    <!-- Single Review-->
                                    <article class="py-5 border-bottom border-top">
                                        <div class="row">
                                            <div class="col-12 col-md-4">
                                                <small class="text-muted fw-bolder">08/12/2021</small>
                                                <p class="fw-bolder">Ben Sandhu, Ireland</p>
                                                <span class="bg-success-faded fs-xs fw-bolder text-uppercase p-2">Verified
                                                    Customer</span>
                                            </div>
                                            <div class="col-12 col-md-8 mt-4 mt-md-0">
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
                                                </div>
                                                <p class="fw-bolder mt-4">Happy with this considering the price</p>
                                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sit sequi,
                                                    architecto placeat nam officia
                                                    sapiente ipsam at dolorum quisquam, ipsa earum qui laboriosam. Pariatur
                                                    recusandae nihil, architecto
                                                    reprehenderit perferendis obcaecati. Lorem ipsum dolor, sit amet
                                                    consectetur adipisicing elit.
                                                    Distinctio sint nesciunt velit quae, quisquam ullam veritatis itaque
                                                    repudiandae. Inventore quae
                                                    doloribus modi nihil illum accusamus voluptas suscipit neque perferendis
                                                    totam!</p>

                                                <small class="fw-bolder bg-light d-table rounded py-1 px-2">Yes, I would
                                                    recommend the product</small>
                                                <div
                                                    class="d-block d-md-flex mt-3 justify-content-between align-items-center">
                                                    <a href="#"
                                                        class="btn btn-link text-muted p-0 text-decoration-none w-100 w-md-auto fw-bolder text-start"
                                                        title=""><small>Was this review helpful?
                                                            <i class="ri-thumb-up-line ms-4"></i> 112 <i
                                                                class="ri-thumb-down-line ms-2"></i>
                                                            23</small></a>
                                                    <a href="#"
                                                        class="btn btn-link text-muted p-0 text-decoration-none w-100 w-md-auto fw-bolder text-start mt-3 mt-md-0"
                                                        title=""><small>Flag as
                                                            inappropriate <i class="ri-flag-2-line ms-2"></i></small></a>
                                                </div>
                                            </div>
                                        </div>
                                    </article>
                                    <!-- /Single Review-->

                                    <!-- Single Review-->
                                    <article class="py-5 border-bottom ">
                                        <div class="row">
                                            <div class="col-12 col-md-4">
                                                <small class="text-muted fw-bolder">08/12/2021</small>
                                                <p class="fw-bolder">Patricia Smith, London</p>
                                                <span class="bg-success-faded fs-xs fw-bolder text-uppercase p-2">Verified
                                                    Customer</span>
                                            </div>
                                            <div class="col-12 col-md-8 mt-4 mt-md-0">
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
                                                </div>
                                                <p class="fw-bolder mt-4">Very happy with my purchase so far...</p>
                                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sit sequi,
                                                    architecto placeat nam officia
                                                    sapiente ipsam at dolorum quisquam, ipsa earum qui laboriosam. Pariatur
                                                    recusandae nihil, architecto
                                                    reprehenderit perferendis obcaecati. Lorem ipsum dolor, sit amet
                                                    consectetur adipisicing elit.
                                                    Distinctio sint nesciunt velit quae, quisquam ullam veritatis itaque
                                                    repudiandae. Inventore quae
                                                    doloribus modi nihil illum accusamus voluptas suscipit neque perferendis
                                                    totam!</p>

                                                <small class="fw-bolder bg-light d-table rounded py-1 px-2">Yes, I would
                                                    recommend the product</small>
                                                <div
                                                    class="d-block d-md-flex mt-3 justify-content-between align-items-center">
                                                    <a href="#"
                                                        class="btn btn-link text-muted p-0 text-decoration-none w-100 w-md-auto fw-bolder text-start"
                                                        title=""><small>Was this review helpful?
                                                            <i class="ri-thumb-up-line ms-4"></i> 112 <i
                                                                class="ri-thumb-down-line ms-2"></i>
                                                            23</small></a>
                                                    <a href="#"
                                                        class="btn btn-link text-muted p-0 text-decoration-none w-100 w-md-auto fw-bolder text-start mt-3 mt-md-0"
                                                        title=""><small>Flag as
                                                            inappropriate <i class="ri-flag-2-line ms-2"></i></small></a>
                                                </div>
                                            </div>
                                        </div>
                                    </article>
                                    <!-- /Single Review-->

                                    <!-- Single Review-->
                                    <article class="py-5 border-bottom ">
                                        <div class="row">
                                            <div class="col-12 col-md-4">
                                                <small class="text-muted fw-bolder">08/12/2021</small>
                                                <p class="fw-bolder">Jack Jones, Scotland</p>
                                                <span class="bg-success-faded fs-xs fw-bolder text-uppercase p-2">Verified
                                                    Customer</span>
                                            </div>
                                            <div class="col-12 col-md-8 mt-4 mt-md-0">
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
                                                </div>
                                                <p class="fw-bolder mt-4">I wish it was a little cheaper - otherwise love
                                                    this!</p>
                                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sit sequi,
                                                    architecto placeat nam officia
                                                    sapiente ipsam at dolorum quisquam, ipsa earum qui laboriosam. Pariatur
                                                    recusandae nihil, architecto
                                                    reprehenderit perferendis obcaecati. Lorem ipsum dolor, sit amet
                                                    consectetur adipisicing elit.
                                                    Distinctio sint nesciunt velit quae, quisquam ullam veritatis itaque
                                                    repudiandae. Inventore quae
                                                    doloribus modi nihil illum accusamus voluptas suscipit neque perferendis
                                                    totam!</p>

                                                <small class="fw-bolder bg-light d-table rounded py-1 px-2">Yes, I would
                                                    recommend the product</small>
                                                <div
                                                    class="d-block d-md-flex mt-3 justify-content-between align-items-center">
                                                    <a href="#"
                                                        class="btn btn-link text-muted p-0 text-decoration-none w-100 w-md-auto fw-bolder text-start"
                                                        title=""><small>Was this review helpful?
                                                            <i class="ri-thumb-up-line ms-4"></i> 112 <i
                                                                class="ri-thumb-down-line ms-2"></i>
                                                            23</small></a>
                                                    <a href="#"
                                                        class="btn btn-link text-muted p-0 text-decoration-none w-100 w-md-auto fw-bolder text-start mt-3 mt-md-0"
                                                        title=""><small>Flag as
                                                            inappropriate <i class="ri-flag-2-line ms-2"></i></small></a>
                                                </div>
                                            </div>
                                        </div>
                                    </article>
                                    <!-- /Single Review-->


                                    <a href="#"
                                        class="btn btn-dark d-table mx-auto mt-6 mb-3 hover-lift-sm hover-boxshadow"
                                        title="">Load More
                                        Reviews</a>
                                    <p class="text-muted text-center fw-bolder">Showing 3 of 1234</p>

                                </section>
                            </div>
                            <!-- / Review Tab Content-->

                            <!-- Delivery Tab Content-->
                            <div class="tab-pane fade py-5" id="delivery" role="tabpanel"
                                aria-labelledby="delivery-tab">
                                <div class="col-12 col-md-10 col-lg-8 mx-auto">
                                    <p>We are now offering contact-free delivery so that you can still receive your parcels
                                        safely without requiring a
                                        signature. Please see below for the available delivery methods, costs and
                                        timescales.</p>
                                    <ul class="list-group list-group-flush mb-4">
                                        <li
                                            class="list-group-item d-flex justify-content-between align-items-center px-0 py-4 bg-transparent">
                                            <div>
                                                <span class="fw-bolder d-block">Standard Delivery</span>
                                                <span class="text-muted">Delivery within 5 days of placing your
                                                    order.</span>
                                            </div>
                                            <p class="m-0 lh-1 fw-bolder">$12.99</p>
                                        </li>
                                        <li
                                            class="list-group-item d-flex justify-content-between align-items-center px-0 py-4 bg-transparent">
                                            <div>
                                                <span class="fw-bolder d-block">Priority Delivery</span>
                                                <span class="text-muted">Delivery within 2 days of placing your
                                                    order.</span>
                                            </div>
                                            <p class="m-0 lh-1 fw-bolder">$17.99</p>
                                        </li>
                                        <li
                                            class="list-group-item d-flex justify-content-between align-items-center px-0 py-4 bg-transparent">
                                            <div>
                                                <span class="fw-bolder d-block">Next Day Delivery</span>
                                                <span class="text-muted">Delivery within 24 hours of placing your
                                                    order.</span>
                                            </div>
                                            <p class="m-0 lh-1 fw-bolder">$33.99</p>
                                        </li>
                                    </ul>
                                    <div class="bg-light rounded p-3">
                                        <p class="fs-6">Form more information, please see our delivery FAQs <a
                                                href="#">here</a></p>
                                        <p class="m-0 fs-6">If you do not find the answer to your query, please contact our
                                            customer support team on
                                            <b>0800 123 456</b> or email us at <b>support@domain.com</b>. We aim to respond
                                            within 48 hours to queries.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <!-- / Delivery Tab Content-->

                            <!-- Returns Tab Content-->
                            <div class="tab-pane fade py-5" id="returns" role="tabpanel"
                                aria-labelledby="returns-tab">
                                <div class="col-12 col-md-10 col-lg-8 mx-auto">
                                    <p>We believe you will completely happy with your item, however if you aren't, there's
                                        no need to worry. We've
                                        listed below the ways you can return your item to us.</p>
                                    <ul class="list-group list-group-flush mb-4">
                                        <li class="list-group-item px-0 py-4 bg-transparent">
                                            <p class="fw-bolder">Return via post</p>
                                            <p class="fs-6">To return your items for free through the postal system,
                                                please complete the returns form that
                                                comes with your order. You'll find a label at the bottom of the form. Simply
                                                peel the label and head to your
                                                nearest post office.</p>
                                        </li>
                                        <li class="list-group-item px-0 py-4 bg-transparent">
                                            <p class="fw-bolder">Return in person</p>
                                            <p class="fs-6">To return your items for free in person, simply stop into any
                                                one of our locations and speak
                                                to a member of our in-store team.</p>
                                        </li>
                                    </ul>
                                    <div class="bg-light rounded p-3">
                                        <p class="fs-6">Form more information, please see our returns FAQs <a
                                                href="#">here</a></p>
                                        <p class="m-0 fs-6">If you do not find the answer to your query, please contact our
                                            customer support team on
                                            <b>0800 123 456</b> or email us at <b>support@domain.com</b>. We aim to respond
                                            within 48 hours to queries.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <!-- / Returns Tab Content-->

                        </div>
                        <!-- / Tab Content-->
                    </div>
                </div>
                <!-- / Product Tabs-->

            </section>

            <!-- Related Products-->

            <!--/ Related Products-->


            <!-- /Page Content -->
        </section>
    </div>
    @push('scripts')
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <script>
            // CSRF token for Laravel
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            document.addEventListener("DOMContentLoaded", function() {
                const selectSize = document.getElementById('selectSize');
                const addToCartBtn = document.getElementById('addToCartBtn');

                // If Choices.js is already initialized globally, don't re-init
                let choices;
                if (!selectSize.dataset.choicesInit) {
                    choices = new Choices(selectSize);
                    selectSize.dataset.choicesInit = "true";
                }

                function updateCartLink(size) {
                    console.log("Selected size:", size);

                    if (size) {
                        let baseUrl = "{{ url('/add-to-cart/' . $product->id . '/' . $selectedColor->color->id) }}";
                        addToCartBtn.href = baseUrl + '/' + size;
                    } else {
                        addToCartBtn.href = "#";
                    }
                }

                // Choices.js fires "change" on the element
                selectSize.addEventListener('change', function(event) {
                    let size = event.detail && event.detail.value ?
                        event.detail.value :
                        event.target.value;

                    updateCartLink(size);
                });

                // AJAX Add to Cart functionality
                $(document).on('click', '#addToCartBtn', function(e) {
                    e.preventDefault();

                    // Get selected color (fallback to URL color if none selected)
                    let selectedColorId = $('input[name="option-colour"]:checked').data('color-id');
                    if (!selectedColorId) {
                        selectedColorId = {{ $color_id }}; // Use color from URL
                    }

                    // Get selected size
                    const selectedSize = $('#selectSize').val();

                    // Get product ID
                    const productId = {{ $product->id }};

                    // Only validate size since color is always available from URL
                    if (!selectedSize) {
                        showToast('error', 'Please select a size');
                        return;
                    }

                    // Disable button
                    const button = $(this);
                    const originalText = button.text();
                    button.prop('disabled', true).text('Adding...');

                    $.ajax({
                        url: `/add-to-cart/${productId}/${selectedColorId}/${selectedSize}`,
                        method: 'GET',
                        dataType: 'json',
                        success: function(response) {
                            if (response.success) {
                                showToast('success', response.message);

                                // Update cart count in UI
                                if (response.cart_count) {
                                    $('.cart-count').text(response.cart_count);
                                }

                                // Visual feedback
                                button.text('Added ✓').addClass('btn-success').removeClass(
                                    'btn-dark');
                                setTimeout(() => {
                                    button.text(originalText).removeClass('btn-success')
                                        .addClass('btn-dark');
                                }, 2000);
                                setTimeout(() => {
                                    $('#offcanvasbody').load(location.href +
                                        ' #offcanvasbody > *');
                                }, 1000);

                            } else {
                                showToast('error', response.message);
                            }

                        },
                        error: function(xhr, status, error) {
                            let errorMessage = 'Something went wrong. Please try again.';

                            if (xhr.responseJSON && xhr.responseJSON.message) {
                                errorMessage = xhr.responseJSON.message;
                            }

                            showToast('error', errorMessage);
                        },
                        complete: function() {
                            // Re-enable button
                            button.prop('disabled', false);
                            if (!button.hasClass('btn-success')) {
                                button.text(originalText);
                            }
                        }
                    });
                });
            });

            // Color selection functionality
            document.addEventListener('DOMContentLoaded', function() {
                const colorInputs = document.querySelectorAll('.form-check-color-input');
                const selectedOptionSpan = document.querySelector('.selected-option');

                colorInputs.forEach(input => {
                    input.addEventListener('change', function() {
                        selectedOptionSpan.textContent = this.value;

                        let productId = this.dataset.productId;
                        let colorId = this.dataset.colorId;

                        // Redirect with both IDs
                        let url = `/product-details/${productId}/${colorId}`;
                        window.location.href = url;
                    });
                });
            });

            // Toast notification function - Bottom Right Position




            <
            script >
                document.addEventListener("DOMContentLoaded", function() {
                    const selectSize = document.getElementById('selectSize');
                    const addToCartBtn = document.getElementById('addToCartBtn');

                    // If Choices.js is already initialized globally, don't re-init
                    let choices;
                    if (!selectSize.dataset.choicesInit) {
                        choices = new Choices(selectSize);
                        selectSize.dataset.choicesInit = "true";
                    }

                    function updateCartLink(size) {
                        console.log("Selected size:", size);

                        if (size) {
                            let baseUrl = "{{ url('/add-to-cart/' . $product->id . '/' . $selectedColor->color->id) }}";
                            addToCartBtn.href = baseUrl + '/' + size;
                        } else {
                            addToCartBtn.href = "#";
                        }
                    }

                    // Choices.js fires "change" on the element
                    selectSize.addEventListener('change', function(event) {
                        // Try Choices.js format first, fallback to normal select
                        let size = event.detail && event.detail.value ?
                            event.detail.value :
                            event.target.value;

                        updateCartLink(size);
                    });
                });
        </script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const colorInputs = document.querySelectorAll('.form-check-color-input');
                const selectedOptionSpan = document.querySelector('.selected-option');

                colorInputs.forEach(input => {
                    input.addEventListener('change', function() {
                        selectedOptionSpan.textContent = this.value;

                        let productId = this.dataset.productId;
                        let colorId = this.dataset.colorId;

                        // Redirect with both IDs
                        let url = `/product-details/${productId}/${colorId}`;
                        window.location.href = url;
                    });
                });
            });
        </script>


        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const colorInputs = document.querySelectorAll('.form-check-color-input');
                const selectedOptionSpan = document.querySelector('.selected-option');

                colorInputs.forEach(input => {
                    input.addEventListener('change', function() {
                        selectedOptionSpan.textContent = this.value;
                    });
                });
            });
        </script>
    @endpush
    <!-- / Main Section-->
@endsection
