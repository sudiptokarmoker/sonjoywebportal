<div class="sidebar-menu">
    <div class="sidebar-header">
        <div class="logo">
            <a href="{{ route('admin.dashboard') }}"><img src="{{ asset('backend/assets/images/icon/logo.svg') }}" alt="logo"></a>
        </div>
    </div>
    <div class="main-menu">
        <div class="menu-inner">
            <nav>
                <ul class="metismenu" id="menu">
                    @can('dashboard.view')
                    <li <?php if(Route::currentRouteName() == 'admin.home' || Route::currentRouteName() == 'admin.dashboard'): ?> class="active" <?php endif; ?>>
                        <a href="{{ route('admin.dashboard') }}" aria-expanded="true"><i class="ti-dashboard"></i><span>dashboard</span></a>
                    </li>
                    @endcan
                    @canany('roles.list', 'group.list', 'permission.list')
                    <li <?php if(Route::currentRouteName() == 'roles.index' || Route::currentRouteName() == 'roles.edit' || Route::currentRouteName() == 'roles.create'): ?> class="active" <?php endif; ?>>
                        <a href="{{ route('admin.dashboard') }}" aria-expanded="true"><i class="ti-dashboard"></i><span>Role Management</span></a>
                        <ul class="collapse">
                            @can('group.list')
                            <li <?php if(Route::currentRouteName() == 'group.index' || Route::currentRouteName() == 'group.edit' || Route::currentRouteName() == 'group.create'): ?> class="active" <?php endif; ?>>
                                <a href="{{ route('group.index') }}" aria-expanded="true"><span>Group</span></a>
                                <ul class="collapse">
                                    <li <?php if(Route::currentRouteName() == 'group.index'): ?> class="active" <?php endif; ?>><a href="{{ route('group.index') }}">Group List</a></li>
                                    @can('group.create.form.view')
                                    <li <?php if(Route::currentRouteName() == 'group.create'): ?> class="active" <?php endif; ?>><a href="{{ route('group.create') }}">Group Create</a></li>
                                    @endcan
                                </ul>
                            </li>
                            @endcan
                            @can('permission.list')
                            <li <?php if(Route::currentRouteName() == 'permission.index' || Route::currentRouteName() == 'permission.edit' || Route::currentRouteName() == 'permission.create'): ?> class="active" <?php endif; ?>>
                                <a href="{{ route('permission.index') }}" aria-expanded="true"><span>Permission</span></a>
                                <ul class="collapse">
                                    <li <?php if(Route::currentRouteName() == 'permission.index'): ?> class="active" <?php endif; ?>><a href="{{ route('permission.index') }}">Permission List</a></li>
                                    @can('permission.create.form.view')
                                    <li <?php if(Route::currentRouteName() == 'permission.create'): ?> class="active" <?php endif; ?>><a href="{{ route('permission.create') }}">Permission Create</a></li>
                                    @endcan
                                </ul>
                            </li>
                            @endcan
                            @can('roles.list')
                            <li <?php if(Route::currentRouteName() == 'roles.index'): ?> class="active" <?php endif; ?>><a href="{{ route('roles.index') }}">Role List</a></li>
                            @endcan
                            @can('roles.create.form.view')
                            <li <?php if(Route::currentRouteName() == 'roles.create'): ?> class="active" <?php endif; ?>><a href="{{ route('roles.create') }}">Role Create</a></li>
                            @endcan
                        </ul>
                    </li>
                    @endcan
                    {{-- users list sidebar --}}
                    @can('users.list')
                    <li <?php if(Route::currentRouteName() == 'users.index' || Route::currentRouteName() == 'users.create'): ?> class="active" <?php endif; ?>>
                        <a href="{{ route('users.index') }}" aria-expanded="true"><i class="ti-dashboard"></i><span>Users</span></a>
                        <ul class="collapse">
                            <li <?php if(Route::currentRouteName() == 'users.index'): ?> class="active" <?php endif; ?>><a href="{{ route('users.index') }}">User List</a></li>
                            @can('users.create.form')
                            <li <?php if(Route::currentRouteName() == 'users.create'): ?> class="active" <?php endif; ?>><a href="{{ route('users.create') }}">Create User</a></li>
                            @endcan
                        </ul>
                    </li>
                    @endcan

                    @can('videoQuestion.list')
                    <li <?php if(Route::currentRouteName() == 'video_question.index' || Route::currentRouteName() == 'video_question.create'): ?> class="active" <?php endif; ?>>
                        <a href="{{ route('video_question.index') }}" aria-expanded="true"><i class="ti-dashboard"></i><span>Question</span></a>
                        <ul class="collapse">
                            <li <?php if(Route::currentRouteName() == 'video_question.index'): ?> class="active" <?php endif; ?>><a href="{{ route('video_question.index') }}">Question List</a></li>
                            @can('videoQuestion.create.form.view')
                            <li <?php if(Route::currentRouteName() == 'video_question.create'): ?> class="active" <?php endif; ?>><a href="{{ route('video_question.create') }}">Question Create</a></li>
                            @endcan
                        </ul>
                    </li>
                    @endcan
                </ul>
            </nav>
        </div>
    </div>
</div>
