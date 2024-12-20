<div class="sidebar pe-4 pb-3">
    <nav class="navbar bg-light navbar-light">
        <a href="index.html" class="navbar-brand mx-4 mb-3">
            <h3 class="text-primary"><i class="fa fa-hashtag me-2"></i>TRK Protectors</h3>
        </a>
        <div class="d-flex align-items-center ms-4 mb-4">
            <div class="position-relative">
                <img class="rounded-circle" src="{{ asset('adminth/img/user.jpg') }}" alt=""
                    style="width: 40px; height: 40px;">
                <div
                    class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1">
                </div>
            </div>
            <div class="ms-3">
                <h6 class="mb-0">{{ Auth::user()->fname }}</h6>
                <span>{{ Auth::user()->user_type ?? 'User' }}</span>
            </div>

                </div>
                <div class="navbar-nav w-100">
                    <a href="{{ route('dashboard')}}" class="nav-item nav-link active"><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
                    <a href="{{ route('users_info') }}" class="nav-item nav-link"><i class="fas fa-users me-2"></i>Users</a>
                    <a href="" class="nav-item nav-link"><i class="fa fa-th me-2"></i>Applications</a>
                    <a href="form.html" class="nav-item nav-link"><i class="fa fa-keyboard me-2"></i>Feedbacks</a>
                    <a href="{{ route('certificates') }}" class="nav-item nav-link"><i class="fa fa-keyboard me-2"></i>Certificates</a>


            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i
                        class="far fa-file-alt me-2"></i>Sign Out</a>
                <div class="dropdown-menu bg-transparent border-0">

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="dropdown-item" type="submit">Logout</button>
                    </form>

                </div>
            </div>
        </div>
    </nav>
</div>
