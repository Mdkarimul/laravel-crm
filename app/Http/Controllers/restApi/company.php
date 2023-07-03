<?php

namespace App\Http\Controllers\restApi;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Company_registration;
use App\Mail\emailVerification;
session_start();
class company extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $data;
    public $password;
    public $generate_password;
    public $query;
    public $mac_address;
    public $mac_address_obj;
    public $allData;
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $mac = new macAddress();
        $request["admin_mac_address"] = $mac->data[1];
        $this->data = $request->all();
      $this->generate_password =   md5($this->data['password']);
      $this->password =  array("password"=>$this->generate_password); //>md5($this->data['password']
      // pc mac address print_r($mac->data[1]);
      $this->data =  array_replace($this->data,$this->password);
        Company_registration::create($this->data);
     //sending erp url and passowrd
     Mail::to($this->data['company_email'])->send(new emailVerification(array(
         "erp_url"=>$this->data['erp_url'],
         "password"=>$this->generate_password
     )));

  //releasing memory
  unset($_POST);
  unset($request);
  unset($this->data);
  unset($this->generate_password);
  unset($this->password);
      return redirect("/congrats");
     return response()->view("congrats",array("notice"=>"Please check your email !"))->header("Content-Type","text/html")->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($query,Request $request)
    {
        //
        $this->mac_address_obj = new macAddress();
        $this->mac_address =   $this->mac_address_obj->__construct();
        //  echo $this->mac_address;
        //  return;
        $this->query = json_decode(base64_decode($query));
        if($this->query->query =="erp")
        {
            $this->data =   Company_registration::where("company_slug",$this->query->string)->get();
            if(count($this->data) != 0)
            {
                if($request->ajax())
                {
                    echo "karimul islam";
                    //releasing memory
                    unset($_GET);
                    unset($query);
                    unset($request);
                    unset($this->mac_address);
                    unset($this->data);
                    unset($this->query);
                    unset($this->mac_address_obj);
                 return response(array("notice"=>"Data found !"),200)->header("Content-Type","text/html");
                }
                else
                {    
                    session()->flash("authentication",$this->query->string);
                    //find not register admin
                    foreach($this->data as $this->allData)
                    {
                        
                       if(empty($this->allData->admin_mac_address))
                       {   
                        session()->flash("mac_authentication","notRegistered");
                       }
                       else
                       {
                           if($this->allData->admin_mac_address == $this->mac_address)
                           {  
                            session()->flash("mac_authentication","admin");
                           }
                           else 
                           {
                           session()->flash("mac_authentication","employee");
                           }
                       }
                    }
                    return response()->view("erp.authenticate")->header("Content-Type","text/html")->setStatusCode(200);
                     //releasing memory
                     unset($_GET);
                     unset($query);
                     unset($request);
                     unset($this->mac_address);
                     unset($this->data);
                     unset($this->query);
                     unset($this->allData);
                     unset($this->mac_address_obj);
                }
            }
            else
            {
            //return response(array("notice"=>"Data not found !"),404)->header("Content-Type","text/html");
              //releasing memory
              unset($_GET);
              unset($query);
              unset($request);
              unset($this->mac_address);
              unset($this->data);
              unset($this->query);
              unset($this->mac_address_obj);

            //   return redirect("/404");
            //   exit;
            return response(array("notice"=>"Data not found !"),404)->header("Content-Type","text/html");
        }
        }
        //next validation
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $query)
    {
        $this->mac_address = new macAddress();
      $this->mac_address =   $this->mac_address->__construct();
        $this->query =  json_decode(base64_decode($query));
       //register admin pc
   
       if($this->query->query=="adminRegister")
       {
  
        $this->data =   Company_registration::where([
            ["company_slug",$this->query->company_slug]
           ])->where([
            ["company_estd",$this->query->company_estd]
            ])->where([
            //   ["password","gmlvx4m@"]
                ])->update(array(
               "admin_mac_address"=>$this->mac_address,
           ));
           if($this->data)
           {
               $_SESSION = array(
                "adminauthentication"=> "true",
                "team-creator" => "7mdkarimul@gmail.com",
                 "team-creator-role"=>"admin"
               );
            return response(array("notice"=>"Admin authenticated !"),200)->header("Content-Type","application/json");
             //releasing memory
             unset($query);
             unset($request);
             unset($this->mac_address);
             unset($this->data);
             unset($this->query);
        }
           else
           {
               return response(array("notice"=>"Authentication failed !"),404)->header("Content-Type","application/json");
               //releasing memory
               unset($query);
               unset($request);
               unset($this->mac_address);
               unset($this->data);
               unset($this->query);
            }
       }
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    //list of custom classes

    //getting admin mac address
}


class macAddress {
    public $data;
    public $info;
      function  __construct(){
        exec("ipconfig/all",$this->info);
        foreach($this->info as $this->data)
        {
            if(preg_match("/Physical Address/i",$this->data))
            {
            $this->data =   preg_replace("/\s+\./","",$this->data);
            $this->data =  explode(":",$this->data);

            return  $this->data[1];

            break;
            }
        }
    }
}
