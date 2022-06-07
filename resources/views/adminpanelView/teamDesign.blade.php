<?php 
session_start();
?>

@if(! isset($_SESSION['adminauthentication']))
<script>
  window.location = "/404";
  </script>
@else
@extends("template.adminPanel.adminpanelTemplate")
@section("title")
WES-TeamDesign
@endsection

@section("custom-css")
<link href="/css/app.css" rel="stylesheet">
<link rel="stylesheet" href="{{url('/')}}/lang/css/adminPanel/teamDesign.css?cache=<?php  echo time(); ?>">
@endsection

@section("custom-js")
<script src="lang/js/adminPanel/teamDesign.js?cache=<?php echo time();  ?>"></script>
@endsection

@section("content")
<a href="#createTeamModal" data-toggle="modal">
<span class="material-icons create-team-icon" style="font-size:;">add_circle</span>
</a>
<!-- start create team modal-->
<!-- The Modal -->
<div class="modal fade shadow-lg" id="createTeamModal">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content border-0">
      
        <!-- Modal Header -->
        <div class="modal-header bg-pink text-white">
          <h4 class="modal-title quicksand-font font-weight-bold ">Create Team</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body quicksand-font" style="letter-spacing:1px;">
          Manage your employees group by creating a team such as service team , backend team and many more !
        
          <form class="create-team-form">
            @csrf 
        <label class="d-none quicksand-font text-danger float-left duplicate-teamname-icon my-1">
      <span class="material-icons float-left">error</span>
      Duplicate entry
    </label>
        <input type="text" required="required" name="team_name" class="form-control my-4 remove-focus team_name" placeholder="Enter team name">
        
        <input type="hidden" name="team_creator" class="team_creator form-control my-4 remove-focus" required="required" value="{{ $_SESSION['team-creator'] }}">
        
        <input type="hidden" name="team_creator_role" class="team_creator_role form-control my-4 remove-focus" required="required" value="{{ $_SESSION['team-creator-role'] }}">
        
        <textarea required="required" name="team_description" class="team_description form-control mb-4 remove-focus" rows="3">Describe something about team 
        </textarea>

        <button class="btn float-right bg-pink text-white remove-focus">Create</button>
    </form>
        
        </div>
      </div>
    </div>
  </div>
<!--end create team modal-->
<!--add job role AND add employee-->
<div class="row">
  <!--start 1st col md 6-->
  <div class="col-md-6">

  <!--start add job role card-->
  <div class="card rounded-0  mt-2 border-0 " style="">
  <div class="card-body m-0  p-2 ">
    <p class="quicksand-font p-0 m-0 mb-2">Setup job role and salary for employees</p>
    <button data-target="#job-role" data-toggle="collapse" class="rounded-0 quicksand-font remove-focus btn bg-pink px-2 text-white d-flex align-items-center">
    <span class="material-icons" style="">post_add</span>
    Add Role
    </button>
    
<div class="job-role mt-4 collapse p-2 " id="job-role">
  <form class="job-role-form">
    @csrf 
    <input type="hidden" name="id" value="0">
    <label class="d-none quicksand-font text-danger  duplicate-jobrole-icon">
      <span class="material-icons ">error</span>
      Duplicate entry
    </label>
    <input type="text" name="job_role" placeholder="Enter job role" class="form-control rounded-0 remove-focus mb-3 quicksand-font " required="required" style="width:300px;">
    <input type="text" name="qualification" placeholder="Enter qualification" class="form-control rounded-0 remove-focus mb-3 quicksand-font" required="required" style="width:300px;">
    <input type="text" name="certification" placeholder="Enter certification" class="form-control rounded-0 remove-focus mb-3 quicksand-font" required="required" style="width:300px;">
    <input type="number" name="experience" placeholder="Enter year of experience" class="form-control rounded-0 remove-focus mb-3 quicksand-font" required="required" style="width:300px;">
    <input type="number" name="salary" placeholder="Salary" class="form-control rounded-0 remove-focus mb-2 quicksand-font" required="required" style="width:300px;">
     
    <select name="team_name" class="form-control mb-2 rounded-0 remove-focus select-team-name" style="width:300px;" >
  <option value="No team">Part of any team</option>
  </select>
    <button type="submit" role="insert" class="edit-job-role-submit-btn btn remove-focus rounded-0 bg-pink bg-success text-white quicksand-font" >Set Role</button>
  
  </form>
</div>
  </div>
</div>
 <!--end add job role card-->
  </div>
 <!--end 1st col md 6-->
  <!--start 2st col md 6-->
  <div class="col-md-6">
    <!--start add job role card-->
  <div class="card rounded-0  mt-2 border-0 " style="">
  <div class="card-body m-0  p-2 ">
    <p class="quicksand-font p-0 m-0 mb-2">Setup job role and salary for employees</p>
    <div class="add-employee-message"></div>
    <button data-target="#add-employee" data-toggle="collapse" class="rounded-0 quicksand-font remove-focus btn erpbg-primary px-2 text-white d-flex align-items-center">
    <span class="material-icons" style="">group_add</span>
    Add Employee
    </button>
    
