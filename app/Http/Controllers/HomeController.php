<?php

namespace App\Http\Controllers;

use App\Branch;
use App\Company;
use App\Designation;
use App\Imports\UsersImport;
use App\UserManagement;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
//    public function __construct()
//    {
//        $this->middleware('auth');
//    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $companies = Company::paginate(1);

        return view('index',[
            "companies" => $companies
        ]);
    }
    public function users()
    {
        $users = UserManagement::paginate(1);
        $branches=Branch::get();
        $designations=Designation::get();
        return view('users',[
            "users" => $users,
            "branches" => $branches,
            "designations" => $designations,
        ]);
    }
    public function usersImport(Request $request)
    {
       Excel::import(new UsersImport(),request()->file('importfile'));
        $users = UserManagement::paginate(1);
        return view('users',[
            "users" => $users
        ]);
    }
    public function addUser(Request $request)
    {
        return view('addusers',[
        ]);
    }
    public function viewDetails($id)
    {
        $userdetails=UserManagement::find($id);
        return view('viewdetails',[
            'userdetails' => $userdetails
        ]);
    }
    public function searchUserByIdandName(Request $request){
if ($request->name or $request->user_id){
    $users = UserManagement::where('name','LIKE','%'.$request->name.'%')->orWhere('user_id','LIKE','%'.$request->user_id.'%')->get();
}else{
    $users=[];
}
        return view('search',[
            'users' => $users
        ]);
    }
    public function sortByBranchDesignation(Request $request)
    {
        if ($request->branch){
            $users=UserManagement::where('branch_id',$request->branch)->get();
        }else{
            $users=UserManagement::where('designation_id',$request->designation)->get();
        }
        return view('search',[
            'users' => $users
        ]);
    }
    public function filterGenderandBranch(Request $request)
    {
        // instead od city here used Gender
        if ($request->gender or $request->branch)
        $query_user = UserManagement::where('id', '!=', '0');

        if ($request->gender and $request->gender != 'all') {
            $query_user->where('gender', $request->gender);
        }

        if ($request->branch and $request->branch) {
            $query_user->where('branch_id', $request->branch);
        }

        $users = $query_user->get();


        return view('search',[
            'users' => $users
        ]);
    }
}
