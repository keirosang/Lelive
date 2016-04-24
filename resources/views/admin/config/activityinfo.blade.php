@extends('admin.app')

@section('config')
    <div class="mdl-card__title header-background-image">
        <h4 class="user-name" style="margin:5px;">直播活动信息</h4>
    </div>
    <div class="mdl-card__supporting-text" style="text-align: center;width: auto;padding:0;">
        @if($live_status)
        <table class="mdl-data-table mdl-js-data-table user-config">
            <thead>
            <tr>
                <th class="mdl-data-table__cell--non-numeric">选项</th>
                <th class="mdl-data-table__cell--non-numeric">详细信息</th>
            </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="mdl-data-table__cell--non-numeric">UID</td>
                    <td class="mdl-data-table__cell--non-numeric">{{ $act_info['uid'] }}</td>
                </tr>
                <tr>
                    <td class="mdl-data-table__cell--non-numeric">用户名</td>
                    <td class="mdl-data-table__cell--non-numeric">{{ $act_info['name'] }}</td>
                </tr>
                <tr>
                    <td class="mdl-data-table__cell--non-numeric">用户邮箱</td>
                    <td class="mdl-data-table__cell--non-numeric">{{ $act_info['email'] }}</td>
                </tr>
                <tr>
                    <td class="mdl-data-table__cell--non-numeric">标题</td>
                    <td class="mdl-data-table__cell--non-numeric">{{ $act_info['title'] }}</td>
                </tr>
                <tr>
                    <td class="mdl-data-table__cell--non-numeric">描述</td>
                    <td class="mdl-data-table__cell--non-numeric">{{ $act_info['description'] }}</td>
                </tr>
                <tr>
                    <td class="mdl-data-table__cell--non-numeric">ActivityID</td>
                    <td class="mdl-data-table__cell--non-numeric">{{ $act_info['activityId'] }}</td>
                </tr>
                <tr>
                    <td class="mdl-data-table__cell--non-numeric">创建时间</td>
                    <td class="mdl-data-table__cell--non-numeric">{{ $act_info['ctime'] }}</td>
                </tr>
        </table>
        @else
            <h5 style="margin:60px 0;">该用户暂时没有直播</h5>
        @endif
    </div>
    @if($live_status)
        <div class="mdl-card__supporting-text" style="text-align: center;width: auto;">
            <form method="post" action="/admin/actinfo/{{ $act_info['uid'] }}">
                {!! csrf_field() !!}
                <button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored mdl-js-ripple-effect">
                    停止活动
                </button>
            </form>
        </div>
    @else
        <div class="mdl-card__supporting-text" style="text-align: center;width: auto;">
            <a class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored mdl-js-ripple-effect" href="{{ url('/account/actinfo') }}">
                点此返回
            </a>
        </div>
    @endif
@endsection