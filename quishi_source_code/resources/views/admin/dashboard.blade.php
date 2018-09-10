@extends('admin.layout.master')
@section('page_specific_css')
@endsection
@section('content')
<div class="pcoded-content">
    <div class="pcoded-inner-content">
        <div class="main-body">
            <div class="page-wrapper">
                <div class="page-body">
                	<div class="row">
						<!-- card1 start -->
						<div class="col-md-6 col-xl-3">
							<div class="card widget-card-1">
								<div class="card-block-small">
									<i class="icofont icofont-users bg-c-blue card1-icon"></i>
									<span class="text-c-blue f-w-600">Total users</span>
									<h4>50K</h4>
								</div>
							</div>
						</div>
						<!-- card1 end -->
						<!-- card1 start -->
						<div class="col-md-6 col-xl-3">
							<div class="card widget-card-1">
								<div class="card-block-small">
									<i class="icofont icofont-question bg-c-pink card1-icon"></i>
									<span class="text-c-pink f-w-600">Total Questions</span>
									<h4>20</h4>
								</div>
							</div>
						</div>
						<!-- card1 end -->
						<!-- card1 start -->
						<div class="col-md-6 col-xl-3">
							<div class="card widget-card-1">
								<div class="card-block-small">
									<i class="icofont icofont-building-alt bg-c-green card1-icon"></i>
									<span class="text-c-green f-w-600">Total Industry</span>
									<h4>98</h4>
								</div>
							</div>
						</div>
						<!-- card1 end -->
						<!-- card1 start -->
						<div class="col-md-6 col-xl-3">
							<div class="card widget-card-1">
								<div class="card-block-small">
									<i class="icofont icofont-users-alt-4 bg-c-yellow card1-icon"></i>
									<span class="text-c-yellow f-w-600">New user for March</span>
									<h4>+562</h4>
								</div>
							</div>
						</div>
						<!-- card1 end -->
						<!--Used tags-->
						<div class="col-md-12 col-xl-4">
							
							<div class="card ">
								<div class="card-header ">
									<div class="card-header-left ">
										<h5>Most used job tags</h5>
									</div>
									
								</div>
								<div class="card-block ">
									<div class="browser-card p-b-15 ">
										<p class="d-inline-block m-0 ">#java</p>
										<button class="btn bg-c-blue btn-round float-right btn-browser ">30K</button>
									</div>
									<div class="browser-card b-t-default p-t-15 p-b-15 ">
										<p class="d-inline-block m-0 ">#Python</p>
										<button class="btn bg-c-pink btn-round float-right btn-browser ">17K</button>
									</div>
									<div class="browser-card b-t-default p-t-15 p-b-15 ">
										<p class="d-inline-block m-0 ">#Angular</p>
										<button class="btn bg-c-yellow btn-round float-right btn-browser ">12K</button>
									</div>
									<div class="browser-card b-t-default p-t-15 p-b-15 ">
										<p class="d-inline-block m-0 ">#DigitalMarketing</p>
										<button class="btn bg-c-green btn-round float-right btn-browser ">5K</button>
									</div>
									<div class="browser-card b-t-default p-t-15 p-b-15 ">
										<p class="d-inline-block m-0 ">#Consultation</p>
										<button class="btn bg-c-yellow btn-round float-right btn-browser ">2K</button>
									</div>
									<div class="browser-card b-t-default p-t-15">
										<p class="d-inline-block m-0 ">#WebDesign</p>
										<button class="btn bg-c-yellow btn-round float-right btn-browser ">1K</button>
									</div>
								</div>
							</div>
						</div>
						<!--Used tags-->
						<!-- Statistics Start -->
						<div class="col-md-12 col-xl-8">
							<div class="card">
								<div class="card-header">
									<h5>User registration ratio</h5>
									<div class="card-header-left ">
									</div>
									
								</div>
								<div class="card-block">
									<div id="statestics-chart" style="height:330px;"></div>
								</div>
							</div>
						</div>
						
						<!-- Statistics End -->
						
					</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('page_specific_js')
	<!-- am chart -->
    <script src="{{ asset('/admin/assets/pages/widget/amchart/amcharts.min.js') }}"></script>
    <script src="{{ asset('/admin/assets/pages/widget/amchart/serial.min.js') }}"></script>
    <!-- Chart js -->
    <script type="text/javascript" src="{{ asset('/admin/bower_components/chart.js/js/Chart.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/admin/assets/pages/dashboard/custom-dashboard.min.js') }}"></script>
@endsection