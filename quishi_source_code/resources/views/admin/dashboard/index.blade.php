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
									<span class="text-c-blue f-w-600">{{ __('Total users') }}</span>
									<h4>{{quishi_convert_number_to_human_readable($total_user)}}</h4>
								</div>
							</div>
						</div>
						<!-- card1 end -->
						<!-- card1 start -->
						<div class="col-md-6 col-xl-3">
							<div class="card widget-card-1">
								<div class="card-block-small">
									<i class="icofont icofont-question bg-c-pink card1-icon"></i>
									<span class="text-c-pink f-w-600">{{ __('Total Questions') }}</span>
									<h4>{{quishi_convert_number_to_human_readable($total_question)}}</h4>
								</div>
							</div>
						</div>
						<!-- card1 end -->
						<!-- card1 start -->
						<div class="col-md-6 col-xl-3">
							<div class="card widget-card-1">
								<div class="card-block-small">
									<i class="icofont icofont-building-alt bg-c-green card1-icon"></i>
									<span class="text-c-green f-w-600">{{ __('Total Industry') }}</span>
									<h4>{{quishi_convert_number_to_human_readable($total_industry)}}</h4>
								</div>
							</div>
						</div>
						<!-- card1 end -->
						<!-- card1 start -->
						<div class="col-md-6 col-xl-3">
							<div class="card widget-card-1">
								<div class="card-block-small">
									<i class="icofont icofont-users-alt-4 bg-c-yellow card1-icon"></i>
									<span class="text-c-yellow f-w-600">{{ __('New user for '. $date) }}</span>
									<h4>+{{quishi_convert_number_to_human_readable($current_month_registered_users)}}</h4>
								</div>
							</div>
						</div>
						<!-- card1 end -->
						<!--Used tags-->
						<div class="col-md-12 col-xl-4">
							
							<div class="card ">
								<div class="card-header ">
									<div class="card-header-left ">
										<h5>{{ __('Most used job tags') }}</h5>
									</div>
								</div>
								
								<div class="card-block ">
									<?php $i=1;?>
									@foreach($common_tags as $common_tag)
										<div class="browser-card p-b-15 ">
											<p class="d-inline-block m-0 "># {{ucwords($common_tag->title)}}</p>
											<button class="{{ show_tags_color($i)}}">{{quishi_convert_number_to_human_readable($common_tag->tag_number)}}</button>
										</div>
										<?php $i++;?>
									@endforeach
								</div>
							</div>
						</div>
						<!--Used tags-->
						<!-- Statistics Start -->
						<div class="col-md-12 col-xl-8">
							<div class="card">
								<div class="card-header">
									<h5>{{ __('User registration ratio') }}</h5>
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
    <script src="{{ asset('/admin_assets/assets/pages/widget/amchart/amcharts.min.js') }}"></script>
    <script src="{{ asset('/admin_assets/assets/pages/widget/amchart/serial.min.js') }}"></script>
    <!-- Chart js -->
    <script type="text/javascript" src="{{ asset('/admin_assets/bower_components/chart.js/js/Chart.js') }}"></script>
   

    <script>
    	//make the ajax request to the get the result
    	var data = "";
    	$.get("{{route('admin.users.monthlyChart')}}",function(data){
    		if(data.status == "success"){
    			data = data.result;
    			var ctx = document.getElementById("statestics-chart");
	    	var chart = AmCharts.makeChart(ctx, {
	            "type": "serial",
	            "marginTop": 0,
	            "hideCredits": true,
	            "marginRight": 0,
	            "dataProvider":data,
	            "valueAxes": [{
	                "axisAlpha": 0,
	                "dashLength": 6,
	                "gridAlpha": 0.1,
	                "position": "left"
	            }],
	            "graphs": [{
	                "id": "g1",
	                "bullet": "round",
	                "bulletSize": 9,
	                "lineColor": "#4680ff",
	                "lineThickness": 2,
	                "negativeLineColor": "#4680ff",
	                "type": "smoothedLine",
	                "valueField": "value"
	            }],
	            "chartCursor": {
	                "cursorAlpha": 0,
	                "valueLineEnabled": false,
	                "valueLineBalloonEnabled": true,
	                "valueLineAlpha": false,
	                "color": '#fff',
	                "cursorColor": '#FC6180',
	                "fullWidth": true
	            },
	            "categoryField": "year",
	            "categoryAxis": {
	                "gridAlpha": 0,
	                "axisAlpha": 0,
	                // "fillAlpha": 1,
	                // "fillColor": "#FAFAFA",
	                // "minorGridAlpha": 0,
	                // "minorGridEnabled": true
	            },
	            "export": {
	                "enabled": true
	            }
	        });
	    }
	    		
	  }); 
	    	

    	
    </script>
@endsection