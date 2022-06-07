@extends('layouts.admin')

@section('PageTitle' , 'Create Article')

@section('content')
	<div class="row">
		<!-- left column -->
		<div class="col-md-12">
			<!-- jquery validation -->
			<div class="card card-primary">
				<div class="card-header">
					<h3 class="card-title">Add New Article  </h3>
				</div>
				<!-- /.card-header -->
				<!-- form start -->
				<form role="form" id="quickForm" action="{{ route('blogs.store') }}" method="POST" enctype="multipart/form-data">
					@csrf
					<div class="card-body">
						<div class="form-group">
							<label for="exampleInputEmail1">Article Title</label>
							<input type="text" name="title" class="form-control" id="exampleInputEmail1" placeholder="Enter title"
								value="{{ old('title') }}">
							@error('title')
								<p class="text-danger">{{ $message }}</p>
							@enderror
						</div>
						<div class="form-group">
							<label for="exampleInputPassword1">Article Body </label>
							<textarea name="body" id="" class="form-control" cols="30" rows="5">{{ old('body') }}</textarea>
							@error('body')
								<p class="text-danger">{{ $message }}</p>
							@enderror
						</div>
						<div class="form-group mb-0">
							<label for="parent">Article Category </label>
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

                        <div class="form-group">
							<label for="exampleInputEmail1">Article Tags</label>
							<input type="text" name="tags" class="form-control" id="exampleInputEmail1" placeholder="Enter Tags"
								value="{{ old('tags') }}">
							@error('tags')
								<p class="text-danger">{{ $message }}</p>
							@enderror
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


