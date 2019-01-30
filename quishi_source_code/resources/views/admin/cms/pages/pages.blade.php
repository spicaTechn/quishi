@extends('admin.layout.master')
@section('page_specific_css')
<!--Load the datatable css-->
<link rel="stylesheet" type="text/css" href="{{ asset('/admin_assets/bower_components/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}">
<!-- Load the sweetalert css -->
<link rel="stylesheet" type="text/css" href="{{ asset('/admin_assets/bower_components/sweetalert/css/sweetalert.css') }}">
<!-- Load the formvalidation css -->
<link rel="stylesheet" type="text/css" href="{{ asset('/admin_assets/bower_components/formvalidation/formValidation.min.css') }}">

<!-- Data Table Css -->
<link rel="stylesheet" type="text/css" href="{{ asset('/admin_assets/bower_components/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('/admin_assets/assets/pages/data-table/extensions/buttons/css/buttons.dataTables.min.css') }}">

<!-- File Input css -->
<link rel="stylesheet" type="text/css" href="{{ asset('/admin_assets/bower_components/file-input/css/fileinput.css') }}">
<style type="text/css">
  /*wysisyg editor initial notification hiding*/
#mceu_34 {

    display: none;
}
</style>
@endsection
@section('content')
<div class="pcoded-content">
<div class="pcoded-inner-content">
<div class="main-body">
   <div class="page-wrapper">
      <div class="page-body">
         <div class="row">
            <div class="col-sm-12">
               <!-- HTML5 Export Buttons table start -->
               <div class="card px-4 py-4 industry-jobs-tab">
                  <div class="card-header">
                     <div class="card-header-left">
                        <h5>Manage Pages</h5>
                     </div>
                     <!-- <div class="card-header-right">
                        <button class="btn btn-grd-primary add-btn">Add new Industry / Job</button>
                     </div> -->
                  </div>
                  <div class="card-block">
                     <ul class="nav nav-tabs md-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                           <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Home</a>
                           <div class="slide"></div>
                        </li>
                        <li class="nav-item">
                           <a class="nav-link" id="about-tab" data-toggle="tab" href="#about" role="tab" aria-controls="about" aria-selected="true">About US</a>
                           <div class="slide"></div>
                        </li>
                        <li class="nav-item">
                           <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="true">Contact US</a>
                           <div class="slide"></div>
                        </li>
                         
                         <li class="nav-item">
                           <a class="nav-link" id="terms-tab" data-toggle="tab" href="#terms" role="tab" aria-controls="terms" aria-selected="true">Terms & Conditions</a>
                           <div class="slide"></div>
                        </li>
                         
                         <li class="nav-item">
                           <a class="nav-link" id="privacy-tab" data-toggle="tab" href="#privacy" role="tab" aria-controls="privacy" aria-selected="true">Privacy Policies</a>
                           <div class="slide"></div>
                        </li>
                         
                     </ul>


                     <div class="tab-content" >
                        <!-- Home Tab -->
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                          <div class="card-block">
                              <h4>Video ID</h4>
                              <br>
                              <form name="home-video" id="home-video" enctype="multipart/form-data">
                                @csrf
                              <input type="hidden" name="home_video_id" class="home_video_id" value="{{ $home_video->id }}"/>
                              <div class="row">
                                <div class="col-sm-12 col-xl-12 m-b-30">
                                   <h4 class="sub-title">Video ID *</h4>
                                   <input type="text" class="form-control home_video" name="home_video" placeholder="Video ID" value="{{ $home_video->content }}">
                                 </div>
                              </div>
                              <button class="btn btn-grd-primary updateVideoId" data-video-id="">Update</button>
                              </form>
                           </div>
                           <div class="card-block">
                            <div class="row">
                               <div class="col-md-6">
                                  <h4>How Quishi Works For You</h4>
                               </div>

                            </div>
                            <div class="dt-responsive table-responsive">
                                <table id="our_team_table" class="table table-striped table-bordered our_team_table">
                                    <thead>
                                    <tr>
                                        <th>S.N.</th>
                                        <th>Icon</th>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Action</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                      <?php $i=1; ?>
                                      @foreach($home as $home_content)

                                        <tr>
                                            <td>{{ $i }}</td>
                                            <td>
                                              @foreach($home_content->page_detail as $home_icon)

                                              <img src="{{asset('/front')}}/images/pages/{{ $home_icon['meta_value'] }}" style="height: 40px; width: 40px;">
                                              @endforeach
                                            </td>
                                            <td>{{ $home_content['title'] }}</td>

                                            <td>{{ $home_content['content'] }}</td>
                                            <td>

                                              <a href="#" class="m-r-15 text-muted edit-home-content"
                                                    data-toggle="tooltip"
                                                    data-placement="top"
                                                    title=""
                                                    data-original-title="Edit"
                                                    data-home-id="{{ $home_content['id'] }}"
                                                    >
                                                 <i class="icofont icofont-ui-edit" ></i>
                                                 </a>
                                            </td>
                                        </tr>
                                        <?php $i++; ?>
                                      @endforeach
                                    </tbody>
                                </table>
                            </div>
                           </div>
                        </div>
                        <!-- End Home  Tap -->


                        <!-- About US Tap -->
                        <div class="tab-pane fade show" id="about" role="tabpanel" aria-labelledby="about-tab">
                           <div class="card-block">
                              <h4>Top Section</h4>
                              <br>

                              <form name="about-us" id="about-us" enctype="multipart/form-data">
                                @csrf

                              <input type="hidden" name="about_id" class="about_id" value="{{$about->id}}"/>
                              <div class="row">
                                <div class="col-sm-12 col-xl-12 m-b-30">
                                     <h4 class="sub-title">Title *</h4>
                                     <input type="text" class="form-control about_title" name="about_title" placeholder="Title" value="{{ $about->title }}">
                                 </div>
                              </div>
                              <div class="row">
                                 <div class="col-sm-6 col-xl-6 m-b-30">
                                     <h4 class="sub-title">Description *</h4>
                                     <textarea style="height: 350px;"  class="form-control about_description" name="about_description" placeholder="Description">{{ $about->content }}</textarea>
                                 </div>

                                 <div class="col-sm-6 col-xl-6 m-b-30">
                                     <h4 class="sub-title">Image *</h4>
                                     <div class="fileinput fileinput-new" data-provides="fileinput">
                                         <div class="fileinput-new thumbnail" style="max-width:359px; max-height: 350px;" data-trigger="fileinput">

                                          <img src="{{asset('/front')}}/images/pages/{{ $about_image->meta_value }}">

                                         </div>
                                         <div class="fileinput-preview fileinput-exists thumbnail" style="max-width:359px; max-height:350px;">
                                         </div>
                                         <div>
                                           <span class="btn btn-file btn-block btn-primary btn-sm">
                                             <span class="fileinput-new">Select Profile Image</span>
                                             <span class="fileinput-exists">Change</span>
                                             <input name="about-image" accept="image/*" type="file">
                                           </span>
                                           <a href="#" class="btn btn-orange fileinput-exists btn-sm btn-block" data-dismiss="fileinput">Remove</a>
                                         </div>
                                     </div>
                                 </div>


                              </div>
                              <button class="btn btn-grd-primary updateAbout" data-about-id="{{ $about->id }}">Update</button>
                              </form>

                           </div>

                           <br><br>

                           <div class="card-block">
                            <div class="row">
                               <div class="col-md-6">
                                  <h4>Our Team</h4>
                               </div>
                               <div class="col-md-6">
                                  <h4 style="float: right;">
                                     <button class="btn btn-grd-primary our-team-add-btn">Add Our Team</button>
                                  </h4>
                               </div>
                            </div>
                            <div class="dt-responsive table-responsive">
                                <table id="our_team_table" class="table table-striped table-bordered our_team_table">
                                    <thead>
                                    <tr>
                                        <th>S.N.</th>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Position</th>
                                        <th>Description</th>
                                        <th>Action</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                      <?php $i=1; ?>
                                      @foreach($about_our_team_unserializes as $value)

                                        <tr>
                                            <td>{{ $i }}</td>
                                            <td>
                                              <img src="{{asset('/front')}}/images/pages/{{ $value['image'] }}" style="height: 40px; width: 40px;">
                                            </td>
                                            <td>{{ $value['title'] }}</td>
                                            <td>{{ $value['position'] }}</td>
                                            <td>{{ $value['description'] }}</td>
                                            <td>

                                                <a href="#" class="m-r-15 text-muted edit-our-team"
                                                      data-toggle="tooltip"
                                                      data-placement="top"
                                                      title=""
                                                      data-original-title="Edit"
                                                      data-our-team-id="{{ $page_detail_id }}"
                                                      data-serialize-id="{{ $value['id'] }}"
                                                      >
                                                   <i class="icofont icofont-ui-edit" ></i>
                                                   </a>
                                                   <a href="#" class="text-muted delete-our-team"
                                                      data-toggle="tooltip"
                                                      data-placement="top" title=""
                                                      data-original-title="Delete"
                                                      data-our-team-id="{{ $page_detail_id }}"
                                                      data-serialize-id="{{ $value['id'] }}"
                                                      >
                                                   <i class="icofont icofont-delete-alt"></i>
                                                   </a>
                                            </td>
                                        </tr>
                                        <?php $i++; ?>
                                      @endforeach
                                    </tbody>
                                </table>
                            </div>
                           </div>
                        </div>
                        <!--End About US Tap -->


                        <!-- Contact US Tap -->
                        <div class="tab-pane fade pt-3" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                          <div class="card-block">
                              <h4>Top Section</h4>
                              <br>

                              <form name="contact-us" id="contact-us" enctype="multipart/form-data">
                                @csrf

                              <input type="hidden" name="contact_id" class="contact_id" value="{{$contact->id}}"/>
                              <div class="row">
                                <div class="col-sm-12 col-xl-12 m-b-30">
                                     <h4 class="sub-title">Title *</h4>
                                     <input type="text" class="form-control contact_title" name="contact_title" placeholder="Title" value="{{ $contact->title }}">
                                 </div>
                              </div>
                              <div class="row">
                                <!--  <div class="col-sm-12 col-xl-12 m-b-30">
                                     <h4 class="sub-title">Description *</h4>
                                     <textarea id="contact_wysiwyg" style="height: 350px;"  class="form-control contact_description" name="contact_description" placeholder="Description" >{{--{{ $contact->content }}--}}</textarea>
                                 </div> -->


                              </div>
                              <button class="btn btn-grd-primary updateContact" data-contact-id="{{ $contact->id }}">Update</button>
                              </form>

                           </div>
                           <div class="card-block">
                              <div class="card-block">
                              <form name="contact-social-form" id="contact-social-form">
                                @csrf
                                <input type="hidden" name="contact_social_id" class="contact_social_id" value="{{$contact->id}}"/>
                                <input type="hidden" name="contact_page_id" class="contact_page_id" value="{{$contact_page_detail_id}}"/>
                              <div class="row">
                                <div class="col-sm-6 col-xl-6 m-b-30">
                                     <h4 class="sub-title">Address *</h4>
                                     <input type="text" class="form-control address" name="address" placeholder="Address" value="{{ $contact_social_unserialize['address'] }}">
                                 </div>
                                 <div class="col-sm-6 col-xl-6 m-b-30">
                                     <h4 class="sub-title">Phone *</h4>
                                     <input type="text" class="form-control phone_number" name="phone_number" placeholder="Phone" value="{{ $contact_social_unserialize['phone_number'] }}">
                                 </div>
                                 <div class="col-sm-6 col-xl-6 m-b-30">
                                     <h4 class="sub-title">Email *</h4>
                                     <input type="text" class="form-control email" name="email" placeholder="Email" value="{{ $contact_social_unserialize['email'] }}">
                                 </div>
                                 <div class="col-sm-6 col-xl-6 m-b-30">
                                     <h4 class="sub-title">Facebook *</h4>
                                     <input type="text" class="form-control facebook" name="facebook" placeholder="Facebook Link" value="{{ $contact_social_unserialize['facebook'] }}">
                                 </div>
                              </div>
                              <div class="row">
                                 <div class="col-sm-6 col-xl-6 m-b-30">
                                     <h4 class="sub-title">Twitter *</h4>
                                     <input type="text" class="form-control twitter" name="twitter" placeholder="Twitter Link" value="{{ $contact_social_unserialize['twitter'] }}">
                                 </div><div class="col-sm-6 col-xl-6 m-b-30">
                                     <h4 class="sub-title">Google Plus *</h4>
                                     <input type="text" class="form-control google_plus" name="google_plus" placeholder="Google Plus Link" value="{{ $contact_social_unserialize['google_plus'] }}">
                                 </div>
                                 <div class="col-sm-6 col-xl-6 m-b-30">
                                     <h4 class="sub-title">Instragram *</h4>
                                     <input type="text" class="form-control instragram" name="instragram" placeholder="Instragram Link" value="{{ $contact_social_unserialize['instragram'] }}">
                                 </div>
                                 <div class="col-sm-6 col-xl-6 m-b-30">
                                     <h4 class="sub-title">LinkedIn *</h4>
                                     <input type="text" class="form-control instragram" name="linkedin" placeholder="LinkedIn Link" value="{{ $contact_social_unserialize['linkedin'] }}">
                                 </div>
                              </div>
                              <button  class="btn btn-grd-primary contactSocialUpdate" id="contactSocialUpdate">Update</button>
                              </form>
                           </div>
                           </div>
                        </div>
                         <!-- End Contact US Tap -->
                         
                         <!-- terms and condition tab-->
                         <div class="tab-pane fade show" id="terms" role="tabpanel" aria-labelledby="terms-tab">
                            <div class="card-block">
                            <div class="row">
                               <div class="col-md-6">
                                  <h4>Terms and conditions</h4>
                               </div>
                               <div class="col-md-6">
                                  <h4 style="float: right;">
                                     <button class="btn btn-grd-primary terms-add-btn">Add Terms and condition</button>
                                  </h4>
                               </div>
                            </div>
                            <div class="dt-responsive table-responsive">
                                <table id="our_team_table" class="table table-striped table-bordered our_team_table">
                                    <thead>
                                    <tr>
                                        <th>S.N.</th>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                      @if($terms_and_conditions)
                                        @if($terms_and_conditions->page_detail()->count() > 0)
                                          <?php 
                                            //unserialize the meta value
                                            $unserialize_term_lists = $terms_and_conditions->page_detail->first()->meta_value;
                                            $serialize_term_lsit    = unserialize($unserialize_term_lists);
                                            $i = 1;
                                        
                                        ?>
                                            @foreach($serialize_term_lsit as $term_list)
                                               <tr>
                                                <td>{{ $i }}</td>
                                                <td>{{ $term_list['title'] }}</td>
                                                <td>{!! $term_list['description'] !!}</td>
                                                <td>

                                                    <a href="#" class="m-r-15 text-muted edit-term"
                                                          data-toggle="tooltip"
                                                          data-placement="top"
                                                          title=""
                                                          data-original-title="Edit"
                                                          data-term-id="{{ $term_list['id'] }}"
                                                          data-page-id="{{ $terms_and_conditions->id }}"
                                                          >
                                                       <i class="icofont icofont-ui-edit" ></i>
                                                       </a>
                                                       <a href="#" class="text-muted delete-term"
                                                          data-toggle="tooltip"
                                                          data-placement="top" title=""
                                                          data-original-title="Delete"
                                                          data-term-id="{{ $term_list['id'] }}"
                                                          data-page-id="{{ $terms_and_conditions->id }}"
                                                          >
                                                       <i class="icofont icofont-delete-alt"></i>
                                                       </a>
                                                </td>
                                            </tr>
                                             <?php $i++;?>
                                        @endforeach
                                        @else
                                         <tr><td>No terms and conditions added yet</td></tr>
                                        @endif
                                      @else
                                        <tr><td>No terms and conditions added yet</td></tr>
                                      @endif
                                    </tbody>
                                </table>
                            </div>
                           </div>
                         </div>
                         <!-- end terms and condition tab-->
                         
                         <!-- Privacy Policy tab-->
                         <div class="tab-pane fade show" id="privacy" role="tabpanel" aria-labelledby="privacy-tab">
                            <div class="card-block">
                                <div class="row">
                                   <div class="col-md-6">
                                      <h4>Privacy Policies</h4>
                                   </div>
                                   <div class="col-md-6">
                                      <h4 style="float: right;">
                                         <button class="btn btn-grd-primary policy-add-btn">Add Policy</button>
                                      </h4>
                                   </div>
                                </div>
                                <div class="dt-responsive table-responsive">
                                    <table id="our_team_table" class="table table-striped table-bordered our_team_table">
                                        <thead>
                                        <tr>
                                            <th>S.N.</th>
                                            <th>Title</th>
                                            <th>Description</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                          @if($privacy_policy)
                                            @if($privacy_policy->page_detail()->count() > 0)
                                              <?php 
                                                //unserialize the meta value
                                                $unserialize_policy_lists = $privacy_policy->page_detail->first()->meta_value;
                                                $serialize_policy_lsit    = unserialize($unserialize_policy_lists);
                                                $i = 1;

                                            ?>
                                                @foreach($serialize_policy_lsit as $policy_list)
                                                   <tr>
                                                    <td>{{ $i }}</td>
                                                    <td>{{ $policy_list['title'] }}</td>
                                                    <td>{!! $policy_list['description'] !!}</td>
                                                    <td>

                                                        <a href="#" class="m-r-15 text-muted edit-policy"
                                                              data-toggle="tooltip"
                                                              data-placement="top"
                                                              title=""
                                                              data-original-title="Edit"
                                                              data-policy-id="{{ $policy_list['id'] }}"
                                                              data-page-id="{{ $privacy_policy->id }}"
                                                              >
                                                           <i class="icofont icofont-ui-edit" ></i>
                                                           </a>
                                                           <a href="#" class="text-muted delete-policy"
                                                              data-toggle="tooltip"
                                                              data-placement="top" title=""
                                                              data-original-title="Delete"
                                                              data-policy-id="{{ $policy_list['id'] }}"
                                                              data-page-id="{{ $privacy_policy->id }}"
                                                              >
                                                           <i class="icofont icofont-delete-alt"></i>
                                                           </a>
                                                    </td>
                                                </tr>
                                                 <?php $i++;?>
                                            @endforeach
                                            @else
                                             <tr><td>No privacy policy added yet</td></tr>
                                            @endif
                                          @else
                                            <tr><td>No privacy policy added yet</td></tr>
                                          @endif
                                        </tbody>
                                    </table>
                                </div>  
                            </div>
                         </div>
                         <!-- end Privacy Policy tab-->
                         
                         
                     </div>
                     <!-- tab-content -->
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- Page-body end -->
   </div>
