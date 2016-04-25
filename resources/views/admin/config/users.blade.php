@extends('admin.app')

@section('config')
    <div class="mdl-card__title header-background-image">
        <h4 class="user-name" style="margin:5px;">所有用户</h4>
    </div>
    <div class="mdl-card__supporting-text" style="text-align: center;width: auto;padding:0px;overflow-x:auto;">
        @if($users_info)
        <table class="mdl-data-table mdl-js-data-table user-config">
            <thead>
            <tr>
                <th class="mdl-data-table__cell--non-numeric">ID</th>
                <th class="mdl-data-table__cell--non-numeric">用户名</th>
                <th class="mdl-data-table__cell--non-numeric">邮箱</th>
                <th class="mdl-data-table__cell--non-numeric">账号状态</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users_info as $value)
                <tr>
                    <td class="mdl-data-table__cell--non-numeric">{{ $value['id'] }}</td>
                    <td class="mdl-data-table__cell--non-numeric">{{ $value['name'] }}</td>
                    <td class="mdl-data-table__cell--non-numeric">{{ $value['email'] }}</td>
                    <td class="mdl-data-table__cell--non-numeric">正常</td>
                    <td>
                        <form method="post" action="/admin/users/{{ $value['id'] }}/block">
                            {!! csrf_field() !!}
                            <button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored mdl-js-ripple-effect">
                                封禁该用户
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
        @else
            <h5 style="margin:60px 0;">没有用户</h5>
        @endif
    </div>
    <div class="mdl-card__supporting-text" style="text-align: center;width: auto;">
        <a class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored mdl-js-ripple-effect" href="{{ url('/admin') }}">
            返回
        </a>
    </div>
@endsection