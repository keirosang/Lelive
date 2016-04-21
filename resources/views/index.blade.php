@extends('layouts.app')

@section('content')
    <div class="mdl-grid main-content">
        @if($count)
            <div class="mdl-cell mdl-cell--12-col live-info">
                <h4 style="margin:5px 0;">正在直播</h4>
            </div>
            @foreach($liveInfo as $value)
                <a class="mdl-cell mdl-cell--3-col-desktop mdl-cell--4-col" href="/u/{{ $value['uid'] }}">
                    <div class="mdl-card mdl-shadow--4dp">
                        <div class="mdl-card__title mdl-card--expand live-shotcut"
                             style="background-image: url({{ $value['cover'] ? url('cover/'.$value['cover']) : 'http://ww2.sinaimg.cn/large/a15b4afegw1f0ngfljsgtj21hc0u0qin.jpg' }});">
                            <h2 class="mdl-card__title-text user-name">{{ $value['title'] }}</h2>
                        </div>
                        <div class="mdl-card__supporting-text">
                            {{ $value['description'] }}
                        </div>
                    </div>
                </a>
            @endforeach
        @else
            <div class="mdl-cell mdl-cell--12-col live-info" style="text-align: center;">
                <h4 style="margin:10px 0 40px;">没有人在直播哦</h4>
                <img style="border-radius: 100%;padding: 5px;border:solid #D5D5D5;" src="http://ww2.sinaimg.cn/large/a15b4afegw1f227ysfraeg2083066ar9.jpg">
            </div>
        @endif
    </div>
@endsection

@section('js')
    <script src="{{ url('/js/index.min.js') }}"></script>
@endsection