<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Facade\FlareClient\Stacktrace\File;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admin_id = admin_id();
        $setting = Setting::where('admin_id',$admin_id)->first();
        return view('setting.index',compact('setting'));
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
        $this->validate($request, [
            'logo' => 'required|mimes:jpeg,jpg,png|max:2048',
        ]);

        $admin_id = admin_id();
        $input = $request->all();
        $input['admin_id'] = $admin_id;
        if(isset($input['logo']))
        {
            $fileName = time() . '.' . $request->logo->extension();
            $input['logo'] = $fileName;
            $destinationPath = str_replace('\\', '/', base_path('public\logo_img/'));
            $request->logo->move($destinationPath, $fileName);
        }

        $create = Setting::create($input);

        return redirect()->route('setting.index')->with('success','Setting updated successfully');

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
        if($request->logo){
            $this->validate($request, [
                'logo' => 'required|mimes:jpeg,jpg,png|max:2048',
            ]);
        }

        $setting = Setting::find($id);

        $admin_id = admin_id();
        $input = $request->all();
        $input['admin_id'] = $admin_id;
        if(isset($input['logo']) && $input['logo'])
        {
            $oldimagePath = base_path('public\logo_img/');
            $oldimagePath = str_replace('\\', '/', $oldimagePath);
            $oldimagePath = $oldimagePath . $setting->logo;

            if ($setting->logo && File::exists(str_replace('\\', '/', base_path('public\logo_img/' . $setting->logo)))) {
                unlink(str_replace('\\', '/', base_path('public\logo_img/' . $setting->logo)));
            }
            $fileName = time() . '.' . $request->logo->extension();
            $input['logo'] = $fileName;
            $destinationPath = str_replace('\\', '/', base_path('public\logo_img/'));
            $request->logo->move($destinationPath, $fileName);


            $setting->update($input);
        }


        return redirect()->route('setting.index')->with('success','Setting updated successfully');
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
