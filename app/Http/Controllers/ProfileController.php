<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Designation;

use App\Profile;

use App\Shift;

use App\Employees;

use App\Payment;

use Session;

use Validator;

use DB;

use App\Custome\SimpleImage\SimpleImage;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        //$profiles = Profile::all();
        
        
 
            $profiles = DB::table('profile')
            ->join('designation', 'designation.id', '=', 'profile.designation_id')
            ->select('profile.*', 'designation.designation_name')
            ->orderBy('profile.employee_id', 'asc')
			->get();
         return view('pages-admin.profile.profiles')->with('profiles',$profiles);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {  
        $designation = Designation::all();
       $shift = Shift::all();
         return view('pages-admin.profile.create')->with(compact('designation','shift'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { 
 // return $request->all(); 

        $ssc = $request->input('ssc').",".$request->input('ssc_group').",".$request->input('ssc_year') .",".$request->input('ssc_institute').",".$request->input('ssc_result');
                
        $hsc = $request->input('hsc').",".$request->input('hsc_group') . "," .$request->input('hsc_year') .",".$request->input('hsc_institute').",".$request->input('hsc_result');
                
        $hons = $request->input('hons').",".$request->input('hons_group')."," .$request->input('hons_year') .",".$request->input('hons_institute').",".$request->input('hons_result');
                

        $masters = $request->input('masters').",".$request->input('master_group') . "," .$request->input('master_year') .",".$request->input('master_institute').",".$request->input('master_result');
                
        $present_address = $request->input('flat_no').",".$request->input('house_no').",".$request->input('road_no') . "," .$request->input('po') .",".$request->input('ps').",".$request->input('dist');
                
        $permanent_address = $request->input('village'). "," .$request->input('per_po') .",".$request->input('per_ps').",".$request->input('per_dist');
               
        $emergency_address = $request->input('em_flat_no') . "," . $request->input('em_house_no').",".$request->input('em_road_no').",".$request->input('em_po') .",".$request->input('em_ps').",".$request->input('em_dist');


                
            //return $ssc . "<br>".$hsc."<br>".$hons."<br>".$masters;

        $validator = Validator::make($request->all(), [
                 //'employee_id'        => 'required|unique:profile,employee_id',
                // 'full_name'        => 'required|max:150|regex:/^[(a-zA-Z0-9\s)]+$/u',
                // 'father_name'      => 'required|max:150|regex:/^[\pL\s\-]+$/u',
                // 'mother_name'      => 'max:150',
                // 'present_address'  => 'required|max:350',
                // 'nid'              => 'required|numeric',
                // 'gender'           => 'required|max:2|numeric',
                // 'religion'         => 'required|max:10|numeric',
                // 'maritial_status'  => 'required|max:2|numeric',
                // 'date_of_birth'    => 'required',
                // 'phone'            => 'required|numeric',
                // 'email'            => 'email',
                // 'fb'               => '',
                // 'skype'            => '',
                // 'date_of_join'     => '',
                // 'shift'            => 'numeric',
                // 'marks'            => '',
                // 'reference'      => '',
                // 'permanent_address'      => 'required',
                // 'emergency_contact_number'      => 'required',
                // 'previous_record'      => '',
                // 'designation_id'      => 'required|numeric',
                // 'blood_group'      => 'numeric|max:10',
                // 'profile_pic'      => 'required|image|max:4000',
                // 'nid_upload'      => 'required|image|max:4000'

                'employee_id'      => 'required|unique:profile,employee_id',
                'salary'       => 'required',
                // 'first_name'       => 'required|max:150|regex:/^[(a-zA-Z0-9. \s)]+$/u',
                // 'middle_name'      => 'required|max:150|regex:/^[(a-zA-Z0-9. \s)]+$/u',
                // 'last_name'        => 'required|max:150|regex:/^[(a-zA-Z0-9. \s)]+$/u',
                // 'father_name'      => 'required|max:150|regex:/^[\pL\s\-]+$/u',
                // 'mother_name'      => 'required|max:150',
                // 'nid'              => 'required|numeric',
                // 'gender'           => 'required|max:2|numeric',
                // 'religion'         => 'required|max:10|numeric',
                // 'maritial_status'  => 'required|max:2|numeric',
                // 'date_of_birth'    => 'required',
                // 'phone'            => 'required',
                // 'email'            => 'email',
                // 'fb'               => '',
                // 'skype'            => '',
                // 'date_of_join'     => '',
                 'shift'            => 'required|numeric',
                // 'marks'            => '',
                // 'reference'      => '',
                // 'emergency_contact_number'      => 'required',
                // 'previous_record'      => '',
                'designation_id'      => 'required|numeric',
                // 'blood_group'      => 'numeric|max:10',
                // 'profile_pic'      => 'image|max:4000',
                // 'nid_upload'      => 'image|max:4000'
            ]);

        if ($validator->fails()) {
            return redirect('profile/create')
                        ->withErrors($validator)
                        ->withInput();
            } else {

              $profile_create = new Profile;
   
    
                if ($request->hasFile('profile_pic')){
                        $file = $request->file('profile_pic');
                        $filename = $file->getClientOriginalName();
                        $filename = date('Y-m-d-H:i:s')."-". pathinfo($filename, PATHINFO_FILENAME);
                        $fullname = str_slug($filename).'.'.$file->getClientOriginalExtension();
                        $upload=$file->move(config('images.upload_folder'),$fullname);
                        
                        $img = new SimpleImage(config('images.upload_folder').'/'.$fullname);
                        $img->resize(config('images.profile_pic_width'),config('images.profile_pic_height'));
                        $img->save(config('images.profile_pic').'/'.$fullname);
                        unlink(config('images.upload_folder').'/'.$fullname);
                       $profile_create['profile_pic']=$fullname;
                       
                    }
                if ($request->hasFile('nid_upload')){
                        $file = $request->file('nid_upload');
                        $filename = $file->getClientOriginalName();
                        $filename = date('Y-m-d-H:i:s')."-". pathinfo($filename, PATHINFO_FILENAME);
                        $fullname = str_slug($filename).'.'.$file->getClientOriginalExtension();
                        $upload=$file->move(config('images.upload_folder'),$fullname);
                        
                        $img = new SimpleImage(config('images.upload_folder').'/'.$fullname);
                        $img->save(config('images.nid_upload').'/'.$fullname);
                        unlink(config('images.upload_folder').'/'.$fullname);
                       $profile_create['nid_upload']=$fullname;
                       
                    }
        

                $ssc = $request->input('ssc').",".$request->input('ssc_group') . "," .$request->input('ssc_year') .",".$request->input('ssc_institute').",".$request->input('ssc_result');
                //return $ssc;



                //$join_date = date('Y-m-d', strtotime($request->input("date_of_join")));
               // $birth_date = date('Y-m-d', strtotime($request->input("date_of_birth")));
                //$phone = $request->input('ccode').$request->input('phone');
                

                //return $join_date .' / ' .$birth_date;

                $profile_create->employee_id                = $request->input('employee_id');
                $profile_create->salary                     = $request->input('salary');
                $profile_create->first_name                 = $request->input('first_name');
                $profile_create->middle_name                = $request->input('middle_name');
                $profile_create->last_name                  = $request->input('last_name');
                $profile_create->father_name                = $request->input('father_name');
                $profile_create->mother_name                = $request->input('mother_name');
                $profile_create->present_address            = $present_address;
                $profile_create->nid                        = $request->input('nid');
                $profile_create->gender                     = $request->input('gender');
                $profile_create->religion                   = $request->input('religion');
                $profile_create->maritial_status            = $request->input('maritial_status');
                $profile_create->date_of_birth              = $request->input("date_of_birth");
                $profile_create->phone                      = $request->input('ccode').' '.$request->input('phone');
                $profile_create->email                      = $request->input('email');
                $profile_create->fb                         = $request->input('fb');
                $profile_create->skype                      = $request->input('skype');
                $profile_create->date_of_join               = $request->input("date_of_join");
                $profile_create->shift                      = $request->input('shift');
                $profile_create->marks                      = $request->input('marks');
                $profile_create->reference                  = $request->input('reference');
                $profile_create->permanent_address          = $permanent_address;
                $profile_create->emergency_contact_number   = $request->input('emergency_contact_number');
                $profile_create->emergency_address          = $emergency_address;
                $profile_create->previous_record            = $request->input('previous_record');
                $profile_create->designation_id             = $request->input('designation_id');
                $profile_create->blood_group                = $request->input('blood_group');
                $profile_create->employee_type              = $request->input('employee_type');
                $profile_create->ssc                = $ssc;
                $profile_create->hsc                = $hsc;
                $profile_create->hons               = $hons;
                $profile_create->masters            = $masters;
                
               // return $profile_create;

                $profile_create->save();

                Session::flash('message', 'Successfully created Profile!');
                
                return redirect('profile');
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
      
        //$profile_view =Profile::find($id);

        $profile_view = DB::table('profile')
            ->join('designation', 'designation.id', '=', 'profile.designation_id')
            ->join('shift', 'shift.id', '=', 'profile.shift')
            ->select('profile.*', 'designation.designation_name', 'shift.*')
            ->where('profile.employee_id', '=',$id )
            //->get()
            ->first();

        //return $profile_view;

        // $profile_view = DB::table('profile')
        //     ->join('designation', 'designation.id', '=', 'profile.designation_id')
        //     ->select('profile.*', 'designation.designation_name')
        //     ->where('profile','=', $pid )
        //     ->get();
         return view('pages-admin.profile.show')->with('profile_view',$profile_view);
         
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        $designation = Designation::all();
        $shift = Shift::all();
        $profile_edit = Profile::where('employee_id', $id)->first();
        return view('pages-admin.profile.edit')->withDesignation($designation)->withProfile_edit($profile_edit)->withShift($shift);
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
        
        //$profile_updates = DB::table('profile')->select('id')->where('employee_id', $id)->get();
//         $p_id = null;
//         foreach ($profile_updates $value) {
//             # code...
//         }
// return $profile_update;
        //return $request->all();
        $profile_update = Profile::where('employee_id', $id)->first();

    //dd($request);
        $ssc = $request->input('ssc').",".$request->input('ssc_group').",".$request->input('ssc_year').",".$request->input('ssc_institute').",".$request->input('ssc_result');
                
                $hsc = $request->input('hsc').",".$request->input('hsc_group') .",".$request->input('hsc_year').",".$request->input('hsc_institute').",".$request->input('hsc_result');
                
                $hons = $request->input('hons').",".$request->input('hons_group').",".$request->input('hons_year').",".$request->input('hons_institute').",".$request->input('hons_result');
                

                $masters = $request->input('masters').",".$request->input('master_group') .",".$request->input('master_year').",".$request->input('master_institute').",".$request->input('master_result');
                
                $present_address = $request->input('house_no').",".$request->input('road_no') . "," .$request->input('po') .",".$request->input('ps').",".$request->input('dist');
                
                $permanent_address = $request->input('village').",".$request->input('per_po').",".$request->input('per_ps').",".$request->input('per_dist');
                
                $emergency_address = $request->input('em_flat_no').",".$request->input('em_house_no').",".$request->input('em_road_no').",".$request->input('em_po') .",".$request->input('em_ps').",".$request->input('em_dist');


                
            //return $ssc . "<br>".$hsc."<br>".$hons."<br>".$masters;

        $validator = Validator::make($request->all(), [
                //'email' => 'unique:users,email_address,'.$id.',employee_id'

                //'employee_id'      => 'required|unique:profile,employee_id,'.$id.',employee_id',
                'first_name'       => 'required|max:150|regex:/^[(a-zA-Z0-9\s)]+$/u',
				'salary'       => 'required',
                // 'middle_name'      => 'required|max:150|regex:/^[(a-zA-Z0-9\s)]+$/u',
                // 'last_name'        => 'required|max:150|regex:/^[(a-zA-Z0-9\s)]+$/u',
                // 'father_name'      => 'required|max:150|regex:/^[\pL\s\-]+$/u',
                // 'mother_name'      => 'max:150',
                //'present_address'  => 'required|max:350',
                // 'nid'              => 'required|numeric',
                // 'gender'           => 'required|max:2|numeric',
                // 'religion'         => 'required|max:10|numeric',
                // 'maritial_status'  => 'required|max:2|numeric',
                // 'date_of_birth'    => 'required',
                // 'phone'            => 'required',
                
                
                // 'po'   => 'required',
                // 'ps'        => 'required',
                // 'dist'        => 'required',
                // 'em_house_no'=> 'required',
                // 'em_road_no'=> 'required',
                // 'em_po'=> 'required',
                // 'em_ps'=> 'required',
                // 'em_dist'=> 'required',
                // 'email'            => 'email',
                // 'fb'               => '',
                // 'skype'            => '',
                // 'date_of_join'     => '',
                'shift'            => 'required|numeric',
                'marks'            => '',
                'reference'      => '',
                //'permanent_address'      => '',
                //'emergency_contact_number'      => 'required',
                //'previous_record'      => '',
                'designation_id'      => 'required|numeric',
                'blood_group'      => 'numeric|max:10',
                'profile_pic'      => 'image|max:4000',
                'nid_upload'      => 'image|max:4000'
            ]);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
            } else {

                if ($request->hasFile('profile_pic')){
                        $file = $request->file('profile_pic');
                        $filename = $file->getClientOriginalName();
                        $filename = date('Y-m-d-H:i:s')."-". pathinfo($filename, PATHINFO_FILENAME);
                        $fullname = str_slug($filename).'.'.$file->getClientOriginalExtension();
                        $upload=$file->move(config('images.upload_folder'),$fullname);
                        
                        $img = new SimpleImage(config('images.upload_folder').'/'.$fullname);
                        $img->resize(config('images.profile_pic_width'),config('images.profile_pic_height'));
                        $img->save(config('images.profile_pic').'/'.$fullname);
                        unlink(config('images.upload_folder').'/'.$fullname);
						
						if ( !empty($profile_update->profile_pic)) {
						   unlink(config('images.profile_pic').'/'.$profile_update->profile_pic );
						}
                        //unlink(config('images.profile_pic').'/'.$profile_update->profile_pic );
						
						$profile_update['profile_pic']=$fullname;
                       
                       
                    }
                if ($request->hasFile('nid_upload')){
                        $file = $request->file('nid_upload');
                        $filename = $file->getClientOriginalName();
                        $filename = date('Y-m-d-H:i:s')."-". pathinfo($filename, PATHINFO_FILENAME);
                        $fullname = str_slug($filename).'.'.$file->getClientOriginalExtension();
                        $upload=$file->move(config('images.upload_folder'),$fullname);
                        
                        $img = new SimpleImage(config('images.upload_folder').'/'.$fullname);
                        $img->save(config('images.nid_upload').'/'.$fullname);
                        unlink(config('images.upload_folder').'/'.$fullname);
						
						if ( !empty($profile_update->nid_upload)) {
						   unlink(config('images.nid_upload').'/'.$profile_update->nid_upload );
						}
                       $profile_update['nid_upload']=$fullname;
                       
                       
                    }
        
                

                $ssc = $request->input('ssc').",".$request->input('ssc_group') . "," .$request->input('ssc_year') .",".$request->input('ssc_institute').",".$request->input('ssc_result');
                //return $ssc;



                $join_date = date('Y-m-d', strtotime($request->input("date_of_join")));
                $birth_date = date('Y-m-d', strtotime($request->input("date_of_birth")));

                $profile_update->salary                     = $request->input('salary');
                $profile_update->first_name                 = $request->input('first_name');
                $profile_update->middle_name                = $request->input('middle_name');
                $profile_update->last_name                  = $request->input('last_name');
                $profile_update->father_name                = $request->input('father_name');
                $profile_update->mother_name                = $request->input('mother_name');
                $profile_update->present_address            = $present_address;
                $profile_update->nid                        = $request->input('nid');
                $profile_update->gender                     = $request->input('gender');
                $profile_update->religion                   = $request->input('religion');
                $profile_update->maritial_status            = $request->input('maritial_status');
                $profile_update->date_of_birth              = $birth_date ;
                $profile_update->phone                      = $request->input('phone');
                $profile_update->email                      = $request->input('email');
                $profile_update->fb                         = $request->input('fb');
                $profile_update->skype                      = $request->input('skype');
                $profile_update->date_of_join               = $join_date ;
                $profile_update->shift                      = $request->input('shift');
                $profile_update->marks                      = $request->input('marks');
                $profile_update->reference                  = $request->input('reference');
                $profile_update->permanent_address          = $permanent_address;
                $profile_update->emergency_contact_number   = $request->input('emergency_contact_number');
                $profile_update->emergency_address          = $emergency_address;
                $profile_update->previous_record            = $request->input('previous_record');
                $profile_update->designation_id             = $request->input('designation_id');
                $profile_update->blood_group                = $request->input('blood_group');
                $profile_update->employee_type              = $request->input('employee_type');




                $profile_update->ssc                = $ssc;
                $profile_update->hsc                = $hsc;
                $profile_update->hons               = $hons;
                $profile_update->masters            = $masters;
                
               // return $profile_create;

                $profile_update->save();

                Session::flash('message', 'Successfully Updated Profile!');
                
                return redirect('profile');
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
        $profile = Profile::where('employee_id', $id)->first();
        //dd($profile);
        //return $profile->employee_id;
        //return $profile->all();
        //
        //

        $result = Employees::where('profile_id', '=', $profile->employee_id )
                            ->exists();

        $result2 = Payment::where('employee_id', '=', $profile->employee_id )
                            ->exists();
        if ( $result ) {

            Session::flash('error-message', 'Please User Account Delete first !');    
            return redirect('user');
            
        }
        
        if ( $result2 ) {

            Session::flash('error-message', 'Please Payment Delete first !');    
            return redirect('user');
            
        } else {

            if ( !empty($profile->profile_pic)) {
               unlink(config('images.profile_pic').'/'.$profile->profile_pic );
            }

            if ( !empty($profile->nid_upload)) {

               unlink(config('images.nid_upload').'/'.$profile->nid_upload );

            }


            $profile->delete();

            return redirect()->back()->with('message','Delete Succesfully');
        }
    }
}

