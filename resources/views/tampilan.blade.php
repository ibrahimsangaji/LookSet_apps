<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>LookSet</title>

    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="{{ asset('page') }}/assets/favicon.ico" />

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <!-- Bootstrap icons-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet" />

    <!-- Custom fonts for this template-->
    <link href="{{ asset('page') }}/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('page') }}/css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="{{ asset('page') }}/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

    <style>
        .notif {
            white-space: normal;
            padding-bottom: 0.5rem;
            border-left: 1px solid #e3e6f0;
            border-right: 1px solid #e3e6f0;
            border-bottom: 1px solid #e3e6f0;
            line-height: 1.3rem;
            min-width: 20rem;
        }
    </style>
</head>
<body>
    <!-- Page Wrapper -->
    <div id="wrapper">
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light topbar static-top shadow" style="background-color: #221ef9; height:80px;">
                    <a class="navbar-brand" href="/welcome">
                        <img src="/lookset.png" alt="Logo" height="50" class="d-inline-block align-text-top">
                    </a>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Notification -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href=" " id="alertsDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bell fa-fw"></i>
                                @php
                                    $unreadCount = auth()->user()->unreadNotifications->where('title', 'font-weight-bold')->count();
                                @endphp
                                <span class="badge badge-danger badge-counter">
                                    {{ $unreadCount > 5 ? '5+' : $unreadCount }}
                                </span>
                            </a>
                            <!-- Dropdown - Notification -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                                <div class="notif">
                                    <div class="dropdown-header d-flex justify-content-between align-items-center">
                                        <h6 class="dropdown-header">Notification</h6>

                                        <a class="dropdown-header mark-all-as-read" href=" " onclick="markAllAsRead()">Mark All as Read</a>
                                    </div>

                                    @forelse(auth()->user()->unreadNotifications->take(5) as $notification)
                                        <a class="dropdown-item d-flex align-items-center" href="{{ url($notification->data['link'] . '?id=' . $notification->id . '&dataNumber=' . $notification->data['number']) }}">
                                            <div class="mr-3">
                                                <div class="{{ $notification->data['iconClass'] }}">
                                                    <i class="{{ $notification->data['icon'] }}"></i>
                                                </div>
                                            </div>
                                            <div>
                                                <div class="small text-gray-500">{{ $notification->created_at->format('F d, Y') }}</div>
                                                <span class="{{ $notification->title }} ">{{ $notification->data['message'] }}</span>
                                            </div>
                                        </a>
                                    @empty
                                        <p class="dropdown-item text-center small text-gray-500">No new notifications</p>
                                    @endforelse

                                    <a class="dropdown-item text-center small text-gray-500" href="#">
                                        Show All Notification
                                    </a>
                                </div>
                            </div>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                @auth
                                    <span class="mr-2 d-none d-lg-inline small">{{ Auth::user()->name }}</span>
                                @endauth
                                <img class="img-profile rounded-circle"
                                    src="{{ asset('page') }}/img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="/logout">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>

                <!-- Begin Page Content -->
                <div>
                    @yield('content')
                </div>
            </div>

            <!-- Footer -->
            <footer class="sticky-footer bg-white px-5">
                <div class="container">
                    <div class="copyright text-center">
                        <span>LookSet&copy; 2024</span>
                    </div>
                </div>
            </footer>

        </div>
    </div>

    <script>
        function markAllAsRead() {
            // Menggunakan AJAX untuk mengirim permintaan ke server
            fetch('/mark-all-as-read', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                },
                body: JSON.stringify({}),
            })
            .then(response => response.json())
            .then(data => {
                // Mengupdate tampilan atau melakukan tindakan lainnya jika diperlukan
                console.log('Marked all notifications as read:', data);
            })
            .catch(error => console.error('Error marking all notifications as read:', error));
        }
    </script>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('page') }}/vendor/jquery/jquery.min.js"></script>
    <script src="{{ asset('page') }}/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('page') }}/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('page') }}/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="{{ asset('page') }}/vendor/chart.js/Chart.min.js"></script>
    <script src="{{ asset('page') }}/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ asset('page') }}/vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('page') }}/js/demo/chart-area-demo.js"></script>
    <script src="{{ asset('page') }}/js/demo/chart-pie-demo.js"></script>
    <script src="{{ asset('page') }}/js/demo/datatables-demo.js"></script>
</body>
</html>
