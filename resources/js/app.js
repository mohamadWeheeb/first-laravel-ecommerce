require('./bootstrap');

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

window.Echo.private('App.Models.User.' + Window.UserId)
    .notification((notification) => {
        alert(notification.title);
    });