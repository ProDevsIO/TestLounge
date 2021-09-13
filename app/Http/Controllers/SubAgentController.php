<?php

namespace App\Http\Controllers;

use App\Helpers\UserShare;
use App\Mail\NewSubAgent;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SubAgentController extends Controller
{

    public $userShareHelper;
    public function __construct()
    {
        $this->userShareHelper = new UserShare();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $builder = User::whereNotNull("main_agent_id")->whereHas("superAgent")->orderby("created_at" , "desc");

        if(!auth()->user()->isAdmin()){
            $builder = $builder->where("main_agent_id", auth()->id());
        }
        $agents = $builder->paginate(20);
        $setting = Setting::where('id', 2)->first();

        return view("users.sub_agents.index", ["users" => $agents, "setting" => $setting]);
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
            'my_share' => 'required|gt:0',
        ]);

        $main_agent = auth()->user();

        if ($request->file) {
            $certificate =  time() . '.' . $request->file->extension();
            $request->file->move(public_path('img/certificate'), $certificate);
            $data['c_o_i'] = "/img/certificate/" . $certificate;
        }


        $referral = generateReferralCode(6);
        $password = time();
        $data["password"] = bcrypt($password);
        $data["main_agent_id"] = $main_agent->id;

        $data["main_agent_share_raw"] = $data["my_share"];
        $data['referal_code'] = $referral;
        $data['type'] = 2;
        $data['status'] = 0;

        unset($data["my_share"]);
        unset($data["file"]);
        $user = User::create($data);

        // Mail::to($user->email)->send(new NewSubAgent([
        //     "email" => $user->email,
        //     "password" => $password,
        //     "main_agent_name" => $main_agent->first_name . " " . $main_agent->last_name,
        //     "complete_link" => env('APP_URL', "https://uktraveltest.prodevs.io") . "/sub/continue/registration/" . $referral . "/" . $user->id
        // ]));

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
        $user = User::findorfail($id);
        $data = $request->validate([
            'my_share' => 'required|gt:0',
        ]);
        $user->update([
            "main_agent_share_raw" => $data["my_share"]
        ]);
        return back()->with('alert-success', "Successfully updated sub-agent share");
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
