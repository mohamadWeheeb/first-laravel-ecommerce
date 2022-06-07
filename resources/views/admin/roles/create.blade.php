@extends('layouts.admin')

@section('PageTitle', 'Create Roles')

@section('content')
	<div class="row">
		<!-- left column -->
		<div class="col-md-12">
			<!-- jquery validation -->
			<div class="card card-primary">
				<div class="card-header">
					<h3 class="card-title">Add New Roles </h3>
				</div>
				<!-- /.card-header -->
				<!-- form start -->
				<form role="form" id="quickForm" action="{{ route('roles.store') }}" method="POST" enctype="multipart/form-data">
					@csrf
					<div class="card-body">
						<div class="form-group">
							<label for="exampleInputEmail1">Roles Name</label>
							<input type="text" name="name" class="form-control" id="exampleInputEmail1" placeholder="Enter Name"
								value="{{ old('name') }}">
							@error('name')
								<p class="text-danger">{{ $message }}</p>
							@enderror
						</div>


						<div class="form-group">
							@foreach (config('abilities') as $ability => $label)
								<div class="form-check">
									<input class="form-check-input" name="abilities[]" type="checkbox" value="{{ $ability }}" id="flexCheckDefault">
									<label class="form-check-label" for="flexCheckDefault">
										{{ $label }}
									</label>
								</div>
							@endforeach
						</div>
					</div>
					<!-- /.card-body -->
					<div class="card-footer">
						<button type="submit" class="btn btn-primary">Add</button>
					</div>
				</form>
			</div>
			<!-- /.card -->
		</div>
		<!--/.col (left) -->
		<!-- right column -->
		<div class="col-md-6">

		</div>
		<!--/.col (right) -->
	</div>
@endsection
