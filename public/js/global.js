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


// #region: Sidebar collapse //
    $('.sidebar-icon').on('click', function() {
        $('.sidebar').toggleClass('active');
        $('.layout-content').toggleClass('full-width');
    });
// #endregion //


// #region: Date picker X //
    $(document).ready(function () {
        const dateInputs = document.querySelectorAll('.date-picker-field');

        dateInputs.forEach(input => {
            input.DatePickerX.init({
                format: 'yyyy-mm-dd',
                minDate: new Date(),
            });
        });
    });
// #endregion //


// #region: Select //
    $(document).ready(function() {
        $('.modal').on('shown.bs.modal', function () {
            $(this).find('.js-single').select2({
                dropdownParent: $(this)
            });

            $(this).find('.js-multiple').select2({
                dropdownParent: $(this)
            });
        });
    });
// #endregion //