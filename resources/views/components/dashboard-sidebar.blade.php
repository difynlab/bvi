<div class="sidebar active">
    <ul class="main-menu">
        <li>
            <img src="{{ asset('storage/global/logo.png') }}" alt="Logo" class="image">
        </li>
        
        <li class="link">
            <a href="{{ route('admin.dashboard') }}" class="{{ Request::segment(2) == 'dashboard' ? 'active' : '' }}">
                <i class="bi bi-ui-checks-grid"></i>
                Dashboard
            </a>
        </li>

        <li class="link">
            <a href="{{ route('admin.events.index') }}" class="{{ Request::segment(2) == 'events' ? 'active' : '' }}">
                <i class="bi bi-calendar3"></i>
                Events
            </a>
        </li>
    </ul>

    <hr>

    <ul class="main-menu">
        <!-- <li class="link">
            <a href="#" class="{{ Request::segment(2) == 'settings' ? 'active' : '' }}">
                <i class="bi bi-gear"></i>
                Settings
            </a>
        </li> -->

        <li class="link">
            <a href="#">
                <i class="bi bi-power"></i>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="log-out">Log Out</button>
                </form>
            </a>
        </li>
    </ul>
</div>