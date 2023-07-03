//animate placeholder


$(document).ready(function(){
    var store = "";
    $(".welcome-form-input").each(function(){
        $(this).click(function(){
            //remove placeholder
            var store = $(this).attr("placeholder");
                $(this).attr("placeholder","");
                //show label
             var parent  = this.parentElement;
              var label =  parent.getElementsByTagName("LABEL")[0];
              $(label).removeClass("d-none");
              $(label).addClass("animate__animated animate__backInUp");
        });
    });
});

//slide on next 
$(document).ready(function(){
    $(".step-1-next-btn").click(function(e){
    e.preventDefault();
    empty_field_validation('step-1','step-2');
    });

    $(".step-2-next-btn").click(function(e){
        e.preventDefault();
        empty_field_validation("step-2","step-3");
        });

        $(".step-3-next-btn").click(function(e){
            e.preventDefault();
            empty_field_validation("step-3","step-4");
            });
});

//validate on next click
function empty_field_validation(f_class,s_class){
    var container = document.getElementsByClassName(f_class)[0];
    var input = container.getElementsByClassName("required");
    var url = container.getElementsByClassName("url");
    var temp = [];
    $(input).each(function(i){
        if($(this).val().trim()=="")
        {
            if(this.nextSibling.nodeName=="SMALL")
            {
                this.nextSibling.remove();   
            }
            $(this).addClass("border-danger");
            $("<small class='text-danger required-notice'><i class='fa fa-warning'></i>This field can't be empty !</small>").insertAfter(this);
        }
        else
        {
            temp[i] = $(this).val().trim();
            if(this.type=="email")
            {
                validate_email(this);
            }
        }
    });

    //validate url fields
    $(url).each(function(){
        if($(this).val().trim() != "")
        {
            validate_url(this);
        }
    });

    //slide if all required field is not empty
    if(temp.length ==input.length && $(".required-notice").length ==0)
    {
        company_validation(f_class,s_class);
//      $("."+f_class).addClass("d-none");
//    $("."+s_class).addClass("animate__animated animate__slideInRight");
//    $("."+s_class).removeClass("d-none");
    }

    //remove required message on input
    $(input).each(function(){
        $(this).on("input",function(){
            if(this.nextSibling.nodeName=="SMALL")
            {
                this.nextSibling.remove();
                $(this).removeClass("border-danger");
            }
        });
    });


     //remove required message on url
     $(url).each(function(){
        $(this).on("input",function(){
            if(this.nextSibling.nodeName=="SMALL")
            {
                this.nextSibling.remove();
                $(this).removeClass("border-danger");
            }
        });
    });

}





//validate email
function validate_email(input){
var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
if(!reg.test(input.value))
{
    if(input.nextSibling.nodeName=="SMALL")
    {
        input.nextSibling.remove();
    }
    $(input).addClass("border-danger");
    $("<small class='text-danger required-notice'><i class='fa fa-warning'></i>Enter a valid email !</small>").insertAfter(input);
}
}

//validate url
function validate_url(input){
    var reg = /(ftp|http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/;
    if(!reg.test(input.value))
    {
        if(input.nextSibling.nodeName=="SMALL")
        {
            input.nextSibling.remove();
        }
        $(input).addClass("border-danger");
        $("<small class='text-danger required-notice'><i class='fa fa-warning'></i>Enter a valid url !</small>").insertAfter(input);
    }
    }


    //validate company
function company_validation(f_class,s_class){
var company_name = $(".company-name").val().trim();
var company_slug = company_name.replace(/ /g,"");
var input = document.querySelector(".company-name");
var erp_url = window.location+"erp/"+company_slug;
$.ajax({
    type:"get",
    url : "/erp/"+company_slug,
    data : {
        _token : $("body").attr("token"),

    },
    success : function(){
  if(input.nextSibling.nodeName=="SMALL")
  {
      input.nextSibling.remove();
  }
  $(input).addClass("border-danger");
  $("<small class='text-danger required-notice'><i class='fa fa-warning'></i>Company name already exits !</small>").insertAfter(input);
    },
    error :function(){
        //writing company slug to input field
        $(".company-slug").val(company_slug);
        //writing erp url to input field
        $(".erp-url").val(erp_url);
        //call generate password
        generate_password();
        $("."+f_class).addClass("d-none");
          $("."+s_class).addClass("animate__animated animate__slideInRight");
            $("."+s_class).removeClass("d-none");
    }
});
}

//generate password
function generate_password(){
var password ="@#@3vcbvb#ddfhghgkjkl$werweqr€xcvv%44€xvxcv€xvmbncmmbncbnm#%44$&4446&t^%eg&*";
var i;
var final_password = " ";
for(i=0;i<8;i++)
{
   var index =  Math.random()*password.length-1;
 index =   Math.floor(index);
 final_password += password[index];
}
$(".password").val(final_password);
}


//slide on back
$(document).ready(function(){
    $(".step-2-back-btn").click(function(e){
        e.preventDefault();
        $(".step-2").addClass("d-none");
        $(".step-1").removeClass("d-none");
        $(".step-1").addClass("animate__animated animate__slideInRight");
    });

    $(".step-3-back-btn").click(function(e){
        e.preventDefault();
        $(".step-3").addClass("d-none");
        $(".step-2").removeClass("d-none");   
    });

    $(".step-4-back-btn").click(function(e){
        e.preventDefault();
        $(".step-4").addClass("d-none");
        $(".step-3").removeClass("d-none");
        
    });
});



