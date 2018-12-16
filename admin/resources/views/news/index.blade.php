@extends('layouts.master')
@section('styles')
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap.min.css"/>
@endsection
@section('content-header')
<h1>
	News 
	<span> 
		<button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#addNews"> 
			<span class="glyphicon glyphicon-plus" data-toggle="tooltip" data-placement="top" title="Add New"></span>
		</button> 
	</span>
</h1>
<ol class="breadcrumb">
	<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
	<li><a href="#">News</a></li>
	<li class="active">View</li>
</ol>

@endsection



@section('content')
<div class="col-md-12">
	<div class="row">
		<div class="panel panel-default">
			{{--  <div class="panel-header">
				<div>
					<button type="button" class="btn btn-primary btn-md" data-toggle="modal" data-target="#addNews"> <span class="glyphicon glyphicon-plus"></span> Add News</button>
				</div>
			</div>  --}}
			<div class="panel-body">
				<div class="table-responsive">
					<table class="table table-bordered table-hover" id="pageTable">
						<thead>
							<tr>
								<th> 
									# 
								</th>
								<th> Title </th>
								<th> Description </th>
								<th> Date </th>
								<th> Action </th>
							</tr>
						</thead>
						<tbody>
							@foreach($news as $index => $n)
							<tr>
								<td>{{$index + 1 }}</td>
								<td>{{$n->title}}</td>
								<td>{{$n->description}}</td>
								<td>{{$n->created_at }}</td>
								<td> 
									<button class="btn btn-primary" type="button" data-mytitle="{{$n->title}}" data-mydesc="{{$n->description}}" data-news_id="{{$n->id}}" data-toggle="modal" data-target="#updateNews"> <span class="glyphicon glyphicon-pencil"></span> </button>
									<form action="{{route('news.destroy',$n->id)}}" method="POST" id="deleteNews" onsubmit="return confirm('Are you sure...!')">
										{{method_field('delete')}}
										{{csrf_field()}}
										<button class="btn btn-danger" type="submit" > <span class="glyphicon glyphicon-trash"></span> </button>
									</form>
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

<!-- Add news Modal -->
<div class="modal fade" id="addNews" tabindex="-1" role="dialog" aria-labelledby="addNewsLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="addNewsLabel">Add News</h4>
			</div>
			<form action="{{route('news.store')}}" method="POST">
				{{csrf_field()}}
				<div class="modal-body">
					@include('news.form')
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Add News</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- Add news Modal-->


<!-- Update news Modal -->
<div class="modal fade" id="updateNews" tabindex="-1" role="dialog" aria-labelledby="addNewsLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="addNewsLabel">Modify News</h4>
			</div>
			<form action="{{route('news.update','test')}}" method="POST">
				{{method_field('patch')}}
				{{csrf_field()}}
				<div class="modal-body">
					<input type="hidden" name="news_id" id="newsId" value=""/>
					@include('news.form')
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Save Changes</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- Add news Modal-->

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
				null
			],
			"aaSorting": [],			
				select: {
					style: 'multi'
				}
			});
		});

	$('#updateNews').on('show.bs.modal', function (event) {
		console.log('modalopen');
		var button = $(event.relatedTarget) // Button that triggered the modal
		var title = button.data('mytitle') // Extract info from data-* attributes
		var desc = button.data('mydesc') // Extract info from data-* attributes
		var news_id = button.data('news_id')
		var modal = $(this);
		modal.find('.modal-body #title').val(title);
		modal.find('.modal-body #description').val(desc);
		modal.find('.modal-body #newsId').val(news_id);
	});




</script>
@endsection