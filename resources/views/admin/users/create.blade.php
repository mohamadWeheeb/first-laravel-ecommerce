@extends('layouts.admin')

@section('PageTitle' , 'Add New User')
@section('content')
	<div class="row">
		<!-- left column -->
		<div class="col-md-12">
			<!-- jquery validation -->
			<div class="card card-primary">
				<div class="card-header">
					<h3 class="card-title">Add New User </h3>
				</div>
				<!-- /.card-header -->
				<!-- form start -->
				<form role="form" id="quickForm" action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
					@csrf
					<div class="card-body">
						<div class="form-group">
							<label for="exampleInputEmail1">User Name</label>
							<input type="text" name="name" class="form-control" id="exampleInputEmail1" placeholder="Enter Name"
								value="{{ old('name') }}">
							@error('name')
								<p class="text-danger">{{ $message }}</p>
							@enderror
						</div>
						<div class="form-group">
							<label for="exampleInputEmail1">User E-mail</label>
							<input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="Enter E-mail"
								value="{{ old('email') }}">
							@error('email')
								<p class="text-danger">{{ $message }}</p>
							@enderror
						</div>
						<div class="form-group">
							<label for="exampleInputEmail1">User Password</label>
							<input type="password" name="password" class="form-control" id="exampleInputEmail1" placeholder="Enter password"
								value="{{ old('password') }}">
							@error('password')
								<p class="text-danger">{{ $message }}</p>
							@enderror
						</div>
                        <div class="form-group">
							<label for="exampleInputEmail1">Confirm Password</label>
							<input type="password" name="password_confirmation" class="form-control" id="exampleInputEmail1" placeholder="Enter password"
								value="{{ old('password_confirmation') }}">
							@error('password_confirmation')
								<p class="text-danger">{{ $message }}</p>
							@enderror
						</div>
                        <div class="form-group mb-0">
							<label for="type">Type </label>
							<select name="type" id="type" class="form-control">
								<option value="">User Type</option>
									<option value="user">User</option>
									<option value="admin">Admin</option>
									<option value="super-admin">Super Admin</option>
							</select>
							@error('type')
								<p class="text-danger">{{ $message }}</p>
							@enderror
						</div>


                        <div class="form-group mb-0">
							<label for="role">User Role </label>
							<select name="role" id="type" class="form-control">
								<option value="">User Roles</option>
                                @foreach($roles as $id => $name)
									<option value="{{ $id }}">{{ $name }}</option>
                                    @endforeach
							</select>
							@error('role')
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

