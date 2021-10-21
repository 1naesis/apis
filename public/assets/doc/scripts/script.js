let listenerRequest = document.querySelectorAll('.listener_api_request');
for (let i = 0; i < listenerRequest.length; i ++) {
    listenerRequest[i].addEventListener('click', e => actionApi(e))
}
const actionApi = (e) => {
    let button = e.target;
    let idButton = button.getAttribute('id');
    if (idButton == 'checkphone_setting_getsetting') {
         xhrGet('/checkphone/setting', null);
    }else {
        console.log(`Не назначено активности для ид: ${idButton}`)
    }
}

function xhrGet(url, body) {
    let xhr = new XMLHttpRequest();
    xhr.open('GET', url, true);
    xhr.onload = function (){
        console.log(xhr.response);
    }
    xhr.onerror = function() { // происходит, только когда запрос совсем не получилось выполнить
        console.log("Ошибка загрузки контента...")
    };
    xhr.send(body)
}