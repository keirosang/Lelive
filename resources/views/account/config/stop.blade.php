@extends('account.app')

@section('config')
    <div class="mdl-card__title header-background-image">
        <h4 class="user-name" style="margin:5px;">停止直播</h4>
    </div>
    <div class="mdl-card__supporting-text" style="text-align: center;width: auto;">
        <h5 style="margin:60px 0;">您有一个正在进行的直播，确定停止吗</h5>
        <form method="post" action="/account/stop">
            {!! csrf_field() !!}
            <button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored mdl-js-ripple-effect">
                确定停止
            </button>
        </form>
    </div>
@endsection