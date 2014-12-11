<form class="upload_frm" id="upload{id}" method="post" 
      action="includes/uploader/upload.php" enctype="multipart/form-data">
    <div id="uploader_div{id}" class="upload">
        <div id="drop{id}" class="drop">
            {drop_here}<a href="#">{choose_pic}</a>
            <input type="file" name="upl"{multiple}  id="upldrop{id}" />
        </div>
        <ul>
            <!-- The file uploads will be shown here -->
        </ul>
        <input type="hidden" value="" id="{upfiles}" />
        

        
    </div>
</form>