</div>
</div>
</div>
@endsection
@section('form_modal')
<!-- add modal -->
<div class="modal fade" id="add-our-team" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
        	<form role="form" name="our-team" id="our-team" enctype="multipart/form-data">
            <input type="hidden" name="about_page_id" class="about_page_id" value="{{$about->id}}"/>
            @csrf
            <!-- <input type="hidden" name="team_id" class="team_id" value=""/>
            <input type="hidden" name="individual_id" class="individual_id" value=""/> -->
	            <div class="modal-header">
	                <h4 class="modal-title"><span>Add Our Team</span></h4>
	                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        						<span aria-hidden="true">&times;</span>
        					</button>
	            </div>
	            <div class="modal-body" name="our-team-add-field" id="our-team-add-field">
                  <div class="row">
                     <div class="col-sm-6 col-xl-6 m-b-30">
                        <div class="row">
                           <div class="col-sm-12 col-xl-12 m-b-30">
                               <h4 class="sub-title">Title *</h4>
                               <input type="text" class="form-control team_title" name="team_title" placeholder="Title">
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-sm-12 col-xl-12 m-b-30">
                               <h4 class="sub-title">Position </h4>
                               <input type="text" class="form-control team_position" name="team_position" placeholder="Position">
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-sm-12 col-xl-12 m-b-30">
                               <h4 class="sub-title">Description *</h4>
                               <textarea  class="form-control team_description" name="team_description" rows="7"></textarea>
                           </div>
                        </div>
                     </div>
                     <div class="col-sm-6 col-xl-6 m-b-30">
                        <div class="row">
                           <div class="col-sm-12 col-xl-12 m-b-30">
                               <h4 class="sub-title">Image *</h4>
                               <div class="fileinput fileinput-new" data-provides="fileinput">
                                   <div class="fileinput-new thumbnail" style="max-width: 250px; max-height: 217px;" data-trigger="fileinput">
                                   <img src="{{asset('/front')}}/images/blog1.jpg" id="team_image">
                                   </div>
                                   <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 250px; max-height:217px;">
                                   </div>
                                   <div>
                                     <span class="btn btn-file btn-block btn-primary btn-sm">
                                       <span class="fileinput-new">Select Profile Image</span>
                                       <span class="fileinput-exists">Change</span>
                                       <input name="team_image" id="team_image" class="form-control team_image" accept="image/*" type="file" />
                                     </span>
                                     <a href="#" class="btn btn-orange fileinput-exists btn-sm btn-block" data-dismiss="fileinput">Remove</a>
                                   </div>
                               </div>
                           </div>
                        </div>
                     </div>

                  </div>
	            </div>


               <div class="modal-footer">
                   <button type="button" class="btn btn-default waves-effect " data-dismiss="modal">Close</button>
                   <button type="submit"  class="btn btn-primary waves-effect waves-light ourTeamSave">Save changes</button>
               </div>
         </form>
        </div>
    </div>
