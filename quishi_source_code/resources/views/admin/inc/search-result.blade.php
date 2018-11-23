<ul>
	@foreach($search_results as $search_result)
    	<li class="country_option" data-value="{{$search_result->search_value}}">{{$search_result->search_value}}</li>
    @endforeach
 </ul>