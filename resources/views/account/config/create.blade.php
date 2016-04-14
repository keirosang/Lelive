@extends('account.app')

@section('config')
    <div class="mdl-card__title header-background-image">
        <h4 class="user-name" style="margin:5px;">开始直播</h4>
    </div>
    <form method="post" action="/account/create">
        <div class="mdl-card__supporting-text" style="text-align:center;width: auto;">
            {!! csrf_field() !!}
            <h5 style="margin: 10px 0 20px 0;">填写直播信息：</h5>
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <input class="mdl-textfield__input" type="text" id="live-name" name="livename" value="{{ Auth::user()->name }}的直播" required>
                <label class="mdl-textfield__label" for="live-name">直播名称</label>
            </div>
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <input class="mdl-textfield__input" type="text" id="live-des" name="livedes" value="暂无简介" required>
                <label class="mdl-textfield__label" for="live-des">直播简介</label>
            </div>
            <h5 style="margin: 20px 0;">选择清晰度：</h5>
            <label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="rate1" style="width: auto;padding-right:20px;">
                <input type="checkbox" id="rate1" name="rate1" class="mdl-checkbox__input">
                <span class="mdl-checkbox__label">标清</span>
            </label>
            <label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="rate2" style="width: auto;padding-right:20px;">
                <input type="checkbox" id="rate2" name="rate2" class="mdl-checkbox__input">
                <span class="mdl-checkbox__label">高清</span>
            </label>
            <label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="rate3" style="width: auto;padding-right:20px;">
                <input type="checkbox" id="rate3" name="rate3" class="mdl-checkbox__input">
                <span class="mdl-checkbox__label">超清</span>
            </label>
            <label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="rate4" style="width: auto;padding-right:20px;">
                <input type="checkbox" id="rate4" name="rate4" class="mdl-checkbox__input">
                <span class="mdl-checkbox__label">1080P</span>
            </label>
            <label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="rate5" style="width: auto;padding-right:20px;">
                <input type="checkbox" id="rate5" name="rate5" class="mdl-checkbox__input" checked required>
                <span class="mdl-checkbox__label">原画</span>
            </label>
            <h5 style="margin: 20px 0;">选择是否录制：</h5>
            <label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="record" style="width: auto;padding-right:20px;">
                <input type="checkbox" id="record" name="record" class="mdl-checkbox__input">
                <span class="mdl-checkbox__label">开启直播录制</span>
            </label>
        </div>
        <div class="mdl-card__actions mdl-card--border" style="text-align: center;">
            <button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored mdl-js-ripple-effect">
                开始直播
            </button>
        </div>
    </form>
@endsection