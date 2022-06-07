@extends('layouts.admin')

@section('PageTitle' , 'Create New Category')
@section('content')
	<div class="row">
		<!-- left column -->
		<div class="col-md-12">
			<!-- jquery validation -->
			<div class="card card-primary">
				<div class="card-header">
					<h3 class="card-title">Add New Category </h3>
				</div>
				<!-- /.card-header -->
				<!-- form start -->
				<form role="form" id="quickForm" action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
					@csrf
					<div class="card-body">
						<div class="form-group">
							<label for="exampleInputEmail1">Category Name</label>
							<input type="text" name="name" class="form-control" id="exampleInputEmail1" placeholder="Enter Name"
								value="{{ old('name') }}">
							@error('name')
								<p class="text-danger">{{ $message }}</p>
							@enderror
						</div>
						<div class="form-group">
							<label for="exampleInputPassword1">Description </label>
							<textarea name="description" id="" class="form-control" cols="30" rows="5">{{ old('description') }}</textarea>
							@error('description')
								<p class="text-danger">{{ $message }}</p>
							@enderror
						</div>
						<div class="form-group mb-0">
							<label for="parent">Parent </label>
							<select name="parent" id="parent" class="form-control">
								<option value="">Chose Parent</option>
								@foreach ($parents as $parent)
									<option value="{{ $parent->id }}">{{$parent->name}}</option>
								@endforeach
							</select>
							@error('parent')
								<p class="text-danger">{{ $message }}</p>
							@enderror
						</div>

						<div class="form-group">
							<label for="image">Image</label>
							<input type="file" class="form-control" name="image" id="image">
							@error('image')
								<p class="text-danger">{{ $message }}</p>
							@enderror
						</div>

						<div class="form-check">
							<input class="form-check-input" value="active" type="radio" name="status" id="status">
							<label class="form-check-label" for="flexRadioDefault1">
								Active
							</label>
						</div>
						<div class="form-check">
							<input class="form-check-input" value="draft" type="radio" name="status" id="status">
							<label class="form-check-label" for="status">
								Draft
							</label>
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


@section('script')
	<script type="text/javascript">
	 $(document).ready(function() {
	  $.validator.setDefaults({
	   submitHandler: function() {
	    alert("Form successful submitted!");
	   }
	  });
	  $('#quickForm').validate({
	   rules: {
	    email: {
	     required: true,
	     email: true,
	    },
	    password: {
	     required: true,
	     minlength: 5
	    },
	    terms: {
	     required: true
	    },
	   },
	   messages: {
	    email: {
	     required: "Please enter a email address",
	     email: "Please enter a vaild email address"
	    },
	    password: {
	     required: "Please provide a password",
	     minlength: "Your password must be at least 5 characters long"
	    },
	    terms: "Please accept our terms"
	   },
	   errorElement: 'span',
	   errorPlacement: function(error, element) {
	    error.addClass('invalid-feedback');
	    element.closest('.form-group').append(error);
	   },
	   highlight: function(element, errorClass, validClass) {
	    $(element).addClass('is-invalid');
	   },
	   unhighlight: function(element, errorClass, validClass) {
	    $(element).removeClass('is-invalid');
	   }
	  });
	 });
	</script>
@endsection
