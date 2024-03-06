import './bootstrap';
import 'flowbite';


import Alpine from 'alpinejs';

window.Alpine = Alpine;
Alpine.start();


import Choices from 'choices.js';
document.addEventListener('DOMContentLoaded', function () {
    const group_managers = new Choices('#choices', {
        removeItemButton:true
    });
});
document.addEventListener('DOMContentLoaded', function () {
    const tags = new Choices('#tags_choices', {
        removeItemButton:true
    });
});

import Quill from 'quill';

const options = {
    debug: 'info',
    modules: {
        toolbar: true,
    },
    placeholder: 'Rédiger un texte...',
    theme: 'snow'
};
const quill = new Quill('#editor', options);
const textarea = document.querySelector('#content-textarea');
quill.on('text-change', function(delta, oldDelta, source) {
    textarea.value = quill.root.innerHTML;
    textarea.dispatchEvent(new Event('input'));
});
