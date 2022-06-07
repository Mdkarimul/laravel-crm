window.onload = function(){
    //step-1 ajax request
    showteams("api/team?page=1","asc");
}


//create team 
$(document).ready(function(){
    $(".create-team-form").submit(function(e){
   e.preventDefault();
   var token = $("body").attr("token");
   //start random color
   var colors = ["erpbg-primary","erpbg-secondary","erpbg-success","erpbg-danger","erpbg-warning","erpbg-info","erpbg-dark","erpbg-pink","erpbg-navy"];
  var index =  Math.floor(Math.random()*9);
   var erpbg = colors[index];
   $.ajax({
       type : "POST",
       url : "api/team",
       data :  {
           _token : token,
           team_name: $(".team_name").val(),
           team_creator: $(".team_creator").val(),
           team_creator_role: $(".team_creator_role").val(),
           team_description : $(".team_description").val()
       },
       beforeSend : function(){
       $(".fullpage-loader").removeClass("d-none");
      // $("#createTeamModal").modal('hide');
       $(".team_name").val("");
       $(".team_description").val("");
       },
       success : function(response){
        $("#createTeamModal").modal('hide');
        $(".fullpage-loader").addClass("d-none");
        showteams("api/team?page=1","desc");
    //    var team_name = response.data.team_name;
    //    var team_description = response.data.team_description;
    //    var card = document.createElement("DIV");
    //    card.className="card my-4 border-0";

    //    var card_header = document.createElement("DIV");
    //    card_header.className="card-header font-weight-bold text-white "+erpbg;
    //    card_header.innerHTML = team_name;
    //    $(card).append(card_header);

    //    var card_body = document.createElement("DIV");
    //    card_body.className="card-body border border-top-0";
    //    card_body.innerHTML = team_description;
    //    $(card).append(card_body);
    //    $(".teams-area").append(card);
       },
       error : function(ajax,error,response){
        $(".fullpage-loader").addClass("d-none");
        //$("#createTeamModal").modal('hide');
        var alertt = document.createElement("DIV");
        alertt.className = "alert bg-warning d-flex align-items-center";
           if(ajax.status==500)
           {
               $(".duplicate-teamname-icon").removeClass("d-none");
               $(".team_name").addClass("animate__animated animate__shakeX");
               //remove duplicate message after click
               $(".team_name").click(function(){ 
                   $(".duplicate-teamname-icon").addClass("d-none");
                   $(".team_name").removeClass("animate__animated animate__shakeX");
               });
            //    alertt.innerHTML = "<span class='material-icons mr-2 bg-warning' style='color:red;' >error</span> Internal server error !";
            //    $(".teams-message").append(alertt);
            //    //remove after 3 seconds
            //    setInterval(function(){
            //        alertt.remove();
            //    },5000);
           }

           if(ajax.status==404)
           {
            alertt.innerHTML = "<span class='material-icons mr-2 ' style='color:red;' >error</span>"+response.notice;
            $(".teams-message").append(alertt);
            //remove after 3 seconds
            setInterval(function(){
                alertt.remove();
            },5000);
           }
          // alert("Something is wrong !");
       }
   });
    });
});


