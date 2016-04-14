@extends('account.app')

@section('config')
    <div class="mdl-card__title header-background-image">
        <h4 class="user-name" style="margin:5px;">直播信息</h4>
    </div>
    <div class="mdl-card__supporting-text" style="text-align: center;width: auto;">
        <h5>请将以下信息填写至OBS或其他推流软件 (只显示一次)</h5>
        <table class="user-config">
            <tbody>
            <tr>
                <td class="mdl-data-table__cell--non-numeric" style="white-space:nowrap;padding:10px 20px;">推流地址</td>
                <td class="mdl-data-table__cell--non-numeric" style="word-break:break-all;padding:10px 20px;">{{ $pushUrl }}</td>
            </tr>
            <tr>
                <td class="mdl-data-table__cell--non-numeric" style="white-space:nowrap;padding:10px 20px;">推流码</td>
                <td class="mdl-data-table__cell--non-numeric" style="word-break:break-all;padding:10px 20px;">{{ $pushKey }}</td>
            </tr>
            <tr>
                <td class="mdl-data-table__cell--non-numeric" style="white-space:nowrap;padding:10px 20px;">合并地址</td>
                <td class="mdl-data-table__cell--non-numeric" style="word-break:break-all;padding:10px 20px;">{{ $pushAll }}</td>
            </tr>
            </tbody>
        </table>
        <a href="/account" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored mdl-js-ripple-effect">
            点击返回
        </a>
    </div>
@endsection