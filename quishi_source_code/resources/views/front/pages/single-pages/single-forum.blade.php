@extends('front.layout.master') @section('content') @section('page_specific_css')
<!-- Load the sweetalert css -->
<link rel="stylesheet" type="text/css" href="{{ asset('/admin_assets/bower_components/sweetalert/css/sweetalert.css') }}">
<!-- Load the formvalidation css -->
<link rel="stylesheet" type="text/css" href="{{ asset('/admin_assets/bower_components/formvalidation/formValidation.min.css') }}"> @endsection
<div class="forum-comment-section">
    <div class="container">
        <div class="forum-title-section forum-comment-title-section">
            <div class="row">
                <div class="col-md-6">
                    <div class="top-forum-user">
                        <div class="forum-user">
                            <img src="{{ asset('/front/images/profile/1.jpg') }}">
                        </div>

                        <div class="forum-title-bar">
                            
                             <div class="user-detail">
                                <h6>Ram<span> Web Developer</span></h6>
                            </div>
                            <h4>New year new begenning...</h4>
                        </div>
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
        <!-- end forume title section -->
        <div class="all-forum-comments">
            <div class="forum-question-answer-section veirfied">
                <div class="post-user-detail">
                    <div class="post-user">
                        <img src="{{ asset('/front/images/profile/1.jpg') }}">
                        <span class="icon-check"></span>
                    </div>
                    <div class="post-user-detail">
                        <h4>Name<span>Profession</span></h4>
                    </div>
                </div>
                <p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.</p>

                <div class="forum-like-comment-view ">
                    <ul>
                        <li><a href="#" class="_total_answer_likes"><span class="like-numbers">0</span> <i class="icon-like"></i> Like</a></li>
                        <li><a href="#" class="go-to-comment"><span class="like-numbers">0</span> <i class="icon-bubble"></i> Comments</a></li>
                    </ul>
                </div>

                <div class="forum-leave-comment">
                    <h4 class="small">Leave a Comment</h4>
                    <form>
                        <div class="forum-reply-form">
                            <div class="reply-user-image">
                                <img src="{{ asset('/front/images/profile/1.jpg') }}">
                            </div>
                            <div class="forum-reply-coment-box">
                                <div class="comment-method">
                                    <ul>
                                        <li>
                                            <a>
                                                <input type="checkbox" id="check-for-login17" name="_hide_name17">
                                                <label for="check-for-login">Post Anonymously</label>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="form-group">
                                    <textarea class="form-control" rows="1" placeholder="Your Message Here !" required=""></textarea>
                                    <button class="btn btn-default btn_comment" data-question-id="17"><i class="icon-cursor"></i></button>
                                </div>
                            </div>
                        </div>
                    </form>

                    <div class="forum-comment-wrapper">
                        <div class="forum-comment-section">
                            <div class="profile-coment-user">
                                <img src="{{ asset('/front/images/profile/1.jpg') }}">
                            </div>

                            <div class="forum-coment-comment">
                                <h5>Trishal Kandel</h5>
                                <p>Hello ram i am posting the comment on your profile</p>
                                <div class="forum-author-comment profile-author-comment">
                                    <ul>
                                        <li><a href="#" class="_comment_like"><i class="icon-like"></i> 0 Like</a></li>
                                        <li><a class="write-comment" id="write-comment-1"><i class="icon-bubble"></i> Reply</a></li>
                                    </ul>
                                    <form>

                                        <div class="clearfix">
                                            <div class="reply-user-image">
                                                <img src="{{ asset('/front/images/profile/1.jpg') }}">
                                            </div>

                                            <div class="comment-method">
                                                <ul>
                                                    <li>
                                                        <a>
                                                            <input type="checkbox" id="check-for-login">
                                                            <label for="check-for-login">Post Anonymously</label>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>

                                        <div class="form-group">

                                            <textarea class="form-control" rows="1" placeholder="Your Message Here !" required="required" name="_quishi_comment_reply"></textarea>
                                            <button class="btn btn-default _comment_reply_btn"><i class="icon-cursor"></i></button>

                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>

                    </div>
                    <!-- end forum-comment-wrapper -->
                    <div class="forum-comment-wrapper">
                        <div class="forum-comment-section">
                            <div class="profile-coment-user">
                                <img src="{{ asset('/front/images/profile/1.jpg') }}">
                            </div>

                            <div class="forum-coment-comment">
                                <h5>Trishal Kandel</h5>
                                <p>Hello ram i am posting the comment on your profile</p>
                                <div class="forum-author-comment profile-author-comment">
                                    <ul>
                                        <li><a href="#" class="_comment_like"><i class="icon-like"></i> 0 Like</a></li>
                                        <li><a class="write-comment" id="write-comment-1"><i class="icon-bubble"></i> Reply</a></li>
                                    </ul>
                                    <form>

                                        <div class="clearfix">
                                            <div class="reply-user-image">
                                                <img src="{{ asset('/front/images/profile/1.jpg') }}">
                                            </div>

                                            <div class="comment-method">
                                                <ul>
                                                    <li>
                                                        <a>
                                                            <input type="checkbox" id="check-for-login">
                                                            <label for="check-for-login">Post Anonymously</label>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>

                                        <div class="form-group">

                                            <textarea class="form-control" rows="1" placeholder="Your Message Here !" required="required" name="_quishi_comment_reply"></textarea>
                                            <button class="btn btn-default _comment_reply_btn"><i class="icon-cursor"></i></button>

                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>

                    </div>
                    <!-- end forum-comment-wrapper -->

                    <div class="forum-comment-wrapper">
                        <div class="forum-comment-section">
                            <div class="profile-coment-user">
                                <img src="{{ asset('/front/images/profile/1.jpg') }}">
                            </div>

                            <div class="forum-coment-comment">
                                <h5>Trishal Kandel</h5>
                                <p>Hello ram i am posting the comment on your profile</p>
                                <div class="forum-author-comment profile-author-comment">
                                    <ul>
                                        <li><a href="#" class="_comment_like"><i class="icon-like"></i> 0 Like</a></li>
                                        <li><a class="write-comment" id="write-comment-1"><i class="icon-bubble"></i> Reply</a></li>
                                    </ul>
                                    <form>

                                        <div class="clearfix">
                                            <div class="reply-user-image">
                                                <img src="{{ asset('/front/images/profile/1.jpg') }}">
                                            </div>

                                            <div class="comment-method">
                                                <ul>
                                                    <li>
                                                        <a>
                                                            <input type="checkbox" id="check-for-login">
                                                            <label for="check-for-login">Post Anonymously</label>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>

                                        <div class="form-group">

                                            <textarea class="form-control" rows="1" placeholder="Your Message Here !" required="required" name="_quishi_comment_reply"></textarea>
                                            <button class="btn btn-default _comment_reply_btn"><i class="icon-cursor"></i></button>

                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>

                    </div>
                    <!-- end forum-comment-wrapper -->
                    <div class="forum-comment-wrapper">
                        <div class="forum-comment-section">
                            <div class="profile-coment-user">
                                <img src="{{ asset('/front/images/profile/1.jpg') }}">
                            </div>

                            <div class="forum-coment-comment">
                                <h5>Trishal Kandel</h5>
                                <p>Hello ram i am posting the comment on your profile</p>
                                <div class="forum-author-comment profile-author-comment">
                                    <ul>
                                        <li><a href="#" class="_comment_like"><i class="icon-like"></i> 0 Like</a></li>
                                        <li><a class="write-comment" id="write-comment-1"><i class="icon-bubble"></i> Reply</a></li>
                                    </ul>
                                    <form>

                                        <div class="clearfix">
                                            <div class="reply-user-image">
                                                <img src="{{ asset('/front/images/profile/1.jpg') }}">
                                            </div>

                                            <div class="comment-method">
                                                <ul>
                                                    <li>
                                                        <a>
                                                            <input type="checkbox" id="check-for-login">
                                                            <label for="check-for-login">Post Anonymously</label>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>

                                        <div class="form-group">

                                            <textarea class="form-control" rows="1" placeholder="Your Message Here !" required="required" name="_quishi_comment_reply"></textarea>
                                            <button class="btn btn-default _comment_reply_btn"><i class="icon-cursor"></i></button>

                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>

                    </div>
                    <!-- end forum-comment-wrapper -->

                    <div class="forum-comment-wrapper">
                        <div class="forum-comment-section">
                            <div class="profile-coment-user">
                                <img src="{{ asset('/front/images/profile/1.jpg') }}">
                            </div>

                            <div class="forum-coment-comment">
                                <h5>Trishal Kandel</h5>
                                <p>Hello ram i am posting the comment on your profile</p>
                                <div class="forum-author-comment profile-author-comment">
                                    <ul>
                                        <li><a href="#" class="_comment_like"><i class="icon-like"></i> 0 Like</a></li>
                                        <li><a class="write-comment" id="write-comment-1"><i class="icon-bubble"></i> Reply</a></li>
                                    </ul>
                                    <form>

                                        <div class="clearfix">
                                            <div class="reply-user-image">
                                                <img src="{{ asset('/front/images/profile/1.jpg') }}">
                                            </div>

                                            <div class="comment-method">
                                                <ul>
                                                    <li>
                                                        <a>
                                                            <input type="checkbox" id="check-for-login">
                                                            <label for="check-for-login">Post Anonymously</label>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>

                                        <div class="form-group">

                                            <textarea class="form-control" rows="1" placeholder="Your Message Here !" required="required" name="_quishi_comment_reply"></textarea>
                                            <button class="btn btn-default _comment_reply_btn"><i class="icon-cursor"></i></button>

                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>

                    </div>
                    <!-- end forum-comment-wrapper -->
                    <div class="forum-comment-wrapper">
                        <div class="forum-comment-section">
                            <div class="profile-coment-user">
                                <img src="{{ asset('/front/images/profile/1.jpg') }}">
                            </div>

                            <div class="forum-coment-comment">
                                <h5>Trishal Kandel</h5>
                                <p>Hello ram i am posting the comment on your profile</p>
                                <div class="forum-author-comment profile-author-comment">
                                    <ul>
                                        <li><a href="#" class="_comment_like"><i class="icon-like"></i> 0 Like</a></li>
                                        <li><a class="write-comment" id="write-comment-1"><i class="icon-bubble"></i> Reply</a></li>
                                    </ul>
                                    <form>

                                        <div class="clearfix">
                                            <div class="reply-user-image">
                                                <img src="{{ asset('/front/images/profile/1.jpg') }}">
                                            </div>

                                            <div class="comment-method">
                                                <ul>
                                                    <li>
                                                        <a>
                                                            <input type="checkbox" id="check-for-login">
                                                            <label for="check-for-login">Post Anonymously</label>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>

                                        <div class="form-group">

                                            <textarea class="form-control" rows="1" placeholder="Your Message Here !" required="required" name="_quishi_comment_reply"></textarea>
                                            <button class="btn btn-default _comment_reply_btn"><i class="icon-cursor"></i></button>

                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>

                    </div>
                    <!-- end forum-comment-wrapper -->

                    <div class="view-all-forum-comment">
                        <span>View more <i class="fa fa-reply" aria-hidden="true"></i> </span>
                    </div>
                </div>
            </div>
            <!-- end forum-question-answer-section 1-->
            <div class="forum-question-answer-section veirfied">
                <div class="post-user-detail">
                    <div class="post-user">
                        <img src="{{ asset('/front/images/profile/1.jpg') }}">
                        <span class="icon-check"></span>
                    </div>
                    <div class="post-user-detail">
                        <h4>Name<span>Profession</span></h4>
                    </div>
                </div>
                <p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.</p>

                <div class="forum-like-comment-view ">
                    <ul>
                        <li><a href="#" class="_total_answer_likes"><span class="like-numbers">0</span> <i class="icon-like"></i> Like</a></li>
                        <li><a href="#" class="go-to-comment"><span class="like-numbers">0</span> <i class="icon-bubble"></i> Comments</a></li>
                    </ul>
                </div>

                <div class="forum-leave-comment">
                    <h4 class="small">Leave a Comment</h4>
                    <form>
                        <div class="forum-reply-form">
                            <div class="reply-user-image">
                                <img src="{{ asset('/front/images/profile/1.jpg') }}">
                            </div>
                            <div class="forum-reply-coment-box">
                                <div class="comment-method">
                                    <ul>
                                        <li>
                                            <a>
                                                <input type="checkbox" id="check-for-login17" name="_hide_name17">
                                                <label for="check-for-login">Post Anonymously</label>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="form-group">
                                    <textarea class="form-control" rows="1" placeholder="Your Message Here !" required=""></textarea>
                                    <button class="btn btn-default btn_comment" data-question-id="17"><i class="icon-cursor"></i></button>
                                </div>
                            </div>
                        </div>
                    </form>

                    <div class="forum-comment-wrapper">
                        <div class="forum-comment-section">
                            <div class="profile-coment-user">
                                <img src="{{ asset('/front/images/profile/1.jpg') }}">
                            </div>

                            <div class="forum-coment-comment">
                                <h5>Trishal Kandel</h5>
                                <p>Hello ram i am posting the comment on your profile</p>
                                <div class="forum-author-comment profile-author-comment">
                                    <ul>
                                        <li><a href="#" class="_comment_like"><i class="icon-like"></i> 0 Like</a></li>
                                        <li><a class="write-comment" id="write-comment-1"><i class="icon-bubble"></i> Reply</a></li>
                                    </ul>
                                    <form>

                                        <div class="clearfix">
                                            <div class="reply-user-image">
                                                <img src="{{ asset('/front/images/profile/1.jpg') }}">
                                            </div>

                                            <div class="comment-method">
                                                <ul>
                                                    <li>
                                                        <a>
                                                            <input type="checkbox" id="check-for-login">
                                                            <label for="check-for-login">Post Anonymously</label>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>

                                        <div class="form-group">

                                            <textarea class="form-control" rows="1" placeholder="Your Message Here !" required="required" name="_quishi_comment_reply"></textarea>
                                            <button class="btn btn-default _comment_reply_btn"><i class="icon-cursor"></i></button>

                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>

                    </div>
                    <!-- end forum-comment-wrapper -->
                    <div class="forum-comment-wrapper">
                        <div class="forum-comment-section">
                            <div class="profile-coment-user">
                                <img src="{{ asset('/front/images/profile/1.jpg') }}">
                            </div>

                            <div class="forum-coment-comment">
                                <h5>Trishal Kandel</h5>
                                <p>Hello ram i am posting the comment on your profile</p>
                                <div class="forum-author-comment profile-author-comment">
                                    <ul>
                                        <li><a href="#" class="_comment_like"><i class="icon-like"></i> 0 Like</a></li>
                                        <li><a class="write-comment" id="write-comment-1"><i class="icon-bubble"></i> Reply</a></li>
                                    </ul>
                                    <form>

                                        <div class="clearfix">
                                            <div class="reply-user-image">
                                                <img src="{{ asset('/front/images/profile/1.jpg') }}">
                                            </div>

                                            <div class="comment-method">
                                                <ul>
                                                    <li>
                                                        <a>
                                                            <input type="checkbox" id="check-for-login">
                                                            <label for="check-for-login">Post Anonymously</label>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>

                                        <div class="form-group">

                                            <textarea class="form-control" rows="1" placeholder="Your Message Here !" required="required" name="_quishi_comment_reply"></textarea>
                                            <button class="btn btn-default _comment_reply_btn"><i class="icon-cursor"></i></button>

                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>

                    </div>
                    <!-- end forum-comment-wrapper -->

                    <div class="forum-comment-wrapper">
                        <div class="forum-comment-section">
                            <div class="profile-coment-user">
                                <img src="{{ asset('/front/images/profile/1.jpg') }}">
                            </div>

                            <div class="forum-coment-comment">
                                <h5>Trishal Kandel</h5>
                                <p>Hello ram i am posting the comment on your profile</p>
                                <div class="forum-author-comment profile-author-comment">
                                    <ul>
                                        <li><a href="#" class="_comment_like"><i class="icon-like"></i> 0 Like</a></li>
                                        <li><a class="write-comment" id="write-comment-1"><i class="icon-bubble"></i> Reply</a></li>
                                    </ul>
                                    <form>

                                        <div class="clearfix">
                                            <div class="reply-user-image">
                                                <img src="{{ asset('/front/images/profile/1.jpg') }}">
                                            </div>

                                            <div class="comment-method">
                                                <ul>
                                                    <li>
                                                        <a>
                                                            <input type="checkbox" id="check-for-login">
                                                            <label for="check-for-login">Post Anonymously</label>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>

                                        <div class="form-group">

                                            <textarea class="form-control" rows="1" placeholder="Your Message Here !" required="required" name="_quishi_comment_reply"></textarea>
                                            <button class="btn btn-default _comment_reply_btn"><i class="icon-cursor"></i></button>

                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>

                    </div>
                    <!-- end forum-comment-wrapper -->
                    <div class="forum-comment-wrapper">
                        <div class="forum-comment-section">
                            <div class="profile-coment-user">
                                <img src="{{ asset('/front/images/profile/1.jpg') }}">
                            </div>

                            <div class="forum-coment-comment">
                                <h5>Trishal Kandel</h5>
                                <p>Hello ram i am posting the comment on your profile</p>
                                <div class="forum-author-comment profile-author-comment">
                                    <ul>
                                        <li><a href="#" class="_comment_like"><i class="icon-like"></i> 0 Like</a></li>
                                        <li><a class="write-comment" id="write-comment-1"><i class="icon-bubble"></i> Reply</a></li>
                                    </ul>
                                    <form>

                                        <div class="clearfix">
                                            <div class="reply-user-image">
                                                <img src="{{ asset('/front/images/profile/1.jpg') }}">
                                            </div>

                                            <div class="comment-method">
                                                <ul>
                                                    <li>
                                                        <a>
                                                            <input type="checkbox" id="check-for-login">
                                                            <label for="check-for-login">Post Anonymously</label>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>

                                        <div class="form-group">

                                            <textarea class="form-control" rows="1" placeholder="Your Message Here !" required="required" name="_quishi_comment_reply"></textarea>
                                            <button class="btn btn-default _comment_reply_btn"><i class="icon-cursor"></i></button>

                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>

                    </div>
                    <!-- end forum-comment-wrapper -->

                    <div class="forum-comment-wrapper">
                        <div class="forum-comment-section">
                            <div class="profile-coment-user">
                                <img src="{{ asset('/front/images/profile/1.jpg') }}">
                            </div>

                            <div class="forum-coment-comment">
                                <h5>Trishal Kandel</h5>
                                <p>Hello ram i am posting the comment on your profile</p>
                                <div class="forum-author-comment profile-author-comment">
                                    <ul>
                                        <li><a href="#" class="_comment_like"><i class="icon-like"></i> 0 Like</a></li>
                                        <li><a class="write-comment" id="write-comment-1"><i class="icon-bubble"></i> Reply</a></li>
                                    </ul>
                                    <form>

                                        <div class="clearfix">
                                            <div class="reply-user-image">
                                                <img src="{{ asset('/front/images/profile/1.jpg') }}">
                                            </div>

                                            <div class="comment-method">
                                                <ul>
                                                    <li>
                                                        <a>
                                                            <input type="checkbox" id="check-for-login">
                                                            <label for="check-for-login">Post Anonymously</label>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>

                                        <div class="form-group">

                                            <textarea class="form-control" rows="1" placeholder="Your Message Here !" required="required" name="_quishi_comment_reply"></textarea>
                                            <button class="btn btn-default _comment_reply_btn"><i class="icon-cursor"></i></button>

                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>

                    </div>
                    <!-- end forum-comment-wrapper -->
                    <div class="forum-comment-wrapper">
                        <div class="forum-comment-section">
                            <div class="profile-coment-user">
                                <img src="{{ asset('/front/images/profile/1.jpg') }}">
                            </div>

                            <div class="forum-coment-comment">
                                <h5>Trishal Kandel</h5>
                                <p>Hello ram i am posting the comment on your profile</p>
                                <div class="forum-author-comment profile-author-comment">
                                    <ul>
                                        <li><a href="#" class="_comment_like"><i class="icon-like"></i> 0 Like</a></li>
                                        <li><a class="write-comment" id="write-comment-1"><i class="icon-bubble"></i> Reply</a></li>
                                    </ul>
                                    <form>

                                        <div class="clearfix">
                                            <div class="reply-user-image">
                                                <img src="{{ asset('/front/images/profile/1.jpg') }}">
                                            </div>

                                            <div class="comment-method">
                                                <ul>
                                                    <li>
                                                        <a>
                                                            <input type="checkbox" id="check-for-login">
                                                            <label for="check-for-login">Post Anonymously</label>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>

                                        <div class="form-group">

                                            <textarea class="form-control" rows="1" placeholder="Your Message Here !" required="required" name="_quishi_comment_reply"></textarea>
                                            <button class="btn btn-default _comment_reply_btn"><i class="icon-cursor"></i></button>

                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>

                    </div>
                    <!-- end forum-comment-wrapper -->

                    <div class="view-all-forum-comment">
                        <span>View more <i class="fa fa-reply" aria-hidden="true"></i> </span>
                    </div>
                </div>
            </div>
            <!-- end forum-question-answer-section 2-->
            <div class="forum-question-answer-section ">
                <div class="post-user-detail">
                    <div class="post-user">
                        <img src="{{ asset('/front/images/profile/1.jpg') }}">
                    </div>
                    <div class="post-user-detail">
                        <h4>Name<span>Profession</span></h4>
                    </div>
                </div>
                <p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.</p>

                <div class="forum-like-comment-view ">
                    <ul>
                        <li><a href="#" class="_total_answer_likes"><span class="like-numbers">0</span> <i class="icon-like"></i> Like</a></li>
                        <li><a href="#" class="go-to-comment"><span class="like-numbers">0</span> <i class="icon-bubble"></i> Comments</a></li>
                    </ul>
                </div>

                <div class="forum-leave-comment">
                    <h4 class="small">Leave a Comment</h4>
                    <form>
                        <div class="forum-reply-form">
                            <div class="reply-user-image">
                                <img src="{{ asset('/front/images/profile/1.jpg') }}">
                            </div>
                            <div class="forum-reply-coment-box">
                                <div class="comment-method">
                                    <ul>
                                        <li>
                                            <a>
                                                <input type="checkbox" id="check-for-login17" name="_hide_name17">
                                                <label for="check-for-login">Post Anonymously</label>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="form-group">
                                    <textarea class="form-control" rows="1" placeholder="Your Message Here !" required=""></textarea>
                                    <button class="btn btn-default btn_comment" data-question-id="17"><i class="icon-cursor"></i></button>
                                </div>
                            </div>
                        </div>
                    </form>

                    <div class="forum-comment-wrapper">
                        <div class="forum-comment-section">
                            <div class="profile-coment-user">
                                <img src="{{ asset('/front/images/profile/1.jpg') }}">
                            </div>

                            <div class="forum-coment-comment">
                                <h5>Trishal Kandel</h5>
                                <p>Hello ram i am posting the comment on your profile</p>
                                <div class="forum-author-comment profile-author-comment">
                                    <ul>
                                        <li><a href="#" class="_comment_like"><i class="icon-like"></i> 0 Like</a></li>
                                        <li><a class="write-comment" id="write-comment-1"><i class="icon-bubble"></i> Reply</a></li>
                                    </ul>
                                    <form>

                                        <div class="clearfix">
                                            <div class="reply-user-image">
                                                <img src="{{ asset('/front/images/profile/1.jpg') }}">
                                            </div>

                                            <div class="comment-method">
                                                <ul>
                                                    <li>
                                                        <a>
                                                            <input type="checkbox" id="check-for-login">
                                                            <label for="check-for-login">Post Anonymously</label>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>

                                        <div class="form-group">

                                            <textarea class="form-control" rows="1" placeholder="Your Message Here !" required="required" name="_quishi_comment_reply"></textarea>
                                            <button class="btn btn-default _comment_reply_btn"><i class="icon-cursor"></i></button>

                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>

                    </div>
                    <!-- end forum-comment-wrapper -->
                    <div class="forum-comment-wrapper">
                        <div class="forum-comment-section">
                            <div class="profile-coment-user">
                                <img src="{{ asset('/front/images/profile/1.jpg') }}">
                            </div>

                            <div class="forum-coment-comment">
                                <h5>Trishal Kandel</h5>
                                <p>Hello ram i am posting the comment on your profile</p>
                                <div class="forum-author-comment profile-author-comment">
                                    <ul>
                                        <li><a href="#" class="_comment_like"><i class="icon-like"></i> 0 Like</a></li>
                                        <li><a class="write-comment" id="write-comment-1"><i class="icon-bubble"></i> Reply</a></li>
                                    </ul>
                                    <form>

                                        <div class="clearfix">
                                            <div class="reply-user-image">
                                                <img src="{{ asset('/front/images/profile/1.jpg') }}">
                                            </div>

                                            <div class="comment-method">
                                                <ul>
                                                    <li>
                                                        <a>
                                                            <input type="checkbox" id="check-for-login">
                                                            <label for="check-for-login">Post Anonymously</label>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>

                                        <div class="form-group">

                                            <textarea class="form-control" rows="1" placeholder="Your Message Here !" required="required" name="_quishi_comment_reply"></textarea>
                                            <button class="btn btn-default _comment_reply_btn"><i class="icon-cursor"></i></button>

                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>

                    </div>
                    <!-- end forum-comment-wrapper -->

                    <div class="forum-comment-wrapper">
                        <div class="forum-comment-section">
                            <div class="profile-coment-user">
                                <img src="{{ asset('/front/images/profile/1.jpg') }}">
                            </div>

                            <div class="forum-coment-comment">
                                <h5>Trishal Kandel</h5>
                                <p>Hello ram i am posting the comment on your profile</p>
                                <div class="forum-author-comment profile-author-comment">
                                    <ul>
                                        <li><a href="#" class="_comment_like"><i class="icon-like"></i> 0 Like</a></li>
                                        <li><a class="write-comment" id="write-comment-1"><i class="icon-bubble"></i> Reply</a></li>
                                    </ul>
                                    <form>

                                        <div class="clearfix">
                                            <div class="reply-user-image">
                                                <img src="{{ asset('/front/images/profile/1.jpg') }}">
                                            </div>

                                            <div class="comment-method">
                                                <ul>
                                                    <li>
                                                        <a>
                                                            <input type="checkbox" id="check-for-login">
                                                            <label for="check-for-login">Post Anonymously</label>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>

                                        <div class="form-group">

                                            <textarea class="form-control" rows="1" placeholder="Your Message Here !" required="required" name="_quishi_comment_reply"></textarea>
                                            <button class="btn btn-default _comment_reply_btn"><i class="icon-cursor"></i></button>

                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>

                    </div>
                    <!-- end forum-comment-wrapper -->
                    <div class="forum-comment-wrapper">
                        <div class="forum-comment-section">
                            <div class="profile-coment-user">
                                <img src="{{ asset('/front/images/profile/1.jpg') }}">
                            </div>

                            <div class="forum-coment-comment">
                                <h5>Trishal Kandel</h5>
                                <p>Hello ram i am posting the comment on your profile</p>
                                <div class="forum-author-comment profile-author-comment">
                                    <ul>
                                        <li><a href="#" class="_comment_like"><i class="icon-like"></i> 0 Like</a></li>
                                        <li><a class="write-comment" id="write-comment-1"><i class="icon-bubble"></i> Reply</a></li>
                                    </ul>
                                    <form>

                                        <div class="clearfix">
                                            <div class="reply-user-image">
                                                <img src="{{ asset('/front/images/profile/1.jpg') }}">
                                            </div>

                                            <div class="comment-method">
                                                <ul>
                                                    <li>
                                                        <a>
                                                            <input type="checkbox" id="check-for-login">
                                                            <label for="check-for-login">Post Anonymously</label>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>

                                        <div class="form-group">

                                            <textarea class="form-control" rows="1" placeholder="Your Message Here !" required="required" name="_quishi_comment_reply"></textarea>
                                            <button class="btn btn-default _comment_reply_btn"><i class="icon-cursor"></i></button>

                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>

                    </div>
                    <!-- end forum-comment-wrapper -->

                    <div class="forum-comment-wrapper">
                        <div class="forum-comment-section">
                            <div class="profile-coment-user">
                                <img src="{{ asset('/front/images/profile/1.jpg') }}">
                            </div>

                            <div class="forum-coment-comment">
                                <h5>Trishal Kandel</h5>
                                <p>Hello ram i am posting the comment on your profile</p>
                                <div class="forum-author-comment profile-author-comment">
                                    <ul>
                                        <li><a href="#" class="_comment_like"><i class="icon-like"></i> 0 Like</a></li>
                                        <li><a class="write-comment" id="write-comment-1"><i class="icon-bubble"></i> Reply</a></li>
                                    </ul>
                                    <form>

                                        <div class="clearfix">
                                            <div class="reply-user-image">
                                                <img src="{{ asset('/front/images/profile/1.jpg') }}">
                                            </div>

                                            <div class="comment-method">
                                                <ul>
                                                    <li>
                                                        <a>
                                                            <input type="checkbox" id="check-for-login">
                                                            <label for="check-for-login">Post Anonymously</label>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>

                                        <div class="form-group">

                                            <textarea class="form-control" rows="1" placeholder="Your Message Here !" required="required" name="_quishi_comment_reply"></textarea>
                                            <button class="btn btn-default _comment_reply_btn"><i class="icon-cursor"></i></button>

                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>

                    </div>
                    <!-- end forum-comment-wrapper -->
                    <div class="forum-comment-wrapper">
                        <div class="forum-comment-section">
                            <div class="profile-coment-user">
                                <img src="{{ asset('/front/images/profile/1.jpg') }}">
                            </div>

                            <div class="forum-coment-comment">
                                <h5>Trishal Kandel</h5>
                                <p>Hello ram i am posting the comment on your profile</p>
                                <div class="forum-author-comment profile-author-comment">
                                    <ul>
                                        <li><a href="#" class="_comment_like"><i class="icon-like"></i> 0 Like</a></li>
                                        <li><a class="write-comment" id="write-comment-1"><i class="icon-bubble"></i> Reply</a></li>
                                    </ul>
                                    <form>

                                        <div class="clearfix">
                                            <div class="reply-user-image">
                                                <img src="{{ asset('/front/images/profile/1.jpg') }}">
                                            </div>

                                            <div class="comment-method">
                                                <ul>
                                                    <li>
                                                        <a>
                                                            <input type="checkbox" id="check-for-login">
                                                            <label for="check-for-login">Post Anonymously</label>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>

                                        <div class="form-group">

                                            <textarea class="form-control" rows="1" placeholder="Your Message Here !" required="required" name="_quishi_comment_reply"></textarea>
                                            <button class="btn btn-default _comment_reply_btn"><i class="icon-cursor"></i></button>

                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>

                    </div>
                    <!-- end forum-comment-wrapper -->

                    <div class="view-all-forum-comment">
                        <span>View more <i class="fa fa-reply" aria-hidden="true"></i> </span>
                    </div>
                </div>
            </div>
            <!-- end forum-question-answer-section 3-->
            <div class="show-more-cmts">
                <a href="#" class="btn btn-default">show more comments</a>
            </div>
        </div>
    </div>
