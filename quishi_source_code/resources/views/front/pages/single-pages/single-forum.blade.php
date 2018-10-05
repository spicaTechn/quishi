@extends('front.layout.master')
@section('content')
<div class="forum-comment-section">
    <div class="container">
        <div class="forum-title-section forum-comment-title-section">
            <div class="row">
                <div class="col-md-6">
                    <div class="forum-title-bar">
                        <h4>New year new begenning...</h4>
                        <div class="time">1 hour ago</div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="forum-share-bar">
                        <div class="product-share">
                            <div class="sh-title"> <i class="icon-share"></i> Share</div>
                            <div class="show-on-share social-share">
                                <ul>
                                    <li>
                                        <a href="#" target="_blank">
                                            <i class="icon-social-facebook" aria-hidden="true"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" target="_blank">
                                            <i class="icon-social-twitter" aria-hidden="true"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" target="_blank">
                                            <i class="icon-social-linkedin" aria-hidden="true"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" target="_blank">
                                            <i class="icon-social-google" aria-hidden="true"></i>
                                        </a>
                                    </li>

                                    </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- forum-comment-title-section" -->
        <div class="forum-comment-description">
            <div class="clearfix">
                <div class="forum-image-left">
                    <img src="images/blog1.jpg">
                </div>
                <div class="forum-content-right">
                    <h5>Jone Deo</h5>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quam numquam in rem eum perspiciatis ratione voluptatibus, cum, dolorem debitis, dolores id officia sunt quae eos maiores! Laboriosam labore culpa consequuntur.Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consequatur officia accusantium dolor ad. Non veritatis ab obcaecati, earum porro, quia repellendus atque iste velit ex ratione explicabo molestiae quasi fugiat?Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eaque cum soluta necessitatibus perspiciatis magnam ab rem blanditiis porro et, accusamus rerum, repellendus assumenda quisquam non quae minima vero quia quidem!</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptates beatae odit quas laudantium itaque asperiores deserunt. Enim ipsam, facere earum excepturi, nihil, provident obcaecati magni eligendi adipisci maiores dignissimos voluptas.</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quam numquam in rem eum perspiciatis ratione voluptatibus, cum, dolorem debitis, dolores id officia sunt quae eos maiores! Laboriosam labore culpa consequuntur.Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consequatur officia accusantium dolor ad. Non veritatis ab obcaecati, earum porro, quia repellendus atque iste velit ex ratione explicabo molestiae quasi fugiat?Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eaque cum soluta necessitatibus perspiciatis magnam ab rem blanditiis porro et, accusamus rerum, repellendus assumenda quisquam non quae minima vero quia quidem!</p>

                    <div class="btn btn-outline-secondary">Reply</div>
                </div>
            </div>
             <!-- end comment reply -->

            <div class="media-block">
                <div class="media">
                    <img class="mr-3" src="images/blog1.jpg" alt="Generic placeholder image">
                    <div class="media-body">
                        <h5 class="mt-0">Media heading</h5>
                        <p>Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.</p>
                        <div class="reply"><i class="icon-action-undo"></i> Reply</div>
                        <div class="reply-form">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="button-addon2">
                                <div class="input-group-append">
                                    <button class="btn btn-default" type="button">
                                        <i class="icon-cursor"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--End media-block -->

            <div class="media-block">
                <div class="media">
                    <img class="mr-3" src="images/blog1.jpg" alt="Generic placeholder image">
                    <div class="media-body">
                        <h5 class="mt-0">Media heading</h5>
                        <p>Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.</p>
                        <div class="reply"><i class="icon-action-undo"></i> Reply</div>
                        <div class="reply-form">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="button-addon2">
                                <div class="input-group-append">
                                    <button class="btn btn-default" type="button">
                                        <i class="icon-cursor"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--End media-block -->
        </div>
    </div>
</div>
@endsection