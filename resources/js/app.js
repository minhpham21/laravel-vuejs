if ($('.modal').length >= 1) {
    var modal = new Modal('#modal-default', '.modal-trigger');
}

if (window.frameElement) {
    var modal = window.parent.$('.modal');
    $('.btn-cancel').click(function () {
        modal.modal('hide');
    });
}

function replaceUrl(url, paramName, paramValue) {
    if (paramValue == null)
        paramValue = '';
    var pattern = new RegExp('\\b(' + paramName + '=).*?(&|$)')
    if (url.search(pattern) >= 0) {
        return url.replace(pattern, '$1' + paramValue + '$2');
    }
    // url = url.replace(/\?$/, '')
    return url + (url.indexOf('?') > 0 ? '&' : '?' ) + paramName + '=' + paramValue
}