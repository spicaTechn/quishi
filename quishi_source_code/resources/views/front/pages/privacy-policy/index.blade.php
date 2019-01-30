@extends('front.layout.master')
@section('title','Quishi | Privacy Policies')
@section('content')

<div class="frequently-question">
           <div class="container">
               <h2>Privacy Policy</h2>
               <div id="accordion">
                   @if($privacy_policy)
                    @if($privacy_policy->page_detail()->count() > 0)
                      <?php 
                        //unserialize the meta value
                        $unserialize_policy_lists = $privacy_policy->page_detail->first()->meta_value;
                        $serialize_policy_lsit    = unserialize($unserialize_policy_lists);
                        rsort($serialize_policy_lsit);
                        $i = 1;
                    ?>
                   @foreach($serialize_policy_lsit as $policy_list)
                   @if($policy_list['title'] == '')
                    <p>{!! $policy_list['description'] !!}</p>
                   @endif
                   @if($policy_list['title'] != '')
                   <div class="card">
                       <div class="card-header" id="headingOne">
                           <h5 class="mb-0">
                           <button class="btn btn-link" data-toggle="collapse" data-target="#{{$i}}" aria-expanded="true" aria-controls="collapseOne">
                           {{ $policy_list['title'] }}
                           </button>
                           </h5>
                       </div>
                       <div id="{{$i}}" class="collapse <?php if($i == 2) echo 'show'; ?>" aria-labelledby="headingOne" data-parent="#accordion">
                           <div class="card-body">
                               {!! $policy_list['description'] !!}
                           </div>
                       </div>
                   </div>
                   @endif
                   <?php $i++;?>
                    @endforeach
                    @else
                        <p>No privacy policy added yet</p>
                    @endif
                  @else
                        <p>No privacy policy added yet</p>
                  @endif
               </div>
           </div>
       </div>

@endsection
