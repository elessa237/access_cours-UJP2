let iziToast = require('izitoast')

window.notification =  (label, message) => {
    iziToast[label]({
        title: label,
        message: message,
        position: 'topRight',
        timeout: 10000,
    });
}