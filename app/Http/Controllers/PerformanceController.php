<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Performance;
use Validator;
use Session;

class PerformanceController extends Controller
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
        $performances = Performance::paginate(10);
        return view('pages-admin.performance.index')->withPerformances($performances);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages-admin.performance.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
                'name'          => 'required|max:150|regex:/^[(a-zA-Z\s)]+$/u',
                'month'         => 'required',
                'start_date'    => 'required',
                'end_date'      => 'required',
                'working_report'=> 'required|max:350',
                'achivement'    => 'required|max:350',
                'goal'          => 'required|max:350',
                'goal_report'   => 'required|max:350',
                'target'        => 'required|max:350',
                'present'       => 'required|',
                'absent'        => '',
                'leave'         => '',
                'payment'       => '',
                'bonus'         => '',
                'overtime'      => '',
                'due_work_time' => '',
                'gap_time'      => '',
                'complain'      => '',
                'remark'        => 'required', 
        ]);
        if ($validator->fails()) {
            return redirect('performance/create')
                        ->withErrors($validator)
                        ->withInput();
        } else {

            $performances = new Performance;
            $start_date = $request->input('start_date');
            $end_date = $request->input('end_date');

            $start_date = date("Y-m-d");
            $end_date = date("Y-m-d");

            $performances->name             = $request->input('name');
            $performances->month            = $request->input('month');
            $performances->start_date       = $start_date;
            $performances->end_date         = $end_date;
            $performances->working_report   = $request->input('working_report');
            $performances->achivement       = $request->input('achivement');
            $performances->goal             = $request->input('goal');
            $performances->goal_report      = $request->input('goal_report');
            $performances->target           = $request->input('target');
            $performances->present          = $request->input('present');
            $performances->absent           = $request->input('absent');
            $performances->leave            = $request->input('leave');
            $performances->payment          = $request->input('payment');
            $performances->bonus            = $request->input('bonus');
            $performances->overtime         = $request->input('overtime');
            $performances->due_work_time    = $request->input('due_work_time');
            $performances->gap_time         = $request->input('gap_time');
            $performances->complain         = $request->input('complain');
            $performances->remark           = $request->input('remark');
            $performances->save();
            
            Session::flash('message', 'Successfully Added Performance!');
            return redirect('performance');
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
        $performance = Performance::find($id);
        return view('pages-admin.performance.show')->withPerformance($performance);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $performance = Performance::find($id);
        return view('pages-admin.performance.edit')->withPerformance($performance);
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
        $performances = Performance::find($id);
        $validator = Validator::make($request->all(), [
                'name'          => 'required|max:150|regex:/^[(a-zA-Z\s)]+$/u',
                'month'         => 'required',
                'start_date'    => 'required',
                'end_date'      => 'required',
                'working_report'=> 'required|max:350',
                'achivement'    => 'required|max:350',
                'goal'          => 'required|max:350',
                'goal_report'   => 'required|max:350',
                'target'        => 'required|max:350',
                'present'       => 'required|',
                'absent'        => '',
                'leave'         => '',
                'payment'       => '',
                'bonus'         => '',
                'overtime'      => '',
                'due_work_time' => '',
                'gap_time'      => '',
                'complain'      => '',
                'remark'        => 'required', 
        ]);
        if ($validator->fails()) {
            return redirect()
                        ->back()
                        ->withErrors($validator)
                        ->withInput();
        } else {

            
            $start_date = $request->input('start_date');
            $end_date = $request->input('end_date');

            $start_date = date("Y-m-d");
            $end_date = date("Y-m-d");

            $performances->name             = $request->input('name');
            $performances->month            = $request->input('month');
            $performances->start_date       = $start_date;
            $performances->end_date         = $end_date;
            $performances->working_report   = $request->input('working_report');
            $performances->achivement       = $request->input('achivement');
            $performances->goal             = $request->input('goal');
            $performances->goal_report      = $request->input('goal_report');
            $performances->target           = $request->input('target');
            $performances->present          = $request->input('present');
            $performances->absent           = $request->input('absent');
            $performances->leave            = $request->input('leave');
            $performances->payment          = $request->input('payment');
            $performances->bonus            = $request->input('bonus');
            $performances->overtime         = $request->input('overtime');
            $performances->due_work_time    = $request->input('due_work_time');
            $performances->gap_time         = $request->input('gap_time');
            $performances->complain         = $request->input('complain');
            $performances->remark           = $request->input('remark');
            $performances->save();
            
            Session::flash('message', 'Successfully Updated Performance!');
            return redirect('performance');
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
        Performance::find($id)->delete();
        Session::flash('message', 'Successfully Deleted Performance!');
        return redirect('performance');
    }
}
