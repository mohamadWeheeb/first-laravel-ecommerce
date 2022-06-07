@extends('layouts.admin')
@section('PageTitle' , 'Edit Article')


@section('content')
	<div class="row">
		<!-- left column -->
		<div class="col-md-12">
			<!-- jquery validation -->
			<div class="card card-primary">
				<div class="card-header">
					<h3 class="card-title">Edit Category {{ $category->name }} </h3>
				</div>
				<!-- /.card-header -->
				<!-- form start -->
				<form role="form" id="quickForm" action="{{ route('categories.update' , $category->id) }}" method="POST" enctype="multipart/form-data">
					@csrf
                    @method('put')
					<div class="card-body">
						<div class="form-group">
							<label for="exampleInputEmail1">Category Name</label>
							<input type="text" name="name" class="form-control" id="exampleInputEmail1" placeholder="Enter Name"
								value="{{ old('name' , $category->name) }}">
							@error('name')
								<p class="text-danger">{{ $message }}</p>
							@enderror
						</div>
						<div class="form-group">
							<label for="exampleInputPassword1">Description </label>
							<textarea name="description" id="" class="form-control" cols="30" rows="5">{{ old('description' , $category->description) }}</textarea>
							@error('description')
								<p class="text-danger">{{ $message }}</p>
							@enderror
						</div>
						<div class="form-group mb-0">
							<label for="parent">Parent </label>
							<select name="parent" id="parent" class="form-control">
								<option value="">Chose Parent</option>
								@foreach ($parents as $parent)
									<option value="{{ $parent->id }}" @if($parent->id == old('parent' , $category->parent_id)) selected @endif>$parent->name</option>
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
                            @if($category->image)
                            <img src="{{ asset('storage/' . $category->image) }}" width="100" alt="{{ $category->name }}">
                            @endif
						</div>

						<div class="form-check">
							<input class="form-check-input" value="active" type="radio" name="status" id="status" @if($category->status == 'active') checked @endif>
							<label class="form-check-label" for="flexRadioDefault1">
								Active
							</label>
						</div>
						<div class="form-check">
							<input class="form-check-input" value="draft" type="radio" name="status" id="status" @if($category->status == 'draft') checked @endif>
							<label class="form-check-label" for="status">
								Draft
							</label>
						</div>

					</div>
					<!-- /.card-body -->
					<div class="card-footer">
						<button type="submit" class="btn btn-primary">Update</button>
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


