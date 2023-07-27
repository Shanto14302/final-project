$('#position').change(function(){
    if($(this).val()=='admin_title_image'){
        $('#type').empty();
        $('#type').append('<option value="" selected disabled>Please Select</option><option value="image">Image</option>')
    }else{
        $('#type').empty();
        $('#type').append('<option value="" selected disabled>Please Select</option><option value="image">Image</option><option value="text">Text</option>')
    }
})

$('#type').change(function(){
    if($(this).val()=='image'){
        $('#upload_type').empty();
        $('#upload_type').append('<label class="labelcolor" for="">Upload Image</label><input type="file" class="dropify" data-height="100" width="100%" name="image" id="image" accept="image/png, image/jpeg,image/jpeg"/>')
        $('.dropify').dropify({
            messages: {
                'default': 'Drag and drop a file here or click',
                'replace': 'Drag and drop or click to replace',
                'remove': 'Remove',
                'error': 'Ooops, something wrong appended.'
            },
            error: {
                'fileSize': 'The file size is too big (1M max).'
            }
        });
    }else{
        $('#upload_type').empty();
        $('#upload_type').append('<label class="labelcolor" for="">Enter Text</label><textarea name="text" id="text" class="form-control" rows="6"></textarea>')
    }
})