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
        $setting = Setting::where('id', 2)->first();
        return view("users.sub_agents.create")->with(compact('setting'));
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
        if ($request->my_share > 99 || $request->my_share < 0) {
            session()->flash('alert-danger', "Super agent share cannot be greater than 99 % or less than 1%");
            return back()->withInput();
        }

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
        try {

            $message2 = "
            Hi Admin,<br/>

            We would like to inform you that a new sub Agent has been created on Traveltestsltd.<br/><br/>
            Name: " . $requet->first_name . " " . $request->last_name . " <br/>
            Email: " . $request->email . "<br/>
            Main agent name:". $main_agent->first_name . " " . $main_agent->last_name."<br/>
            <br/>Kindly click the button below to login and review/activate<br/><br/>
            <a href='" . env('APP_URL', "https://uktraveltest.prodevs.io/login") . "'  style='background: #0c99d5; color: #fff; text-decoration: none; border: 14px solid #0c99d5; border-left-width: 50px; border-right-width: 50px; text-transform: uppercase; display: inline-block;'>
                   Go to Login
                  </a>

                  <br/><br/>
                  Thank you.
                  <br/><br/>
                Traveltestsltd Team
            ";
            Mail::to(['itunu.akinware@medburymedicals.com', 'ola.2@hotmail.com'])->send(new BookingCreation($message2, "New Agent Registration"));
        } catch (\Exception $e) {
        }

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
        if ($data["my_share"] > 99 || $data["my_share"] < 0) {
            session()->flash('alert-danger', "Super agent share cannot be greater than 99 % or less than 1%");
            return back()->withInput();
        }
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
