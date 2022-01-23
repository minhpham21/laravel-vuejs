require('./bootstrap');

import { Modal } from "./modal";

if ($('.modal').length >= 1) {
    var modal = new Modal('#modal-default', '.modal-trigger');
}

if (window.frameElement) {
    var modal = window.parent.$('.modal');
    $('.btn-cancel').click(function () {
        modal.modal('hide');
    });
}