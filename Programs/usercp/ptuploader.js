function usercp_ptuploader(callback_args, uploader_result) {

var extension_arr = uploader_result.toString().split('.');
var extension = extension_arr[extension_arr.length - 1].toString();
            
            
$('#MiniNewsPic').html('<img src="uploads/users/admin/avatar_128.' + extension + '?v=' + Math.random() + '" />');
$('#UserPic').html('<img src="uploads/users/admin/avatar_128.' + extension + '?v=' + Math.random() + '" />');
$.ajax({
    url:'Programs/usercp/rpc.php',
    data:{e:extension},
    type:'post'
});
}