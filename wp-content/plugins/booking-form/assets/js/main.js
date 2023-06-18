function checkPhoneNumber(phone) {
    if (!/(84|0[3|5|7|8|9])+([0-9]{8})\b/g.test(phone)) {
        return false;
    }
    if (phone.trim() === "") {
        return false;
    }
    return true;
}

function checkEmail(email) {
    if (!/^[\w-\.]+@([\w-]+\.)+[\w-]{1,15}$/g.test(email)) {
        return false;
    }
    if (email.trim() === "") {
        return false;
    }
    return true;
}

function validate_field(field, error = 0) {
    if (field.is('select')) {
        if (field.val() == '' || field.val() == null) {
            field.parent().find('.invalid-feedback').html('Chưa ' + field.find('option[value=""]').html().toLowerCase());
            field.addClass('is-invalid');
            error++;
        } else {
            field.removeClass('is-invalid');
        }
    } else {
        if (field.val() == '' || field.val().trim() === "") {
            field.parent().find('.invalid-feedback').html('Chưa ' + field.attr('placeholder').toLowerCase());
            field.addClass('is-invalid');
            error++;
        } else {
            if (field.attr('id') == 'mobile') {
                if (!checkPhoneNumber(field.val())) {
                    field.parent().find('.invalid-feedback').html('Số điện thoại không hợp lệ');
                    field.addClass('is-invalid');
                    error++;
                } else {
                    field.removeClass('is-invalid');
                }
            } else if (field.attr('id') == 'email') {
                if (!checkEmail(field.val())) {
                    field.parent().find('.invalid-feedback').html('Email không hợp lệ');
                    field.addClass('is-invalid');
                    error++;
                } else {
                    field.removeClass('is-invalid');
                }
            } else {
                field.removeClass('is-invalid');
            }
        }
    }
    return error;
}

jQuery(function($) {
    $(document).ready(function() {
        $('.pick-date').flatpickr({
            enableTime: false,
            dateFormat: 'd-m-Y',
            inline: true,
            minDate: "today",
            defaultDate: "today",
            locale: {
                weekdays: {
                    shorthand: ["CN", "T2", "T3", "T4", "T5", "T6", "T7"],
                    longhand:["Chủ nhật", "Thứ hai", "Thứ ba", "Thứ tư", "Thứ năm", "Thứ sáu", "Thứ bảy"]
                },
                months: {
                    shorthand: ["Th01", "Th02", "Th03", "Th04", "Tháng 05", "Th06", "Th07", "Th08", "Th09", "Th10", "Th11", "Th12"],
                    longhand: ["Tháng 01", "Tháng 02", "Tháng 03", "Tháng 04", "Tháng 05", "Tháng 06", "Tháng 07", "Tháng 08", "Tháng 09", "Tháng 10", "Tháng 11", "Tháng 12"]
                }
            }
        });
        $('.numInput.cur-year').attr('readonly', true);
    
        $('body').on('click', '.next-step', function() {
            let btn = $(this);
            let step = btn.val();
            let nextStep = Number(step) + 1;
            var error = 0;
    
            $(`.step-body.step-${step} :input`).each(function() {
                error = validate_field($(this), error);
            });
            
            if (error != 0) {
                $(`label[for="${$(":input.is-invalid").first().attr('id')}"]`).focus();
                return false;
            }
            if(Number(step) == 3) {
                $.ajax({
                    url: "",
                    type:"POST",
                    data:{action: 'wp_ajax_save_data_booking_form', data:$('#book-exam-form').serialize()},
                    // data:{data:$('#book-exam-form').serialize()},
                    success:function(rs){
                        console.log(rs);
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
                return false;
                $('.step-' + step).removeClass('active');
                setTimeout(() => {
                    $('.step-' + nextStep).addClass('active');
                    $('.process-' + nextStep).addClass('active');
                }, 50);
            } else {
                $('.step-' + step).removeClass('active');
                setTimeout(() => {
                    $('.step-' + nextStep).addClass('active');
                    $('.process-' + nextStep).addClass('active');
                }, 50);
            }
        });
    
        $('body').on('click', '.back-step', function() {
            let btn = $(this);
            let step = btn.val();
            let currentStep = Number(step) + 1;
            $('.step-' + currentStep).removeClass('active');
            $('.process-' + currentStep).removeClass('active');
            setTimeout(() => {
                $('.step-' + step).addClass('active');
            }, 50);
        });
    
        $('body').on('input', ':input', function() {
            validate_field($(this));
        });
    
        $('body').on('click', '.btnPickTime', function() {
            let val = $(this).val();
            $('input[name="book[booking_time]"]').val(val);
            $('.step-2').removeClass('active');
            $('#time-picked').html(val);
            $('#date-picked').html($('[name="book[booking_date]"]').val());
            $('#service-picked').html($('[name="book[service]"] option:selected').text());
            $('#brand-picked').html($('[name="book[brand]"] option:selected').text());
            setTimeout(() => {
                $('.step-3').addClass('active');
                $('.process-3').addClass('active');
            }, 50);
        });
    
    });
});