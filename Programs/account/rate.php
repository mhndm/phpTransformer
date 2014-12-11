<?php
global $UserId,$member_id;
?>
<script type="text/javascript">
    $(document).ready(function () {
<?php
if (!isset($UserId) || empty($UserId) || $UserId === '20070000000') {
    ?>
            $.each($('.rate_div'), function (index, element)
            {
                $(element).rate_control({
                    stars: $(element).attr('data-rate'),
                    editable: false,
                    max_rate: 5,
                    lang: 'rtl',
                    stars_path: 'Themes/mobile/Images/rate/',
                    on_rate: function (rate_element, rate_value, rate_data, rate_container)
                    {

                    }
                });
            });
            $(".rate_loader").html('<a href="Prog-account_acnt-login_Lang-Arabic_nl-1.pt" style="font-size:x-small;" >(سجل دخولك من أجل التقييم)</a>');
    <?php
} else {
    ?>
            $.each($('.rate_div'), function (index, element)
            {
                $(element).rate_control({
                    stars: $(element).attr('data-rate'),
                    editable: true,
                    max_rate: 5,
                    lang: 'rtl',
                    stars_path: 'Themes/mobile/Images/rate/',
                    on_rate: function (rate_element, rate_value, rate_data, rate_container)
                    {
                        rate(rate_element, rate_value, rate_data, rate_container);
                    }
                });
            });
    <?php
}
?>




    });

    function rate(rate_element, rate_value, rate_data, rate_container)
    {
        var disabled_rating_data = {
            stars: rate_value, editable: false,
            max_rate: 5, data: {},
            lang: 'rtl',
            stars_path: 'Themes/mobile/Images/rate/',
            on_rate: function () {
            }};

        $(rate_container.container).rate_control(disabled_rating_data);
        var container = $(rate_container.container);
        container.parent().find('.rate_loader').html('<span class="rate_loader"><image src="Themes/mobile/Images/rate/loader.gif" width="16" /></span>');
        var that = $(rate_element);
        var member_id = container.parent().find('.rate_div').attr('data-id');
        var ajax_data = {op: 'r', a: 'set', i: {
                t: "<?php global $app_token; echo $app_token; ?>",
                m: member_id,
                r: rate_value
            }};
        var ajax_options = {url: "Programs/api_full/api_full_app_alpha.php", data: ajax_data, dataType: 'json', type: 'POST'};
        var request = $.ajax(ajax_options);
        request.done(function (data)
        {
            container.parent().find('.rate_loader').html('');
            var enabled_rating_data =
                    {
                        stars: data.r,
                        editable: true,
                        max_rate: 5,
                        stars_path: 'Themes/mobile/Images/rate/',
                        data: {},
                        lang: 'rtl',
                        on_rate: function (rate_element, rate_value, rate_data, rate_container)
                        {
                            rate(rate_element, rate_value, rate_data, rate_container);

                        }
                    };
            container.parent().find('.my_rate_div').html(data.m_r + ' + ');
            $(rate_container.container).rate_control(enabled_rating_data);
        });
        request.fail(function (error)
        {

        });

    }
</script>