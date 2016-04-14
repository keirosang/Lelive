@extends('layouts.app')

@section('content')
    <div class="mdl-grid login-content">
        <div class="mdl-cell mdl-cell--12-col">
            <div class="mdl-card mdl-shadow--4dp">
                <div class="mdl-card__title mdl-card--expand header-background-image">
                    <h2 class="mdl-card__title-text user-name">重置密码</h2>
                </div>
                <form method="POST" action="{{ url('/password/email') }}">
                    {!! csrf_field() !!}
                    <div class="mdl-card__supporting-text login-info">
                        <div class="mdl-textfield mdl-js-textfield login-input">
                            <input class="mdl-textfield__input" type="email" id="mail" name="email" value="{{ old('email') }}" required>
                            <label class="mdl-textfield__label" for="mail">邮箱</label>
                        </div>
                    </div>
                    <div class="mdl-card__actions mdl-card--border login-submit">
                        <button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored mdl-js-ripple-effect">发送重置密码邮件</button>
                    </div>
                    @if ($errors->has('email'))
                        <div class="mdl-card__actions mdl-card--border login-submit">
                            <span style="color: red">{{ $errors->first('email') }}</span>
                        </div>
                    @endif
                    @if (session('status'))
                        <div class="mdl-card__actions mdl-card--border login-submit">
                            <span style="color: red">{{ session('status') }}</span>
                        </div>
                    @endif
                </form>
            </div>
        </div>
    </div>
@endsection