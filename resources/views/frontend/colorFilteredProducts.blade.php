@if ($products->isEmpty())
    <div class="alert alert-warning text-center my-4">
        No products found with this filter.
    </div>
@else
    <div class="row g-4 mb-5">
        @foreach ($products as $product)
            <div class="col-12 col-sm-6 col-md-4">
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
                            <img class="w-100 img-fluid position-relative z-index-10" src="{{ $imgPath }}">
                        </picture>
                        <div class="card-actions" id="quickadd">
                            <button type="button" class="btn btn-link p-0 quickadd-btn"
                                data-product-id="{{ $product->id }}">
                                <span class="small text-uppercase tracking-wide fw-bolder text-center d-block">
                                    Quick Add
                                </span>
                            </button>
                        </div>
                        {{-- card actions --}}
                        {{-- <div class="card-actions">
                            <span class="small text-uppercase tracking-wide fw-bolder text-center d-block">
                                Quick Add
                            </span>
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
                            </div>
                            <span class="small fw-bolder ms-2 text-muted"> 4.7 (456)</span>
                        </div>

                        <a class="mb-0 mx-2 mx-md-4 fs-p  text-decoration-none d-block text-center"
                            href="{{ route('product.details', ['product_id' => $product->id, 'color_id' => $product->firstVariant?->color_id]) }}">
                            {{ $product->name }}
                        </a>

                        <p class="lead fw-bolder m-0 fs-3 lh-1 text-danger me-2">
                            Rs. {{ $product->firstVariant?->price - $product->firstVariant?->discountedPrice }}
                        </p>
                        <s class="lh-1 me-2">
                            <span class="fw-bolder m-0">
                                Rs. {{ $product->firstVariant?->price }}
                            </span>
                        </s>
                        (<span>{{ $product->firstVariant?->discount }}% off</span>)
                        <p class="lead fw-bolder m-0 fs-6 lh-1 text-success">
                            Save Rs. {{ $product->firstVariant?->discountedPrice }}
                        </p>
                    </div>
                </div>
                <!--/ Card Product-->
            </div>
        @endforeach
        @push('scripts')
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script>
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
            </script>
        @endpush
    </div>
@endif
