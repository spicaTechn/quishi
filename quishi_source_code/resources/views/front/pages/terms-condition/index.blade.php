@extends('front.layout.master')
@section('content')

<div class="frequently-question">
           <div class="container">
               <h2>Terms and Conditions</h2>
               <div id="accordion">
                   @if($terms_and_conditions)
                    <p class="updated_date">
                        Last updated at: <?php echo $terms_and_conditions->updated_at->toFormattedDateString(); ?>
                    </p>
                    @if($terms_and_conditions->page_detail()->count() > 0)
                        <?php 
                            //unserialize the meta value
                            $unserialize_term_lists = $terms_and_conditions->page_detail->first()->meta_value;
                            $serialize_term_lsit    = unserialize($unserialize_term_lists);
                            rsort($serialize_term_lsit);
                            $i = 1;
                        ?>
                        @foreach($serialize_term_lsit as $term_list)
                       <div class="card">
                           <div class="card-header" id="headingOne">
                               <h5 class="mb-0">
                               <button class="btn btn-link" data-toggle="collapse" data-target="#{{$i}}" aria-expanded="true" aria-controls="collapseOne">
                               {{ $term_list['title'] }}
                               </button>
                               </h5>
                           </div>
                           <div id="{{$i}}" class="collapse <?php if($i == 1) echo 'show'; ?>" aria-labelledby="headingOne" data-parent="#accordion">
                               <div class="card-body">
                                   {{ $term_list['description'] }}
                               </div>
                           </div>
                       </div>
                        <?php $i++;?>
                        @endforeach
                        @else
                         <p>No terms and conditions added yet</p>
                        @endif
                      @else
                        <p>No terms and conditions added yet</p>
                      @endif
               </div>
           </div>
       </div>

@endsection
