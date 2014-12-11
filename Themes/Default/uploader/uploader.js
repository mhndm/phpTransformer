

function pt_uploader(drop_id, upload_id, multi_files, upfiles_id, allowed_ext, callback_name, callback_args) {

//console.log(allowed_ext);

    var ul = $('#' + upload_id + ' ul');

    $('#' + drop_id + ' a').on('click', function()
    {
        $(this).parent().find('input').click();
        return false;
    });

    $('#' + upload_id).fileupload({
        dropZone: $('#' + drop_id),
        dataType: 'json',
        add: function(e, data)
        {
            //$('#' + drop_id + ' a').prop('disabled','disabled');
            $('#upl' + drop_id).prop('disabled', 'disabled');
            $('#' + drop_id + ' a').addClass('disabled');

            var tpl = $('<li class="working">\n\
                    <input class="progress_input" type="text" value="0" data-width="48" data-height="48"' +
                    ' data-fgColor="#0788a5" data-readOnly="1" data-bgColor="#3e4043" /><p></p>\n\
                    <span></span></li>');

            tpl.find('p').text(data.files[0].name).append('<i>' + formatFileSize(data.files[0].size) + '</i>');
            if (multi_files == "0") {
                ul.html(tpl);
                data.context = tpl;
                tpl.find('input').knob();
            } else
            {
                data.context = tpl.appendTo(ul);
                tpl.find('input').knob();
            }

            tpl.find('span').click(function()
            {
                if (tpl.hasClass('working')) {
                    jqXHR.abort();
                }
                tpl.fadeOut(function() {
                    tpl.remove();
                });
            });
            var extension_arr = data.files[0].name.toString().split('.');

            var extensions = allowed_ext;

            var extension = extension_arr[extension_arr.length - 1].toString().toLowerCase();
            if (extension_arr.length <= 1 || $.inArray(extension, extensions) == -1) {

                tpl.removeClass('working');
                tpl.addClass('error');
                return false;
            }
            var jqXHR = data.submit();
            jqXHR.done(function(data)
            {
                $('#' + drop_id + ' a').removeProp('disabled');
                $('#upl' + drop_id + '').removeProp('disabled');
                $('#' + drop_id + ' a').addClass('working');

                if (typeof callback_name !== "undefined" && callback_name !== null) {

                    if (typeof callback_args !== "undefined" && callback_args !== null) {

                    }
                }

                if (multi_files == "0"){
                    $('#' + upfiles_id).val(data['fname']);
                }
                else{
                    $('#' + upfiles_id).val($('#' + upfiles_id).val() + data['fname'] + "||");
                }
                //callback
                usercp_ptuploader(callback_args, $('#' + upfiles_id).val());
            })
        },
        progress: function(e, data)
        {
            var progress = parseInt(data.loaded / data.total * 100, 10);
            data.context.find('input').val(progress).change();
            if (progress == 100)
            {
                data.context.removeClass('working');
            }
        },
        fail: function(e, data)
        {
            data.context.addClass('error');
        }
    });


    // Prevent the default action when a file is dropped on the window
    $(document).on('drop dragover', function(e)
    {
        e.preventDefault();
    });


}

function formatFileSize(bytes)
{
    if (typeof bytes !== 'number')
    {
        return '';
    }
    if (bytes >= 1000000000)
    {
        return (bytes / 1000000000).toFixed(2) + ' GB';
    }
    if (bytes >= 1000000)
    {
        return (bytes / 1000000).toFixed(2) + ' MB';
    }
    return (bytes / 1000).toFixed(2) + ' KB';
}

