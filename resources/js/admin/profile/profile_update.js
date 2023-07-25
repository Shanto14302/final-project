
function formValidation(){
    var flag = 0;
    if(document.getElementById('father_name').value==''){
        flag = 1;
        document.getElementById('father_name_error').innerHTML='Father Name Required';
    }else{
        flag = 0;
        document.getElementById('father_name_error').innerHTML='';
    }
    if(document.getElementById('mother_name').value==''){
        flag = 1;
        document.getElementById('mother_name_error').innerHTML='Mother Name Required';
    }else{
        flag = 0;
        document.getElementById('mother_name_error').innerHTML='';
    }
    if(document.getElementById('address').value==''){
        flag = 1;
        document.getElementById('address_error').innerHTML='Address Required';
    }else{
        flag = 0;
        document.getElementById('address_error').innerHTML='';
    }
    if(document.getElementById('profile_image').value==''){
        flag = 1;
        document.getElementById('profile_image_error').innerHTML='Profile Image Required';
    }else{
        var FileUploadPath = document.getElementById('profile_image').value;
        var Extension = FileUploadPath.substring(FileUploadPath.lastIndexOf('.') + 1).toLowerCase();
        if (Extension == "png" || Extension == "jpeg" || Extension == "jpg") {
            flag = 0;
            document.getElementById('profile_image_error').innerHTML='';
        }else{
            flag = 1;
            document.getElementById('profile_image_error').innerHTML='Image format invalid . Required ["jpg","jpeg","png"]';
        }
    }

    if(flag==0){
        return true;
    }
}

$('#trigger_user_basic_edit').on("click",function(){
    if(document.getElementById('user_basic_edit').style.display=='none'){
        document.getElementById('user_basic_edit').style.display='block';
        document.getElementById('trigger_user_basic_edit').classList.remove("fa-pen-square");
        document.getElementById('trigger_user_basic_edit').classList.add("fa-minus-square");
        document.getElementById('trigger_user_basic_edit').style.color='red';
    }else{
        document.getElementById('user_basic_edit').style.display='none';
        document.getElementById('trigger_user_basic_edit').classList.remove("fa-minus-square");
        document.getElementById('trigger_user_basic_edit').classList.add("fa-pen-square");
        document.getElementById('trigger_user_basic_edit').style.color='';
    }
    

    // alert(style)
});

$('#trigger_user_additional_edit').on("click",function(){
    if(document.getElementById('user_additional_edit').style.display=='none'){

        document.getElementById('user_image_edit').style.display='none';
        document.getElementById('trigger_user_image_edit').style.color='';

        
        document.getElementById('user_additional_edit').style.display='block';
        document.getElementById('trigger_user_additional_edit').classList.remove("fa-pen-square");
        document.getElementById('trigger_user_additional_edit').classList.add("fa-minus-square");
        document.getElementById('trigger_user_additional_edit').style.color='red';
    }else{
        document.getElementById('user_additional_edit').style.display='none';
        document.getElementById('trigger_user_additional_edit').classList.remove("fa-minus-square");
        document.getElementById('trigger_user_additional_edit').classList.add("fa-pen-square");
        document.getElementById('trigger_user_additional_edit').style.color='';
    }
    

    // alert(style)
});

$('#trigger_user_image_edit').on("click",function(){
    if(document.getElementById('user_image_edit').style.display=='none'){
        
        document.getElementById('user_additional_edit').style.display='none';
        document.getElementById('trigger_user_additional_edit').classList.remove("fa-minus-square");
        document.getElementById('trigger_user_additional_edit').classList.add("fa-pen-square");
        document.getElementById('trigger_user_additional_edit').style.color='';


        document.getElementById('user_image_edit').style.display='block';
        document.getElementById('trigger_user_image_edit').style.color='red';
        
    }else{
        document.getElementById('user_image_edit').style.display='none';
        document.getElementById('trigger_user_image_edit').style.color='';
    }
    

    // alert(style)
});