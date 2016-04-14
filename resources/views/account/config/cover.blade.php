@extends('account.app')

@section('config')
    <div class="mdl-card__title header-background-image">
        <h4 class="user-name" style="margin:5px;">修改封面</h4>
    </div>
    <div class="mdl-card__supporting-text" style="text-align: center;width: auto;">
        @if($cover)
            <img src="{{ url('/cover/'.$cover) }}" style="width:60%;padding: 5px;border:solid #D5D5D5;">
        @else
            <h4>您尚未设置封面</h4>
        @endif
        <form method="post" action="/account/cover" enctype="multipart/form-data">
            {!! csrf_field() !!}
            <label for="cover" class="mdl-button mdl-js-button mdl-button--accent" style="padding:0 20px;margin: 20px 0;">
                <input type="file" name="cover" id="cover" accept="image/*" style="display: none;" required>
                <span id="coverinfo">点此选择图片,支持jpg,png,gif</span>
            </label>
            <br/>
            <button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored mdl-js-ripple-effect">
                开始上传
            </button>
        </form>
    </div>
@endsection

@section('js')
    <script src="{{ url('/js/cover.min.js') }}"></script>
@endsection