</div>

<!-- edit modal -->
<div class="modal fade" id="edit-our-team" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <form role="form" name="update-our-team" id="update-our-team">
            @csrf
            <input type="hidden" name="about_page_id" class="about_page_id" value="{{$about->id}}"/>
            <input type="hidden" name="team_id" class="team_id" value=""/>
            <input type="hidden" name="individual_id" class="individual_id" value=""/>
              <div class="modal-header">
                  <h4 class="modal-title"><span>Add Our Team</span></h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body" name="our-team-add-field" id="our-team-add-field">
                  <div class="row">
                     <div class="col-sm-6 col-xl-6 m-b-30">
                        <div class="row">
                           <div class="col-sm-12 col-xl-12 m-b-30">
                               <h4 class="sub-title">Title *</h4>
                               <input type="text" class="form-control team_title" name="team_title" placeholder="Title" value="" />
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-sm-12 col-xl-12 m-b-30">
                               <h4 class="sub-title">Position </h4>
                               <input type="text" class="form-control team_position" name="team_position" placeholder="Position" value="" />
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-sm-12 col-xl-12 m-b-30">
                               <h4 class="sub-title">Description *</h4>
                               <textarea class="form-control team_description" name="team_description" rows="7"></textarea>
                           </div>
                        </div>
                     </div>
                     <div class="col-sm-6 col-xl-6 m-b-30">
                        <div class="row">
                           <div class="col-sm-12 col-xl-12 m-b-30">
                               <h4 class="sub-title">Image *</h4>
                               <div class="fileinput fileinput-new" data-provides="fileinput">
                                   <div class="fileinput-new thumbnail" style="max-width: 250px; max-height: 217px;" data-trigger="fileinput">
                                   <img src="{{asset('/front')}}/images/blog1.jpg" id="our_team_image">
                                   </div>
                                   <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 180px; max-height:180px;">
                                   </div>
                                   <div>
                                     <span class="btn btn-file btn-block btn-primary btn-sm">
                                       <span class="fileinput-new">Select Profile Image</span>
                                       <span class="fileinput-exists">Change</span>
                                       <input name="our_team_image" id="our_team_image" class="form-control our_team_image" accept="image/*" type="file" style="height: 180px; width: 180px;" />
                                     </span>
                                     <a href="#" class="btn btn-orange fileinput-exists btn-sm btn-block" data-dismiss="fileinput">Remove</a>
                                   </div>
                               </div>
                           </div>
                        </div>
                     </div>

                  </div>
              </div>


               <div class="modal-footer">
                   <button type="button" class="btn btn-default waves-effect " data-dismiss="modal">Close</button>
                   <button type="submit"  class="btn btn-primary waves-effect waves-light updateOurTeam">Save changes</button>
               </div>
         </form>
        </div>
    </div>
