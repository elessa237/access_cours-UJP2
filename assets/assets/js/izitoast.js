let iziToast = require('izitoast')

window.notification =  (label, message) => {
    iziToast[label]({
        message: message,
        position: 'topRight',
        timeout: 5000,
    });
}