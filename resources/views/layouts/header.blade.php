<header>
    <div class="topbar d-flex align-items-center">
        <nav class="navbar navbar-expand">
            <div class="mobile-toggle-menu"><i class='bx bx-menu'></i>
            </div>
            <div class="top-menu ms-auto">
                <ul class="navbar-nav align-items-center">
                    @role('admin')
                    <!-- <li class="nav-item dropdown dropdown-large">
                        <a class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <span class="alert-count">{{ count(Auth::user()->unreadNotifications) }}</span>
                            <i class='bx bx-bell'></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <a href="javascript:;">
                                <div class="msg-header">
                                    <p class="msg-header-title">Notifications</p>
                                </div>
                            </a>
                            <div class="header-notifications-list">
                                @foreach (Auth::user()->unreadNotifications as $notification)
                                    <a class="dropdown-item" href="javascript:;">
                                        <div class="d-flex align-items-center">
                                            <div class="notify bg-light-primary text-primary"><i class="bx bx-group"></i></div>
                                            <div class="flex-grow-1">
                                                <h6 class="msg-name">{{ $notification->data['message'] }}
                                            </div>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </li> -->
                    @endrole
                    <li class="nav-item dropdown dropdown-large">
                        <div class="dropdown-menu dropdown-menu-end">
                            <a href="javascript:;">
                            </a>
                            <div class="header-notifications-list">
                                <a class="dropdown-item" href="javascript:;">
                                </a>
                                <a class="dropdown-item" href="javascript:;">
                                </a>
                                <a class="dropdown-item" href="javascript:;">
                                </a>
                                <a class="dropdown-item" href="javascript:;">
                                </a>
                                <a class="dropdown-item" href="javascript:;">
                                </a>
                                <a class="dropdown-item" href="javascript:;">
                                </a>
                                <a class="dropdown-item" href="javascript:;">
                                </a>
                                <a class="dropdown-item" href="javascript:;">
                                </a>
                                <a class="dropdown-item" href="javascript:;">
                                </a>
                            </div>
                            <a href="javascript:;">
                            </a>
                        </div>
                    </li>
                    <li class="nav-item dropdown dropdown-large">
                        <div class="dropdown-menu dropdown-menu-end">
                            <a href="javascript:;">
                            </a>
                            <div class="header-message-list">
                                <a class="dropdown-item" href="javascript:;">
                                </a>
                                <a class="dropdown-item" href="javascript:;">
                                </a>
                                <a class="dropdown-item" href="javascript:;">
                                </a>
                                <a class="dropdown-item" href="javascript:;">
                                </a>
                                <a class="dropdown-item" href="javascript:;">
                                </a>
                                <a class="dropdown-item" href="javascript:;">
                                </a>
                                <a class="dropdown-item" href="javascript:;">
                                </a>
                                <a class="dropdown-item" href="javascript:;">
                                </a>
                                <a class="dropdown-item" href="javascript:;">
                                </a>
                                <a class="dropdown-item" href="javascript:;">
                                </a>
                                <a class="dropdown-item" href="javascript:;">
                                </a>
                            </div>
                            <a href="javascript:;">
                            </a>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="user-box dropdown border-light-2">
                <a class="d-flex align-items-center nav-link dropdown-toggle dropdown-toggle-nocaret" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="{{ url('assets/images/avatars/avatar-2.png')}}" class="user-img" alt="user avatar">
                    <div class="user-info ps-3">
                        <p class="user-name mb-0">{{ Auth::user()->name}}</p>
                        <!-- <p class="designattion mb-0">Web Designer</p> -->
                    </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <a class="dropdown-item" href="{{ route('profile.edit') }}">
                            <i class="bx bx-user"></i><span>Profile</span>
                        </a>
                    </li>
                    <li>
                        <div class="dropdown-divider mb-0"></div>
                    </li>
                    <form id="logout-form" method="POST" action="{{ route('logout') }}">
                        @csrf
                        <li>
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class='bx bx-log-out-circle'></i><span>Logout</span>
                            </a>
                        </li>
                    </form>
                </ul>
            </div>
        </nav>
    </div>
</header>