</div>

<!-- Home Page Content Model is here -->
<!-- edit home content model -->
<div class="modal fade" id="edit-home" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <form role="form" name="home-form" id="home-form" enctype="multipart/form-data">

            @csrf
            <input type="hidden" name="home_id" class="home_id" value=""/>
            <input type="hidden" name="page_id" class="page_id" value=""/>
              <div class="modal-header">
                  <h4 class="modal-title"><span>Update This Content</span></h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body" name="our-team-add-field" id="our-team-add-field">
                  <div class="row">
                     <div class="col-sm-6 col-xl-6 m-b-30">
                        <div class="row">
                           <div class="col-sm-12 col-xl-12 m-b-30">
                               <h4 class="sub-title">Title *</h4>
                               <input type="text" class="form-control home_title" name="home_title" placeholder="Title">
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-sm-12 col-xl-12 m-b-30">
                               <h4 class="sub-title">Description *</h4>
                               <textarea  class="form-control home_description" style="height: 144px;" name="home_description" placeholder="Description"></textarea>
                           </div>
                        </div>
                     </div>
                     <div class="col-sm-6 col-xl-6 m-b-30">
                        <div class="row">
                           <div class="col-sm-12 col-xl-12 m-b-30">
                               <h4 class="sub-title">Icon *</h4>
                               <div class="fileinput fileinput-new" data-provides="fileinput">
                                   <div class="fileinput-new thumbnail" style="max-width: 250px; max-height: 217px;" data-trigger="fileinput">
                                   <img src="{{asset('/front')}}/images/blog1.jpg" id="home_icon">
                                   </div>
                                   <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 250px; max-height:177px;">
                                   </div>
                                   <div>
                                     <span class="btn btn-file btn-block btn-primary btn-sm">
                                       <span class="fileinput-new">Select Profile Image</span>
                                       <span class="fileinput-exists">Change</span>
                                       <input name="home_icon" id="home_icon" class="form-control home_icon" accept="image/*" type="file" />
                                     </span>
                                     <a href="#" class="btn btn-orange fileinput-exists btn-sm btn-block" data-dismiss="fileinput">Remove</a>
                                   </div>
                               </div>
                           </div>
                        </div>
                     </div>

                  </div>
              </div>


               <div class="modal-footer">
                   <button type="button" class="btn btn-default waves-effect " data-dismiss="modal">Close</button>
                   <button type="submit"  class="btn btn-primary waves-effect waves-light updateHome">Save changes</button>
               </div>
         </form>
        </div>
    </div>
</div>

<!-- Terms and condition add modal -->
<div class="modal fade" id="add-terms" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
        	<form role="form" name="termsandcondition" id="termsandcondition">
            <input type="hidden" name="term_page_id" class="term_page_id" value=""/>
            <input type="hidden" name="term_id" class="term_id" value=""/>
            <input type="hidden" name="page_detail_id" class="page_detail_id" value="">
            @csrf
	            <div class="modal-header">
	                <h4 class="modal-title"><span>Add new Terms and Condition</span></h4>
	                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
	            </div>
	            <div class="modal-body" name="our-team-add-field" id="our-team-add-field">
                  <div class="row">
                     <div class="col-sm-12 col-xl-12 m-b-30">
                        <div class="row">
                           <div class="col-sm-12 col-xl-12 m-b-30">
                               <h4 class="sub-title">Title</h4>
                               <input type="text" class="form-control term_title" name="term_title" placeholder="Title">
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-sm-12 col-xl-12 m-b-30">
                               <h4 class="sub-title">Description *</h4>
                               <textarea id="term_description" class="form-control term_description" name="term_description" rows="7"></textarea>
                           </div>
                        </div>
                     </div>
                  </div>
	            </div>

               <div class="modal-footer">
                   <button type="button" class="btn btn-default waves-effect " data-dismiss="modal">Close</button>
                   <button type="submit"  class="btn btn-primary waves-effect waves-light termSave">Save changes</button>
               </div>
         </form>
        </div>
    </div>
</div>
<!-- End terms and condition add modal-->

<!--add privacy policy modal-->
<div class="modal fade" id="add-privacy" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
        	<form role="form" name="privacypolicy" id="privacypolicy">
            <input type="hidden" name="privacypolicy_page_id" class="privacypolicy_page_id" value=""/>
            <input type="hidden" name="privacypolicy_id" class="privacypolicy_id" value=""/>
            <input type="hidden" name="page_detail_id" class="page_detail_id" value="">
            @csrf
	            <div class="modal-header">
	                <h4 class="modal-title"><span>Add new Privacy Policy</span></h4>
	                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
	            </div>
	            <div class="modal-body" name="our-team-add-field" id="our-team-add-field">
                  <div class="row">
                     <div class="col-sm-12 col-xl-12 m-b-30">
                        <div class="row">
                           <div class="col-sm-12 col-xl-12 m-b-30">
                               <h4 class="sub-title">Title</h4>
                               <input type="text" class="form-control privacy_policy_title" name="privacy_policy_title" placeholder="Title">
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-sm-12 col-xl-12 m-b-30">
                               <h4 class="sub-title">Description *</h4>
                               <textarea id="privacy_policy_description" class="form-control privacy_policy_description" name="privacy_policy_description" rows="7"></textarea>
                           </div>
                        </div>
                     </div>
                  </div>
	            </div>

               <div class="modal-footer">
                   <button type="button" class="btn btn-default waves-effect " data-dismiss="modal">Close</button>
                   <button type="submit"  class="btn btn-primary waves-effect waves-light termSave">Save changes</button>
               </div>
         </form>
        </div>
    </div>
</div>
<!--end add privacy policy modal-->

