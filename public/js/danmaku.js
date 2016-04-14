/**
 * Created by Volio on 2016/3/13.
 */
var clientId = '游客';
var firstFlag = true;
var rt;
var room;
var inputSend = document.getElementById('danmaku');

bindEvent(document.body, 'keydown', function(e) {
    if (e.keyCode === 13) {
        if (firstFlag) {
            main();
        } else {
            sendMsg();
        }
    }
});

function bindEvent(dom, eventName, fun) {
    if (window.addEventListener) {
        dom.addEventListener(eventName, fun);
    } else {
        dom.attachEvent('on' + eventName, fun);
    }
}

function main(appId,roomId){
    printWall.innerHTML = null;
    showMessage('系统','正在连接弹幕姬...');
    if (!firstFlag) {
        rt.close();
    }

    rt = AV.realtime({
        appId: appId,
        clientId: clientId,
        secure: true
    });

    rt.on('open', function() {
        firstFlag = false;
        showMessage('系统','弹幕姬连接成功！');
        // 获得已有房间的实例
        rt.room(roomId, function(object) {

            // 判断服务器端是否存在这个 room，如果存在
            if (object) {
                room = object;

                // 当前用户加入这个房间
                room.join(function() {

                    // 获取成员列表
                    /*room.list(function(data) {
                     showMessage('成员列表', data);
                     rt.ping(data.slice(0, 20), function(list) {
                     showMessage('当前在线', list);
                     });
                     });*/

                });

                // 房间接受消息
                room.receive(function(data) {
                    showMsg(data);
                    printWall.scrollTop = printWall.scrollHeight;
                });
            } else {
                showMessage('系统','弹幕姬连接失败Orz');
            }
        });
    });

    // 监听服务情况
    rt.on('reuse', function() {
        showMessage('系统','弹幕姬正在重连，请耐心等待...');
    });

    // 监听错误
    rt.on('error', function() {
        showMessage('系统','弹幕姬遇到错误。。。');
    });
}

function showMessage(name, data) {
    if (data) {
        console.log(name, data);
        msg = '<a>' + encodeHTML(name) + '</a> : <span>' + encodeHTML(data) + '</span>'
    }
    var div = document.createElement('div');
    div.className = 'user-danmaku';
    div.innerHTML = msg;
    printWall.appendChild(div);
    if(printWall.childNodes.length>150){
        printWall.removeChild(printWall.childNodes[0]);
    }
}

function encodeHTML(source) {
    return String(source)
        .replace(/&/g, '&amp;')
        .replace(/</g, '&lt;')
        .replace(/>/g, '&gt;');
}

function showMsg(data) {
    var text = '';
    var from = data.fromPeerId;
    if (data.msg.type) {
        text = data.msg.text;
    } else {
        text = data.msg;
    }
    if (String(text).replace(/^\s+/, '').replace(/\s+$/, '')) {
        showMessage(encodeHTML(from), text);
    }
}

function sendMsg() {

    // 如果没有连接过服务器
    if (firstFlag) {
        alert('请先连接服务器！');
        return;
    }
    var val = inputSend.value;

    // 不让发送空字符
    if (!String(val).replace(/^\s+/, '').replace(/\s+$/, '')) {
        alert('请输入点文字！');
    }else {
        //发送消息
        room.send({
            text: val
        }, {
            type: 'text'
        }, function (data) {
            inputSend.value = '';
            showMessage('我', val);
            printWall.scrollTop = printWall.scrollHeight;
        });
    }
}