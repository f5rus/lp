jQuery(document).ready(function () {
    Security.initLoginForm();
});

var Security = {
    options: {
        loginFormClass: '.js-login-form',
        successNoteClass: '.js-success-note',
        failNoteClass: '.js-fail-note'
    },

    initLoginForm: function () {
        var _self = this;
        var $loginForm = $(_self.options.loginFormClass);
        var $failNote = $(_self.options.failNoteClass);
        var $successNote = $(_self.options.successNoteClass);

        $loginForm.submit(function (e) {
            e.preventDefault();
            var $this = $(this);
            var url = $this.attr('action');

            $.ajax({
                type: "POST",
                url: url,
                data: $(this).serialize(),
                success: function(data)
                {
                    if (data.success) {
                        $failNote.hide();
                        $successNote.show();
                        window.location.href = data.redirectURI;
                    } else {
                        $failNote.show();
                    }
                }
            });
        })
    }
};