@extends('layouts.master')
@section('styles')
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap.min.css"/>
	
@endsection


@section('content-header')
<h1>
	Enquiries
</h1>
<ol class="breadcrumb">
	<li><a href="#"><i class="fa fa-dashboard"></i> Enquiry</a></li>
	<li class="active">View</li>
</ol>

@endsection

@section('content')
<div class="col-md-12">
	<div class="row">
		<div class="panel panel-default">
			<div class="panel-body">
				<div class="table-responsive">
					<table class="table table-bordered table-hover" id="pageTable">
						<thead>
							<tr>
								<th>
									# 
								</th>
								<th> Name </th>
								<th> E mail </th>
								<th> Mobile  </th>
								<th> Enquiry </th>
								<th> Reply </th>
								<th> Reply Date </th>
								<th> Action </th>
							</tr>
						</thead>
						<tbody>
							@foreach($data as $index => $enq)
							<tr>
								<td>{{$index + 1 }}</td>
								<td>{{$enq->name}}</td>
								<td>{{$enq->email}}</td>
								<td>{{$enq->mobile }}</td>
								<td> {{$enq->enquiry}} </td>
								<td> {{$enq->reply}} </td>
								<td>{{Carbon\Carbon::parse($enq->reply_date)->format('d-m-Y i')}} </td>
								{{--  <td> {{\Carbon\Carbon::createFromFormat('Y-m-d',$enq->reply_date)}} </td>  --}}
								<td> 
									<form action="{{route('enquiries.destroy',$enq->id)}}" method="POST" id="deleteEnquires" onsubmit="return confirm('Are you sure...!')">
										{{method_field('delete')}}
										{{csrf_field()}}
										<button class="btn btn-danger" type="submit" > Delete </button>
									</form>
									<button class="btn btn-primary" title="Reply" onclick="window.location='{{route("enquiries.edit",$enq->id)}}'">
										<span class="glyphicon glyphicon-send">
										</span>
									</button>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection

@section('scripts')
	<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js"></script>
	
	<script>
			jQuery(function($) {
				//initiate dataTables plugin
				var myTable = 
				$('#pageTable')
				//.wrap("<div class='dataTables_borderWrap' />")   //if you are applying horizontal scrolling (sScrollX)
				.DataTable( {
					bAutoWidth: false,
					"aoColumns": [
						null,
						null,
						null,
						null,
						null,
						null,
						null,
						null
					],
					"aaSorting": [],			
						select: {
							style: 'multi'
						}
					});
				});


				
	</script>

@endsection