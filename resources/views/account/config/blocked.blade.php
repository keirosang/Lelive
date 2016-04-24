@extends('account.app')

@section('config')
    <div class="mdl-card__title header-background-image">
        <h4 class="user-name" style="margin:5px;">账号状态</h4>
    </div>
    <div class="mdl-card__supporting-text" style="text-align: center;width: auto;">
        <h5 style="margin:60px 0;line-height: 2em;">您的账号暂时不能创建直播</br>请加群联系群主开通</h5>
        <a class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored mdl-js-ripple-effect" href="#">
            点击加群
        </a>
    </div>
@endsection