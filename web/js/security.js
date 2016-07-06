jQuery(document).ready(function () {
    Security.initLoginForm();
    Security.initModalForm();
    Security.initForgotPassword();
});

var Security = {
    options: {
        loginFormClass: '.js-login-form',
        successNoteClass: '.js-success-note',
        failNoteClass: '.js-fail-note',
        modalForgotPasswordClass: '.js-modal-forgot-password',
        modalForgotPasswordBtnClass: '.js-modal-forgot-password-btn',
        modalForgotPasswordCancelBtnClass: '.js-modal-forgot-password-cancel-btn',
        modalForgotPasswordSendBtnClass: '.js-modal-forgot-password-send-btn'
    },

    initLoginForm: function() {
        var _self = this;
        var $loginForm = $(_self.options.loginFormClass);
        var $failNote = $(_self.options.failNoteClass);
        var $successNote = $(_self.options.successNoteClass);

        $loginForm.submit(function (e) {
            e.preventDefault();
            var $this = $(this);
            var url = $this.attr('action');

            $.ajax({
                type: 'POST',
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
    },

    initModalForm: function() {
        var _self = this;
        var $modalForgotPassword = $(_self.options.modalForgotPasswordClass);
        var $modalForgotPasswordBtn = $(_self.options.modalForgotPasswordBtnClass);
        var $modalForgotPasswordCancelBtn = $(_self.options.modalForgotPasswordCancelBtnClass);

        $modalForgotPasswordBtn.on('click', function() {
            $modalForgotPassword.show();
        });

        $modalForgotPasswordCancelBtn.on('click', function() {
            $modalForgotPassword.hide();
        })
    },

    initForgotPassword: function() {
        var _self = this;
        var $modalForgotPasswordSendBtn = $(_self.options.modalForgotPasswordSendBtnClass);

        $modalForgotPasswordSendBtn.on('click', function() {

        })
    }
};