// #region: Toggle password //   
    $(".toggle-password").click(function () {
        $(this).toggleClass("bi-eye-slash-fill bi-eye-fill");

        if($(this).prev().attr("type") == "password") {
            $(this).prev().attr("type", "text");
        }
        else {
            $(this).prev().attr("type", "password");
        }
    });
// #endregion //


// #region: Prevent too many clicks //
    document.querySelectorAll('form').forEach(function(form) {
        form.addEventListener('submit', function(event) {
            form.querySelectorAll('button, input[type="submit"]').forEach(function(button) {
                button.disabled = true;
            });
        });
    });
// #endregion //