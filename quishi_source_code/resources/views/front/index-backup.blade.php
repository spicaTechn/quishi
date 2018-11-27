<!-- trending-profiles -->
<div class="page-section about-section">
    <div class="container">
        <div class="row">
            @foreach($services as $service)
             @foreach($service->page_detail as $service_icon)
                <div class="col-md-4">
                    <div class="about-inner-section">
                        <div class="about-icon-section">
                            <img src="{{asset('/front')}}/images/pages/{{ $service_icon['meta_value'] }}" alt="expert">
                        </div>
                        <div class="about-content-section">
                            <h4>{{ $service->title }}</h4>
                            <p>{{ $service->content }}</p>
                            <a href="#">{{ __('More about our experts') }} <i class="icon-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
             @endforeach
            @endforeach

        </div>
    </div>
</div>
<!-- end about section -->