@extends('admin.app')

@section('config')
    <div class="mdl-card__title header-background-image">
        <h4 class="user-name" style="margin:5px;">所有直播活动</h4>
    </div>
    <div class="mdl-card__supporting-text" style="text-align: center;width: auto;padding:0;overflow-x:auto;">
        @if($livingInfo)
        <table class="mdl-data-table mdl-js-data-table user-config">
            <thead>
            <tr>
                <th class="mdl-data-table__cell--non-numeric">ID</th>
                <th class="mdl-data-table__cell--non-numeric">UID</th>
                <th class="mdl-data-table__cell--non-numeric">活动ID</th>
                <th class="mdl-data-table__cell--non-numeric">标题</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            @foreach($livingInfo as $value)
            <tr>
                <td class="mdl-data-table__cell--non-numeric">{{ $value['id'] }}</td>
                <td class="mdl-data-table__cell--non-numeric">{{ $value['uid'] }}</td>
                <td class="mdl-data-table__cell--non-numeric">{{ $value['activityId'] }}</td>
                <td class="mdl-data-table__cell--non-numeric">{{ $value['title'] }}</td>
                <td>
                    <a href="{{ url('/admin/actinfo').'/'.$value['uid'] }}">查看详细信息</a>
                </td>
            </tr>
            @endforeach
        </table>
        @else
            <h5 style="margin:60px 0;">没有正在进行的直播活动</h5>
        @endif
    </div>
    <div class="mdl-card__supporting-text" style="text-align: center;width: auto;">
        <a class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored mdl-js-ripple-effect" href="{{ url('/admin') }}">
            返回
        </a>
    </div>
@endsection