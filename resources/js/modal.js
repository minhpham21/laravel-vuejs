export function Modal(element, trigger, options) {
    var defaultOptions = {
        backdrop: true,
        keyboard: true,
        show: true
    }

    if (typeof options === 'object')
        this.options = Object.assign(defaultOptions, options);
    else
        this.options = defaultOptions;

    if (this.setTrigger(trigger) === false) return;

    this.modal = $(element);
    this.frame = this.modal.find('iframe');
    this.setEvents();
}

Modal.prototype.setEvents = function () {
    var that = this;

    this.trigger.click(function (e) {
        e.preventDefault();
        var url = $(this).data('url');
        that.modal.modal(that.options);
        that.frame.attr('src', url);

    });

    if (this.frame[0] != undefined) {
        this.frame[0].onload = function () {
            setTimeout(() => {
                if (this.contentDocument.body.innerHTML == '')
                    window.parent.location = window.parent.location

                console.log('height frame', this.contentDocument.body.scrollHeight);
                this.height = this.contentDocument.body.scrollHeight != 0
                    ? this.contentDocument.body.scrollHeight + 'px'
                    : '450px';
            }, 50);
        }
    }
}

Modal.prototype.setTrigger = function (element) {
    if (typeof element === 'object')
        this.trigger = element;
    else
        this.trigger = $(element);
    if (!this.trigger.length) return false;

    if (!this.trigger.data('url'))
        throw new Error("Attribute data-url is not set");
}