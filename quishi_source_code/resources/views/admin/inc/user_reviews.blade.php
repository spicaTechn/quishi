<div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Reviews to {{$career_seeker->user_profile->first_name}}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form name="add-review-form" id="add-review-form">
                   <!--Setting user ID-->
                    <input type="hidden" name="user_id" value="1">
                    <div class="row">
                       <div class="col-sm-12 col-xl-12 m-b-30">
                            <h4 class="sub-title">Write new Review</h4>
                            <textarea class="form-control review" id="review_content" name="review" required="required"></textarea>
                            <input type="hidden" name="career-seeker-id" id="career-seeker-id" value="{{$career_seeker->id}}" />
                        </div> 
                    </div>
                    <div class="row">
                      <div class="col-sm-12 col-xl-12 m-b-30">
                        <button type="submit" class="btn btn-primary waves-effect waves-light create-review ">Send review</button>
                      </div>
                    </div>
                </form><!--end form-->

                <!-- Previous review list-->
                <div class="row card-block">
                  <div class="col-sm-12 col-xl-12 m-b-30">
                    <div class="card card-block user-card career-seeker-reviews">
                        <ul class="basic-list list-icons">
                          @foreach($career_seeker_admin_reviews as $admin_review)
                            <li>
                                <p>{{$admin_review->content}}</p>

                                <button type="button" 
                                  class="btn btn-primary btn-mini waves-effect waves-light  p-absolute text-center d-block resolve-review" 
                                  data-review-id="{{$admin_review->id}}" data-career-seeker-id="{{$career_seeker->id}}">
                                  Resolve review
                                </button>
                            </li>
                          @endforeach
                        </ul>
                    </div>
                  </div>
                 </div>
                 <!-- end Previous review list-->

                
            </div>
        </div>
    </div>