//show teams on document onload
function showteams(url,order_by){
   var token = $("body").attr("token");
   $.ajax({
       type : "GET",
       url : url,
       data : {
           _token : token,
           fetch_type : "pagination",
           order_by : order_by
       },
       beforeSend : function(){
       $(".reams-loader").removeClass("d-none");
       },
       success :  function(response){
           //hide loader
           $(".reams-loader").addClass("d-none");
          // console.log(response);
           $(".teams-area").html(" ");
            //show pagination number
            var start = response.data.from;
            var end = response.data.last_page;
            var total = "Total : "+response.data.total;
            $(".total-team").html(total);
            var pagination_cont = document.querySelector(".paginate-sm-btn");
           // $(pagination_cont).html("");
            for(var i=start;i<=end;i++)
            {
                if (response.data.total <=4) { break; }
                var a = document.createElement("A");
                a.innerHTML=i;
                a.className=" page-link z-10 bg-indigo-50 border-indigo-500 text-indigo-600 relative inline-flex items-center px-4 py-2 border text-sm font-medium";
                 a.href="api/team?page="+i;
                 
                 if(pagination_cont.querySelectorAll("A").length !=end)
                 {
                    $(pagination_cont).append(a);
                 }
                 //get data on onclick
                 $(a).click(function(e){
                     e.preventDefault();
                     var href = $(this).attr("href");
                     showteams(href,"asc");
                 });
            }
   
         
           //return false;
           response.data.data.forEach(function(data){

            //start random color
     var colors = ["erpbg-primary","erpbg-secondary","erpbg-success","erpbg-warning","erpbg-danger","erpbg-info","erpbg-dark","erpbg-pink","erpbg-navy"];
     var index =  Math.floor(Math.random()*7);
      var erpbg = colors[index];

           var team_name = data.team_name;
           var team_description = data.team_description;

           var card = document.createElement("DIV");
           card.className="card shadow-sm my-3 border-0";
           var card_header = document.createElement("DIV");
           card_header.className="card-header p-1 quicksand-font-m pl-2 m-0 font-weight-bold text-white "+erpbg;
           card_header.innerHTML = team_name;
           $(card).append(card_header);
    
           var card_body = document.createElement("DIV");
           card_body.className="card-body p-2 m-0 quicksand-font-s border-0 border-top-0";
           card_body.innerHTML = team_description;
           $(card).append(card_body);
    
           $(".teams-area").append(card);
           });

           //step-2 ajax request 
           if($(".show-job-role").html() == "")
           {
               // request data in ascending order
            show_jobs("api/jobrole?page=1","asc");
           }
       },
       error : function (ajax,error,response){
           console.log(ajax);
           alert("Something is wrong !");
       }
   });
}


//load team name in add role
$(document).ready(function(){
    $("#job-role").on("show.bs.collapse",function(){
        var token = $("body").attr("token");
     var all_option =    $(".select-team-name option");
     if(all_option.length <=1)
     {
        $.ajax({
            type: "GET",
            url : "api/team",
            data : {
                _token : token,
                fetch_type : "job-role"
            },
            success : function(response){
               response.data.forEach(function(data){
                  var team_name =  data.team_name;
                  var option = document.createElement("OPTION");
                  option.innerHTML = team_name;
                  $(".select-team-name").append(option);
               });
            },
            error : function(ajax,error,response){
                alert("Something is wrong !");
            }
        });
     }
    });
});



//insert job role
$(document).ready(function(){
    $(".job-role-form").submit(function(e){
    e.preventDefault();
   var role =  $(".edit-job-role-submit-btn").attr("role");
   var id = $('[name=id]').val();
    var type = "";
    var url = "";
   if(role =="insert")
   {
   type = "POST";
   url = "api/jobrole";
   }
   if(role=="update")
   {
    type = "PUT";
    url = "api/jobrole/"+id;
   }
    $.ajax({
        type : type,
        url : url,
        data  :{
            _token : $("body").attr("token"),
            id : id,
            job_role : $("[name=job_role]").val(),
            qualification : $("[name=qualification]").val(),
            certification : $("[name=certification]").val(),
            experience : $("[name=experience]").val(),
            salary : $("[name=salary]").val(),
            team_name : $(".select-team-name").val(),
            
        },
        success : function(response){
            //set default behaviour to set role !
          if(response.notice =="Update success !")
          {
            $(".edit-job-role-submit-btn").html("Set Role");
            $(".edit-job-role-submit-btn").attr("role","insert");
          }
         //collapse add role form
         $(".job-role-form").trigger('reset');
         $("#job-role").collapse('hide');
         //request data in descending order
         show_jobs("api/jobrole?page=1","desc");
        },
        error : function(ajax,error,response)
        {
            console.log(ajax);
            if(ajax.status ==500)
            {
                $(".duplicate-jobrole-icon").removeClass("d-none");
                $("[name=job_role]").addClass("animate__animated animate__shakeX");
                //remove duplicate message after click
                $("[name=job_role]").click(function(){
                    $(".duplicate-jobrole-icon").addClass("d-none");
                    $("[name=job_role]").removeClass("animate__animated animate__shakeX");
                });
            }
        }
    });
    });
});


