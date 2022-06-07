<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>@yield('PageTitle', 'Dashboard')</title>
	<!-- Tell the browser to be responsive to screen width -->
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Font Awesome -->
	<link rel="stylesheet" href="{{ asset('admin/plugins/fontawesome-free/css/all.min.css') }}">
	<!-- overlayScrollbars -->
	<link rel="stylesheet" href="{{ asset('admin/dist/css/adminlte.min.css') }}">
	@yield('css')
</head>

<body class="hold-transition sidebar-mini">
	<!-- Site wrapper -->
	<div class="wrapper">
		<!-- Navbar -->
		<nav class="main-header navbar navbar-expand navbar-white navbar-light">
			<!-- Left navbar links -->
			<ul class="navbar-nav">
				<li class="nav-item">
					<a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
				</li>
				<li class="nav-item d-none d-sm-inline-block">
					<a href="{{ route('admin.dashboard') }}" class="nav-link">Home</a>
				</li>
				<li class="nav-item d-none d-sm-inline-block">
					<a href="{{ route('home') }}" class="nav-link">Visit Website</a>
				</li>
				<li class="nav-item d-none d-sm-inline-block">
					<form action="{{ route('logout') }}" method="POST" id="form-id" hidden>
						@csrf
						<input type="submit" value="">
					</form>
					<a href="javascript:void(0);" onclick="document.getElementById('form-id').submit();"
						class="nav-link">Logout</a>
				</li>
			</ul>

			<!-- SEARCH FORM -->
			<form class="form-inline ml-3">
				<div class="input-group input-group-sm">
					<input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
					<div class="input-group-append">
						<button class="btn btn-navbar" type="submit">
							<i class="fas fa-search"></i>
						</button>
					</div>
				</div>
			</form>


			<!-- Right navbar links -->
			<ul class="navbar-nav ml-auto">
				<!-- Messages Dropdown Menu -->
				<li class="nav-item dropdown">
					<a class="nav-link" data-toggle="dropdown" href="#">
						<i class="far fa-comments"></i>
						<span class="badge badge-danger navbar-badge">3</span>
					</a>
					<div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
						<a href="#" class="dropdown-item">
							<!-- Message Start -->
							<div class="media">
								<img src="../../dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
								<div class="media-body">
									<h3 class="dropdown-item-title">
										Brad Diesel
										<span class="text-danger float-right text-sm"><i class="fas fa-star"></i></span>
									</h3>
									<p class="text-sm">Call me whenever you can...</p>
									<p class="text-muted text-sm"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
								</div>
							</div>
							<!-- Message End -->
						</a>
						<div class="dropdown-divider"></div>
						<a href="#" class="dropdown-item">
							<!-- Message Start -->
							<div class="media">
								<img src="../../dist/img/user8-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
								<div class="media-body">
									<h3 class="dropdown-item-title">
										John Pierce
										<span class="text-muted float-right text-sm"><i class="fas fa-star"></i></span>
									</h3>
									<p class="text-sm">I got your message bro</p>
									<p class="text-muted text-sm"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
								</div>
							</div>
							<!-- Message End -->
						</a>
						<div class="dropdown-divider"></div>
						<a href="#" class="dropdown-item">
							<!-- Message Start -->
							<div class="media">
								<img src="../../dist/img/user3-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
								<div class="media-body">
									<h3 class="dropdown-item-title">
										Nora Silvester
										<span class="text-warning float-right text-sm"><i class="fas fa-star"></i></span>
									</h3>
									<p class="text-sm">The subject goes here</p>
									<p class="text-muted text-sm"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
								</div>
							</div>
							<!-- Message End -->
						</a>
						<div class="dropdown-divider"></div>
						<a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
					</div>
				</li>
				<!-- Notifications Dropdown Menu -->
				<li class="nav-item dropdown">
					<a class="nav-link" data-toggle="dropdown" href="#">
						<i class="far fa-bell"></i>
						<span class="badge badge-warning navbar-badge">15</span>
					</a>
					<div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
						<span class="dropdown-item dropdown-header">15 Notifications</span>
						<div class="dropdown-divider"></div>
						<a href="#" class="dropdown-item">
							<i class="fas fa-envelope mr-2"></i> 4 new messages
							<span class="text-muted float-right text-sm">3 mins</span>
						</a>
						<div class="dropdown-divider"></div>
						<a href="#" class="dropdown-item">
							<i class="fas fa-users mr-2"></i> 8 friend requests
							<span class="text-muted float-right text-sm">12 hours</span>
						</a>
						<div class="dropdown-divider"></div>
						<a href="#" class="dropdown-item">
							<i class="fas fa-file mr-2"></i> 3 new reports
							<span class="text-muted float-right text-sm">2 days</span>
						</a>
						<div class="dropdown-divider"></div>
						<a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
					</div>
				</li>
				<li class="nav-item">
					<a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
						<i class="fas fa-th-large"></i>
					</a>
				</li>
			</ul>
		</nav>
		<!-- /.navbar -->

		<!-- Main Sidebar Container -->
		<aside class="main-sidebar sidebar-dark-primary elevation-4">
			<!-- Brand Logo -->
			<a href="../../index3.html" class="brand-link">
				<img src="../../dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
					style="opacity: .8">
				<span class="brand-text font-weight-light">AdminLTE 3</span>
			</a>

			<!-- Sidebar -->
			<div class="sidebar">
				<!-- Sidebar user (optional) -->
				<div class="user-panel d-flex mt-3 mb-3 pb-3">
					<div class="image">
						<img src="{{ Auth::user()->Image_url }}" class="img-circle elevation-2" alt="User Image">
					</div>
					<div class="info">
						<a href="{{ route('users.show', Auth::id()) }}" class="d-block"> {{ Auth::user()->name }}</a>
					</div>
				</div>

				<!-- Sidebar Menu -->
				<nav class="mt-2">
					<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
						<!-- Add icons to the links using the .nav-icon class
															with font-awesome or any other icon font library -->

						<li class="nav-item">
							<a href="{{ route('users.index') }}" class="nav-link">
								<i class="nav-icon fas fa-th"></i>
								<p>
									Users
								</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="{{ route('categories.index') }}" class="nav-link">
								<i class="nav-icon fas fa-th"></i>
								<p>
									Categories
								</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="{{ route('products.index') }}" class="nav-link">
								<i class="nav-icon fas fa-th"></i>
								<p>
									Products
								</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="{{ route('blogs.index') }}" class="nav-link">
								<i class="nav-icon fas fa-th"></i>
								<p>
									Blogs
								</p>
							</a>
						</li>

						<li class="nav-item">
							<a href="{{ route('roles.index') }}" class="nav-link">
								<i class="nav-icon fas fa-th"></i>
								<p>
									Roles
								</p>
							</a>
						</li>


					</ul>
				</nav>
				<!-- /.sidebar-menu -->
			</div>
			<!-- /.sidebar -->
		</aside>

		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
			<!-- Content Header (Page header) -->
			<section class="content-header">
				<div class="container-fluid">
					<div class="row mb-2">
						<div class="col-sm-6">
							<h1>@yield('PageTitle')</h1>
						</div>

					</div>
				</div><!-- /.container-fluid -->
			</section>

			<!-- Main content -->
			<section class="content">

				@yield('content')
				<!-- Default box -->

				<!-- /.card -->

			</section>
			<!-- /.content -->
		</div>
		<!-- /.content-wrapper -->

		<footer class="main-footer">
			<div class="d-none d-sm-block float-right">
				<b>Version</b> 3.0.5
			</div>
			<strong>Copyright &copy; 2014-2019 <a href="http://adminlte.io">AdminLTE.io</a>.</strong> All rights
			reserved.
		</footer>

		<!-- Control Sidebar -->
		<aside class="control-sidebar control-sidebar-dark">
			<!-- Control sidebar content goes here -->
		</aside>
		<!-- /.control-sidebar -->
	</div>
	<!-- ./wrapper -->


      {{-- start pusher --}}

{{--
<script src="https://js.pusher.com/7.0/pusher.min.js"></script>
<script>

  // Enable pusher logging - don't include this in production
  Pusher.logToConsole = true;

  var pusher = new Pusher('152f40ba3ab791fa55ba', {
    cluster: 'eu' ,
    authEndpoint : "broadcasting/auth"
  });

  var channel = pusher.subscribe('private-App.Models.User.{{ Auth::id() }}');
  channel.bind('Illuminate\\Notifications\\Events\\BroadcastNotificationCreated', function(data) {
    alert(data.title);
  });
</script> --}}

    {{-- End Pusher  --}}
    <script>
        Window.UserId = "{{ Auth::id() }}" ;
    </script>
    <script src="{{ asset('js/app.js') }}"></script>
	<!-- jQuery -->
	<script src="{{ asset('admin/plugins/jquery/jquery.min.js') }}"></script>
	<!-- Bootstrap 4 -->
	<script src="{{ asset('admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
	<!-- AdminLTE App -->
	<script src="{{ asset('admin/dist/js/adminlte.min.js') }}"></script>
	<!-- AdminLTE for demo purposes -->
	<script src="{{ asset('admin/dist/js/demo.js') }}"></script>
	@yield('script')


</body>

</html>
