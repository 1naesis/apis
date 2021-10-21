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
            document.getElementById(`${idButton}_response`).innerText = xhr.response
            offLoad(button, loader);
        }
        xhr.onerror = function() { // происходит, только когда запрос совсем не получилось выполнить
            console.log("Ошибка загрузки контента...")
        };
        xhr.send();
    } else {
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