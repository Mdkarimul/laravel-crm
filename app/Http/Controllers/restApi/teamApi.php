<?php

namespace App\Http\Controllers\restApi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Team;
use Illuminate\Support\Facades\DB;


class teamApi extends Controller
{
    public $response;
    public $data;
    public $all_data=[];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
    
        if($request['fetch_type'] =="job-role")
        {
           $this->response =  Team::get('team_name');
           if(count($this->response) != 0)
           {
               return response(array("data"=>$this->response),200)->header('Content-Type','application/json');
           }
           else 
           {
            return response(array("notice"=>"Data not found !"),404)->header('Content-Type','application/json');
           }
        }
        //pagination result
    //    $this->response =    DB::table('teams')->paginate(2);
    //       return view("test",['data'=>$this->response]);
     if($request['fetch_type'] =="pagination")
{
       $this->response =  Team::orderBy("created_at",$request['order_by'])->paginate(4);
      if(count($this->response) !=0)
      {
      
       return response(array("data"=>$this->response),200)->header('Content-Type','application/json');
      }
      else
      {
          return response(array("notice"=>"Data not found !"),404)->header("Content-Type","application/json");
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
       // print_r($request->all());
     $this->response = Team::create($request->all());
     if($this->response)
     {
   return response(array("notice"=>"Record inserted !","data"=>$this->response),200)->header("Content-Type","application/json");
     }
     else
     {
        return response(array("notice"=>"something is wrong !"),404)->header("Content-Type","application/json");
     }
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
        //
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
