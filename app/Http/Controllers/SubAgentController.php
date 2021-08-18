<?php

namespace App\Http\Controllers;

use App\Mail\NewSubAgent;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SubAgentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $agents = User::where("main_agent_id" , auth()->id())->paginate(20);
        $setting = Setting::where('id', 2)->first();

        return view("users.sub_agents.index" , ["users" => $agents , "setting" => $setting]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("users.sub_agents.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|string|unique:users,email',
            'phone_no' => 'required|string',
            'company' => 'required|string',
            'platform_name' => 'required|string',
            'director' => 'required|string',
            'file' => 'file|mimes:csv,txt,xlx,xls,pdf,docx|max:2048',
            'certified' => 'required|string',
            'my_share' => 'required|gt:0',
        ]);

        $main_agent = auth()->user();
        $setting = Setting::where('id', 2)->first();

        if($request->file)
        {
            $certificate =  time().'.'.$request->file->extension();
            $request->file->move(public_path('img/certificate'), $certificate);
            $data['c_o_i'] = "/img/certificate/". $certificate;
        }


        $main_agent_share_raw = $data["my_share"];
        $base_agent_share = $setting->value;
        $main_agent_share = $main_agent_share_raw * $base_agent_share / 100;
        $sub_agent_share = $base_agent_share - $main_agent_share;

        $password = time();
        $data["main_agent_id"] = $main_agent->id;
        $data["main_agent_share_percent"] = $main_agent_share;
        $data["main_agent_share_raw"] = $main_agent_share_raw;
        $data["percentage_split"] = $sub_agent_share;
        $data["password"] = bcrypt($password);

        unset($data["my_share"]);
        unset($data["file"]);
        $user = User::create($data);

        Mail::to($user->email)->send(new NewSubAgent([
            "email" => $user->email,
            "password" => $password,
            "main_agent_name" => $main_agent->first_name." ".$main_agent->last_name
        ]));

        return redirect()->route("sub-agents.index")->with('alert-success', "Successfully created sub-agent");
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
