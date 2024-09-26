<nav class="navbar navbar-expand-lg card navbar-dark bg-primary" style="width: 100VW;">
    <!-- Primary Navigation Menu -->
    <div class="container-fluid">
        <a class="navbar-brand" href="javascript:void(0)"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-ex-7">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbar-ex-7">
            <ul class="navbar-nav ms-lg-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{route('profile.edit')}}">
                           <i class="tf-icons navbar-icon ri-user-3-line me-1"></i> {{ __('Profile') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="javascript:void(0)"><i class="tf-icons navbar-icon ri-settings-3-line me-1"></i>Settings</a>
                </li>
                <li class="nav-item">

                    <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <a class="nav-link" href="{{route('logout')}}"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </a>
                        </form>

                </li>
            </ul>
        </div>
    </div>
</nav>

