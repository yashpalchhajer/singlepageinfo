@extends('layouts.master')
@section('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap.min.css" />
@endsection
@section('content-header')
<h1>
  Dashboard
</h1>
<ol class="breadcrumb">
  <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
</ol>
@endsection

@section('content')
<div class="col-md-12">
  <div class="row">
    <div class="panel panel-default">
      <div class="panel panel-body">
        <!-- Info boxes -->
        <div class="row">
          <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
              <span class="info-box-icon bg-aqua">
                <i class="fa fa-eye"></i>
              </span>
              <div class="info-box-content">
                <span class="info-box-text">Visitors</span>
                <span class="info-box-number" id="totalVisitors"></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
              <span class="info-box-icon bg-red"><i class="fa fa-newspaper-o"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Subcribers</span>
                <span class="info-box-number" id="totalSubscribers"></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

          <!-- fix for small devices only -->
          <div class="clearfix visible-sm-block"></div>

          <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
              <span class="info-box-icon bg-green"><i class=" fa fa-question"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Total Enquiries</span>
                <span class="info-box-number" id="totalEnquiries"></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
              <span class="info-box-icon bg-yellow"><i class="fa fa-mail-reply"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Total Replies</span>
                <span class="info-box-number" id="totalReplies"></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
        </div>
        <!-- ./row -->

        <!-- .row for Graphs -->
        <div class="row">
          <div class="col-md-12">
            <div id="enquiryGraph"></div>
          </div>
        </div>
        <!-- /.row -->
      </div>
    </div>
  </div>
</div>


@endsection

@section('scripts')
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="{{asset('js/dashboard.js')}}"></script>
<script>
var baseUrl = '{{ env('APP_URL') }}';
</script>
@endsection