</div>
@endsection @section('page_specific_js')
<!-- Sweetalert -->
<script type="text/javascript" src="{{ asset('/admin_assets/bower_components/sweetalert/js/sweetalert.min.js') }}"></script>
<!-- Formvalidation -->
<script type="text/javascript" src="{{ asset('/admin_assets/bower_components/formvalidation/formValidation.js') }}"></script>
<script type="text/javascript" src="{{ asset('/admin_assets/bower_components/formvalidation/framework/bootstrap.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function() {
        // show answer field when click reply button
        $(".btn-outline-secondary").click(function() {
            $('#reply-form')[0].reset();
            $('#reply-form').data('formValidation').resetForm(true);
            $(".profile-leave-comment").toggle('slow');
        });

        $(".reply-to-answer").click(function(e) {
            // var answer_id = $('.reply-to-answer').attr('data-answer-id');
            //   alert(answer_id);
            var parent_div = $(this).parent('div.reply-to').find('.reply-answer-form');

            parent_div.toggle('slow');
        });

        // from validation for reply answer logged in user
        $('#reply-form').on('init.field.fv', function(e, data) {
                var $parent = data.element.parents('.form-group'),
                    $icon = $parent.find('.form-control-feedback[data-fv-icon-for="' + data.field + '"]');

                $icon.on('click.clearing', function() {
                    // Check if the field is valid or not via the icon class
                    if ($icon.hasClass('fa fa-remove')) {
                        // Clear the field
                        data.fv.resetField(data.element);
                    }
                });
            })
            .formValidation({
                framework: 'bootstrap',
                icon: {
                    valid: 'fa fa-check',
                    invalid: 'fa fa-times',
                    validating: 'fa fa-refresh'
                },
                fields: {
                    'answer': {
                        validators: {
                            notEmpty: {
                                message: 'The answer  is required'
                            }
                        }
                    }
                }
            })
            .on('success.form.fv', function(e) {
                // Prevent form submission
                e.preventDefault();
                //alert("success");
                // get the form input value
                var result = new FormData($("#reply-form")[0]);

                $.ajax({
                    //make the ajax request to either add or update the
                    url: "{{url('')}}" + "/forums/answer",
                    data: result,
                    dataType: "Json",
                    contentType: false,
                    processData: false,
                    type: "POST",
                    success: function(data) {
                        if (data.status == "success") {
                            //hide the modal
                            //$('#add-new-question-modal').modal('hide');
                            setTimeout(function() {
                                swal({
                                    title: "Answer has been added to Question!",
                                    text: "A  answer  has been added to Question",
                                    type: "success",
                                    closeOnConfirm: true,
                                }, function() {
                                    window.location.reload();
                                });
                            }, 1000);
                            $('#reply-form')[0].reset();
                            $('#reply-form').data('formValidation').resetForm(true);

                        }
                    },
                    error: function(event) {
                        console.log('Cannot reply answer  to the question . Please try again later on..');
                    }

                });
            });

        // saving reply to answer reply-anonymously
        $(".saveAnswerReply").click(function(e) {
            //alert("click");
            //Prevent form submission
            e.preventDefault();

            //var id =$(this).parent('div.reply-to').find('.reply-to-answer');

            //var answer_id = $('.reply-to-answer').attr('data-answer-id');
            //alert(answer_id);\
            var form = $(this).parents('form.reply-answer-form');
            var data = new FormData($(form)[0]);
            //alert(data);
            $.ajax({
                //make the ajax request to either add or update the
                url: "{{url('')}}" + "/forums/answer/reply",
                data: data,
                dataType: "Json",
                contentType: false,
                processData: false,
                type: "POST",
                success: function(data) {
                    if (data.status == "success") {
                        //hide the modal
                        //$('#add-new-question-modal').modal('hide');
                        setTimeout(function() {
                            swal({
                                title: "Reply has been added to Answer!",
                                text: "A  reply  has been added to Answer",
                                type: "success",
                                closeOnConfirm: true,
                            }, function() {
                                window.location.reload();
                            });
                        }, 1000);
                        $('.reply-answer-form')[0].reset();
                        $('.reply-answer-form').data('formValidation').resetForm(true);

                    }
                },
                error: function(event) {
                    console.log('Cannot reply answer to the quesiton . Please try again later on..');
                }

            });
        });

    });
</script>
@endsection