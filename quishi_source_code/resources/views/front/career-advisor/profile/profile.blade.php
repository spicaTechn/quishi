@extends('front.career-advisor.layout.master')
@section('title','Career Advisor Dashboard')
@section('content')
        <div class="profile-main-section">
            @if(Auth::user()->user_profile->status != 1)
            <div class="email-verification alert alert-danger">
                {{ __('Please verify your email address')}}
                <a href="#">{{ __('Reset activation') }}</a>
                <span id="close">×</span>
            </div> 
            @endif
            <div class="profile-first-section">
                <div class="row">
                    <div class="col-md-3">
                        <div class="profile-details text-center">
                            <a id="profile-edit-link" data-toggle="tooltip" data-placement="top" title="Edit Link" href="{{route('careerAdvisior.my-account.index')}}">
                                <i class="icon-pencil"></i>
                            </a>
                            <div class="profile-picture">
                                @if(Auth::user()->user_profile->image_path == "")
                                    <img src="{{asset('/front')}}/images/blog1.jpg" alt="profile">
                                @else
                                    <img src="{{asset('/front/images/profile').'/'.Auth::user()->user_profile->image_path}}" alt="profile">
                                @endif
                            </div>
                            <div class="profile-name">
                                {{ Auth::user()->user_profile->first_name }}
                            </div>
                            <div class="profile-pic-detail">
                                <p><a href="mailto:john@gmail.com">{{ Auth::user()->email }}</a></p>
                                <a class="btn btn-default" href="{{URL::to('/career-advisor/'.Auth::user()->id)}}" target="_blank">View Public Profile</a>
                            </div>
                        </div>
                    </div>
                    <!-- col-md-3 -->
                    <div class="col-md-9">
                        <div class="profile-detail-right">
                            <div class="profile-details-content">
                                <h4>My Bio </h4>
                                <p>{{ Auth::user()->user_profile->description }}</p>
                            </div>
                            <!-- profile-details -->
                            <div class="profile-background">
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 col-sm-6">
                                        <div class="profile-background-detail">
                                            <p><label>Address:</label> {{ ucwords(Auth::user()->user_profile->location) }}</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-4 col-sm-6">
                                        <div class="profile-background-detail">
                                            <p><label>Education Level: </label> {{ ucwords(Auth::user()->user_profile->educational_level) }}</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-4 col-sm-6">
                                        <div class="profile-background-detail">
                                            <p><label>Major:</label> {{ ucwords(Auth::user()->user_profile->education->name) }}</p>
                                            
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-4 col-sm-6">
                                        <div class="profile-background-detail">

                                            <p><label>Job Title:</label> {{ ucwords(Auth::user()->careers()->first()->title) }}</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-4 col-sm-6">
                                        <div class="profile-background-detail">
                                            <p><label>Experience:</label> {{ show_career_advisior_job_experience(Auth::user()->user_profile->job_experience) }}</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-4 col-sm-6">
                                        <div class="profile-background-detail">
                                            <p><label>Age Group:</label> {{ show_career_advisior_age_group(Auth::user()->user_profile->age_group) }}</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-4 col-sm-6">
                                        <div class="profile-background-detail">
                                            <p><label>Salary Range:</label> {{ show_career_advisior_salary_range(Auth::user()->user_profile->salary_range) }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- profile-background -->
                            <div class="profile-viewers">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="profile-view-wrapper">
                                            <div class="profile-icon">
                                                <i class="icon-like"></i>
                                            </div>
                                            <div class="profile-view-detai">
                                                <span>{{ quishi_convert_number_to_human_readable(Auth::user()->user_profile->total_likes) }}</span> Likes
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="profile-view-wrapper">
                                            <div class="profile-icon">
                                                <i class="icon-eye"></i>
                                            </div>
                                            <div class="profile-view-detai">
                                                <span>{{quishi_convert_number_to_human_readable( Auth::user()->user_profile->profile_views) }}</span> Views
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="profile-view-wrapper">
                                            <div class="profile-icon">
                                                <i class="icon-bubble"></i>
                                            </div>
                                            <div class="profile-view-detai">
                                                <span>{{quishi_convert_number_to_human_readable( $total_comments) }}</span> @if($total_comments > 1)  {{ 'Comments' }} @else {{ 'Comment' }} @endif
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <!-- profile-viewers -->
                            <div class="add-remove-social-media">
                                <div class="media-title-block">
                                    <h6>My External Links</h6>
                                    <span id="add-skill"><i class="icon-plus"></i></span>
                                </div>
                                <div class="social-media-body">
                                    <div class="row link_row">
                                        @foreach($user_links as $user_link)
                                        <div class="col-md-6">
                                            <div class="editable-section">
                                                <a href="#" class="hide-social-icon"> <i class="{{get_link_icon_class($user_link->label)}}"></i><span>{{$user_link->link}}</span></a>
                                                <form action=""  style="display: none;" data_link_type="{{$user_link->label}}">
                                                    <div class="form-group">
                                                        <input type="text" name="facebook-link" class="form-control"  value="{{$user_link->link}}">
                                                    </div>
                                                    <div class="button-groups">
                                                        <button class="btn btn-success btn-save">Save</button>
                                                        <button class="btn btn-secondary btn-cancel">Cancel</button>
                                                    </div>
                                                </form>
                                                <div class="editable-icon">
                                                    <a class="edit-link" data-toggle="tooltip" data-placement="top" title="Edit Link">
                                                        <i class="icon-pencil"></i>
                                                    </a>
                                                @if($user_link->type == "1")
                                                    <a class="link-delete" data-toggle="tooltip" data-placement="top" title="Delete Link" data-link-id="{{$user_link->id}}">
                                                        <i class="icon-trash"></i>
                                                    </a>
                                                @endif
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <!-- end add-remove-social-media -->
                        </div>
                        <!-- profile-detail-right -->
                    </div>
                    <!-- col-md-9 -->
                </div>
            </div>
            <!-- profile-first-section -->
        </div>
        <!-- profile-main-section -->
    </div>
</div>


<!-- modal to show to display the add link model-->
<div class="modal fade add-link" id="external-link" tabindex="-1" role="dialog" aria-labelledby="external-linkLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="external-linkLabel">Add New External Link</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>External Link</label>
                    <input type="text" name="new_external_link" class="form-control new_external_link" placeholder="https://www.google.com/" required="">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-default btn-save-link" disabled="disabled">Save changes</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('page_specific_js')
<script>
    $(document).ready(function(){
       
       //make the process back to normal when the user click the cancel button 
        $(document).on('click',".btn-cancel", function(e){
           //prevent the default action 
           e.preventDefault();
           var _parent_div       = $(this).parents('div.editable-section');
           //hide the form and show the editiable sections and socail icon class
           _parent_div.find('form').hide();
           _parent_div.find('.editable-icon').show();
           _parent_div.find('.hide-social-icon').show();
        });


        //delete external link
        $(document).on('click',"a.link-delete", function(e){
            var link_id    = $(this).attr('data-link-id');
            var parent_col = $(this).parents('div.col-md-6');
            //make the ajax delete request to delete the link
            $.ajax({
                url      : "{{URL::to('/profile/links')}}" + "/" + link_id,
                type     : 'DELETE',
                data     : {
                    '_token'  : "{{csrf_token()}}"
                },
                dataType : 'JSON',
                success  : function(data){
                   if(data.status == "success"){
                        parent_col.remove();
                        //show the swal message
                         swal({
                          title: "Link Deleted!!",
                          text: "Link has been deleted successfully!",
                          type: "success",
                          closeOnConfirm: true,
                        });
                   } 
                },
                error    : function(event){

                }
            });
        });


        //action when the edit link was clicked on the user profile link
        $(document).on('click',".edit-link", function(e) {
            e.preventDefault();
            
            var _parent_div       = $(this).parents('div.editable-section');
               //hide the form and show the editiable sections and socail icon class
           _parent_div.find('form').show();
           _parent_div.find('.editable-icon').hide();
           _parent_div.find('.hide-social-icon').hide();

        });

        //update the process when the user click the save button

        $(document).on('click', ".btn-save", function(e){
            //prevent the default action
            e.preventDefault();
            var _parent_div             = $(this).parents('div.editable-section');
            var _link_type              = $(_parent_div).find('form').attr('data_link_type');
            var _social_link_input      =  _parent_div.find('form input').val();
            $.post("{{route('profile.links.udpate')}}",{_social_link_input: _social_link_input, link_type : _link_type, _token: "{{csrf_token()}}"},function(data){
                if(data.status == 'success'){

                    //update the record value 
                    swal({
                          title: "Link Updated!!",
                          text: "Link has been updated successfully!",
                          type: "success",
                          closeOnConfirm: true,
                        });
                    $(_parent_div).find('.hide-social-icon span').html(_social_link_input);
                    //now hide the form 
                    _parent_div.find('form').hide();
                    //show the editable-icon 
                     _parent_div.find('.editable-icon').show();
                    //show the hide-social -icon
                    _parent_div.find('.hide-social-icon').show();
                }
            });

        });


        $("#add-skill").on('click',function(e){
            e.preventDefault();
            $('.add-link').modal('show');
        });


        //check the external link 
        $('.new_external_link').on('keyup',function(e){
            if($(this).val().length <= 0){
                $('.btn-save-link').prop('disabled',true);
            }else{
                $('.btn-save-link').prop('disabled',false);
            }
        });


        //add new link in the if btn save clicked!!

        $('.btn-save-link').on('click',function(e){
            //now make the request to add the new link
            $.post("{{route('profile.links.store')}}",{_token: "{{csrf_token()}}",'new_link_data':$(".new_external_link").val()},function(data){
                if(data.status == "success"){
                    //close the modal
                    $('.add-link').modal('hide');
                    //set the value to empty
                    $('.new_external_link').val('');
                    //disabled the input field
                    $('.btn-save-link').prop('disabled',true);
                    //append the data
                    $('.link_row').append(data.result);
                    //reset the tooltip    
                    $('[data-toggle="tooltip"]').tooltip();
                    //show alert message
                    swal({
                      title: "Link has been added!!",
                      text: "New external Link has been added successfully!",
                      type: "success",
                      closeOnConfirm: true,
                    });



                }
            });
        });

        $(document).on('click','#close',function(e){
            e.preventDefault();
            $('.email-verification').hide();
        });
        

    });
</script>
@endsection