//show jobs role
function show_jobs(url,arrange_by){
    var token = $("body").attr("token");
    $.ajax({
        type : "GET",
        url : url,
        data : {
            _token  : token,
            fetch_type : "pagination",
            arrange_by : arrange_by
        },
        beforeSend : function(){
            $(".job-role-loader").removeClass("d-none");
        },
        success : function(response){
           
            //hide loader
            $(".job-role-loader").addClass("d-none");
         console.log(response,"ssssss");
         $(".show-job-role").html(" ");

  //show pagination number
  var start = response.data.from;
  var end = response.data.last_page;
  //show jobs role
var total = "Total : "+response.data.total;
$(".total-roles").html(total);
  var pagination_cont_job_role = document.querySelector(".show-job-role-paginate");
  
  for(var i=start;i<=end;i++)
  {
    if (response.data.total <=4) { break; }

      var aa = document.createElement("A");
      aa.innerHTML=i;
      aa.className=" page-link z-10 bg-indigo-50 border-indigo-500 text-indigo-600 relative inline-flex items-center px-4 py-2 border text-sm font-medium";
       aa.href="api/jobrole?page="+i;
       if(pagination_cont_job_role.querySelectorAll("A").length !=end)
       {
           
          $(pagination_cont_job_role).append(aa);
           
       }
       //get data on onclick
       $(aa).click(function(e){
           e.preventDefault();
           var href = $(this).attr("href");
           alert(href);
            show_jobs(href,"asc"); 
       });
       
  }
  


 //create table
   var table = document.createElement("TABLE");
   table.className = "table table-bordered text-center";
   var th_row = document.createElement("TR");
   var th_jobrole = document.createElement("TH");
   var th_salary = document.createElement("TH");
   var th_teamname = document.createElement("TH");
   var th_action = document.createElement("TH");
   th_jobrole.innerHTML = "Job role";
   th_salary.innerHTML = "Salary";
   th_teamname.innerHTML = "Work As";
   th_action.innerHTML = "Action";
   $(th_row).append(th_jobrole);
   $(th_row).append(th_salary);
   $(th_row).append(th_teamname);
   $(th_row).append(th_action);
   $(table).append(th_row);
   $(".show-job-role").append(table);

   response.data.data.forEach(function(data,index){
   var job_role = data.job_role;
   var salary = data.salary;
   var team_name = data.team_name;

   var tr = document.createElement("TR");
  if(index ==0 && arrange_by=="desc")
  {
      $(tr).addClass("erpbg-info animate__animated animate__shakeX");
      setTimeout(function(){
          $(tr).removeClass("erpbg-info animate__animated animate__shakeX");
      },2000);
  }
   var td_jobrole = document.createElement("TD");
   var td_salary = document.createElement("TD");
   var td_teamname = document.createElement("TD");
   var td_action = document.createElement("TD");



   td_jobrole.innerHTML = job_role;
   td_salary.innerHTML = salary;
   td_teamname.innerHTML = team_name;
   td_action.innerHTML = "<button class='edit-job-role btn remove-focus' data='"+JSON.stringify(data)+"'><span class=' material-icons'>create</span></button>";

   $(tr).append(td_jobrole);
   $(tr).append(td_salary);
   $(tr).append(td_teamname);
   $(tr).append(td_action);
   $(table).append(tr);
         });


         //edit job role
         $(".edit-job-role").each(function(){
             
             $(this).click(function(){
                 this.setAttribute("title","Double click to close");
                 var all_data = $(this).attr("data");
                 all_data = JSON.parse(all_data);
                 var id = all_data.id;
                 var job_role = all_data.job_role;
                 var qualification = all_data.qualification;
                 var certification = all_data.certification;
                 var experience = all_data.experience;
                 var team_name = all_data.team_name;
                 var salary = all_data.salary;

                 //open add role collapsible form
             
                     if($("#job-role").collapse('show'))
                     {
                    $(".edit-job-role-submit-btn").html("Save changes !");
                    $(".edit-job-role-submit-btn").attr("role","update");
                    //$("#job-role").collapse('toggle');
                  //write data to input fields
                    $("[name=job_role]").val(job_role);
                    $("[name=qualification]").val(qualification);
                    $("[name=certification]").val(certification);
                    $("[name=experience]").val(experience);
                    $("[name=team_name]").val(team_name);
                    $("[name=salary]").val(salary);
                    $("[name=id]").val(id);
                    $(this).dblclick(function(){
                        $("#job-role").collapse('hide');
                        $(".edit-job-role-submit-btn").html("Set Role");
                        $(".edit-job-role-submit-btn").attr("role","insert");
                        $(".job-role-form").trigger('reset');
                        this.removeAttribute("title"); 
                    });
                     }
             
             });
         });

        } ,
        error : function(ajax,error,response){
        $(".job-role-loader").addClass("d-none");
        if(ajax.status ==404)
        {
        var response = JSON.parse(ajax.responseText).data+" <span class='material-icons mx-2'>error</span>";
        var message_cont = document.querySelector(".jobrole-message");
        var message = document.createElement("DIV");
        message.className = "bg-notice p-2 text-notice my-4 d-flex align-items-center";
        message.innerHTML =response;
        message_cont.append(message);
        
        }
        }
    });
};


