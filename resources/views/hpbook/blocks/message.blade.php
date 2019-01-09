@if(Session::has('flash_message'))
	
	<div class="alert alert-{!!session('flash_message')!!} alert-block mb-1">
	    <button type="button" class="close" data-dismiss="alert">x</button>
	    <strong>{!!session('message')!!}</strong>
	</div>
@elseif(count($errors)>0)
		<div class="alert alert-danger alert-block mb-1">
	    <button type="button" class="close" data-dismiss="alert">x</button>
	    <strong>
			@foreach($errors->all() as $error)
			{!!$error!!}
			@endforeach
		</strong>
	</div>
@endif