import './bootstrap';
import 'flowbite';


import Alpine from 'alpinejs';
import { create, registerPlugin, setOptions } from 'filepond';
import 'filepond/dist/filepond.min.css';
import FilePondPluginFileValidateType from 'filepond-plugin-file-validate-type';
import FilePondPluginImagePreview from 'filepond-plugin-image-preview';
import 'filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.css';

window.Alpine = Alpine;
Alpine.start();

import 'select2/dist/css/select2.min.css';
import $ from 'jquery';
import select2 from 'select2';
select2();
$(".select2").select2();

// Register the plugin with FilePond
//registerPlugin(FilePondPluginImagePreview,FilePondPluginFileValidateType);
//
//setOptions({
//    server: {
//        url:'/upload',
//        headers: {
//            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
//        },
//    }
//});
//// Get a file input reference
//const inputPost = document.querySelector('.pictures-post');
//// Create a FilePond instance
//create(inputPost,{
//    labelIdle:'Glisser & Déposer vos photos ou <span class="filepond--label-action"> chercher </span>',
//    acceptedFileTypes: ['image/*'],
//    imagePreviewMaxHeight: '200px',
//});
//const inputGroup = document.querySelector('.pictures-group');
//// Create a FilePond instance
//create(inputGroup,{
//    labelIdle:'Glisser & Déposer votre photo ou <span class="filepond--label-action"> chercher </span>',
//    acceptedFileTypes: ['image/*'],
//    imagePreviewMaxHeight: '200px',
//
//});
