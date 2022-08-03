<div class="sidebar-inner">
    <!--- Sidemenu -->
    <div id="sidebar-menu">
        <ul>
            @can('dashboard.view')
            <li class="has_sub">
                <a href="{{ route('admin.dashboard') }}" class="waves-effect">
                    <img src="{{ asset('public/backend/assets_v2/images/icon/dashboard-01.svg') }}" class="img-fluid">
                    <span>Dashboard</span>
                </a>
            </li>
            @endcan
            <!-- role all menu here -->
            @canany('roles.list', 'group.list', 'permission.list')
            <li <?php if(Route::currentRouteName() == 'roles.index' || Route::currentRouteName() == 'roles.edit' || Route::currentRouteName() == 'roles.create'): ?> class="has_sub active" <?php else: ?> class="has_sub" <?php endif; ?>>
                <a href="javascript:void(0);" class="waves-effect">
                    <img src="{{ asset('public/backend/assets_v2/images/icon/Role-management-03.svg') }}" class="img-fluid">
                    <span>Role Management</span>
                    <span class="menu-arrow"></span>
                </a>
                <ul>
                    @can('group.list')
                    <li <?php if(Route::currentRouteName() == 'group.index' || Route::currentRouteName() == 'group.edit' || Route::currentRouteName() == 'group.create'): ?> class="active has_sub" <?php else: ?> class="has_sub" <?php endif; ?>>
                        <a href="javascript:void(0);" class="waves-effect">
                            <span>Group</span>
                            <span class="menu-arrow"></span>
                        </a>
                        <ul>
                            <li <?php if(Route::currentRouteName() == 'group.index'): ?> class="active" <?php endif; ?>>
                                <a href="{{ route('group.index') }}" class="waves-effect">
                                    <span>Group List</span>
                                </a>
                            </li>
                            @can('group.create.form.view')
                            <li <?php if(Route::currentRouteName() == 'group.create'): ?> class="active" <?php endif; ?>>
                                <a href="{{ route('group.create') }}" class="waves-effect">
                                    <span>Group Create</span>
                                </a>
                            </li>
                            @endcan
                        </ul>
                    </li>
                    @endcan
                    @can('permission.list')
                    <li <?php if(Route::currentRouteName() == 'permission.index' || Route::currentRouteName() == 'permission.edit' || Route::currentRouteName() == 'permission.create'): ?> class="active has_sub" <?php else: ?> class="has_sub" <?php endif; ?>>
                        <a href="javascript:void(0);" class="waves-effect">
                            <span>Permission</span>
                            <span class="menu-arrow"></span>
                        </a>
                        <ul>
                            <li <?php if(Route::currentRouteName() == 'permission.index'): ?> class="active" <?php endif; ?>>
                                <a href="{{ route('permission.index') }}" class="waves-effect">
                                    <span>Permission List</span>
                                </a>
                            </li>
                            @can('permission.create.form.view')
                            <li <?php if(Route::currentRouteName() == 'permission.create'): ?> class="active" <?php endif; ?>>
                                <a href="{{ route('permission.create') }}" class="waves-effect">
                                    <span>Permission Create</span>
                                </a>
                            </li>
                            @endcan
                        </ul>
                    </li>
                    @endcan
                    @canany('roles.list', 'roles.create.form.view')
                    <li <?php if(Route::currentRouteName() == 'roles.list' || Route::currentRouteName() == 'roles.create.form.view'): ?> class="active has_sub" <?php else: ?> class="has_sub" <?php endif; ?>>
                        <a href="javascript:void(0);" class="waves-effect">
                            <span>Role</span>
                            <span class="menu-arrow"></span>
                        </a>
                        <ul>
                            @can('roles.list')
                            <li <?php if(Route::currentRouteName() == 'roles.index'): ?> class="active" <?php endif; ?>>
                                <a href="{{ route('roles.index') }}" class="waves-effect">
                                    <span>Role List</span>
                                </a>
                            </li>
                            @endcan
                            @can('roles.create.form.view')
                            <li <?php if(Route::currentRouteName() == 'roles.create'): ?> class="active" <?php endif; ?>>
                                <a href="{{ route('roles.create') }}" class="waves-effect">
                                    <span>Role Create</span>
                                </a>
                            </li>
                            @endcan
                        </ul>
                    </li>
                    @endcan
                </ul>
            </li>
            @endcan
            <!-- end of role menu -->
            <!-- user menu -->
            @can('users.list')
            <li <?php if(Route::currentRouteName() == 'users.index' || Route::currentRouteName() == 'users.create'): ?> class="active has_sub" <?php else: ?> class="has_sub" <?php endif; ?>>
                <a href="javascript:void(0);" class="waves-effect">
                    <img src="{{ asset('public/backend/assets_v2/images/icon/users-04.svg') }}" class="img-fluid">
                    <span>Users</span>
                    <span class="menu-arrow"></span>
                </a>
                <ul class="collapse">
                    <li <?php if(Route::currentRouteName() == 'users.index'): ?> class="active" <?php endif; ?>><a href="{{ route('users.index') }}">User List</a></li>
                    @can('users.create.form')
                    <li <?php if(Route::currentRouteName() == 'users.create'): ?> class="active" <?php endif; ?>><a href="{{ route('users.create') }}">Create User</a></li>
                    <li <?php if(Route::currentRouteName() == 'users.restore'): ?> class="active" <?php endif; ?>><a href="{{ route('users.restore') }}">Restore Deleted User</a></li>
                    @endcan
                </ul>
            </li>
            @endcan
            <!-- end of user menu -->
            <!-- vendor payment account related end -->
            <!-- course lists here -->
            @can('course_category.list')
            <li <?php if(Route::currentRouteName() == 'course_category' || Route::currentRouteName() == 'course_category.edit' || Route::currentRouteName() == 'course_category.create'): ?> class="active has_sub" <?php else: ?> class="has_sub" <?php endif; ?>>
                <a href="javascript:void(0);" class="waves-effect">
                    <img src="{{ asset('public/backend/assets_v2/images/icon/profile.svg') }}" class="img-fluid"/>
                    <span>Course Category Lists</span>
                    <span class="menu-arrow"></span>
                </a>
                <ul>
                    <li <?php if(Route::currentRouteName() == 'course_category' || Route::currentRouteName() == 'course_category.edit'): ?> class="active" <?php endif; ?>>
                        <a href="{{ route('course_category.index') }}" class="waves-effect">
                            <img src="{{ asset('public/backend/assets_v2/images/icon/profile.svg') }}" class="img-fluid">
                            <span>Course Category Lists</span>
                        </a>
                    </li>
                    <li <?php if(Route::currentRouteName() == 'course_category.create'): ?> class="active" <?php endif; ?>>
                        <a href="{{ route('course_category.create') }}" class="waves-effect">
                            <img src="{{ asset('public/backend/assets_v2/images/icon/profile.svg') }}" class="img-fluid">
                            <span>Course Category Create</span>
                        </a>
                    </li>
                </ul>
            </li>
        @endcan
            <!-- course lists end here -->
            <!-- course lists here -->
            @can('course.list')
            <li <?php if(Route::currentRouteName() == 'course' || Route::currentRouteName() == 'course.edit' || Route::currentRouteName() == 'course.create'): ?> class="active has_sub" <?php else: ?> class="has_sub" <?php endif; ?>>
                <a href="javascript:void(0);" class="waves-effect">
                    <img src="{{ asset('public/backend/assets_v2/images/icon/profile.svg') }}" class="img-fluid"/>
                    <span>Course</span>
                    <span class="menu-arrow"></span>
                </a>
                <ul>
                    <li <?php if(Route::currentRouteName() == 'course' || Route::currentRouteName() == 'course.edit'): ?> class="active" <?php endif; ?>>
                        <a href="{{ route('course.index') }}" class="waves-effect">
                            <img src="{{ asset('public/backend/assets_v2/images/icon/profile.svg') }}" class="img-fluid">
                            <span>Lists</span>
                        </a>
                    </li>
                    <li <?php if(Route::currentRouteName() == 'course.create'): ?> class="active" <?php endif; ?>>
                        <a href="{{ route('course.create') }}" class="waves-effect">
                            <img src="{{ asset('public/backend/assets_v2/images/icon/profile.svg') }}" class="img-fluid">
                            <span>Create</span>
                        </a>
                    </li>
                </ul>
            </li>
        @endcan
            <!-- course lists end here -->
            <!-- course files here -->
            @can('course_files.list')
            <li <?php if(Route::currentRouteName() == 'course_files' || Route::currentRouteName() == 'course_files.edit' || Route::currentRouteName() == 'course.create'): ?> class="active has_sub" <?php else: ?> class="has_sub" <?php endif; ?>>
                <a href="javascript:void(0);" class="waves-effect">
                    <img src="{{ asset('public/backend/assets_v2/images/icon/profile.svg') }}" class="img-fluid"/>
                    <span>Course Files</span>
                    <span class="menu-arrow"></span>
                </a>
                <ul>
                    <li <?php if(Route::currentRouteName() == 'course_files' || Route::currentRouteName() == 'course_files.edit'): ?> class="active" <?php endif; ?>>
                        <a href="{{ route('course_files.index') }}" class="waves-effect">
                            <img src="{{ asset('public/backend/assets_v2/images/icon/profile.svg') }}" class="img-fluid">
                            <span>Lists</span>
                        </a>
                    </li>
                    <li <?php if(Route::currentRouteName() == 'course_files.create'): ?> class="active" <?php endif; ?>>
                        <a href="{{ route('course_files.create') }}" class="waves-effect">
                            <img src="{{ asset('public/backend/assets_v2/images/icon/profile.svg') }}" class="img-fluid">
                            <span>Create</span>
                        </a>
                    </li>
                </ul>
            </li>
        @endcan
            <!-- course lists end here -->
        <!-- posts category start -->
        @can('posts_category.list')
            <li <?php if(Route::currentRouteName() == 'posts_category' || Route::currentRouteName() == 'posts_category.edit' || Route::currentRouteName() == 'posts_category.create'): ?> class="active has_sub" <?php else: ?> class="has_sub" <?php endif; ?>>
                <a href="javascript:void(0);" class="waves-effect">
                    <img src="{{ asset('public/backend/assets_v2/images/icon/profile.svg') }}" class="img-fluid"/>
                    <span>Posts Category</span>
                    <span class="menu-arrow"></span>
                </a>
                <ul>
                    <li <?php if(Route::currentRouteName() == 'posts_category' || Route::currentRouteName() == 'posts_category.edit'): ?> class="active" <?php endif; ?>>
                        <a href="{{ route('posts_category.index') }}" class="waves-effect">
                            <img src="{{ asset('public/backend/assets_v2/images/icon/profile.svg') }}" class="img-fluid">
                            <span>Lists</span>
                        </a>
                    </li>
                    <li <?php if(Route::currentRouteName() == 'posts_category.create'): ?> class="active" <?php endif; ?>>
                        <a href="{{ route('posts_category.create') }}" class="waves-effect">
                            <img src="{{ asset('public/backend/assets_v2/images/icon/profile.svg') }}" class="img-fluid">
                            <span>Create</span>
                        </a>
                    </li>
                </ul>
            </li>
        @endcan
        <!-- posts category end -->
        <!-- posts category all general start -->
        {{-- @can('posts_category_all_general.list')
            <li <?php if(Route::currentRouteName() == 'posts_category_all_general' || Route::currentRouteName() == 'posts_category_all_general.edit' || Route::currentRouteName() == 'posts_category_all_general.create'): ?> class="active" <?php else: ?> <?php endif; ?>>
                <a href="{{ route('posts_category_all_general.index') }}" class="waves-effect">
                    <img src="{{ asset('backend/assets_v2/images/icon/profile.svg') }}" class="img-fluid"/>
                    <span>Posts Category All General</span>
                    <span class="menu-arrow"></span>
                </a>
            </li>
        @endcan --}}
        <!-- posts category all general end -->
        <!-- artists start -->
        @can('artists.list')
            <li <?php if(Route::currentRouteName() == 'artists' || Route::currentRouteName() == 'artists.edit' || Route::currentRouteName() == 'artists.create'): ?> class="active has_sub" <?php else: ?> class="has_sub" <?php endif; ?>>
                <a href="javascript:void(0);" class="waves-effect">
                    <img src="{{ asset('public/backend/assets_v2/images/icon/profile.svg') }}" class="img-fluid"/>
                    <span>Artists</span>
                    <span class="menu-arrow"></span>
                </a>
                <ul>
                    <li <?php if(Route::currentRouteName() == 'artists' || Route::currentRouteName() == 'artists.edit'): ?> class="active" <?php endif; ?>>
                        <a href="{{ route('artists.index') }}" class="waves-effect">
                            <img src="{{ asset('public/backend/assets_v2/images/icon/profile.svg') }}" class="img-fluid">
                            <span>Lists</span>
                        </a>
                    </li>
                    <li <?php if(Route::currentRouteName() == 'artists.create'): ?> class="active" <?php endif; ?>>
                        <a href="{{ route('artists.create') }}" class="waves-effect">
                            <img src="{{ asset('public/backend/assets_v2/images/icon/profile.svg') }}" class="img-fluid">
                            <span>Create</span>
                        </a>
                    </li>
                </ul>
            </li>
        @endcan
        <!-- artists end -->
        <!-- composer start -->
        @can('artists.list')
            <li <?php if(Route::currentRouteName() == 'composer' || Route::currentRouteName() == 'composer.edit' || Route::currentRouteName() == 'composer.create'): ?> class="active has_sub" <?php else: ?> class="has_sub" <?php endif; ?>>
                <a href="javascript:void(0);" class="waves-effect">
                    <img src="{{ asset('public/backend/assets_v2/images/icon/profile.svg') }}" class="img-fluid"/>
                    <span>Composer</span>
                    <span class="menu-arrow"></span>
                </a>
                <ul>
                    <li <?php if(Route::currentRouteName() == 'composer' || Route::currentRouteName() == 'composer.edit'): ?> class="active" <?php endif; ?>>
                        <a href="{{ route('composer.index') }}" class="waves-effect">
                            <img src="{{ asset('public/backend/assets_v2/images/icon/profile.svg') }}" class="img-fluid">
                            <span>Lists</span>
                        </a>
                    </li>
                    <li <?php if(Route::currentRouteName() == 'composer.create'): ?> class="active" <?php endif; ?>>
                        <a href="{{ route('composer.create') }}" class="waves-effect">
                            <img src="{{ asset('public/backend/assets_v2/images/icon/profile.svg') }}" class="img-fluid">
                            <span>Create</span>
                        </a>
                    </li>
                </ul>
            </li>
        @endcan
        <!-- composer end -->
        <!-- songs start -->
        @can('songs.list')
            <li <?php if(Route::currentRouteName() == 'songs' || Route::currentRouteName() == 'songs.edit' || Route::currentRouteName() == 'songs.create'): ?> class="active has_sub" <?php else: ?> class="has_sub" <?php endif; ?>>
                <a href="javascript:void(0);" class="waves-effect">
                    <img src="{{ asset('public/backend/assets_v2/images/icon/icons8-music-folder-48.png') }}" class="img-fluid"/>
                    <span>Songs</span>
                    <span class="menu-arrow"></span>
                </a>
                <ul>
                    @can('songs_category.list')
                        <li>
                            <a href="javascript:void(0);" class="waves-effect">
                                <img src="{{ asset('public/backend/assets_v2/images/icon/icons8-music-folder-48.png') }}" class="img-fluid"/>
                                <span>Songs Category</span>
                                <span class="menu-arrow"></span>
                            </a>
                            <ul>
                                <li <?php if(Route::currentRouteName() == 'songs_category' || Route::currentRouteName() == 'songs_category.edit'): ?> class="active" <?php endif; ?>>
                                    <a href="{{ route('songs_category.index') }}" class="waves-effect">
                                        <img src="{{ asset('public/backend/assets_v2/images/icon/profile.svg') }}" class="img-fluid">
                                        <span>Category Lists</span>
                                    </a>
                                </li>
                                <li <?php if(Route::currentRouteName() == 'songs_category.create'): ?> class="active" <?php endif; ?>>
                                    <a href="{{ route('songs_category.create') }}" class="waves-effect">
                                        <img src="{{ asset('public/backend/assets_v2/images/icon/profile.svg') }}" class="img-fluid">
                                        <span>Create Create</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @endcan
                    <li <?php if(Route::currentRouteName() == 'songs' || Route::currentRouteName() == 'songs.edit'): ?> class="active" <?php endif; ?>>
                        <a href="{{ route('songs.index') }}" class="waves-effect">
                            <img src="{{ asset('public/backend/assets_v2/images/icon/profile.svg') }}" class="img-fluid">
                            <span>Lists</span>
                        </a>
                    </li>
                    <li <?php if(Route::currentRouteName() == 'songs.create'): ?> class="active" <?php endif; ?>>
                        <a href="{{ route('songs.create') }}" class="waves-effect">
                            <img src="{{ asset('public/backend/assets_v2/images/icon/profile.svg') }}" class="img-fluid">
                            <span>Create</span>
                        </a>
                    </li>
                </ul>
            </li>
        @endcan
        <!-- songs end -->

        <!-- verses start -->
        @can('verses.list')
            <li <?php if(Route::currentRouteName() == 'verses' || Route::currentRouteName() == 'verses.edit' || Route::currentRouteName() == 'verses.create'): ?> class="active has_sub" <?php else: ?> class="has_sub" <?php endif; ?>>
                <a href="javascript:void(0);" class="waves-effect">
                    <img src="{{ asset('public/backend/assets_v2/images/icon/verses-icon.png') }}" class="img-fluid"/>
                    <span>verses</span>
                    <span class="menu-arrow"></span>
                </a>
                <ul>
                    @can('verses_category.list')
                        <li>
                            <a href="javascript:void(0);" class="waves-effect">
                                <img src="{{ asset('public/backend/assets_v2/images/icon/icons8-music-folder-48.png') }}" class="img-fluid"/>
                                <span>verses Category</span>
                                <span class="menu-arrow"></span>
                            </a>
                            <ul>
                                <li <?php if(Route::currentRouteName() == 'verses_category' || Route::currentRouteName() == 'verses_category.edit'): ?> class="active" <?php endif; ?>>
                                    <a href="{{ route('verses_category.index') }}" class="waves-effect">
                                        <img src="{{ asset('public/backend/assets_v2/images/icon/profile.svg') }}" class="img-fluid">
                                        <span>Verses Lists</span>
                                    </a>
                                </li>
                                <li <?php if(Route::currentRouteName() == 'verses_category.create'): ?> class="active" <?php endif; ?>>
                                    <a href="{{ route('verses_category.create') }}" class="waves-effect">
                                        <img src="{{ asset('public/backend/assets_v2/images/icon/profile.svg') }}" class="img-fluid">
                                        <span>Create Create</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @endcan
                    <li <?php if(Route::currentRouteName() == 'verses' || Route::currentRouteName() == 'verses.edit'): ?> class="active" <?php endif; ?>>
                        <a href="{{ route('verses.index') }}" class="waves-effect">
                            <img src="{{ asset('public/backend/assets_v2/images/icon/profile.svg') }}" class="img-fluid">
                            <span>Lists</span>
                        </a>
                    </li>
                    <li <?php if(Route::currentRouteName() == 'verses.create'): ?> class="active" <?php endif; ?>>
                        <a href="{{ route('verses.create') }}" class="waves-effect">
                            <img src="{{ asset('public/backend/assets_v2/images/icon/profile.svg') }}" class="img-fluid">
                            <span>Create</span>
                        </a>
                    </li>
                </ul>
            </li>
        @endcan
        <!-- songs end -->

        <!-- novels start -->
        @can('novels.list')
            <li <?php if(Route::currentRouteName() == 'novels' || Route::currentRouteName() == 'novels.edit' || Route::currentRouteName() == 'novels.create'): ?> class="active has_sub" <?php else: ?> class="has_sub" <?php endif; ?>>
                <a href="javascript:void(0);" class="waves-effect">
                    <img src="{{ asset('public/backend/assets_v2/images/icon/novels-icon.png') }}" class="img-fluid"/>
                    <span>novels</span>
                    <span class="menu-arrow"></span>
                </a>
                <ul>
                    <li <?php if(Route::currentRouteName() == 'novels' || Route::currentRouteName() == 'novels.edit'): ?> class="active" <?php endif; ?>>
                        <a href="{{ route('novels.index') }}" class="waves-effect">
                            <img src="{{ asset('public/backend/assets_v2/images/icon/profile.svg') }}" class="img-fluid">
                            <span>Lists</span>
                        </a>
                    </li>
                    <li <?php if(Route::currentRouteName() == 'novels.create'): ?> class="active" <?php endif; ?>>
                        <a href="{{ route('novels.create') }}" class="waves-effect">
                            <img src="{{ asset('public/backend/assets_v2/images/icon/profile.svg') }}" class="img-fluid">
                            <span>Create</span>
                        </a>
                    </li>
                </ul>
            </li>
        @endcan
        <!-- novels end -->
        </ul>
        <div class="clearfix"></div>
    </div>
    <!-- Sidebar -->
    <div class="clearfix"></div>
</div>
