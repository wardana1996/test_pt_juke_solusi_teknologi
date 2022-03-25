<?php

namespace App\Http\Controllers;
use App\Models\employee;
use App\Models\Province;
use App\Models\City;
use Carbon\Carbon;
use DataTables;
use File;
use Image;
use Illuminate\Http\Request;

class employeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $provinces = Province::get();
        $names = employee::get();
        if ($request->ajax()) {
            $data = employee::orderBy('first_name','asc')->latest();
            return Datatables::of($data)
              ->addIndexColumn()
              ->editColumn('date_of_birth', function ($request) {
                return Carbon::parse($request->date_of_birth)->translatedFormat('d/m/Y'); 
              })
              ->addColumn('name', function($row) {
                return $row->first_name. ' ' .$row->last_name;
              })
              ->addColumn('action', function($row) {
                $btn = '<a href="#" class="editEmployee" data-id='.$row->id.'><i class="fa fa-edit fa-fw text-warning"></i></a> &nbsp;
                      <a href="#" data-id='.$row->id.' class="delete"><i class="fa fa-trash fa-fw text-danger"></i></a> &nbsp;';
                      return $btn;
              })
              ->addColumn('view', function($row) {
                $view = '<a href="#" class="btn btn-info ktpView" data-toggle="modal" data-target="#emodalView" data-id='.$row->id.' data-ktp='.$row->ktp_file.'>view</a>';
                        return $view;
                })
                ->filter(function ($instance) use ($request) {
                    if ($request->get('current_position_bank_account')) {
                        $instance->where('current_position_bank_account', $request->get('current_position_bank_account'));
                    }
                    if ($request->get('first_name')) {
                        $instance->where('first_name', $request->get('first_name'));
                    }
                    if (!empty($request->get('search'))) {
                         $instance->where(function($w) use($request){
                            $search = $request->get('search');
                            $w->orWhere('first_name', 'LIKE', "%$search%")
                            ->orWhere('email', 'LIKE', "%$search%");
                        });
                    }
                })
              ->rawColumns(['current_position_bank_account','view','action'])
              ->make(true);
            }
            return view('employees',compact('provinces','names'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function indexCity($id)
    {
        $cities = City::where("province_id",$id)->get('name_city');
        return json_encode($cities);
    }

    public function create(Request $request)
    {
        $ktpPath = 'ktp_directory/';

        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email_address' => 'required|email',
            'phone_number' => 'required|numeric',
            'date_of_birth' => 'required',
            'province_id' => 'required',
            'province_address' => 'required',
            'city_address' => 'required',
            'street_address' => 'required',
            'zip_code' => 'required|numeric',
            'current_position_bank_account' => 'required',
            'bank_account' => 'required',
            'bank_account_number' => 'required|numeric',
            'ktp_number' => 'required|numeric',
            'ktp_file' => 'required|image',
        ]);
  

        $employee = new employee();
        $employee->first_name =  $request->first_name;
        $employee->last_name =  $request->last_name;
        $employee->email_address =  $request->email_address;
        $employee->phone_number =  $request->phone_number;
        $employee->date_of_birth = Carbon::createFromFormat('d/m/Y', $request->date_of_birth)->format('Y-m-d');
        $employee->province_id =  $request->province_id;
        $employee->province_address =  $request->province_address;
        $employee->city_address =  $request->city_address;
        $employee->street_address =  $request->street_address;
        $employee->zip_code =  $request->zip_code;
        $employee->current_position_bank_account =  $request->current_position_bank_account;
        $employee->bank_account =  $request->bank_account;
        $employee->bank_account_number =  $request->bank_account_number;
        $employee->ktp_number =  $request->ktp_number;
        if(File::isDirectory($ktpPath)){
            $file = $request->file('ktp_file');
            $fileNameDirectory = $file->getClientOriginalExtension();
            $fileName = $file->getClientOriginalName();
            $file->move($ktpPath, $fileName);
            $employee->ktp_file = $fileName;   
        } else {
            File::makeDirectory($ktpPath, 0777, true, true);
            $file = $request->file('ktp_file');
            $fileNameDirectory = $file->getClientOriginalExtension();
            $fileName = $file->getClientOriginalName();
            $file->move($ktpPath, $fileName);
            $employee->ktp_file = $fileName;   
        }
        $employee->save();

        return response()->json(['message'=>'success !']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function edit(Request $request, $id)
    {
        $where = array('id' => $request->id);
        $employee  = employee::where($where)->first();
     
        return Response()->json($employee);
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
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email_address' => 'required|email',
            'phone_number' => 'required|numeric',
            'date_of_birth' => 'required',
            'province_id' => 'required',
            'province_address' => 'required',
            'city_address' => 'required',
            'street_address' => 'required',
            'zip_code' => 'required|numeric',
            'current_position_bank_account' => 'required',
            'bank_account' => 'required',
            'bank_account_number' => 'required|numeric',
            'ktp_number' => 'required|numeric',
            'ktp_file' => 'image',
        ]);
        
        $employee = employee::find($id);
        $ktpPath = 'ktp_directory/';
        $employee->first_name =  $request->first_name;
        $employee->last_name =  $request->last_name;
        $employee->email_address =  $request->email_address;
        $employee->phone_number =  $request->phone_number;
        $employee->date_of_birth =  date('Y-m-d',strtotime($request->date_of_birth));
        $employee->province_id =  $request->province_id;
        $employee->province_address =  $request->province_address;
        $employee->city_address =  $request->city_address;
        $employee->street_address =  $request->street_address;
        $employee->zip_code =  $request->zip_code;
        $employee->current_position_bank_account =  $request->current_position_bank_account;
        $employee->bank_account =  $request->bank_account;
        $employee->bank_account_number =  $request->bank_account_number;
        $employee->ktp_number =  $request->ktp_number;
        if(File::isDirectory($ktpPath)){
            if ($request->hasFile('ktp_file_edit') != null) {
                $file = $request->file('ktp_file_edit');
                if ($employee->ktp_file != null){
                    unlink(public_path('ktp_directory/') . $employee->ktp_file);
                }
                $fileNameDirectory = $file->getClientOriginalExtension();
                $fileName = $file->getClientOriginalName();
                $file->move($ktpPath, $fileName);
                $employee->ktp_file = $fileName;     
            } 
        }
        $employee->save();

        return response()->json(['message'=>'success !']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $employee = employee::find($id);
        $path = 'ktp_directory/'.$employee->ktp_file;
        if (File::exists($path)) {
            File::delete($path);
        }
        $employee->delete();
        return response()->json(['message'=>'success !']);
    }
}
