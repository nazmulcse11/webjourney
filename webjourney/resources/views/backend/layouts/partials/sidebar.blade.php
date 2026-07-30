<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('admin.dashboard') }}" class="brand-link">
        <img src="{{ asset('images/favicon/favicon.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">{{ ('Web Journey') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link @if(request()->routeIs(['admin.dashboard'])) active @endif">
                        <i class="nav-icon fas fa-th"></i>
                        <p>{{ __('Dashboard') }}</p>
                    </a>
                </li>

                {{--catelouge start--}}
                <li class="nav-item
                    @if(request()->routeIs(['admin.category'])
                    || request()->routeIs(['admin.subcategory'])
                    ||request()->routeIs(['admin.tag'])
                    ||request()->routeIs(['admin.post'])
                    ||request()->routeIs(['admin.add.post'])
                    ||request()->routeIs(['admin.edit.post'])
                    || request()->routeIs(['admin.post.comment'])
                    ) menu-open @endif">
                    <a href="#" class="nav-link
                        @if(request()->routeIs(['admin.category'])
                            || request()->routeIs(['admin.subcategory'])
                            || request()->routeIs(['admin.tag'])
                            || request()->routeIs(['admin.post'])
                            || request()->routeIs(['admin.add.post'])
                            || request()->routeIs(['admin.edit.post'])
                            || request()->routeIs(['admin.post.comment'])
                            ) active @endif">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            {{ __('Catalogue') }}
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.category') }}" class="nav-link @if(request()->routeIs(['admin.category'])) active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('Category') }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.subcategory') }}" class="nav-link @if(request()->routeIs(['admin.subcategory'])) active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('Sub Category') }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.tag') }}" class="nav-link @if(request()->routeIs(['admin.tag'])) active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('Tag') }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.post') }}"
                               class="nav-link
                                @if(request()->routeIs(['admin.post'])
                                || request()->routeIs(['admin.add.post'])
                                || request()->routeIs(['admin.edit.post'])
                                ) active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('Post') }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.post.comment') }}" class="nav-link @if(request()->routeIs(['admin.post.comment'])) active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('Comment') }}</p>
                            </a>
                        </li>
                    </ul>
                </li>
                {{--catelouge end--}}

                {{--quiz start--}}
                <li class="nav-item
                    @if(request()->routeIs(['admin.quiz'])
                    ||request()->routeIs(['admin.add.quiz'])
                    ||request()->routeIs(['admin.edit.quiz'])
                    || request()->routeIs(['admin.type'])
                    || request()->routeIs(['admin.add.type'])
                    || request()->routeIs(['admin.edit.type'])
                    ) menu-open @endif">
                    <a href="#" class="nav-link
                        @if(request()->routeIs(['admin.quiz'])
                            || request()->routeIs(['admin.add.quiz'])
                            || request()->routeIs(['admin.edit.quiz'])
                            || request()->routeIs(['admin.type'])
                            || request()->routeIs(['admin.add.type'])
                            || request()->routeIs(['admin.edit.type'])
                            ) active @endif">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            {{ __('Quizzes') }}
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.type') }}"
                               class="nav-link
                                @if(request()->routeIs(['admin.type'])
                                || request()->routeIs(['admin.add.type'])
                                || request()->routeIs(['admin.edit.type'])
                                ) active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('Type') }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.quiz') }}"
                               class="nav-link
                                @if(request()->routeIs(['admin.quiz'])
                                || request()->routeIs(['admin.add.quiz'])
                                || request()->routeIs(['admin.edit.quiz'])
                                ) active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('Quiz') }}</p>
                            </a>
                        </li>
                    </ul>
                </li>
                {{--quiz end--}}

                {{--course start--}}
                <li class="nav-item
                    @if(request()->routeIs(['admin.course'])
                    ||request()->routeIs(['admin.add.course'])
                    ||request()->routeIs(['admin.edit.course'])
                    ) menu-open @endif">
                    <a href="#" class="nav-link
                        @if(request()->routeIs(['admin.course'])
                            || request()->routeIs(['admin.add.course'])
                            || request()->routeIs(['admin.edit.course'])
                            ) active @endif">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            {{ __('Courses') }}
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.course') }}"
                               class="nav-link
                                @if(request()->routeIs(['admin.course'])
                                || request()->routeIs(['admin.add.course'])
                                || request()->routeIs(['admin.edit.course'])
                                ) active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('Course') }}</p>
                            </a>
                        </li>
                    </ul>
                </li>
                {{--course end--}}

                {{--page settings start--}}
                <li class="nav-item
                    @if(request()->routeIs([
                        'admin.settings.contact.page','admin.settings.home.page',
                        ])) menu-open @endif">
                    <a href="#" class="nav-link
                    @if(request()->routeIs([
                         'admin.settings.contact.page', 'admin.settings.home.page',
                         ])) active @endif">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            {{ __('Page Settings') }}
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.settings.home.page') }}"
                               class="nav-link
                                @if(request()->routeIs(['admin.settings.home.page'])
                                ) active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('Home Page') }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.settings.contact.page') }}"
                               class="nav-link
                                @if(request()->routeIs(['admin.settings.contact.page'])
                                ) active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ __('Contact Page') }}</p>
                            </a>
                        </li>
                    </ul>
                </li>
                {{--page settings  end--}}

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Simple Link
                            <span class="right badge badge-danger">New</span>
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.logout') }}" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>{{ __('Logout') }}</p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
