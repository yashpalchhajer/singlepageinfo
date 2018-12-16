@extends('layouts.master')

@section('content-header')
<h1>
	Enquiry Reply
</h1>
<ol class="breadcrumb">
	<li><a href="#"><i class="fa fa-dashboard"></i> Enquiry </a></li>
	<li class="active">Reply</li>
</ol>

@endsection



@section('content')
<div class="col-md-12">
	<div class="row">
		<div class="panel panel-default">
			<div class="panel-body">
				<form action="{{route('enquiries.update',$id)}}" method="POST" enctype="multipart/form-data">
					{{csrf_field()}}
					{{method_field('patch')}}
					<div class="row">
						<div class="col-md-4">
								<div class="form-group">
									<label for="email">Name</label>
									<input type="text" class="form-control" id="" name="name" value="{{$data->name}}" disabled />
								</div>
							</div>
						<div class="col-md-4">
							<div class="form-group">
								<label for="email">Email</label>
								<input type="text" class="form-control" id="" name="email" value="{{$data->email}}" disabled />
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label for="mobile"> Mobile </label>
								<input type="text" class="form-control" id="" name="mobile" value="{{$data->mobile}}" disabled />
							</div>
						</div>
					</div>

					<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<label for="enquiry"> Subject </label>
									<input type="text" class="form-control" id="" name="title" value="{{$data->title}}" disabled>
								</div>
							</div>
						<div class="col-md-4">
							<div class="form-group">
								<label for="enquiry"> Enquiry </label>
								<textarea class="form-control" id="" name="enquiry" disabled>{{$data->enquiry}}</textarea>
							</div>
						</div>
						<div class="col-md-3">
							<label for=""> Send reply on </label>
							<div class="checkbox">
								<label>
									<input type="checkbox" name="replyOption[]" id="forMobile" value="sendMob" aria-label="..."> Mobile
								</label>
							</div>
							<div class="checkbox">
								<label>
									<input type="checkbox" name="replyOption[]" id="forEmail" value="sendEmail" aria-label="..." checked> Email
								</label>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="reply"> Reply </label>
								<textarea name="reply" class="form-control" id="" cols="30" rows="5"></textarea>
							</div>
						</div>
					</div>




					<button type="submit" class="btn btn-default">Submit</button>
				</form>
			</div>
		</div>
	</div>
</div>

@endsection
