@extends('account.app')

@section('config')
    <div class="mdl-card__title header-background-image">
        <h4 class="user-name" style="margin:5px;">修改邮箱</h4>
    </div>
    <div class="mdl-card__supporting-text" style="text-align: center;width: auto;padding:0px;">
        <form method="post" action="/account/email">
            {!! csrf_field() !!}
            <table class="mdl-data-table mdl-js-data-table user-config">
                <tbody>
                <tr>
                    <td class="mdl-data-table__cell--non-numeric">旧邮箱</td>
                    <td class="mdl-data-table__cell--non-numeric">
                        <div class="mdl-textfield mdl-js-textfield">
                            <input class="mdl-textfield__input" type="email" id="oldEmail" value="{{ Auth::user()->email }}" required>
                            <label class="mdl-textfield__label" for="oldEmail">旧邮箱</label>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="mdl-data-table__cell--non-numeric">新邮箱</td>
                    <td class="mdl-data-table__cell--non-numeric">
                        <div class="mdl-textfield mdl-js-textfield">
                            <input class="mdl-textfield__input" type="email" id="newEmail" name="newEmail" required>
                            <label class="mdl-textfield__label" for="newEmail">在此填写新邮箱</label>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="mdl-data-table__cell--non-numeric">点右侧提交</td>
                    <td class="mdl-data-table__cell--non-numeric">
                        <button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored mdl-js-ripple-effect">
                            确定修改
                        </button>
                    </td>
                </tr>
                </tbody>
            </table>
        </form>
    </div>
@endsection