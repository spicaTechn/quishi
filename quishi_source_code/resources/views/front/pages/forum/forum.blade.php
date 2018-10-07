@extends('front.layout.master')
@section('content')
	<div class="forum-section">
            <div class="container">
                <div class="forum-title-section">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="forum-title-bar">
                                <h4>Questions</h4>
                                <ul>
                                    <li class="active">Recent</li>
                                    <li>Popular</li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="forum-search-bar">
                                <div class="search-form">
                                    <button class="btn btn-transparent"><i class="icon-magnifier"></i></button>
                                    <input name="search-form" class="form-control" type="text" placeholder="Type and enter">
                                </div>
                                <div class="new-questions"><a href="#" class="btn btn-default" id="show-qusetion-modal">new questions</a></div>
                                <div class="modal fade" id="add-new-question-modal">
                                    <div class="modal-dialog" role="document">
                                        <form action="">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Add Question</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="user-question-adds">
                                                        <a href="#"><img src="images/blog1.jpg">Laxman Tako </a>added
                                                    </div>
                                                    <div class="user-Anonymous-question-adds">
                                                        <img src="images/blog1.jpg">Anonymous asks
                                                    </div>
                                                    <div class="form-group">
                                                        <textarea class="form-control" rows="1" placeholder="Start your question with &quot;What&quot;, &quot;How&quot;, &quot;Why&quot;, etc."></textarea>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <span class="btn" id="cancel">Cancel</span>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input" id="customCheck1">
                                                        <label class="custom-control-label" for="customCheck1" id="anonymous-user">Add Anonymously</label>
                                                    </div>
                                                    <button type="button" class="btn btn-default">Add Question</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- forum-title-section" -->
                <div class="forum-question-list">
                    <ul>
                        <li>
                            <div class="forum-question-image">
                                <img src="images/blog1.jpg">
                            </div>
                            <div class="forum-question-content">
                                <div class="forum-question-content-title">
                                    <a href="{{ URL::to('/forum').'/'.'1' }}"><h4>Who is using this apple</h4>
                                    <h6>By james Khanna about 1 hour ago</h6></a>
                                </div>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Odio rem alias voluptatum eum, quaerat iure, earum quam cupiditate sunt laboriosam vero temporibus sequi soluta reprehenderit molestiae, in autem illum dolore!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Maxime, fuga inventore culpa dolores porro doloribus ad sit quidem quisquam est, quos blanditiis asperiores, amet velit itaque nam, vel dolorem excepturi.</p>
                            </div>
                            <div class="forum-question-replies">
                                <a href="#">14 <span>Replies</span></a>
                            </div>
                        </li>
                        <!-- end list 1 -->
                        <li>
                            <div class="forum-question-image">
                                <img src="images/blog1.jpg">
                            </div>
                            <div class="forum-question-content">
                                <div class="forum-question-content-title">
                                    <a href="{{ URL::to('/forum').'/'.'1' }}"><h4>Who is using this apple</h4>
                                    <h6>By james Khanna about 1 hour ago</h6></a>
                                </div>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Odio rem alias voluptatum eum, quaerat iure, earum quam cupiditate sunt laboriosam vero temporibus sequi soluta reprehenderit molestiae, in autem illum dolore!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Maxime, fuga inventore culpa dolores porro doloribus ad sit quidem quisquam est, quos blanditiis asperiores, amet velit itaque nam, vel dolorem excepturi.</p>
                            </div>
                            <div class="forum-question-replies">
                                <a href="#">14 <span>Replies</span></a>
                            </div>
                        </li>
                        <!-- end list 2 -->
                        <li>
                            <div class="forum-question-image">
                                <img src="images/blog1.jpg">
                            </div>
                            <div class="forum-question-content">
                                <div class="forum-question-content-title">
                                    <a href="{{ URL::to('/forum').'/'.'1' }}"><h4>Who is using this apple</h4>
                                    <h6>By james Khanna about 1 hour ago</h6></a>
                                </div>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Odio rem alias voluptatum eum, quaerat iure, earum quam cupiditate sunt laboriosam vero temporibus sequi soluta reprehenderit molestiae, in autem illum dolore!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Maxime, fuga inventore culpa dolores porro doloribus ad sit quidem quisquam est, quos blanditiis asperiores, amet velit itaque nam, vel dolorem excepturi.</p>
                            </div>
                            <div class="forum-question-replies">
                                <a href="#">14 <span>Replies</span></a>
                            </div>
                        </li>
                        <!-- end list 3 -->
                        <li>
                            <div class="forum-question-image">
                                <img src="images/blog1.jpg">
                            </div>
                            <div class="forum-question-content">
                                <div class="forum-question-content-title">
                                    <a href="{{ URL::to('/forum').'/'.'1' }}"><h4>Who is using this apple</h4>
                                    <h6>By james Khanna about 1 hour ago</h6></a>
                                </div>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Odio rem alias voluptatum eum, quaerat iure, earum quam cupiditate sunt laboriosam vero temporibus sequi soluta reprehenderit molestiae, in autem illum dolore!Lorem ipsum dolor sit amet, consectetur adipisicing elit. Maxime, fuga inventore culpa dolores porro doloribus ad sit quidem quisquam est, quos blanditiis asperiores, amet velit itaque nam, vel dolorem excepturi.</p>
                            </div>
                            <div class="forum-question-replies">
                                <a href="#">14 <span>Replies</span></a>
                            </div>
                        </li>
                        <!-- end list 4 -->
                    </ul>
                </div>
            </div>
        </div>
@endsection