@extends("template.default")

@section("title")
Wap erp solutions
@endsection

@section("custom-css")
<link rel="stylesheet" href="lang/css/welcome.css?cache=<?php echo time(); ?>">
@endsection

@section("custom-js")
<script src="lang/js/welcome.js?cache=<?php echo time(); ?>"></script>
@endsection

@section("content")
<div class="container bg-white shadow-lg my-4">
    <div class="row">
        <div class="col-md-6 p-0 welcome-image"></div>
        <div class="col-md-6 py-5">
            <!--start branding coding-->
            <div class="branding">
                <h1>Wes</h1>
                <p>WAP ERP SOLUTIONS</p>
            </div>

            <!--start form coding-->
            <div class="welcome-form p-4 overflow-hidden">
            <form class="signup-form" autocomplete="off" action="/api/company" method="post">
                @csrf
                
                <!--first step-->
                <div class="step-1 ">
                    <div class="form-group mb-3 overflow-hidden">
                        <label class="d-none">Company name</label>
                        <input type='text'  name="company_name" maxlength="80" class="company-name form-control welcome-form-input rounded-0 required" placeholder="COMPANY NAME">
                    </div>

                    <div class="form-group mb-3 overflow-hidden d-none">
                        <label class="d-none">Company slug</label>
                        <input type='text'  name="company_slug" maxlength="80" class="company-slug form-control welcome-form-input rounded-0" placeholder="COMPANY SLUG">
                    </div>

                    <div class="d-none form-group mb-3 overflow-hidden">
                        <label class="d-none">Erp url</label>
                        <input type='url'  name="erp_url" maxlength="80" class=" form-control welcome-form-input rounded-0  erp-url" placeholder="ERP URL">
                    </div>

                    <div class="form-group mb-3 overflow-hidden d-none">
                        <label class="d-none">Password</label>
                        <input type='password'  name="password" maxlength="9" class="password form-control welcome-form-input rounded-0" placeholder="PASSWORD">
                    </div>

                    <div class="form-group mb-3 overflow-hidden">
                        <label class="d-none">Tagline</label>
                        <input type='text' name="tagline" maxlength="95" class="form-control welcome-form-input rounded-0" placeholder="TAGLINE">
                    </div>

                    <div class="form-group mb-3 overflow-hidden">
                        <label class="d-none">Web site</label>
                        <input type='url' name="website" maxlength="95" class="form-control welcome-form-input rounded-0 url" placeholder="WEBSITE">
                    </div>

                    <div class="form-group mb-3 overflow-hidden">
                        <label class="d-none">Email</label>
                        <input type='email'  name="company_email" maxlength="95" class="form-control welcome-form-input rounded-0 required" placeholder="EMAIL">
                    </div>

                    <div class="form-group mb-3 overflow-hidden">
                        <label class="d-none">Founder</label>
                        <input type='text'  name="founder" maxlength="80" class="form-control welcome-form-input rounded-0 required" placeholder="FOUNDER">
                    </div>

                    <div class="form-group mb-4 overflow-hidden">
                        <label class="d-none">Founder email</label>
                        <input type='email' name="founder_email" maxlength="95"  class="form-control welcome-form-input rounded-0 required" placeholder="FOUNDER EMAIL">
                    </div>


                    <div class="form-group ">
                       <button type="submit" class="btn float-right next-btn step-1-next-btn"><i class="fa fa-angle-double-right mr-2"></i>NEXT</button>
                    </div>

                </div>

                <!--second step 2 -->
                <div class="step-2 d-none">
                <div class="form-group mb-4 overflow-hidden">
                        <label class="d-none">Contact number</label>
                        <input type='number'  name="contact_number" maxlength="15" class="form-control welcome-form-input rounded-0 required" placeholder="CONTACT NUMBER">
                    </div>

                    <div class="form-group mb-4 overflow-hidden">
                        <label class="d-none">Street address</label>
                        <input type='text' name="street_address"  class="form-control welcome-form-input rounded-0 required" placeholder="STREES ADDRESS">
                    </div>

                    <div class="form-group mb-4 overflow-hidden">
                        <label class="d-none">City</label>
                        <input type='text' name="city" maxlength="80"  class="form-control welcome-form-input rounded-0 required" placeholder="CITY">
                    </div>

                    <div class="form-group mb-4 overflow-hidden">
                        <label class="d-none">State</label>
                        <input type='text' name="state"  maxlength="80" class="form-control welcome-form-input rounded-0 required" placeholder="STATE">
                    </div>

                    <div class="form-group mb-4 overflow-hidden">
                        <label class="d-none">Country</label>
                        <input type='text' name="country" maxlength="80"  class="form-control welcome-form-input rounded-0 required" placeholder="COUNTRY">
                    </div>

                    <div class="form-group mb-4 overflow-hidden">
                        <label class="d-none">Pin code</label>
                        <input type='text'  name="pin_code" maxlength="15" class="form-control welcome-form-input rounded-0 required" placeholder="PIN CODE">
                    </div>

                    <div class="form-group  overflow-hidden">
                    <button type="submit" class="btn float-left back-btn step-2-back-btn">BACK<i class="fa fa-angle-double-left ml-2"></i></button>
                    <button type="submit" class="btn float-right next-btn step-2-next-btn"><i class="fa fa-angle-double-right mr-2"></i>NEXT</button>
                    </div>

                </div>


  <!-- start step 3-->
                <div class="step-3 d-none">
                <div class="form-group mb-4 overflow-hidden">
                        <label class="d-none">GSTIN</label>
                        <input type='text' name="gstin" maxlength="20" class="form-control welcome-form-input rounded-0" placeholder="GSTIN">
                    </div>

                    <div class="form-group mb-4 overflow-hidden">
                        <label class="d-none">Office start at</label>
                        <input type='time' name="office_start_at" class="form-control welcome-form-input rounded-0 required" >
                    </div>

                    <div class="form-group mb-4 overflow-hidden">
                        <label class="d-none">Office end at</label>
                        <input type='time'  name="office_end_at" class="form-control welcome-form-input rounded-0 required" >
                    </div>

                    <div class="form-group mb-4 overflow-hidden">
                        <label class="d-none">Established in</label>
                        <input type='date'  name="company_estd" class="form-control welcome-form-input rounded-0 required " >
                    </div>

                    <div class="form-group mb-4 overflow-hidden">
                        <label class="d-none">Facebook page url</label>
                        <input type='url' name="facebook_url" class="form-control welcome-form-input rounded-0 url" placeholder='FACEBOOK URL' >
                    </div>

                    <div class="form-group mb-4 overflow-hidden">
                        <label class="d-none">Twitter page url</label>
                        <input type='url' name="twitter_url" class="form-control welcome-form-input rounded-0 url" placeholder="TWITTER URL" >
                    </div>

                    <div class="form-group  overflow-hidden">
                    <button type="submit" class="btn float-left back-btn step-3-back-btn">BACK<i class="fa fa-angle-double-left ml-2"></i></button>
                    <button type="submit" class="btn float-right next-btn step-3-next-btn"><i class="fa fa-angle-double-right mr-2"></i>NEXT</button>
                    </div>

                </div>

                <!--step four -->
                <div class="step-4 d-none">
                <div class="form-group mb-4 overflow-hidden">
                        <label class="d-none">What's app number</label>
                        <input type='number' maxlength="18" name="whats_app" class="form-control welcome-form-input rounded-0" placeholder="WHAT'S APP NUMBER" >
                    </div>

                    <div class="form-group mb-5 overflow-hidden">
                        <label class="">Category</label>
                       <select name="category" class="form-control welcome-form-input rounded-0 required" >
                           <option>Education</option>
                           <option>Company</option>
                           <option>Organization</option>
                       </select>
                    </div>


                    <div class="form-group  overflow-hidden">
                    <button type="submit" class="btn float-left back-btn step-4-back-btn">BACK<i class="fa fa-angle-double-left ml-2"></i></button>
                    <button type="submit" class="btn float-right submit-btn rounded-0">SUBMIT</button>
                    </div>

                </div>




            </form>
            </div>
        </div>
    </div>
</div>
@endsection