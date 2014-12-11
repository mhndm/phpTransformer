<?php
include_once("../../../../../config.php");
include_once("../../../../../includes/ezsql/ez_sql.php");
include_once("../../../../../includes/InputFilters.php");

if(isset($_GET['path'])){
    $path = InputFilter($_GET['path']);
}else{
    $path = '';
}

?>
$(document).ready(function() {
    var errorHandler = function(event, id, fileName, reason) {
        qq.log("id: " + id + ", fileName: " + fileName + ", reason: " + reason);
    };

    var fileNum = 0;

    $('#basicUploadSuccessExample').fineUploader({
        debug: true,
//        cors: {
//            expected: true
//        },
        request: {
            endpoint: "<?php echo $path; ?>",
            paramsInBody: true
//            params: {
//                test: 'one',
//                blah: 'foo',
//                bar: {
//                    one: '1',
//                    two: '2',
//                    three: {
//                        foo: 'bar'
//                    }
//                },
//                fileNum: function() {
//                    fileNum+=1;
//                    return fileNum;
//                }
//            }
        },
        chunking: {
            enabled: true
        },
//        resume: {
//            enabled: true
//        },
        retry: {
            enableAuto: true,
            showButton: true
        },
        deleteFile: {
            enabled: true,
            endpoint: '<?php echo $path; ?>',
            forceConfirm: true,
            params: {foo: "bar"}
        },
        display: {
            fileSizeOnSubmit: true
        }
    })
        .on('error', errorHandler)
        .on('uploadChunk resume', function(event, id, fileName, chunkData) {
            qq.log('on' + event.type + ' -  ID: ' + id + ", FILENAME: " + fileName + ", PARTINDEX: " + chunkData.partIndex + ", STARTBYTE: " + chunkData.startByte + ", ENDBYTE: " + chunkData.endByte + ", PARTCOUNT: " + chunkData.totalParts);
        })
        .on("upload", function(event, id, filename) {
            $(this).fineUploader('setParams', {"hey": "ho"}, id);
        });

    $('#manualUploadModeExample').fineUploader({
        autoUpload: false,
        uploadButtonText: "Select Files",
        request: {
            endpoint: "<?php echo $path; ?>"
        },
        display: {
            fileSizeOnSubmit: true
        }
    }).on('error', errorHandler);

    $('#triggerUpload').click(function() {
        $('#manualUploadModeExample').fineUploader("uploadStoredFiles");
    });


    $('#basicUploadFailureExample').fineUploader({
        request: {
            endpoint: "<?php echo $path; ?>",
            params: {"generateError": true}
        },
        failedUploadTextDisplay: {
            mode: 'custom',
            maxChars: 5
        },
        retry: {
            enableAuto: true,
            showButton: true
        }
    }).on('error', errorHandler);


    $('#uploadWithVariousOptionsExample').fineUploader({
        multiple: false,
        request: {
            endpoint: "<?php echo $path; ?>"
        },
        validation: {
            allowedExtensions: ['jpeg', 'jpg', 'txt','jpeg','bmp'],
            sizeLimit: 50000,
            minSizeLimit: 2000
        },
        text: {
            uploadButton: "Click Or Drop"
        },
        display: {
            fileSizeOnSubmit: true
        }
    }).on('error', errorHandler);


    $('#fubExample').fineUploader({
        uploaderType: 'basic',
        multiple: false,
        autoUpload: false,
        button: $("#fubUploadButton"),
        request: {
            endpoint: "<?php echo $path; ?>"
        }
    }).on('error', errorHandler);
});