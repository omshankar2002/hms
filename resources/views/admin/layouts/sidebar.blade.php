<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('front.home') }}" class="brand-link d-flex flex-column align-items-center justify-content-center text-center" style="padding: 1rem;">
        <img src="{{ asset('hotel-assets/images/logo.png') }}" alt="Hotel Logo" style="width: 150px; height: 60px; opacity: 0.9; object-fit: contain;" class="elevation-3 mb-2">
        <span class="brand-text font-weight-light" style="font-size: 15px;">Hotel Management</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                {{-- Dashboard --}}
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                {{-- Rooms Section --}}
                <li class="nav-header" style="color:#c2c7d0; font-size:11px; padding: 8px 16px 4px;">ROOMS</li>

                <li class="nav-item {{ request()->routeIs('room-types.*') ? 'menu-open' : '' }}">
                    <a href="{{ route('room-types.index') }}" class="nav-link {{ request()->routeIs('room-types.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-bed"></i>
                        <p>Room Types</p>
                    </a>
                </li>

                <li class="nav-item {{ request()->routeIs('rooms.*') ? 'menu-open' : '' }}">
                    <a href="{{ route('rooms.index') }}" class="nav-link {{ request()->routeIs('rooms.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-door-open"></i>
                        <p>Rooms</p>
                    </a>
                </li>

                {{-- Bookings Section --}}
                <li class="nav-header" style="color:#c2c7d0; font-size:11px; padding: 8px 16px 4px;">BOOKINGS</li>

                <li class="nav-item">
                    <a href="{{ route('bookings.create') }}" class="nav-link {{ request()->routeIs('bookings.create') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-plus-circle"></i>
                        <p>New Booking</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('bookings.index') }}" class="nav-link {{ request()->routeIs('bookings.index') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-calendar-check"></i>
                        <p>All Bookings</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('bookings.index', ['status' => 'checked_in']) }}" class="nav-link">
                        <i class="nav-icon fas fa-sign-in-alt"></i>
                        <p>Checked In</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('bookings.index', ['status' => 'pending']) }}" class="nav-link">
                        <i class="nav-icon fas fa-clock"></i>
                        <p>Pending</p>
                    </a>
                </li>

                {{-- Guests --}}
                <li class="nav-header" style="color:#c2c7d0; font-size:11px; padding: 8px 16px 4px;">GUESTS</li>

                <li class="nav-item">
                    <a href="{{ route('guests.index') }}" class="nav-link {{ request()->routeIs('guests.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-user-friends"></i>
                        <p>Guest Management</p>
                    </a>
                </li>

                {{-- Billing --}}
                <li class="nav-header" style="color:#c2c7d0; font-size:11px; padding: 8px 16px 4px;">BILLING</li>

                <li class="nav-item">
                    <a href="{{ route('payments.index') }}" class="nav-link {{ request()->routeIs('payments.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-credit-card"></i>
                        <p>Payments</p>
                    </a>
                </li>

                {{-- Housekeeping --}}
                <li class="nav-header" style="color:#c2c7d0; font-size:11px; padding: 8px 16px 4px;">OPERATIONS</li>

                <li class="nav-item">
                    <a href="{{ route('housekeeping.index') }}" class="nav-link {{ request()->routeIs('housekeeping.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-broom"></i>
                        <p>Housekeeping</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('hotel-services.index') }}" class="nav-link {{ request()->routeIs('hotel-services.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-concierge-bell"></i>
                        <p>Hotel Services</p>
                    </a>
                </li>

                {{-- Website Content --}}
                <li class="nav-header" style="color:#c2c7d0; font-size:11px; padding: 8px 16px 4px;">WEBSITE</li>

                <li class="nav-item">
                    <a href="{{ route('admin.banner.edit') }}" class="nav-link {{ request()->routeIs('admin.banner.edit') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-image"></i>
                        <p>Homepage Banner</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('about.edit') }}" class="nav-link {{ request()->routeIs('about.edit') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-info-circle"></i>
                        <p>About Section</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('services.index') }}" class="nav-link {{ request()->routeIs('services.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-briefcase"></i>
                        <p>Services</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('testimonials.index') }}" class="nav-link {{ request()->routeIs('testimonials.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-comments"></i>
                        <p>Testimonials</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('faqs.index') }}" class="nav-link {{ request()->routeIs('faqs.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-question-circle"></i>
                        <p>FAQs</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('blogs.index') }}" class="nav-link {{ request()->routeIs('blogs.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-newspaper"></i>
                        <p>Blogs</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.social-links') }}" class="nav-link {{ request()->routeIs('admin.social-links') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-share-alt"></i>
                        <p>Social & Contact</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.popup.edit') }}" class="nav-link {{ request()->routeIs('admin.popup.edit') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-bell"></i>
                        <p>Homepage Popup</p>
                    </a>
                </li>

                {{-- Users & Settings --}}
                <li class="nav-header" style="color:#c2c7d0; font-size:11px; padding: 8px 16px 4px;">SETTINGS</li>

                <li class="nav-item">
                    <a href="{{ route('users.index') }}" class="nav-link {{ request()->routeIs('users.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-users"></i>
                        <p>Users</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('newsletter.*') ? 'active' : '' }}" data-bs-toggle="collapse" href="#newsletterMenu" role="button">
                        <i class="nav-icon fas fa-envelope-open-text"></i>
                        <p>Newsletter <i class="fas fa-angle-right right"></i></p>
                    </a>
                    <div class="collapse {{ request()->routeIs('newsletter.*') ? 'show' : '' }}" id="newsletterMenu">
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('newsletter.list') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Subscribers</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('newsletter.bulk') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Send Bulk Mail</p>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.showChangePasswordForm') }}" class="nav-link {{ request()->routeIs('admin.showChangePasswordForm') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-lock"></i>
                        <p>Change Password</p>
                    </a>
                </li>

            </ul>
        </nav>
    </div>
</aside>
