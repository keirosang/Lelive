@extends('layouts.app')

@section('content')
    <div class="mdl-grid main-content">
        <div class="mdl-cell mdl-cell--8-col mdl-cell--4-col-desktop">
            <div class="mdl-card mdl-shadow--4dp">
                <div class="mdl-card__title header-background-image">
                    <img src="//gravatar.iwch.me/avatar/{{ md5(Auth::user()->email) }}?s=60" class="user-gravatar">
                    <div class="mdl-card live-info" style="background-color: rgba(255,255,255,0);">
                        <div class="mdl-card__supporting-text user-name">
                            <h4 style="margin:5px;">个人信息</h4>
                        </div>
                    </div>
                </div>
                <table class="mdl-data-table mdl-js-data-table user-config">
                    <tbody>
                    <tr>
                        <td class="mdl-data-table__cell--non-numeric">用户名</td>
                        <td class="mdl-data-table__cell--non-numeric">{{ Auth::user()->name }}</td>
                        <td>
                            <a href="{{ url('/account/username') }}">修改</a>
                        </td>
                    </tr>
                    <tr>
                        <td class="mdl-data-table__cell--non-numeric">邮箱</td>
                        <td class="mdl-data-table__cell--non-numeric">{{ Auth::user()->email }}</td>
                        <td>
                            <a href="{{ url('/account/email') }}">修改</a>
                        </td>
                    </tr>
                    <tr>
                        <td class="mdl-data-table__cell--non-numeric">封面</td>
                        <td class="mdl-data-table__cell--non-numeric">设置直播封面</td>
                        <td>
                            <a href="{{ url('/account/cover') }}">设置</a>
                        </td>
                    </tr>
                    <tr>
                        <td class="mdl-data-table__cell--non-numeric">直播状态</td>
                        @if(!$livestatus)
                            <td class="mdl-data-table__cell--non-numeric">未开始</td>
                            <td>
                                <a href="{{ url('/account/create') }}">开始</a>
                            </td>
                        @else
                            <td class="mdl-data-table__cell--non-numeric">正在直播</td>
                            <td>
                                <a href="{{ url('/account/stop') }}">停止</a>
                            </td>
                        @endif
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