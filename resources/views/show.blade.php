@extends('layouts.app')

@section('content')
    <div class="mdl-grid main-content">
        <div class="mdl-cell mdl-cell--12-col">
            <div class="mdl-card mdl-shadow--4dp live-info">
                <div class="mdl-card__title" style="padding-bottom: 0;padding-top: 0;">
                    <img src="//gravatar.tycdn.net/avatar/{{ md5($email) }}?s=80" class="user-gravatar">
                    <div class="mdl-card live-info">
                        <div class="mdl-card__supporting-text">
                            <h4 style="margin:5px;">{{ $title }}</h4>
                            <h5 style="margin:5px;">主播：{{ $name }}</h5>
                        </div>
                    </div>
                    <div class="mdl-layout-spacer"></div>
                    <div class="mdl-card live-info">
                        <div class="mdl-card__supporting-text">
                            <h5 style="margin:5px;">简介：</h5>
                            <h6 style="margin:5px;white-space:nowrap;">{{ $description }}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="mdl-cell mdl-cell--8-col">
            <div class="mdl-card mdl-shadow--4dp" id="playcard">
                <div id="player"></div>
                <div class="danmuarea">
                    <div id="danmu"></div>
                </div>
            </div>
        </div>
        <div class="mdl-cell mdl-cell--8-col mdl-cell--4-col-desktop">
            <div class="mdl-card mdl-shadow--4dp" id="comments">
                <div class="mdl-card__title mdl-card--expand header-background-image">
                    <h2 class="mdl-card__title-text user-name">Danmaku</h2>
                </div>
                <div class="mdl-card__supporting-text" style="height: 70%;overflow-y:scroll;width:auto;" id="printWall">
                </div>
                <div class="mdl-card__actions mdl-card--border">
                    <div class="mdl-textfield mdl-js-textfield login-input" style="margin-left:5%">
                        <input class="mdl-textfield__input" type="email" id="danmaku">
                        <label class="mdl-textfield__label" for="danmaku">点此发送弹幕</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="//cdn.bootcss.com/jquery/2.2.0/jquery.js"></script>
    <script src="{{ url('/js/jquery.danmu.js') }}"></script>
    <script src="{{ url('/js/blive.js') }}"></script>
    <script src="{{ url('/js/AV.realtime.js') }}"></script>
    <script src="{{ url('/js/danmaku.js') }}"></script>
    <script src="{{ url('/js/index.min.js') }}"></script>
    <script>
        var player = new CloudLivePlayer();
        player.init({activityId:"{{ $activityId }}"},'player');
        main('{{ $appId }}','{{ $roomId }}');
    </script>
@endsection