<div class="job-role mt-4 collapse   " id="add-employee" style="">
  <form class="add-employee-form  p-2 text-white" >
    @csrf 
    <div class="row px-3">
      <div class="col-md-2 px-0 p-4">
        <img src="assets/images/employee.jpg" class="" width="100%" >
      </div>
      <div class="col-md-10 pr-0">
        <input type="text" required name="employee_name" class="form-control rounded-0 remove-focus mb-3" placeholder="Employee name">
        <select name="job_role" class="form-control remove-focus rounded-0 select-job-role">
          <option salary="0">Select job role</option>
        </select>
        <!--hidden salary input-->
        <input type="hidden" name="salary" required class="hidden_salary form-control " value="0">
      </div>
    </div>

    <div class="row px-3">
    <div class="col-md-6 px-0">
    <div class="form-group my-3">
      <label class="quicksand-font">Residential proof</label>
      <input type="file" name="residential_proof" accept="image/*" required class="form-control remove-focus rounded-0">
    </div>

    <div class="form-group my-3">
      <label class="quicksand-font">Certification proof</label>
      <input type="file" name="qualification_proof" accept="image/*" required class="form-control remove-focus rounded-0">
    </div>

    <div class="form-group my-3">
      <label class="quicksand-font">Secondary contact</label>
      <input type="number" name="secondary_contact" required class="form-control remove-focus rounded-0">
    </div>


    <div class="form-group my-3 mb-4">
      <label class="quicksand-font">Gender</label>
      <select name="gender" class="form-control remove-focus rounded-0">
        <option>Gender</option>
        <option>Male</option>
        <option>Female</option>
      </select>
    </div>

    <div class="form-group my-3">
      <label class="quicksand-font">City</label>
      <input type="text" name="city" required class="form-control remove-focus rounded-0">
    </div>


    <div class="form-group my-3">
      <label class="quicksand-font">State</label>
      <input type="text" name="state" required class="form-control remove-focus rounded-0">
    </div>



    </div>

    <div class="col-md-6 pr-0">
    <div class="form-group my-3">
      <label class="quicksand-font">Qualification proof</label>
      <input type="file" name="qualification_proof" accept="image/*" required class="form-control remove-focus rounded-0">
    </div>

    <div class="form-group my-3">
      <label class="quicksand-font">Primary contact</label>
      <input type="number" name="primary_contact" required class="form-control remove-focus rounded-0">
    </div>

    <div class="form-group my-3">
      <label class="quicksand-font">Date of birth</label>
      <input type="date" name="dob" required class="form-control  remove-focus rounded-0">
    </div>


    <div class="form-group mt-3 mb-0">
      <label class="quicksand-font">Street address</label>
      <textarea  name="street_address" required class="form-control remove-focus rounded-0"></textarea>
    </div>

    <div class="form-group mb-3 mt-0 ">
      <label class="quicksand-font">Pincode</label>
      <input type="number" name="pin_code" required class="form-control remove-focus rounded-0">
    </div>


    <div class="form-group my-3">
      <label class="quicksand-font">Country</label>
      <input type="text" name="country" required class="form-control remove-focus rounded-0">
    </div>

  
    </div>

<div class="col-md-12 p-0">
<div class="form-group mb-3">
  <input type="checkbox" name="agree" class="rounded-0 agree-checkbox" id="agree-checkbox" data-target="#agree-form" data-toggle="collapse">
  <label class="quicksand-font" for="agree-checkbox">Have you worked any where before</label>
</div>
</div>

    </div>


    <!--new row-->
    <div class="row px-3 collapse " id="agree-form">
      <div class="col-md-6 px-0">
        <div class="form-group my-2">
          <label class="quicksand-font">Company name</label>
            <input type="text" name="company_name" class="form-control rounded-0 remove-focus">
        </div>
      </div>

      <div class="col-md-6 pr-0 ">
      <div class="form-group my-2">
          <label class="quicksand-font">Experience</label>
            <input type="number" name="experience" class="form-control rounded-0 remove-focus">
        </div>
      </div>


      <div class="col-md-6 px-0">
        <div class="form-group my-2">
          <label class="quicksand-font">Salary</label>
            <input type="number" name="previous_salary" class="form-control rounded-0 remove-focus">
        </div>
      </div>

      <div class="col-md-6 pr-0">
      <div class="form-group my-2">
          <label class="quicksand-font">4 Copies of salary sleep</label>
            <input type="file" name="salary_sleep" accept="image/*" class="form-control rounded-0 remove-focus">
        </div>
      </div>



    </div>
   
   
    <button type="submit" role="insert" class="edit-job-role-submit-btn btn remove-focus rounded-0  bg-success text-white quicksand-font" >Register</button>
  
  </form>
</div>
  </div>
</div>
  </div>
   <!--end 2st col md 6-->
</div>
<!--end row coding-->




   <div class="row pt-1">
     <div class="col-md-6" >
       <div class="card border-0 rounded-0 shadow-sm mb-4">
         <div class="card-body">
         <h5 class="quicksand-font font-weight-bold d-flex justify-content-between">
           Teams
           <span class="badge badge-info total-team">Total : 0</span>
           </h5>
           <div class="teams-loader d-none">
           <div class="loader"></div>
           </div>
         <div class="teams-message"></div>
         <div class="teams-area"></div>
         <div class="teams-pagination">
        <div class="paginate-sm-btn"></div>

    </div>
   </div>
    </div>
 
     </div>
     <div class="col-md-6 p-0 m-0 " >
                
     <div class="card border-0 rounded-0 shadow-sm mb-4">
         <div class="card-body">
         <h5 class="quicksand-font font-weight-bold mb-2 d-flex justify-content-between">
           Job roles 
           <span class="badge badge-info total-roles">Total : 0</span>
          </h5>
          <div class="jobrole-message"></div>
          <div class="job-role-loader d-none">
           <div class="loader"></div>
           </div>
         <div class="show-job-role"></div>
          <div class="show-job-role-paginate"></div>
              </div>
              </div>
            </div>
                  
                
                
   </div>

@endsection


@endif
