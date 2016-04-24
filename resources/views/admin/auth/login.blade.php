@extends('layouts.app')

@section('content')
    <div class="mdl-grid login-content">
        <div class="mdl-cell mdl-cell--12-col">
            <div class="mdl-card mdl-shadow--4dp">
                <div class="mdl-card__title mdl-card--expand header-background-image">
                    <h2 class="mdl-card__title-text user-name">管理员登录</h2>
                </div>
                <form method="POST" action="{{ url('/admin/login') }}">
                    <div class="mdl-card__supporting-text login-info">
                        <img src="http://ww2.sinaimg.cn/large/a15b4afegw1f1wosd1qvqg20360340sp.jpg" class="login-image mdl-layout--large-screen-only">
                        {!! csrf_field() !!}
                        <div class="mdl-textfield mdl-js-textfield login-input">
                            <input class="mdl-textfield__input" type="email" id="mail" name="email" value="{{ old('email') }}" required>
                            <label class="mdl-textfield__label" for="mail">邮箱</label>
                        </div>
                        <div class="mdl-textfield mdl-js-textfield login-input">
                            <input class="mdl-textfield__input" type="password" id="password" name="password" required>
                            <label class="mdl-textfield__label" for="password">密码</label>
                        </div>
                        <label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="checkbox">
                            <input type="checkbox" id="checkbox" class="mdl-checkbox__input" name="remember">
                            <span class="mdl-checkbox__label">记住密码</span>
                        </label>
                    </div>
                    <div class="mdl-card__actions mdl-card--border login-submit">
                        <button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored mdl-js-ripple-effect">点击登录</button>
                    </div>
                    @if ($errors->has('email'))
                        <div class="mdl-card__actions mdl-card--border login-submit">
                            <span style="color: red">{{ $errors->first('email') }}</span>
                        </div>
                    @endif
                    @if ($errors->has('password'))
                        <div class="mdl-card__actions mdl-card--border login-submit">
                            <span style="color: red">{{ $errors->first('password') }}</span>
                        </div>
                    @endif
                </form>
            </div>
        </div>
    </div>
@endsection