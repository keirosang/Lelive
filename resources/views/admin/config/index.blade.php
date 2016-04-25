@extends('admin.app')

@section('config')
    <div class="mdl-card__title header-background-image">
        <h4 class="user-name" style="margin:5px;">平台信息</h4>
    </div>
    <div class="mdl-card__supporting-text" style="text-align: center;width: auto;padding:0;overflow-x:auto;">
        <table class="mdl-data-table mdl-js-data-table user-config">
            <tbody>
            <tr>
                <td class="mdl-data-table__cell--non-numeric">管理员ID</td>
                <td class="mdl-data-table__cell--non-numeric">{{ Auth::guard('admin')->user()->id }}</td>
                <td>
                    <a disabled>修改</a>
                </td>
            </tr>
            <tr>
                <td class="mdl-data-table__cell--non-numeric">管理员邮箱</td>
                <td class="mdl-data-table__cell--non-numeric">{{ Auth::guard('admin')->user()->email }}</td>
                <td>
                    <a disabled>修改</a>
                </td>
            </tr>
            <tr>
                <td class="mdl-data-table__cell--non-numeric">已注册用户数量</td>
                <td class="mdl-data-table__cell--non-numeric">{{ $user_number }}</td>
                <td>
                    <a href="{{ url('/admin/users') }}">查看</a>
                </td>
            </tr>
            <tr>
                <td class="mdl-data-table__cell--non-numeric">正在进行的活动数量</td>
                <td class="mdl-data-table__cell--non-numeric">{{ $act_number }}</td>
                <td>
                    <a href="{{ url('/admin/actinfo') }}">查看</a>
                </td>
            </tr>
            <tr>
                <td class="mdl-data-table__cell--non-numeric">PHP版本</td>
                <td class="mdl-data-table__cell--non-numeric">{{ PHP_VERSION }}</td>
                <td>
                    <a disabled>查看</a>
                </td>
            </tr>
            <tr>
                <td class="mdl-data-table__cell--non-numeric">系统信息</td>
                <td class="mdl-data-table__cell--non-numeric">{{ php_uname('s') }}</td>
                <td>
                    <a disabled>查看</a>
                </td>
            </tr>
        </table>
    </div>
@endsection