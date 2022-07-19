<ol class="breadcrumb">
    @can('dashboard.view')
    <li>
        <a href="{{ route('admin.home') }}">Dashboard</a>
    </li>
    @endcan
    @can('group.list')
    <li>
        <a href="{{ route('group.index') }}">Group</a>
    </li>
    @endcan
    @can('permission.list')
    <li>
        <a href="{{ route('permission.index') }}">Permission</a>
    </li>
    @endcan
    @can('roles.list')
    <li>
        <a href="{{ route('roles.index') }}">Role</a>
    </li>
    @endcan
    @can('users.list')
    <li>
        <a href="{{ route('users.index') }}">User</a>
    </li>
    @endcan
    @can('videoQuestion.list')
    <li>
        <a href="{{ route('video_question.index') }}">Question</a>
    </li>
    @endcan
    @can('jobInterest.list')
    <li>
        <a href="{{ route('job_interest.index') }}">Job Interest</a>
    </li>
    @endcan
    <li class="active">
        @yield('active_breadcumbs_title')
    </li>
</ol>