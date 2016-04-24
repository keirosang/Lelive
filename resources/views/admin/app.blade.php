@extends('layouts.admin')

@section('content')
    <div class="mdl-grid main-content">
        <div class="mdl-cell mdl-cell--8-col mdl-cell--4-col-desktop">
            <div class="mdl-card mdl-shadow--4dp">
                <div class="mdl-card__title header-background-image">
                    <img src="//gravatar.tycdn.net/avatar/{{ md5(Auth::guard('admin')->user()->email) }}?s=60" class="user-gravatar">
                    <div class="mdl-card live-info" style="background-color: rgba(255,255,255,0);">
                        <div class="mdl-card__supporting-text user-name">
                            <h4 style="margin:5px;">管理选项</h4>
                        </div>
                    </div>
                </div>
                <table class="mdl-data-table mdl-js-data-table user-config">
                    <tbody>
                    <tr>
                        <td class="mdl-data-table__cell--non-numeric">正在进行的直播活动</td>
                        <td class="mdl-data-table__cell--non-numeric"></td>
                        <td>
                            <a href="{{ url('/admin/actinfo') }}">管理</a>
                        </td>
                    </tr>
                    <tr>
                        <td class="mdl-data-table__cell--non-numeric">已注册的用户信息</td>
                        <td class="mdl-data-table__cell--non-numeric"></td>
                        <td>
                            <a href="{{ url('/admin/users') }}">管理</a>
                        </td>
                    </tr>
                    <tr>
                        <td class="mdl-data-table__cell--non-numeric">已封禁用户信息</td>
                        <td class="mdl-data-table__cell--non-numeric"></td>
                        <td>
                            <a href="{{ url('/admin/blocked') }}">管理</a>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="mdl-cell mdl-cell--8-col">
            <div class="mdl-card mdl-shadow--4dp">
                @yield('config')
            </div>
        </div>
    </div>
@endsection