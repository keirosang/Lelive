@extends('account.app')

@section('config')
    <div class="mdl-card__title header-background-image">
        <h4 class="user-name" style="margin:5px;">修改用户名</h4>
    </div>
    <div class="mdl-card__supporting-text" style="text-align: center;width: auto;padding:0;">
        <form method="post" action="/account/username">
        {!! csrf_field() !!}
        <table class="mdl-data-table mdl-js-data-table user-config">
            <tbody>
            <tr>
                <td class="mdl-data-table__cell--non-numeric">旧用户名</td>
                <td class="mdl-data-table__cell--non-numeric">
                    <div class="mdl-textfield mdl-js-textfield">
                        <input class="mdl-textfield__input" type="text" id="oldUsername" value="{{ Auth::user()->name }}" required>
                        <label class="mdl-textfield__label" for="oldUsername">旧用户名</label>
                    </div>
                </td>
            </tr>
            <tr>
                <td class="mdl-data-table__cell--non-numeric">新用户名（至少4个字符）</td>
                <td class="mdl-data-table__cell--non-numeric">
                    <div class="mdl-textfield mdl-js-textfield">
                        <input class="mdl-textfield__input" type="text" id="newUsername" name="newUsername" required>
                        <label class="mdl-textfield__label" for="newUsername">在此填写新用户名</label>
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