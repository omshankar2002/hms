@extends('front.layouts.app')

@section('content')
<section class="hero hero-1 bg-overlay bg-overlay-dark-hero">
    <div class="bg-section"> <img src="{{asset ('front-assets/images/hero/1.jpg') }}" alt="background" /></div>
    <div class="container">
      <div class="hero-content">
        <div class="row">
          <div class="col-12 col-lg-5">
            <h2 class="hero-title">Order</h2>
          </div>
        </div>
      </div>
      <!-- End .hero-content-->
    </div>
    <!-- End .container-->
    <div class="breadcrumb-holder">
      <div class="container">
        <ol class="breadcrumb d-flex justify-content-center justify-content-lg-start breadcrumb-light">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item"><a href="javascript:void(0)">Order</a></li>
        </ol>
        <!-- End .breadcrumb-->
      </div>
      <!-- End .container-->
    </div>
    <!-- End .breadcrumb-holder-->
    <div class="divider">
      <div class="bg"></div><a class="scroll-btn" href="#about-2">
        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="12px" height="21px">
          <path fill-rule="evenodd" fill="rgb(255, 255, 255)" d="M11.627,15.787 L6.591,19.792 C6.223,20.084 5.700,20.084 5.333,19.792 L0.297,15.787 C0.152,15.670 0.061,15.522 -0.000,15.362 L-0.000,14.626 C0.036,14.540 0.076,14.452 0.139,14.374 C0.487,13.944 1.121,13.873 1.555,14.217 L5.000,16.959 L5.000,0.021 L7.006,0.021 L7.006,16.862 L7.049,16.859 L10.370,14.217 C10.804,13.873 11.438,13.944 11.785,14.374 C12.132,14.809 12.061,15.440 11.627,15.787 Z"></path>
        </svg></a>
    </div>
    <!-- End .divider-->
</section>

<section class=" section-11 ">
    <div class="container  mt-5">
        <div class="row">
            <div class="col-md-3">
                @include('front.account.common.sidebar')
            </div>
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">
                        <h2 class="h5 mb-0 pt-2 pb-2">My Orders</h2>
                    </div>
                    <div class="card-body p-4">
                        <div class="table-responsive">
                            <table class="table">
                                <thead> 
                                    <tr>
                                        <th>Orders #</th>
                                        <th>Date Purchased</th>
                                        <th>Status</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($orders->isNotEmpty())
                                        @foreach ($orders as $order)
                                        <tr>
                                            <td>
                                                <a href="{{ route('account.orderDetail',$order->id) }}">{{ $order->id }}</a>
                                            </td>
                                            <td>{{  \Carbon\Carbon::parse($order->created_at)->format('d M, Y') }}</td>
                                            <td>
                                                @if ($order->status == 'pending')
                                                <span class="badge bg-danger">Pending</span>      
                                                @elseif ($order->status == 'shipped')
                                                <span class="badge bg-info">Shipped</span>   
                                                @elseif ($order->status == 'delivered')
                                                <span class="badge bg-success">Delivered</span>   
                                                @else
                                                <span class="badge bg-danger">Cancelled</span> 
                                                @endif                                                                                           

                                            </td>
                                            <td>${{ number_format($order->grand_total,2) }}</td>
                                        </tr>   
                                        @endforeach                                               
                                    @else
                                        <tr>
                                            <td colspan="3">Orders not found</td>
                                        </tr>
                                    @endif                                   
                                                                           
                                </tbody>
                            </table>
                        </div>  
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection