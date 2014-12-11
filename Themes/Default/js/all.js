$(document).ready(function () {

    $('.static').on("click", function () {
        $(window).scrollTop(0);
    });
    $(window).scroll(function () {
        if ($(window).scrollTop() > 500) {
            var option = {
                bottom: 150
            };
            $('.static').animate(option, {
                queue: false,
                duration: "slow"
            });
            $('.static').show();
        }
        else
        {
            var optiono = {
                bottom: 20
            };
            $('.static').animate(optiono, {
                queue: false,
                duration: "slow"
            });
            $('.static').hide();
        }
    });

    $('.gallery_div_picture').hover(
            function () {
                $(this).find(".gallery_div_comment").show();
            },
            function () {
                $(this).find(".gallery_div_comment").hide();
            });



    $('#account_password').on("keydown", function () {
        var data = {'password': $('#account_password').val(),
            'session_id': $('#session_id').val()};
        $.post("Programs/account/get_password_force.php", data, function (data) {
            $('#account_password_force').html(data);
        });


    });

    $.each($('input[type="text"]'), function (index, element)
    {
        $(element).val($(element).val().replace(" (at) ", '@'));
    });

});




