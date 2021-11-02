let listenerRequest = document.querySelectorAll('.listener_api_request');
for (let i = 0; i < listenerRequest.length; i ++) {
    listenerRequest[i].addEventListener('click', e => actionApi(e))
}
const actionApi = (e) => {
    let button = e.target;
    let idButton = button.getAttribute('id');
    let loader = document.getElementById(`${idButton}_loader`);

    onLoad(button, loader);


    if (idButton == 'checkphone_setting_getsetting') {
        let xhr = new XMLHttpRequest();
        xhr.open('GET', "/checkphone/setting", true);
        xhr.onload = function (){
            try {
                let response = JSON.parse(xhr.response);
                jsonOutput(document.getElementById(`${idButton}_response`), response);
            } catch (e) {
                document.getElementById(`${idButton}_response`).innerText = xhr.response;
            }
            offLoad(button, loader);
        }
        xhr.onerror = function() { // происходит, только когда запрос совсем не получилось выполнить
            console.log("Ошибка загрузки контента...")
        };
        xhr.send();
    } else if (idButton == 'checkphone_setting_setsetting') {
        let id_chat = document.getElementById(`${idButton}_id_chat`);
        let url = '/checkphone/setting?'
        if (id_chat && id_chat.value.length > 0) {
            url += 'id_chat='+id_chat.value.toString();
        }
        let xhr = new XMLHttpRequest();
        xhr.open('GET', url, true);
        xhr.onload = function (){
            try {
                let response = JSON.parse(xhr.response);
                jsonOutput(document.getElementById(`${idButton}_response`), response);
            } catch (e) {
                document.getElementById(`${idButton}_response`).innerText = xhr.response;
            }
            offLoad(button, loader);
        }
        xhr.onerror = function() { // происходит, только когда запрос совсем не получилось выполнить
            console.log("Ошибка загрузки контента...")
        };
        xhr.send();
    } else if (idButton == 'checkphone_getphone') {
        let phone = document.getElementById(`${idButton}_phone`).value;
        let idDev = document.getElementById(`${idButton}_id_dev`).value;
        document.getElementById(`${idButton}_response`).innerText = "";
        if (phone.trim().length == 0) {
            document.getElementById(`${idButton}_response`).innerText = "Номер телефона обязателен";
            offLoad(button, loader);
            return;
        }
        let getParams = '';
        if (idDev.trim().length > 0) {
            getParams += `?id_dev=${idDev.trim()}`;
        }
        let xhr = new XMLHttpRequest();
        xhr.open('GET', `/checkphone/client/${phone}${getParams}`, true);
        xhr.onload = function (){
            try {
                let response = JSON.parse(xhr.response);
                jsonOutput(document.getElementById(`${idButton}_response`), response);
            } catch (e) {
                document.getElementById(`${idButton}_response`).innerText = xhr.response;
            }
            offLoad(button, loader);
        }
        xhr.onerror = function() { // происходит, только когда запрос совсем не получилось выполнить
            console.log("Ошибка загрузки контента...")
        };
        xhr.send();
    } else if (idButton == 'checkphone_setphone') {
        let phone = document.getElementById(`${idButton}_phone`).value;
        let idDev = document.getElementById(`${idButton}_id_dev`).value;
        document.getElementById(`${idButton}_response`).innerText = "";
        if (phone.trim().length == 0) {
            document.getElementById(`${idButton}_response`).innerText = "Номер телефона обязателен";
            offLoad(button, loader);
            return;
        }
        let fd = new FormData();
        fd.append("phone", phone);
        if (idDev.trim().length > 0) {
            fd.append("id_dev", idDev);
        }
        let xhr = new XMLHttpRequest();
        xhr.open('POST', `/checkphone/client`, true);
        xhr.onload = function (){
            try {
                let response = JSON.parse(xhr.response);
                jsonOutput(document.getElementById(`${idButton}_response`), response);
            } catch (e) {
                document.getElementById(`${idButton}_response`).innerText = xhr.response;
            }
            offLoad(button, loader);
        }
        xhr.onerror = function() { // происходит, только когда запрос совсем не получилось выполнить
            console.log("Ошибка загрузки контента...")
        };
        xhr.send(fd);
    } else if (idButton == 'downloader_download') {
        let form = new FormData(document.getElementById('downloader_download_form'));
        let xhr = new XMLHttpRequest();
        xhr.open('POST', '/download', true)
        xhr.onload = function () {
            try {
                let response = JSON.parse(xhr.response);
                jsonOutput(document.getElementById(`${idButton}_response`), response);
            } catch (e) {
                document.getElementById(`${idButton}_response`).innerText = xhr.response;
            }
            offLoad(button, loader);
        }
        xhr.send(form);

    }else {
        console.log(`Не назначено активности для ид: ${idButton}`)
    }
}

const offLoad = (button, loader) => {
    button.classList.remove('hiddenclass');
    loader.classList.add('hiddenclass');
}

const onLoad = (button, loader) => {
    loader.classList.remove('hiddenclass');
    button.classList.add('hiddenclass');
}

const jsonOutput = (body, json) => {
    body.innerHTML = `{<br>`;
    for (let key in json) {
        body.innerHTML += `<p style="padding-left: 10px; margin: 0;">"${key}" : "${json[key]}"</p>`;
    }
    body.innerHTML += `}<br>`;
}