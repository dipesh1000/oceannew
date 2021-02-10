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
                  <a href="{{ URL::to('/userdashboard') }}"> Home </a>
                </li>
                <li>/</li>
                <li class="active">
                  <a href="">
                    <span>Payment History</span>
                  </a>
                </li>
              </ul>
            </div>
          </div>
            <div class="course_container">  
                <div class="row">
                    <div class="col-lg-12">
                        <div class="allcourses-content">
                            <table class="table">
                                <thead>
                                  <tr>
                                    <th scope="col">Date</th>
                                    <th scope="col">Invoice No</th>
                                    <th scope="col">Course</th>
                                    <th scope="col">Amount</th>
                                    <th scope="col">Payment Method</th>
                                    <th scope="col">Action</th>
                                  </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users_order as $orderItem)
                                    <tr>
                                      <th scope="row">{{ date('d-m-Y', strtotime( $orderDate )) }}</th>
                                      <td>{{ $orderItem->invoice_no }}</td>
                                      <td>{{ $courseTitle }}</td>
                                      <td>{{ $orderItem->grandTotal }}</td>
                                      <td>{{ $orderItem->payment_method }}</td>
                                      <td>
                                          <button type="button" class="btn btn-outline-dark btn-sm" title="print invoice"><i class="fa fa-print"></i></button>
                                          <button type="button" class="btn btn-outline-dark btn-sm" title="view"><i class="fa fa-eye"></i></button>
                                          <button type="button" class="btn btn-outline-dark btn-sm" title="download"><i class="fa fa-download"></i></button>
                                      </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                              </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection