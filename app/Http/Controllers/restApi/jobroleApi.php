<?php

namespace App\Http\Controllers\restApi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
 use App\Models\Jobrole;

class jobroleApi extends Controller
{
    public $response;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        //get data with pagination
          if($request['fetch_type'] =="pagination")
          {
             $this->response =  Jobrole::orderBy("created_at",$request['arrange_by'])->paginate(4);
          
                if(count($this->response) != 0)
                {
                    return response(array("data"=>$this->response),200)->header('Content-Type','application/json');
                }
                else
                {
                    return response(array("data"=>"Data not found !"),404)->header('Content-Type','application/json');
                }
          }


           //get data with jobrole and salary
           if($request['fetch_type'] =="get-jobrole-with-salary")
           {
              $this->response =  Jobrole::get(['job_role','salary']);
           
                 if(count($this->response) != 0)
                 {
                     return response(array("data"=>$this->response),200)->header('Content-Type','application/json');
                 }
                 else
                 {
                     return response(array("data"=>"Data not found !"),404)->header('Content-Type','application/json');
                 }
           }

         

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       return  Jobrole::create($request->all());
       

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    public function update(Request $request, $id)
    {
   $this->response =  Jobrole::where("id",$id)->update(array(
        "job_role"=> $request['job_role'],
        "qualification"=> $request['qualification'],
        "certification"=> $request['certification'],
        "experience"=> $request['experience'],
        "team_name"=>$request['team_name'],
        "salary"=>$request['salary']
    ));
    if($this->response)
    {
     return response(array("notice"=>"Update success !"),200)->header("Content-Type","application/json");
    }
    else 
    {
        return response(array("notice"=>"Update failed !"),404)->header("Content-Type","application/json");
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
}
