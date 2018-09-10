@extends('./front.layout.master')
@section('content')
<div class="about-section">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="about-content-top">
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iusto rem assumenda, </p>
                </div>
                <div class="about-content">
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Excepturi maiores ipsa exercitationem debitis aut unde corporis numquam dicta quibusdam perferendis quaerat eos, natus necessitatibus error expedita at mollitia consequatur, eius.Lorem ipsum dolor sit amet, consectetur adipisicing elit. Assumenda recusandae voluptas, reprehenderit fugiat provident. Dicta veritatis eaque quod quidem, quos, rerum ducimus numquam sapiente eum nam enim quo, esse soluta!</p>
                </div>
                <!-- <div class="about-slogan" style="background: url(images/blog2.jpg) no-repeat;">
                    Motivation is the first step of success
                </div> -->
            </div>
            <div class="col-md-6">
                <div class="about-image">
                    <img src="{{asset('/front')}}/images/career.jpg" alt="career">
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end about section -->
<div class="our-team">
    <div class="container">
        <h2>Our Team</h2>
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <div class="team-section">
                    <img src="{{asset('/front')}}/images/blog2.jpg" alt="">
                    <a href="#" class="link"><i class="icon-link"></i></a>
                    <div class="team-caption">
                        <h4>Royal Zinda</h4>
                        <span>Singer</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="team-section">
                    <img src="{{asset('/front')}}/images/blog1.jpg" alt="">
                    <a href="#" class="link"><i class="icon-link"></i></a>
                    <div class="team-caption">
                        <h4>Royal Zinda</h4>
                        <span>Singer</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="team-section">
                    <img src="{{asset('/front')}}/images/blog2.jpg" alt="">
                    <a href="#" class="link"><i class="icon-link"></i></a>
                    <div class="team-caption">
                        <h4>Royal Zinda</h4>
                        <span>Singer</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="team-section">
                    <img src="{{asset('/front')}}/images/blog1.jpg" alt="">
                    <a href="#" class="link"><i class="icon-link"></i></a>
                    <div class="team-caption">
                        <h4>Royal Zinda</h4>
                        <span>Singer</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