<!-- end add modal -->
@endsection
@section('page_specific_js')
<!-- file input js -->
<script src="{{ asset('/admin_assets/bower_components/file-input/js/fileinput.js') }}"></script>
<!-- Datatable -->
<script src="{{ asset('/admin_assets/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('/admin_assets/bower_components/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('/admin_assets/assets/pages/data-table/js/jszip.min.js') }}"></script>
<script src="{{ asset('/admin_assets/assets/pages/data-table/js/vfs_fonts.js') }}"></script>
<script src="{{ asset('/admin_assets/assets/pages/data-table/extensions/buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('/admin_assets/assets/pages/data-table/extensions/buttons/js/buttons.flash.min.js') }}"></script>
<script src="{{ asset('/admin_assets/assets/pages/data-table/extensions/buttons/js/jszip.min.js') }}"></script>
<script src="{{ asset('/admin_assets/assets/pages/data-table/extensions/buttons/js/vfs_fonts.js') }}"></script>
<script src="{{ asset('/admin_assets/bower_components/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('/admin_assets/bower_components/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('/admin_assets/bower_components/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('/admin_assets/bower_components/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('/admin_assets/bower_components/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>
<!-- Sweetalert -->
<script type="text/javascript" src="{{ asset('/admin_assets/bower_components/sweetalert/js/sweetalert.min.js') }}"></script>
<!-- Formvalidation -->
<script type="text/javascript" src="{{ asset('/admin_assets/bower_components/formvalidation/formValidation.js') }}"></script>
<script type="text/javascript" src="{{ asset('/admin_assets/bower_components/formvalidation/framework/bootstrap.js') }}"></script>
>
<script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=ihfid13c6c1ygvc66guxqmkllfkfjbgtewnm9komiqvsm6to"></script>

