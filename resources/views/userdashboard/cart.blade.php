@extends('frontend.layouts.app')
@section('content')
<div id="savedcourses_page">
    <div class="row no-gutters">
      @include('userdashboard.partials.side-nav')
      <div class="col-md-8 col-lg-9">
        <div class="savedcourses_content">
            <div class="d_breadcrumb">
              <ul>
                <li>
                  <a href=""> Home </a>
                </li>
                <li>/</li>
                <li class="active">
                  <a href="saved-courses.html">
                    <span>Saved Courses</span>
                  </a>
                </li>
              </ul>
            </div>
          </div>
        <div class="course_container">
          <div class="row">
            <div class="col-lg-12">
              <div class="savedcourses-content">
                @php
                    $total = 0;
                @endphp
                @if (Cart::instance('default')->count())
                <div class="row">
                    <div
                      class="col-lg-9 order-lg-1 order-md-12 order-sm-12 order-2"
                    >
                    @foreach ($courses as $cartContent)
                    @php
                        $total += $cartContent->offer_price
                    @endphp
                    <div class="saved-courses-list">
                      <div class="row">
                        <div class="col-lg-2">
                          <div class="course-image">
                          <img src="{{ $cartContent->image }}" />
                          </div>
                        </div>
                        <div class="col-lg-6">
                          <div class="course-details">
                            <div class="course-title">
                            <strong>{{ $cartContent->title }}</strong>
                            </div>
                            {{-- <div class="course-subtitle">
                                {{ $details['description'] }}
                            </div> --}}
                          </div>
                        </div>
                        <div class="col-lg-2">
                          <div class="course-add-remove">
                            {{-- <button class="add-to-cart-button">Add</button> --}}

                          <button class="remove-from-cart-button remove-from-cart" data-id="{{ $cartContent->cartId }}">
                            Remove
                          </button>

                          </div>
                        </div>
                        <div class="col-lg-2">
                          <div class="course-price">
                            <strong>Rs.{{ $cartContent->offer_price }}</strong>
                            <s>Rs. {{ $cartContent->price }}</s> 
                          </div>
                        </div>
                      </div>
                    </div>
                    @endforeach
                    </div>
                    <div
                      class="col-lg-3 order-lg-12 order-md-1 order-sm-1 order-1"
                    >
                      <div class="total-checkout-price-section">
                        Total
                        <p class="total-price">Rs.{{ $total }} /-</p>
                        <button class="checkout-button checkout" data-total="{{ $total }}">Checkout</button>
                      </div>
                    </div>
                  </div>
                @endif
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
@section('scripts')
  <script type="text/javascript">
    $('.remove-from-cart').click(function (e) {
        e.preventDefault();

        var ele = $(this);
        if(confirm("Are You Sure")) {
            $.ajax({
                url: '{{ url('remove-from-cart') }}',
                method: 'DELETE',
                data: {_token: '{{ csrf_token() }}', id: ele.attr('data-id')},
                success: function(response) {
                    console.log(response)
                    window.location.reload();
                }
            })
        }
    })
    // Order Store Request
    $(document).on("click", ".checkout", function (e) {
            e.preventDefault();
            var $this = $(this);
            var price = $this.attr('data-total');
            // alert($price);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "POST",
                url: "{{ route('checkout.store')  }}",
                data: {
                    price: price
                },
                beforeSend: function () {
                    $this.prop('disabled', true);
                },
                success: function (data) {
                  if (data.status) {
                    swal(data.status, data.message, "success");
                  }
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    console.log(thrownError);
                },
                complete: function () {
                    // location.reload();
                }
            });

        });
  </script>
@endsection

