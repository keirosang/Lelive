@extends('layouts.app')

@section('content')
    <div class="mdl-grid main-content">
        <div class="mdl-cell mdl-cell--12-col">
            <div class="mdl-card mdl-shadow--4dp live-info">
                <div class="mdl-card__title" style="padding-bottom: 0;padding-top: 0;">
                    <img src="//gravatar.tycdn.net/avatar/{{ md5($email) }}?s=80" class="user-gravatar">
                    <div class="mdl-card live-info">
                        <div class="mdl-card__supporting-text">
                            <h4 class="show-title">{{ $title }}</h4>
                            <h5 class="show-title">主播：{{ $name }}</h5>
                        </div>
                    </div>
                    <div class="mdl-layout-spacer"></div>
                    <div class="mdl-card live-info">
                        <div class="mdl-card__supporting-text">
                            <h5 class="show-title">简介：</h5>
                            <h6 class="show-title">{{ $description }}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="mdl-cell mdl-cell--8-col">
            <div class="mdl-card mdl-shadow--4dp" id="playcard">
                <div id="player"></div>
                <div class="danmuarea">
                    <div id="danmu" style="display: none"></div>
                </div>
            </div>
        </div>
        <div class="mdl-cell mdl-cell--8-col mdl-cell--4-col-desktop">
            <div class="mdl-card mdl-shadow--4dp" id="comments">
                <div class="mdl-card__title mdl-card--expand header-background-image">
                    <h4 class="user-name" style="margin: 0;">Danmaku</h4>
                    <label class="mdl-switch mdl-js-switch mdl-js-ripple-effect" for="switch-danmu" style="margin-left: 2em;">
                        <input type="checkbox" id="switch-danmu" class="mdl-switch__input" onchange="showOrHideDanmu();">
                        <span class="mdl-switch__label"></span>
                    </label>
                </div>
                <div class="mdl-card__supporting-text" style="height: 70%;overflow-y:scroll;width:auto;" id="printWall">
                </div>
                <div class="mdl-card__actions mdl-card--border">
                    <div class="mdl-textfield mdl-js-textfield danmaku-input">
                        <input class="mdl-textfield__input" type="text" id="danmaku">
                        <label class="mdl-textfield__label" for="danmaku">点此发送弹幕</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ url('/js/jquery.danmu.js') }}"></script>
    <script src="{{ url('/js/blive.js') }}"></script>
    <script src="{{ url('/js/AV.realtime.js') }}"></script>
    <script src="{{ url('/js/danmaku.js') }}"></script>
    <script src="{{ url('/js/live.min.js') }}"></script>
    <script>
        var player = new CloudLivePlayer();
        player.init({activityId:"{{ $activityId }}"},'player');
        main('{{ $appId }}','{{ $roomId }}');
    </script>
@endsection