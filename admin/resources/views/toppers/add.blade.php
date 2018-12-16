@extends('layouts.master')

@section('content-header')
<h1>
	Toppers
</h1>
<ol class="breadcrumb">
	<li><a href="#"><i class="fa fa-dashboard"></i> Toppers</a></li>
	<li class="active">Add</li>
</ol>

@endsection



@section('content')
<div class="col-md-12">
	<div class="row">
		<div class="panel panel-default">
			<div class="panel-body">
				<form action="{{route('toppers.store')}}" method="POST" enctype="multipart/form-data">
					{{csrf_field()}}
					@include('toppers.form');
					<button type="submit" class="btn btn-default">Submit</button>
				</form>
			</div>
		</div>
	</div>
</div>

@endsection
