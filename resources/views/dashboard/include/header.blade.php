<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light"
    style="background: #5C3D2E; border-bottom: 2px solid #4A3226;">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button" style="color: #F0E8E0;">
                <i class="fas fa-bars"></i>
            </a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
     
        <!-- Messages Dropdown Menu -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#" style="color: #F0E8E0;">
                <i class="far fa-comments"></i>
                <span class="badge badge-danger navbar-badge" style="background: #C0392B;">
                    {{ $unreadCount ?? 0 }}
                </span>
            </a>

            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right"
                style="border-radius: 12px; border: 1px solid #E8DCD2; box-shadow: 0 8px 25px rgba(92, 61, 46, 0.15);">

                @forelse($latestMessages ?? [] as $latestMessage)
                    <a href="{{ route('admin.contact.show', $latestMessage->id) }}" class="dropdown-item"
                        style="padding: 12px 16px; transition: all 0.2s;" onmouseover="this.style.background='#FBF7F4'"
                        onmouseout="this.style.background='transparent'">

                        <div class="media">

                            {{-- Avatar --}}
                            <div class="img-size-50 mr-3 img-circle d-flex align-items-center justify-content-center text-white"
                                style="background: #8B6B4A; width: 50px; height: 50px; border-radius: 50%; font-weight: 700; font-size: 1rem; flex-shrink: 0;">
                                {{ Str::substr($latestMessage->fullname, 0, 2) }}
                            </div>

                            <div class="media-body">
                                <h3 class="dropdown-item-title"
                                    style="font-weight: 600; color: #5C3D2E; margin-bottom: 4px;">
                                    {{ $latestMessage->fullname }}

                                    @if (!$latestMessage->is_read ?? false)
                                        <span class="float-right text-sm" style="color: #C0392B;">
                                            <i class="fas fa-circle" style="font-size: 8px;"></i>
                                        </span>
                                    @endif
                                </h3>

                                <p class="text-sm" style="color: #6B4F3A; margin-bottom: 4px;">
                                    {{ Str::limit($latestMessage->message, 40) }}
                                </p>

                                <p class="text-sm" style="color: #A67B5B; margin-bottom: 0;">
                                    <i class="far fa-clock mr-1"></i>
                                    {{ $latestMessage->created_at->diffForHumans() }}
                                </p>
                            </div>

                        </div>

                    </a>

                    <div class="dropdown-divider" style="border-color: #E8DCD2; margin: 0;"></div>
                @empty
                    <div class="dropdown-item text-center" style="color: #8B6B4A; padding: 20px;">
                        <i class="far fa-envelope-open"
                            style="font-size: 1.5rem; display: block; margin-bottom: 8px; color: #C4A88C;"></i>
                        No messages
                    </div>
                @endforelse

                <a href="{{ route('admin.contact.index') }}" class="dropdown-item dropdown-footer"
                    style="background: #FBF7F4; color: #5C3D2E; font-weight: 600; text-align: center; padding: 12px; border-radius: 0 0 12px 12px; transition: all 0.2s;"
                    onmouseover="this.style.background='#E8DCD2'" onmouseout="this.style.background='#FBF7F4'">
                    See All Messages
                    <i class="fas fa-arrow-right ml-1"></i>
                </a>

            </div>
        </li>

        <!-- User Menu -->
        <li class="nav-item dropdown user-menu mr-5">
            <a href="#" class="nav-link dropdown-toggle rounded p-2 " data-toggle="dropdown"
                style="color: #F0E8E0;
            ">

                @if (Auth::guard('admin')->user()?->image)
                    <img src="{{ asset('storage/' . Auth::guard('admin')->user()->image) }}"
                        class="user-image img-circle " alt="User Image"
                        style="width: 40px; height: 40px; border-radius: 50%; border: 2px solid #6c6156;">
                @else
                    <img src="{{ asset('backend/image/avatar.jpg') }}" class="user-image img-circle " alt="User Image"
                        style="width: 40px; height: 40px; border-radius: 50%; border: 2px solid #F0E8E0;">
                @endif

                <span class="d-none d-md-inline" style="color: #6c6156; font-weight: 500;">
                    {{ Auth::guard('admin')->user()?->name ?? 'User' }}
                </span>
            </a>

            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right"
                style="border-radius: 12px; border: 1px solid #E8DCD2; box-shadow: 0 8px 25px rgba(92, 61, 46, 0.15); padding: 0;">

                <div class="dropdown-item" style="padding: 16px; background: #5C3D2E; border-radius: 12px 12px 0 0;">
                    <div class="text-center" style="color: #F0E8E0;">
                        <div style="font-weight: 700; font-size: 1.1rem;">
                            {{ Auth::guard('admin')->user()?->name ?? 'User' }}</div>
                        <div style="font-size: 0.85rem; opacity: 0.8;">
                            {{ Auth::guard('admin')->user()?->email ?? '' }}
                        </div>
                    </div>
                </div>

                <div class="dropdown-divider" style="margin: 0; border-color: #E8DCD2;"></div>

                <a href="{{ route('admin.profile.index') }}" class="dropdown-item"
                    style="padding: 12px 16px; color: #5C3D2E; transition: all 0.2s;"
                    onmouseover="this.style.background='#FBF7F4'" onmouseout="this.style.background='transparent'">
                    <i class="fas fa-user mr-2" style="color: #cc7824;"></i>
                    Profile
                </a>

                <a href="{{ route('admin.profile.index') }}" class="dropdown-item"
                    style="padding: 12px 16px; color: #5C3D2E; transition: all 0.2s;"
                    onmouseover="this.style.background='#FBF7F4'" onmouseout="this.style.background='transparent'">
                    <i class="fas fa-cog mr-2" style="color: #cc7824;"></i>
                    Settings
                </a>

                <div class="dropdown-divider" style="margin: 0; border-color: #E8DCD2;"></div>

                <form action="{{ route('admin.logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="dropdown-item"
                        style="padding: 12px 16px; color: #C0392B; transition: all 0.2s; width: 100%; text-align: left; border: none; background: transparent;"
                        onmouseover="this.style.background='#FBF7F4'"
                        onmouseout="this.style.background='transparent'">
                        <i class="fas fa-sign-out-alt mr-2"></i>
                        Logout
                    </button>
                </form>

            </div>
        </li>

    </ul>
</nav>
<!-- /.navbar -->
