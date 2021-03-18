var Base = function () {

};

Base.prototype = {
    alert: function () {
    },

    url: null,
    params: {},
    method: 'post',
    form: null,

    setUrl: function (url) {
        this.url = url;
        return this;
    },
    getUrl: function () {
        return this.url;
    },


    setMethod: function (method) {
        this.method = method;
        return this;
    },
    getMethod: function () {
        return this.method;
    },


    resetParams: function () {
        this.params = {};
        return this;
    },
    setParams: function (params) {
        this.params = params;
        return this;
    },
    getParams: function (key) {
        if (typeof key === 'undefined') {
            return this.params;
        }
        if (typeof this.params[key] == 'undefined') {
            return null;
        }
        return this.params[key];
    },


    addParam: function (key, value) {
        this.params[key] = value;
        return this;
    },
    removeParam: function (key) {
        if (typeof this.params[key] != 'undefined') {
            delete this.params[key];
        }
        return this;
    },

    // load: function () {
    //     var request = $.ajax({
    //         method: this.getMethod(),
    //         url: this.getUrl(),
    //         data: this.getParams(),
    //         success: function (response) {
    //             // console.log(response);
    //             $(response.element.selector).html(response.element.html);
    //         }
    //     });
    // },

    load: function () {
        var self = this;
        var request = $.ajax({
            method: this.getMethod(),
            url: this.getUrl(),
            data: this.getParams(),
            success: function (response) {
                // $(response.element.selector).html(response.element.html);
                self.manageHtml(response);
            }
        });

    },

    manageHtml: function (response) {
        if (typeof response.element == 'undefined') {
            return false;
        }
        if (typeof response.element == 'object') {
            $(response.element).each(function (i, element) {
                //alert('jsbd');
                $(element.selector).html(element.html);
            })
        } else {
            $(response.element.selector).html(response.element.html);
        }
    },

    setForm: function (button) {
        this.form = $(button).closest("form");
        this.setParams(this.form.serialize());
        this.setMethod(this.form.attr('method'));
        this.setUrl(this.form.attr('action'));
        return this;
    },
    getForm: function () {
        return this.form;
    }
}
var object = new Base();