//load team name in add employee area
$(document).ready(function(){
    $("#add-employee").on("show.bs.collapse",function(){
        //controll notice data role not found
        var employee_message_cont = document.querySelector(".add-employee-message");
        $(employee_message_cont).html(" ");
        

        var token = $("body").attr("token");
     var all_option =    $(".select-job-role option");
     if(all_option.length <=1)
     {
        $.ajax({
            type: "GET",
            url : "api/jobrole",
            data : {
                _token : token,
                fetch_type : "get-jobrole-with-salary"
            },
            success : function(response){
                console.log(response.data);
               response.data.forEach(function(data){
                  var team_name =  data.job_role;
                  var salary = data.salary;
                  var option = document.createElement("OPTION");
                  $(option).attr("salary",salary);
                  option.innerHTML = team_name;
                  $(".select-job-role").append(option);
               });
            },
            error : function(ajax,error,response){
               // alert("Something is wrong !");
               // console.log(ajax);
                if(ajax.status ==404)
                {
                    //disabled input when data not found !
                var  add_employee_form = document.querySelector(".add-employee-form");
                 var  all_input =   add_employee_form.querySelectorAll("INPUT, SELECT,TEXTAREA,BUTTON");
                 for(var i=1;i<all_input.length;i++)
                 {
                    all_input[i].setAttribute("disabled","disabled");
                 }
                    
                var response = JSON.parse(ajax.responseText).data +" add new job role first <span class='material-icons mx-2'>error</span>";
                var message = document.createElement("DIV");
                message.className = "bg-notice p-2 text-notice my-4 d-flex align-items-center";
                message.innerHTML =response;
                employee_message_cont.append(message);
                
                }
            }
        });
     }
    });
//per
   $("#add-employee").on("hide.bs.collapse",function(){
    var employee_message_cont = document.querySelector(".add-employee-message");
    if(employee_message_cont.childElementCount !=0)
    {
        employee_message_cont.querySelector("DIV").remove();
    }
            //remove disabled input when data not found  !
            var  add_employee_form = document.querySelector(".add-employee-form");
            var  all_input =   add_employee_form.querySelectorAll("INPUT, SELECT,TEXTAREA,BUTTON");
            for(var i=1;i<all_input.length;i++)
            {
               all_input[i].removeAttribute("disabled");
            }
   });


});



//set salary according to job role
$(document).ready(function(){
    $(".select-job-role").on("change",function(){
     var option_index = this.selectedIndex;
     var all_option_tag = $(".select-job-role option");
     var salary =   $(all_option_tag[option_index]).attr("salary");
     $(".hidden_salary").val(salary);
    });
});


// add require attribute to provious worked field
$(document).ready(function(){
    $("#agree-form").on("show.bs.collapse",function(){
       var input = $("#agree-form input");
       $(input).each(function(){
           $(this).attr("required","required");
       });
    });
});

//remove require attribute from previous worked field
$(document).ready(function(){
    $("#agree-form").on("hide.bs.collapse",function(){
        var input = $("#agree-form input");
        $(input).each(function(){
            $(this).removeAttr("required");
        });
     });
});



//validate file upload input from registration area
$(document).ready(function(){
    $("#add-employee input[type=file]").each(function(){
        $(this).on('change',function(){
            var file = this.files[0];
            var file_size = file.size;
            var file_type = file.type;
            //validate file size
            if(file_size<3145728)
            { 
                //check file type
            if(file_type=="image/jpeg" || file_type=="image/png" ||file_type=="image/gif"  || file_type=="image/jpg")
            {
                if($(this).next().hasClass("upload-message"))
                {
                    $(this).next().remove();
                }
            }
            else
            {
                if(!$(this).next().hasClass("upload-message"))
                {
                    $("<div class='upload-message d-flex align-items-center'><span class='material-icons mx-2 text-notice'>error</span><span class='text-notice quicksand-font'>Please upload image file only</span></div>").insertAfter(this);
                }
            }
        }
            else
            {
                if(!$(this).next().hasClass("upload-message"))
                {
                    $("<div class='upload-message d-flex align-items-center'><span class='material-icons mx-2 text-notice'>error</span><span class='text-notice quicksand-font'>Upload limit less than 3 MB</span></div>").insertAfter(this);
                }
            }


        });
    });
}); 