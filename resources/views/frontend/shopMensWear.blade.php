@extends('layouts.frontend.app')

@section('main-container')
    <!-- Main Section-->
    <style>
        /* Hide native checkbox */
        .form-check-color-input {
            display: none;
        }

        /* Colored box */
        .form-check-label {
            display: inline-block;
            width: 32px;
            height: 32px;
            border-radius: 4px;
            cursor: pointer;
            border: 1px solid #ccc;
            position: relative;
        }

        /* Show tick mark when selected */
        .form-check-color-input:checked+.form-check-label::after {
            content: "✔";
            color: #fff;
            /* always white tick */
            font-size: 18px;
            font-weight: bold;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }
    </style>

    <section class="mt-0">

        <!-- Category Top Banner -->
        <div class="py-6 bg-img-cover bg-dark bg-overlay-gradient-dark position-relative overflow-hidden mb-4 bg-pos-center-center"
            style="background-image:url('/assets/images/banners/banner-1.jpg')">
            <div class="container position-relative z-index-20" data-aos="fade-right" data-aos-delay="300">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item breadcrumb-light"><a href="#">Home</a></li>
                        <li class="breadcrumb-item breadcrumb-light"><a href="#">Activities</a></li>
                        <li class="breadcrumb-item active breadcrumb-light" aria-current="page">Clothing</li>
                    </ol>
                </nav>
                <h1 class="fw-bold display-6 mb-4 text-white">Latest Arrivals (121)</h1>
                <div class="col-12 col-md-6">
                    <p class="lead text-white mb-0">
                        Move, stretch, jump and hike in our latest waterproof arrivals. We've got you covered for your
                        hike or climbing sessions, from Gortex jackets to lightweight waterproof pants. Discover our
                        latest range of outdoor clothing.
                    </p>
                </div>
            </div>
        </div>
        <!-- Category Top Banner -->

        <div class="container">

            <div class="row">

                <!-- Category Aside/Sidebar -->
                <div class="d-none d-lg-flex col-lg-3">
                    <div class="pe-4">
                        <!-- Category Aside -->
                        <aside>

                            <!-- Filter Category -->
                            <div class="mb-4">
                                {{-- {{ dd($categorydata); }} --}}
                                <h2 class="mb-4 fs-6 mt-2 fw-bolder">Product Categories</h2>
                                <nav>
                                    <ul id='categorynames' class="list-unstyled list-default-text">
                                        @foreach ($categorydata as $category)
                                            <li class="mb-2"><a
                                                    class="text-decoration-none text-body text-secondary-hover transition-all d-flex justify-content-between align-items-center"
                                                    data-id="{{ $category->id }}"
                                                    onclick="loadProducts({{ $category->id }})"><span><i
                                                            class="ri-arrow-right-s-line align-bottom ms-n1"></i>
                                                        {{ $category->name }}</span> <span
                                                        class="text-muted ms-4">({{ $category->products->count() }})
                                                    </span></a>
                                            </li>
                                        @endforeach
                                        <li class="mb-2" id="">
                                            <a href="{{ route('product.list') }}"
                                                class="text-decoration-none text-body text-secondary-hover transition-all d-flex justify-content-between align-items-center">Show
                                                All</a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                            <!-- / Filter Category-->

                            <!-- Price Filter -->
                            {{-- <div class="py-4 widget-filter widget-filter-price border-top">
                                <a class="small text-body text-decoration-none text-secondary-hover transition-all transition-all fs-6 fw-bolder d-block collapse-icon-chevron"
                                    data-bs-toggle="collapse" href="#filter-price" role="button" aria-expanded="true"
                                    aria-controls="filter-price">
                                    Price
                                </a>
                                <div id="filter-price" class="collapse show">
                                    <div class="filter-price mt-6"></div>
                                    <div class="d-flex justify-content-between align-items-center mt-7">
                                        <div class="input-group mb-0 me-2 border">
                                            <span
                                                class="input-group-text bg-transparent fs-7 p-2 text-muted border-0">$</span>
                                            <input type="number" min="00" max="1000" step="1"
                                                class="filter-min form-control-sm border flex-grow-1 text-muted border-0">
                                        </div>
                                        <div class="input-group mb-0 ms-2 border">
                                            <span
                                                class="input-group-text bg-transparent fs-7 p-2 text-muted border-0">$</span>
                                            <input type="number" min="00" max="1000" step="1"
                                                class="filter-max form-control-sm flex-grow-1 text-muted border-0">
                                        </div>
                                    </div>
                                </div>
                            </div> --}}
                            <!-- / Price Filter -->

                            <!-- Brands Filter -->
                            {{-- <div class="py-4 widget-filter border-top">
                                <a class="small text-body text-decoration-none text-secondary-hover transition-all transition-all fs-6 fw-bolder d-block collapse-icon-chevron"
                                    data-bs-toggle="collapse" href="#filter-brands" role="button" aria-expanded="true"
                                    aria-controls="filter-brands">
                                    Brands
                                </a>
                                <div id="filter-brands" class="collapse show">
                                    <div class="input-group my-3 py-1">
                                        <input type="text" class="form-control py-2 filter-search rounded"
                                            placeholder="Search" aria-label="Search">
                                        <span
                                            class="input-group-text bg-transparent px-2 position-absolute top-7 end-0 border-0 z-index-20"><i
                                                class="ri-search-2-line text-muted"></i></span>
                                    </div>
                                    <div class="simplebar-wrapper">
                                        <div class="filter-options" data-pixr-simplebar>
                                            <div class="form-group form-check mb-0">
                                                <input type="checkbox" class="form-check-input" id="filter-brand-0">
                                                <label
                                                    class="form-check-label fw-normal text-body flex-grow-1 d-flex justify-content-between"
                                                    for="filter-brand-0">Adidas <span class="text-muted">(21)</span></label>
                                            </div>
                                            <div class="form-group form-check mb-0">
                                                <input type="checkbox" class="form-check-input" id="filter-brand-1">
                                                <label
                                                    class="form-check-label fw-normal text-body flex-grow-1 d-flex justify-content-between"
                                                    for="filter-brand-1">Asics <span class="text-muted">(13)</span></label>
                                            </div>
                                            <div class="form-group form-check mb-0">
                                                <input type="checkbox" class="form-check-input" id="filter-brand-2">
                                                <label
                                                    class="form-check-label fw-normal text-body flex-grow-1 d-flex justify-content-between"
                                                    for="filter-brand-2">Canterbury <span
                                                        class="text-muted">(18)</span></label>
                                            </div>
                                            <div class="form-group form-check mb-0">
                                                <input type="checkbox" class="form-check-input" id="filter-brand-3">
                                                <label
                                                    class="form-check-label fw-normal text-body flex-grow-1 d-flex justify-content-between"
                                                    for="filter-brand-3">Converse <span
                                                        class="text-muted">(25)</span></label>
                                            </div>
                                            <div class="form-group form-check mb-0">
                                                <input type="checkbox" class="form-check-input" id="filter-brand-4">
                                                <label
                                                    class="form-check-label fw-normal text-body flex-grow-1 d-flex justify-content-between"
                                                    for="filter-brand-4">Donnay <span
                                                        class="text-muted">(11)</span></label>
                                            </div>
                                            <div class="form-group form-check mb-0">
                                                <input type="checkbox" class="form-check-input" id="filter-brand-5">
                                                <label
                                                    class="form-check-label fw-normal text-body flex-grow-1 d-flex justify-content-between"
                                                    for="filter-brand-5">Nike <span class="text-muted">(19)</span></label>
                                            </div>
                                            <div class="form-group form-check mb-0">
                                                <input type="checkbox" class="form-check-input" id="filter-brand-6">
                                                <label
                                                    class="form-check-label fw-normal text-body flex-grow-1 d-flex justify-content-between"
                                                    for="filter-brand-6">Millet <span
                                                        class="text-muted">(24)</span></label>
                                            </div>
                                            <div class="form-group form-check mb-0">
                                                <input type="checkbox" class="form-check-input" id="filter-brand-7">
                                                <label
                                                    class="form-check-label fw-normal text-body flex-grow-1 d-flex justify-content-between"
                                                    for="filter-brand-7">Puma <span class="text-muted">(11)</span></label>
                                            </div>
                                            <div class="form-group form-check mb-0">
                                                <input type="checkbox" class="form-check-input" id="filter-brand-8">
                                                <label
                                                    class="form-check-label fw-normal text-body flex-grow-1 d-flex justify-content-between"
                                                    for="filter-brand-8">Reebok <span
                                                        class="text-muted">(19)</span></label>
                                            </div>
                                            <div class="form-group form-check mb-0">
                                                <input type="checkbox" class="form-check-input" id="filter-brand-9">
                                                <label
                                                    class="form-check-label fw-normal text-body flex-grow-1 d-flex justify-content-between"
                                                    for="filter-brand-9">Under Armour <span
                                                        class="text-muted">(24)</span></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}
                            <!-- / Brands Filter -->

                            <!-- Type Filter -->
                            {{-- <div class="py-4 widget-filter border-top">
                                <a class="small text-body text-decoration-none text-secondary-hover transition-all transition-all fs-6 fw-bolder d-block collapse-icon-chevron"
                                    data-bs-toggle="collapse" href="#filter-type" role="button" aria-expanded="true"
                                    aria-controls="filter-type">
                                    Type
                                </a>
                                <div id="filter-type" class="collapse show">
                                    <div class="input-group my-3 py-1">
                                        <input type="text" class="form-control py-2 filter-search rounded"
                                            placeholder="Search" aria-label="Search">
                                        <span
                                            class="input-group-text bg-transparent px-2 position-absolute top-7 end-0 border-0 z-index-20"><i
                                                class="ri-search-2-line text-muted"></i></span>
                                    </div>
                                    <div class="filter-options">
                                        @foreach ($producttype as $type)
                                            <div class="form-group form-check mb-0">
                                                <input type="checkbox" class="form-check-input" id="filter-type-0">
                                                <label
                                                    class="form-check-label fw-normal text-body flex-grow-1 d-flex justify-content-between"
                                                    for="filter-type-0">{{ $type->name }}</label>
                                            </div>
                                        @endforeach
                                    


                                    </div>
                                </div>
                            </div> --}}
                            <!-- / Type Filter -->

                            <!-- Sizes Filter -->
                            {{-- @php
                                $sizes = [
                                    'UK 1',
                                    'UK 2',
                                    'UK 3',
                                    'UK 4',
                                    'UK 5',
                                    'UK 6',
                                    'UK 7',
                                    'UK 8',
                                    'UK 9',
                                    'UK 10',
                                    'UK 11',
                                    'UK 12',
                                    '24 (2-3 years)',
                                    '26 (4-5 years)',
                                    '28 (6-7 years)',
                                    '30 (8-9 years)',
                                    '32 (10-11 years)',
                                    '34 (12-13 years)',
                                    'S',
                                    'M',
                                    'L',
                                    'XL',
                                    'XXL',
                                    'XXXL',
                                    'FS',
                                    '6 Oz',
                                    '8 Oz',
                                    '10 Oz',
                                    '12 Oz',
                                    '14 Oz',
                                    '16 Oz',
                                    '4 mm',
                                    '6 mm',
                                    '8 mm',
                                    '10 mm',
                                ];
                            @endphp
                            <div class="py-4 widget-filter border-top">
                                <a class="small text-body text-decoration-none text-secondary-hover transition-all fs-6 fw-bolder d-block collapse-icon-chevron"
                                    data-bs-toggle="collapse" href="#filter-sizes" role="button" aria-expanded="true"
                                    aria-controls="filter-sizes">
                                    Sizes
                                </a>
                                <div id="filter-sizes" class="collapse show">
                                    <div class="filter-options mt-3">
                                        @foreach ($sizes as $index => $size)
                                            <div class="form-group d-inline-block mr-2 mb-2">
                                                <input type="checkbox" class="form-check-input"
                                                    id="size-{{ $index }}">
                                                <label class="form-check-label form-check-size"
                                                    for="size-{{ $index }}">
                                                    {{ $size }}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div> --}}

                            <!-- / Sizes Filter -->

                            <!-- Colour Filter -->
                            <div class="py-4 widget-filter border-top">
                                <a class="small text-body text-decoration-none text-secondary-hover transition-all fs-6 fw-bolder d-block collapse-icon-chevron"
                                    data-bs-toggle="collapse" href="#filter-colour" role="button" aria-expanded="true"
                                    aria-controls="filter-colour">
                                    Colour
                                </a>
                                <div id="filter-colour" class="collapse show">
                                    <div class="filter-options mt-3">
                                        @foreach ($colordata as $data)
                                            <div class="form-group d-inline-block mr-1 mb-1">
                                                <input type="checkbox" class="form-check-color-input"
                                                    id="filter-colours-{{ $data->id }}" name="color_ids[]"
                                                    value="{{ $data->id }}" onchange="getFilteredProducts()">

                                                <label class="form-check-label" for="filter-colours-{{ $data->id }}"
                                                    style="background-color: {{ $data->colorCode }};">
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <!-- / Colour Filter -->

                        </aside>
                        <!-- / Category Aside-->
                    </div>
                </div>
                <!-- / Category Aside/Sidebar -->

                <!-- Category Products-->
                <div class="col-12 col-lg-9">

                    <!-- Top Toolbar-->
                    {{-- <div class="mb-4 d-md-flex justify-content-between align-items-center">
                        <div class="d-flex justify-content-start align-items-center flex-grow-1 mb-4 mb-md-0">
                            <small class="d-inline-block fw-bolder">Filtered by:</small>
                            <ul class="list-unstyled d-inline-block mb-0 ms-2">
                                <li class="bg-light py-1 fw-bolder px-2 cursor-pointer d-inline-block me-1 small">Type:
                                    Slip On <i class="ri-close-circle-line align-bottom ms-1"></i></li>
                            </ul>
                            <span
                                class="fw-bolder text-muted-hover text-decoration-underline ms-2 cursor-pointer small">Clear
                                All</span>
                        </div>
                        <div class="d-flex align-items-center flex-column flex-md-row">
                            <!-- Filter Trigger-->
                            <button
                                class="btn bg-light p-3 d-flex d-lg-none align-items-center fs-xs fw-bold text-uppercase w-100 mb-2 mb-md-0 w-md-auto"
                                type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasFilters"
                                aria-controls="offcanvasFilters">
                                <i class="ri-equalizer-line me-2"></i> Filters
                            </button>
                            <!-- / Filter Trigger-->
                            <div class="dropdown ms-md-2 lh-1 p-3 bg-light w-100 mb-2 mb-md-0 w-md-auto">
                                <p class="fs-xs fw-bold text-uppercase text-muted-hover p-0 m-0" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">Sort By <i
                                        class="ri-arrow-drop-down-line ri-lg align-bottom"></i></p>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item fs-xs fw-bold text-uppercase text-muted-hover mb-2"
                                            href="#">Price: Hi Low</a></li>
                                    <li><a class="dropdown-item fs-xs fw-bold text-uppercase text-muted-hover mb-2"
                                            href="#">Price: Low Hi</a></li>
                                    <li><a class="dropdown-item fs-xs fw-bold text-uppercase text-muted-hover mb-2"
                                            href="#">Name</a></li>
                                </ul>
                            </div>
                        </div>
                    </div> <!-- / Top Toolbar--> --}}

                    <!-- Products-->
                    <div class="row g-4 mb-5" id='product-list'>
                        @foreach ($menswear as $menswear)
                            <div class="col-12 col-sm-6 col-md-4">
                                <!-- Card Product-->
                                <div class="card position-relative h-100 card-listing hover-trigger">
                                    <div class="card-header">
                                        @php

                                            $img = $menswear->firstVariantImage?->name;
                                            $imgPath =
                                                $img && file_exists(public_path('variantThumbnail/' . $img))
                                                    ? url('variantThumbnail/' . $img)
                                                    : asset('images/no-image.jpg');

                                        @endphp

                                        <picture class="position-relative overflow-hidden d-block bg-light">
                                            <img class="w-100 img-fluid position-relative z-index-10"
                                                src="{{ $imgPath }}">
                                        </picture>
                                        <div class="card-actions" id="quickadd">
                                            <button type="button" class="btn btn-link p-0 quickadd-btn"
                                                data-product-id="{{ $menswear->id }}">
                                                <span
                                                    class="small text-uppercase tracking-wide fw-bolder text-center d-block">
                                                    Quick Add
                                                </span>
                                            </button>
                                        </div>
                                        {{-- <div class="card-actions">
                                            <span
                                                class="small text-uppercase tracking-wide fw-bolder text-center d-block">Quick
                                                Add</span>
                                        </div> --}}
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
                                        <a class="mb-0 mx-2 mx-md-4 fs-p  text-decoration-none d-block text-center"
                                            href="{{ route('product.details', ['product_id' => $menswear->id, 'color_id' => $menswear->firstVariant->color_id]) }}">
                                            {{ $menswear->firstVariant?->name }}</a>
                                        <p class="lead fw-bolder m-0 fs-3 lh-1 text-danger me-2">Rs.
                                            {{ $menswear->firstVariant?->price - $menswear->firstVariant?->discountedPrice }}
                                        </p>
                                        <s class="lh-1 me-2"><span class="fw-bolder m-0">Rs.
                                                {{ $menswear->firstVariant?->price }}</span></s>
                                        (<span>{{ $menswear->firstVariant?->discount }}% off</span>)
                                        <p class="lead fw-bolder m-0 fs-6 lh-1 text-success">Save Rs.
                                            {{ $menswear->firstVariant?->discountedPrice }}</p>
                                    </div>
                                </div>
                                <!--/ Card Product-->
                            </div>
                        @endforeach
                    </div>
                    <div class="modal fade" id="addedToCartModal" tabindex="-1" aria-labelledby="addedToCartModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="addedToCartModalLabel">Select Variant & Add to Cart</h5>
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

                                            <button id="add-to-cart-btn" class="btn btn-primary mt-2">Add to Cart</button>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    {{-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Continue
                                        Shopping</button> --}}
                                    <a href="{{ route('cart.page') }}" class="btn btn-success">Go to Cart</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- / Products-->

                    <!-- Pagiation-->
                    <!-- Pagination-->
                    <nav class="border-top mt-5 pt-5 d-flex justify-content-between align-items-center"
                        aria-label="Category Pagination">
                        <ul class="pagination">
                            {{-- <div class="mt-4">
                                {{ $menswear->links('pagination::bootstrap-5') }}
                            </div> --}}
                        </ul>
                    </nav> <!-- / Pagination-->

                    <!-- Related Categories-->
                    {{-- <div class="border-top mt-5 pt-5">
                        <p class="lead fw-bolder">Related Categories</p>
                        <div class="d-flex flex-wrap justify-content-start align-items-center">
                            <a class="btn btn-sm btn-outline-dark rounded-pill me-2 mb-2 mb-md-0 text-white-hover"
                                href="#">Hiking
                                Shoes</a>
                            <a class="btn btn-sm btn-outline-dark rounded-pill me-2 mb-2 mb-md-0 text-white-hover"
                                href="#">Waterproof Trousers</a>
                            <a class="btn btn-sm btn-outline-dark rounded-pill me-2 mb-2 mb-md-0 text-white-hover"
                                href="#">Hiking
                                Shirts</a>
                            <a class="btn btn-sm btn-outline-dark rounded-pill me-2 mb-2 mb-md-0 text-white-hover"
                                href="#">Jackets</a>
                            <a class="btn btn-sm btn-outline-dark rounded-pill me-2 mb-2 mb-md-0 text-white-hover"
                                href="#">Gilets</a>
                            <a class="btn btn-sm btn-outline-dark rounded-pill me-2 mb-2 mb-md-0 text-white-hover"
                                href="#">Hiking
                                Socks</a>
                            <a class="btn btn-sm btn-outline-dark rounded-pill me-2 mb-2 mb-md-0 text-white-hover"
                                href="#">Rugsacks</a>
                        </div>
                    </div> --}}
                    <!-- Related Categories-->

                </div>
                <!-- / Category Products-->

            </div>
        </div>

    </section>

    <!-- / Main Section-->
@endsection
@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

    {{-- <script>
        // CSRF token for Laravel
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // Quick Add AJAX function
        $(document).on('click', '.quickadd-btn', function(e) {
            e.preventDefault();

            const productId = $(this).data('product-id');
            const button = $(this);

            // Disable button to prevent double clicks
            button.prop('disabled', true);
            button.find('span').text('Adding...');

            $.ajax({
                url: `/quick-add/${productId}`, // Adjust this URL to match your route
                method: 'get',
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        showToast('success', response.message);

                        // Optional: Update cart count in UI
                        if (response.cart_count) {
                            $('.cart-count').text(response.cart_count);
                        }
                        setTimeout(() => {
                            $('#offcanvasbody').load(location.href + ' #offcanvasbody > *');
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
                    button.find('span').text('Quick Add');
                }
            });
        });

        // Toast notification function
        // Toast notification function - Bottom Right Position
        function showToast(type, message) {
            // Remove existing toasts
            $('.toast').remove();

            const toastClass = type === 'success' ? 'toast-success' : 'toast-error';
            const bgClass = type === 'success' ? 'bg-success' : 'bg-danger';

            const toastHtml = `
        <div class="toast ${toastClass} position-fixed bottom-0 end-0 m-3" role="alert" style="z-index: 9999;">
            <div class="toast-header ${bgClass} text-white">
                <strong class="me-auto">
                    ${type === 'success' ? '✓ Success' : '✗ Error'}
                </strong>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast"></button>
            </div>
            <div class="toast-body">
                ${message}
            </div>
        </div>
    `;

            $('body').append(toastHtml);

            // Show toast
            $('.toast').toast('show');

            // Auto remove after 3 seconds
            setTimeout(() => {
                $('.toast').toast('hide');
            }, 3000);
        }
    </script> --}}

    <script>
        $(document).ready(function() {
            let selectedColor = null;
            let selectedSize = null;
            let productId = null;

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

                            // Fill color options with price data
                            $('#variant-colors').empty();
                            if (product.variants && product.variants.length > 0) {
                                product.variants.forEach(function(variant) {
                                    $('#variant-colors').append(`
                                <div class="color-option" 
                                    data-color-id="${variant.color_id}" 
                                    data-color-name="${variant.color_name}" 
                                    data-color-code="${variant.color_code}" 
                                    data-price="${variant.price}"
                                    data-discount="${variant.discount}"
                                    data-actualprice="${variant.actualprice}"
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

            // Updated color option click handler with price change
            $(document).on('click', '.color-option', function() {
                selectedColor = $(this).data('color-id');
                let image = $(this).data('image');
                let price = $(this).data('price'); // Get price for this color
                let discount = $(this).data('discount'); // Get discount for this color
                let actualPrice = $(this).data('actualprice'); // Get actual price for this color
                let sizes = JSON.parse($(this).attr('data-sizes'));

                // Update image
                $('#modal-product-image').attr('src', image);

                // Update price information dynamically
                $('#modal-product-price').text("₹: " + price);
                $('#modal-product-discount').text("Discount: " + discount + "%");
                $('#modal-product-actualprice').text("₹" + actualPrice);

                // Update size options
                $('#variant-size').empty().append('<option value="">Select size</option>');
                sizes.forEach(function(size) {
                    $('#variant-size').append(`<option value="${size}">${size}</option>`);
                });

                if (sizes.length > 0) {
                    $('#variant-size').val(sizes[0]).trigger('change');
                }

                // Update visual selection
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
    </script>


    <script>
        function loadProducts(categoryId) {
            console.log('function hit');
            $.ajax({
                url: "/product-list/get-filtered-products/" + categoryId,
                type: "GET",
                success: function(response) {
                    $("#product-list").html(response.html);
                },
                error: function() {
                    $("#product-list").html('<div class="alert alert-danger">Something went wrong</div>');
                }
            });
        }
    </script>
    <script>
        function getFilteredProducts() {
            let selectedColorIds = [];
            $('.form-check-color-input:checked').each(function() {
                selectedColorIds.push($(this).val());
            });

            $.ajax({
                url: "/product-list/get-color-filtered-products",
                type: "GET",
                data: {
                    color_ids: selectedColorIds
                },
                success: function(response) {
                    $("#product-list").html(response.html);
                },
                error: function() {
                    $("#product-list").html('<div class="alert alert-danger">Something went wrong</div>');
                }
            });
        }
    </script>
@endpush