<!-- Page wise Javascript code -->
<script type="text/javascript">
   $(document).ready(function () {

      //

      // installing wysiwyg editor
      tinymce.init({
        selector: '#contact_wysiwyg, #term_description, #privacy_policy_description',
        height: 300,
        menubar: false,
        plugins: [
          'advlist autolink lists link image charmap print preview anchor textcolor',
          'searchreplace visualblocks code fullscreen',
          'insertdatetime media table contextmenu paste code help wordcount'
        ],
        toolbar: 'insert | undo redo |  formatselect | bold italic backcolor  | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | help',
        content_css: [
          '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
          '//www.tinymce.com/css/codepen.min.css']
      });


      // Home page section
          // form validation home video section
          $('#home-video').on('init.field.fv', function(e, data) {
            var $parent = data.element.parents('.form-group'),
                $icon   = $parent.find('.form-control-feedback[data-fv-icon-for="' + data.field + '"]');

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
                  'home_video': {
                      validators: {
                          notEmpty: {
                              message: 'The video id is required'
                          }
                      }
                  }
              }
          });
          $( ".updateVideoId" ).on( "click", function(e) {
            e.preventDefault();

            var id = $('.home_video_id').val();
            //alert(id);
            var URI = "{{url('/admin/cms/pages/homeVideoIdUpdate')}}"+"/" +  id;

            // get the input values
            var result = new FormData($("#home-video")[0]);

            $.ajax({
            //make the ajax request to either add or update the
              url:URI,
              data:result,
              dataType:"Json",
              contentType: false,
              processData: false,
              type:"POST",
              success:function(data)
              {
                  if(data.status == "success"){
                      $('#edit-home').modal('hide');
                      setTimeout(function() {
                                swal({
                                  title: "Video ID  has been added!",
                                  text: "A  video id  has been added to Quishi",
                                  type: "success",
                                  closeOnConfirm: true,
                                }, function() {
                                    window.location = "{{route('admin.cms.pages')}}";
                                });
                      }, 1000);

                      //console.log(data);
                  }
              },
              error:function(event)
              {
                  console.log('Cannot update video id in quishi. Please try again later on..');
              }

            });
        });



          //loading edit  modal
          $( ".edit-home-content" ).on( "click", function(e) {
            e.preventDefault();
            var id = $(this).attr('data-home-id');

            $.ajax({
                url:"{{url('')}}" + "/admin/cms/pages/editHome/" + id,
                type:"GET",
                dataType:"json",
                success:function(data){
                    //check for the success status only
                    if(data.status == "success"){
                        //insert the data in the modal
                        //alert(data.result.image);
                        $(".home_id").val(id);
                        $(".page_id").val(data.result.id);
                        $(".home_title").val(data.result.title);
                        $(".home_description").val(data.result.description);
                        var image="{{asset('/front')}}/images/pages" + "/" +data.result.image;
                         $("#home_icon").attr('src',image);
                         $('#edit-home').modal('show');
                         $('.modal-title').text('Update Home Content'); // Set Title to Bootstrap modal title
                        //console.log(data.result);
                    }
                },
                error:function(event){
                        console.log('Cannot get the particular team');
                }
            });

          });

          // Formvalidation
          $('#home-form').on('init.field.fv', function(e, data) {
            var $parent = data.element.parents('.form-group'),
                $icon   = $parent.find('.form-control-feedback[data-fv-icon-for="' + data.field + '"]');

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
                  'home_title': {
                      validators: {
                          notEmpty: {
                              message: 'The title is required'
                          }
                      }
                  },
                  'home_description': {
                      validators: {
                          notEmpty: {
                                 message: 'The description  is required'
                             },

                      }
                  }
              }
          });
          $( ".updateHome" ).on( "click", function(e) {
            e.preventDefault();

            var id = $('.home_id').val();
            //alert(id);
            var URI = "{{url('/admin/cms/pages/homeUpdate')}}"+"/" +  id;

            // get the input values
            var result = new FormData($("#home-form")[0]);

            $.ajax({
            //make the ajax request to either add or update the
              url:URI,
              data:result,
              dataType:"Json",
              contentType: false,
              processData: false,
              type:"POST",
              success:function(data)
              {
                  if(data.status == "success"){
                      $('#edit-home').modal('hide');
                      setTimeout(function() {
                                swal({
                                  title: "Contact content has been added!",
                                  text: "A  contact content has been added to Quishi",
                                  type: "success",
                                  closeOnConfirm: true,
                                }, function() {
                                    window.location = "{{route('admin.cms.pages')}}";
                                });
                      }, 1000);
                      $('#home-form')[0].reset();
                      $('#home-form').data('formValidation').resetForm(true);
                      //console.log(data);
                  }
              },
              error:function(event)
              {
                  console.log('Cannot update contact data in quishi. Please try again later on..');
              }

            });
        });


      // End home page section

      // Fomvalidation setup about us top section
      $('#about-us').on('init.field.fv', function(e, data) {
            var $parent = data.element.parents('.form-group'),
                $icon   = $parent.find('.form-control-feedback[data-fv-icon-for="' + data.field + '"]');

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
                'about_title': {
                    validators: {
                        notEmpty: {
                            message: 'The title is required'
                        }
                    }
                },
                'about_description': {
                    validators: {
                        notEmpty: {
                               message: 'The description is required'
                           },
                        // stringLength: {
                        //     message: 'Type description must be less than 500 characters',
                        //     max: function (value, validator, $field) {
                        //         return 200 - (value.match(/\r/g) || []).length;
                        //     }
                        // }
                    }
                }
            }
        });

        // update the about top section content
        $('body').on('click','.updateAbout', function(e) {
            // Prevent form submission

            e.preventDefault();
            var about_id = $(this).attr('.about_id');
            //alert(about_id);

            URI = "{{url('/admin/cms/pages/aboutUpdate')}}" +"/" +  about_id;


                // get the input values
            var result = new FormData($("#about-us")[0]);

            $.ajax({
            //make the ajax request to either add or update the
              url:URI,
              data:result,
              dataType:"Json",
              contentType: false,
              processData: false,
              type:"POST",
              success:function(data)
              {
                  if(data.status == "success"){
                      setTimeout(function() {
                                swal({
                                  title: "About content has been updated!",
                                  text: "A  about content has been updated to Quishi",
                                  type: "success",
                                  closeOnConfirm: true,
                                }, function() {
                                    window.location = "{{route('admin.cms.pages')}}";
                                });
                      }, 1000);
                      $('#about-us')[0].reset();
                      $('#about-us').data('formValidation').resetForm(true);
                      //console.log(data);
                  }
              },
              error:function(event)
              {
                  console.log('Cannot update about data in quishi. Please try again later on..');
              }

            });
        });


        // loading add our team modal
        $( ".our-team-add-btn" ).on( "click", function() {
          save_method = 'add';
          // $('#our-team')[0].reset();
          // $('#our-team').data('formValidation').resetForm(true);
          $('#add-our-team').modal('show');
        });

        // Fomvalidation setup about us our team
        $('#our-team').on('init.field.fv', function(e, data) {
            var $parent = data.element.parents('.form-group'),
                $icon   = $parent.find('.form-control-feedback[data-fv-icon-for="' + data.field + '"]');

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
                   'team_title': {
                       validators: {
                           notEmpty: {
                               message: 'The title is required'
                           }
                       }
                   },
                   'team_image': {
                       validators: {
                           notEmpty: {
                               message: 'The image is required'
                           }
                       }
                   },

                   'team_description': {
                       validators: {
                           notEmpty: {
                                  message: 'The description is required'
                              },
                           stringLength: {
                               message: 'Type description must be less than 2000 characters',
                               max: function (value, validator, $field) {
                                   return 2000 - (value.match(/\r/g) || []).length;
                               }
                           }
                       }
                   }
               }
           })
           .on('success.form.fv', function(e) {
            // Prevent form submission
            e.preventDefault();

            // find if the action is save or update
            if(save_method == 'add')
            {
                URI = "{{route('admin.cms.pages.ourTeam')}}";
            }
            // else{
            //     var team_id  = $(".team_id").val();
            //     var team_update_id = $(this).attr('data-serialize-id');
            //     URI = "{{url('/admin/cms/pages/updateOurTeam')}}" +"/" +  team_id;
            // }

            // get the input values
            result = new FormData($("#our-team")[0]);

            $.ajax({
            //make the ajax request to either add or update the
            url:URI,
            data:result,
            dataType:"Json",
            contentType: false,
            processData: false,
            type:"POST",
            success:function(data)
            {
                if(data.status == "success"){
                    //hide the modal
                     $('#add-our-team').modal('hide');
                     if(save_method == "add")
                     {
                      setTimeout(function()
                        {
                                swal({
                                  title: "Team Member  has been added to Quishi!",
                                  text: "A  team member has been added to Quishi",
                                  type: "success",
                                  closeOnConfirm: true,
                                }, function() {
                                    window.location = "{{route('admin.cms.pages')}}";
                                });
                      }, 1000);
                      $('#our-team')[0].reset();
                      $('#our-team').data('formValidation').resetForm(true);
                     }

                }
            },
            error:function(event)
            {
                console.log('Cannot add new user into the quishi system. Please try again later on..');
            }

          });
        });

        // our team edit button click
        $( ".edit-our-team" ).on( "click", function(e) {
            e.preventDefault();
            var hidden_id = $(this).attr('data-our-team-id');
            //console.log(hidden_id);
            var team_edit_id = $(this).attr('data-serialize-id');
            //console.log(team_edit_id);
            //$('#edit-our-team').modal('show');

            $.ajax({
                url:"{{url('')}}" + "/admin/cms/pages/editOurTeam/" + hidden_id,
                type:"GET",
                dataType:"json",
                data: {'edit_id':team_edit_id,'hidden_id':hidden_id},
                success:function(data){
                    //check for the success status only
                    if(data.status == "success"){
                        //insert the data in the modal
                        //alert(data.result.image);
                        $(".team_id").val(hidden_id);
                        $(".individual_id").val(team_edit_id);
                        $(".team_title").val(data.result.title);
                        $(".team_position").val(data.result.position);
                        $(".team_description").val(data.result.description);

                        var image="{{asset('/front')}}/images/pages" + "/" +data.result.image;
                        $("#our_team_image").attr('src',image);

                         $('#edit-our-team').modal('show'); // show bootstrap modal
                         $('.modal-title').text('Update Team'); // Set Title to Bootstrap modal title
                        //console.log(data.result);
                    }

                },
                error:function(event){
                        console.log('Cannot get the particular team');
                }
            });

        });



        // validating edit form before updating data to database
        $('#update-our-team').on('init.field.fv', function(e, data) {
            var $parent = data.element.parents('.form-group'),
                $icon   = $parent.find('.form-control-feedback[data-fv-icon-for="' + data.field + '"]');

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
                   'team_title': {
                       validators: {
                           notEmpty: {
                               message: 'The title is required'
                           }
                       }
                   },
                   'team_description': {
                       validators: {
                           notEmpty: {
                                  message: 'The description is required'
                              },
                           stringLength: {
                               message: 'Type description must be less than 2000 characters',
                               max: function (value, validator, $field) {
                                   return 2000 - (value.match(/\r/g) || []).length;
                               }
                           }
                       }
                   }
               }
          }).on('success.form.fv', function(e) {
            e.preventDefault();
            var team_id = $('.team_id').val();
            var URI = "{{URL::to('/admin/cms/pages/updateOurTeam')}}" +"/" +  team_id;
            var result = new FormData($("#update-our-team")[0]);
            $.ajax({
            //make the ajax request to either add or update the
              url:URI,
              data:result,
              dataType:"Json",
              contentType: false,
              processData: false,
              cache    : false,
              type:"POST",
              success:function(data)
              {
                  if(data.status == "success"){
                      //console.log(data);
                      $('#edit-our-team').modal('hide');
                      setTimeout(function() {
                                swal({
                                  title: "Team Member  has been updated to Quishi!",
                                  text: "A  team member has been update to Quishi",
                                  type: "success",
                                  closeOnConfirm: true,
                                }, function() {
                                    window.location = "{{route('admin.cms.pages')}}";
                                });
                      }, 1000);
                      $('#update-our-team')[0].reset();
                      $('#update-our-team').data('formValidation').resetForm(true);
                      //console.log(data);
                  }
              },
              error:function(event)
              {
                  console.log('Cannot update about data in quishi. Please try again later on..');
              }

            });
          });



        // our team delete button click
        $( ".delete-our-team" ).on( "click", function(e) {

          //alert(id);
            e.preventDefault();
            var delete_id = $(this).attr('data-our-team-id');
            var hidden_id = $('.about_page_id').val();
            //alert(hidden_id);
            var individual_id = $(this).attr('data-serialize-id');
            var _token="{{csrf_token()}}";
            //show the alert notification
            swal({
                title: "Are you sure?",
                text: "You will not be able to your team!",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel please!",
                closeOnConfirm: false,
                closeOnCancel: false
            },function(isConfirm){
                if(isConfirm){
                    //make ajax request
                    $.ajax({
                        url:"{{url('/admin/cms/pages/deleteOurTeam')}}" + "/" + delete_id,
                        type:"POST",
                        dataType:"Json",
                        data:{_token:_token,individual_id:individual_id,hidden_id:hidden_id},
                        success:function(data){
                            if(data.status == "success")
                            {
                              setTimeout(function() {
                                swal({
                                  title: "Team Member  has been deleted from Quishi!",

                                  type: "success",
                                  closeOnConfirm: true,
                                }, function() {
                                    window.location = "{{route('admin.cms.pages')}}";
                                });
                      }, 1000);

                            }
                            else
                            {
                              setTimeout(function() {
                                swal({
                                  title: "Team Member  has not been updated to Quishi!",

                                  type: "success",
                                  closeOnConfirm: true,
                                }, function() {
                                    window.location = "{{route('admin.cms.pages')}}";
                                });
                      }, 1000);

                            }
                        }
                    });
                }
                else {
                    swal("Cancelled", "Your team is safe :)", "error");
                }
            });
        });


        // update contact us  section content

      // Fomvalidation setup about us top section
      $('#contact-us').on('init.field.fv', function(e, data) {
            var $parent = data.element.parents('.form-group'),
                $icon   = $parent.find('.form-control-feedback[data-fv-icon-for="' + data.field + '"]');

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
                'contact_title': {
                    validators: {
                        notEmpty: {
                            message: 'The title is required'
                        }
                    }
                },
                'contact_description': {
                    validators: {
                        notEmpty: {
                               message: 'The description is required'
                           },

                    }
                }
            }
        });

        // update the contact us top section content
        $('body').on('click','.updateContact', function(e) {
            // Prevent form submission

            e.preventDefault();
            var contact_id = $(this).attr('.contact_id');
            //alert(contact_id);

            var URI = "{{url('/admin/cms/pages/contactUpdate')}}" +"/" +  contact_id;


                // get the input values
            var result = new FormData($("#contact-us")[0]);

            $.ajax({
            //make the ajax request to either add or update the
              url:URI,
              data:result,
              dataType:"Json",
              contentType: false,
              processData: false,
              type:"POST",
              success:function(data)
              {
                  if(data.status == "success"){
                      setTimeout(function() {
                                swal({
                                  title: "Contact content has been updated!",
                                  text: "A  contact content has been updated to Quishi",
                                  type: "success",
                                  closeOnConfirm: true,
                                }, function() {
                                    window.location = "{{route('admin.cms.pages')}}";
                                });
                      }, 1000);
                      $('#contact-us')[0].reset();
                      $('#contact-us').data('formValidation').resetForm(true);
                      //console.log(data);
                  }
              },
              error:function(event)
              {
                  console.log('Cannot update contact us data in quishi. Please try again later on..');
              }

            });
        });



        // Fomvalidation setup about us top section
      $('#contact-social-form').on('init.field.fv', function(e, data) {
            var $parent = data.element.parents('.form-group'),
                $icon   = $parent.find('.form-control-feedback[data-fv-icon-for="' + data.field + '"]');

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
                'address': {
                    validators: {
                        notEmpty: {
                            message: 'The address is required'
                        }
                    }
                },
                'phone_number': {
                    validators: {
                        notEmpty: {
                               message: 'The phone number is required'
                           },

                    }
                },
                'email': {
                    validators: {
                        notEmpty: {
                               message: 'The email is required'
                           },

                    }
                },
                'twitter': {
                    validators: {
                        notEmpty: {
                               message: 'The twitter is required'
                           },

                    }
                },
                'google_plus': {
                    validators: {
                        notEmpty: {
                               message: 'The google_plus is required'
                           },

                    }
                },
                'instragram': {
                    validators: {
                        notEmpty: {
                               message: 'The instragram is required'
                           },

                    }
                },
                'facebook': {
                    validators: {
                        notEmpty: {
                               message: 'The facebook is required'
                           },

                    }
                }
            }
        })
        .on('success.form.fv', function(e) {
            e.preventDefault();

            var contact_page_id = $('.contact_page_id').val();
            //alert(contact_social_id);
            //var _token = $("input[name='_token']").val();
            // if(contact_social_id){
            //   var URI = "{{url('/admin/cms/pages/contactSocialUpdate')}}" +"/" +  contact_social_id;
            // }
            // else
            // {
            if(contact_page_id){
              var URI = "{{url('/admin/cms/pages/contactSocialUpdate')}}"+"/" +  contact_page_id;;
            }
            else
            {
               var URI = "{{url('/admin/cms/pages/contactSocialUpdate')}}";
            }
            // }

            // get the input values
            var result = new FormData($("#contact-social-form")[0]);

            $.ajax({
            //make the ajax request to either add or update the
              url:URI,
              data:result,
              dataType:"Json",
              contentType: false,
              processData: false,
              type:"POST",
              success:function(data)
              {
                  if(data.status == "success"){
                      setTimeout(function() {
                                swal({
                                  title: "Contact content has been added!",
                                  text: "A  contact content has been added to Quishi",
                                  type: "success",
                                  closeOnConfirm: true,
                                }, function() {
                                    window.location = "{{route('admin.cms.pages')}}";
                                });
                      }, 1000);
                      // $('#')[0].reset();
                      // $('#').data('formValidation').resetForm(true);
                      //console.log(data);
                  }
              },
              error:function(event)
              {
                  console.log('Cannot update contact data in quishi. Please try again later on..');
              }

            });
        });

      
       // terms and conditions add modal
       $( ".terms-add-btn" ).on( "click", function(e) {
            e.preventDefault();
            save_method = 'add';
            $('#add-terms').modal('show');
       });
       
       // terms and conditions add form validation
       $('#termsandcondition').on('init.field.fv', function(e, data) {
            var $parent = data.element.parents('.form-group'),
                $icon   = $parent.find('.form-control-feedback[data-fv-icon-for="' + data.field + '"]');

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
                   'term_description': {
                       validators: {
                           notEmpty: {
                                  message: 'The term description is required'
                              },
                           stringLength: {
                               message: 'The term description must be less than 2000 characters',
                               max: function (value, validator, $field) {
                                   return 2000 - (value.match(/\r/g) || []).length;
                               }
                           }
                       }
                   }
               }
           })
           .on('success.form.fv', function(e) {
            // Prevent form submission
            e.preventDefault();

            // find if the action is save or update
            if(save_method == 'add')
            {
                URI = "{{route('admin.cms.pages.termsConditions')}}";
            }else{
              URI   = "{{URL::to('/admin/cms/pages/updateTerm')}}";
            }
            // get the input values
            result = new FormData($("#termsandcondition")[0]);

            $.ajax({
            //make the ajax request to either add or update the
            url:URI,
            data:result,
            dataType:"Json",
            contentType: false,
            processData: false,
            type:"POST",
            success:function(data)
            {
                if(data.status == "success"){
                    //hide the modal
                     $('#add-terms').modal('hide');
                     if(save_method == "add")
                     {
                      setTimeout(function()
                        {
                                swal({
                                  title: "terms and condition has been added to Quishi!",
                                  text: "A  new terms and condition has been added to Quishi",
                                  type: "success",
                                  closeOnConfirm: true,
                                }, function() {
                                    window.location = "{{route('admin.cms.pages')}}";
                                });
                      }, 1000);
                      $('#termsandcondition')[0].reset();
                      $('#termsandcondition').data('formValidation').resetForm(true);
                     }
                     else{

                          setTimeout(function()
                          {
                                  swal({
                                    title: "terms and condition has been updated to Quishi!",
                                    text: "A  new terms and condition has been updated to Quishi",
                                    type: "success",
                                    closeOnConfirm: true,
                                  }, function() {
                                      window.location = "{{route('admin.cms.pages')}}";
                                  });
                        }, 1000);
                        $('#termsandcondition')[0].reset();
                        $('#termsandcondition').data('formValidation').resetForm(true);
                       }
                     

                }
            },
            error:function(event)
            {
                console.log('Cannot add terms and conditions into the quishi system. Please try again later on..');
            }

          });
        });
       
       // our team terms and conditions
        $( ".edit-term" ).on( "click", function(e) {
            e.preventDefault();
            save_method = "edit";
            var hidden_id = $(this).attr('data-term-id');
            //console.log(hidden_id);
            var term_page_id = $(this).attr('data-page-id');
            //console.log(team_edit_id);
            //$('#edit-our-team').modal('show');

            $.ajax({
                url:"{{url('')}}" + "/admin/cms/pages/editTerm/" + hidden_id + '/' + term_page_id,
                type:"GET",
                dataType:"json",
                data: {'edit_id':term_page_id,'hidden_id':hidden_id},
                success:function(data){
                    //check for the success status only
                    if(data.status == "success"){
                        $(".term_title").val(data.result.title);
                        $(".term_page_id").val(term_page_id);
                        tinyMCE.get('term_description').setContent(data.result.description);
                        $(".page_detail_id").val(data.result.page_detail_id);
                        $(".term_id").val(data.result.id);
                        $("#add-terms .modal-title").text('Edit terms and conditions');
                        
                        $("#add-terms").modal('show');
                    }

                },
                error:function(event){
                        console.log('Cannot get the particular team');
                }
            });

        });
       

         // our team delete button click
        $( ".delete-term" ).on( "click", function(e) {

          //alert(id);
            e.preventDefault();
            var delete_id = $(this).attr('data-term-id');
            var hidden_id = $(this).attr('data-page-id');
            var _token="{{csrf_token()}}";
            //show the alert notification
            swal({
                title: "Are you sure?",
                text: "You will not be able to your team!",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel please!",
                closeOnConfirm: false,
                closeOnCancel: false
            },function(isConfirm){
                if(isConfirm){
                    //make ajax request
                    $.ajax({
                        url:"{{url('/admin/cms/pages/deleteTerm')}}",
                        type:"POST",
                        dataType:"Json",
                        data:{_token:_token,term_id:delete_id,term_page_id:hidden_id},
                        success:function(data){
                            if(data.status == "success")
                            {
                              setTimeout(function() {
                                swal({
                                  title: "Terms and conditions   has been deleted from Quishi!",

                                  type: "success",
                                  closeOnConfirm: true,
                                }, function() {
                                    window.location = "{{route('admin.cms.pages')}}";
                                });
                      }, 1000);

                            }
                            else
                            {
                              setTimeout(function() {
                                swal({
                                  title: "Terms and conditions  has not been updated to Quishi!",

                                  type: "success",
                                  closeOnConfirm: true,
                                }, function() {
                                    window.location = "{{route('admin.cms.pages')}}";
                                });
                      }, 1000);

                            }
                        }
                    });
                }
                else {
                    swal("Cancelled", "Your team is safe :)", "error");
                }
            });
        });


       // Privacy policy add modal
       $('.policy-add-btn'). on('click', function(e) {
            e.preventDefault();
            save_method = 'add';
            $('#add-privacy').modal('show');
       });
       
       // privacy policy add form
       // terms and conditions add form validation
       $('#privacypolicy').on('init.field.fv', function(e, data) {
            var $parent = data.element.parents('.form-group'),
                $icon   = $parent.find('.form-control-feedback[data-fv-icon-for="' + data.field + '"]');

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
                   'privacy_policy_description': {
                       validators: {
                           notEmpty: {
                                  message: 'The privacy policy description is required'
                              },
                           stringLength: {
                               message: 'The privacy policy description must be less than 2000 characters',
                               max: function (value, validator, $field) {
                                   return 2000 - (value.match(/\r/g) || []).length;
                               }
                           }
                       }
                   }
               }
           })
           .on('success.form.fv', function(e) {
            // Prevent form submission
            e.preventDefault();

            // find if the action is save or update
            if(save_method == 'add')
            {
                URI = "{{route('admin.cms.pages.PrivacyPolicy')}}";
            }else{
              URI   = "{{URL::to('/admin/cms/pages/updatePrivacyPolicy')}}";
            }
            // get the input values
            result = new FormData($("#privacypolicy")[0]);

            $.ajax({
            //make the ajax request to either add or update the
            url:URI,
            data:result,
            dataType:"Json",
            contentType: false,
            processData: false,
            type:"POST",
            success:function(data)
            {
                if(data.status == "success"){
                    //hide the modal
                     $('#add-privacy').modal('hide');
                     if(save_method == "add")
                     {
                      setTimeout(function()
                        {
                                swal({
                                  title: "Privacy Policy has been added to Quishi!",
                                  text: "A  new privacy policy has been added to Quishi",
                                  type: "success",
                                  closeOnConfirm: true,
                                }, function() {
                                    window.location = "{{route('admin.cms.pages')}}";
                                });
                      }, 1000);
                      $('#termsandcondition')[0].reset();
                      $('#termsandcondition').data('formValidation').resetForm(true);
                     }
                     else{

                          setTimeout(function()
                          {
                                  swal({
                                    title: "terms and condition has been updated to Quishi!",
                                    text: "A  new terms and condition has been updated to Quishi",
                                    type: "success",
                                    closeOnConfirm: true,
                                  }, function() {
                                      window.location = "{{route('admin.cms.pages')}}";
                                  });
                        }, 1000);
                        $('#privacypolicy')[0].reset();
                        $('#privacypolicy').data('formValidation').resetForm(true);
                       }
                     

                }
            },
            error:function(event)
            {
                console.log('Cannot add privacy policy into the quishi system. Please try again later on..');
            }

          });
        });
       
       // edit privacy policy
        $( ".edit-policy" ).on( "click", function(e) {
            e.preventDefault();
            save_method = "edit";
            var hidden_id = $(this).attr('data-policy-id');
            //console.log(hidden_id);
            var policy_page_id = $(this).attr('data-page-id');
            //console.log(team_edit_id);
            //$('#edit-our-team').modal('show');

            $.ajax({
                url:"{{url('')}}" + "/admin/cms/pages/editPrivacyPolicy/" + hidden_id + '/' + policy_page_id,
                type:"GET",
                dataType:"json",
                data: {'edit_id':policy_page_id,'hidden_id':hidden_id},
                success:function(data){
                    //check for the success status only
                    if(data.status == "success"){
                        $(".privacy_policy_title").val(data.result.title);
                        $(".privacypolicy_page_id").val(policy_page_id);
                        tinyMCE.get('privacy_policy_description').setContent(data.result.description);
                        //$(".privacy_policy_description").val(data.result.description);
                        $(".page_detail_id").val(data.result.page_detail_id);
                        $(".privacypolicy_id").val(data.result.id);
                        $("#add-privacy .modal-title").text('Edit Privacy Policy');
                        
                        $("#add-privacy").modal('show');
                    }

                },
                error:function(event){
                        console.log('Cannot get the particular privacy policy');
                }
            });

        });
       
       // Delete privacy policy
        $( ".delete-policy" ).on( "click", function(e) {

          //alert(id);
            e.preventDefault();
            var delete_id = $(this).attr('data-policy-id');
            var hidden_id = $(this).attr('data-page-id');
            var _token="{{csrf_token()}}";
            //show the alert notification
            swal({
                title: "Are you sure?",
                text: "You will not be able to recover this privacy policy!",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel please!",
                closeOnConfirm: false,
                closeOnCancel: false
            },function(isConfirm){
                if(isConfirm){
                    //make ajax request
                    $.ajax({
                        url:"{{url('/admin/cms/pages/deletePrivacyPolicy')}}",
                        type:"POST",
                        dataType:"Json",
                        data:{_token:_token,privacy_policy_id:delete_id,privacy_policy_page_id:hidden_id},
                        success:function(data){
                            if(data.status == "success")
                            {
                              setTimeout(function() {
                                swal({
                                  title: "Privacy policy  has been deleted from Quishi!",

                                  type: "success",
                                  closeOnConfirm: true,
                                }, function() {
                                    window.location = "{{route('admin.cms.pages')}}";
                                });
                      }, 1000);

                            }
                            else
                            {
                              setTimeout(function() {
                                swal({
                                  title: "Privacy policy  has not been updated to Quishi!",

                                  type: "success",
                                  closeOnConfirm: true,
                                }, function() {
                                    window.location = "{{route('admin.cms.pages')}}";
                                });
                      }, 1000);

                            }
                        }
                    });
                }
                else {
                    swal("Cancelled", "Your privacy policy is safe :)", "error");
                }
            });
        });
       
       
       

   });
</script>
@endsection