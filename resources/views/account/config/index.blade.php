@extends('account.app')

@section('config')
    <div class="mdl-card__title header-background-image">
        <h4 class="user-name" style="margin:5px;">直播状态</h4>
    </div>
    <div class="mdl-card__supporting-text" style="text-align: center;width: auto;">
        @if(!$livestatus)
            <h5 style="margin:60px 0;">您暂时没有正在进行的直播</h5>
            <a class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored mdl-js-ripple-effect" href="{{ url('/account/create') }}">
                开始直播
            </a>
        @else
            <h5 style="margin:60px 0;">您有一个正在进行的直播</h5>
            <a class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored mdl-js-ripple-effect" href="{{ url('/account/stop') }}">
                停止直播
            </a>
        @endif
    </div>
@endsection