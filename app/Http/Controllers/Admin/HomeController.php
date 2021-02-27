<?php

namespace App\Http\Controllers\Admin;
use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
class HomeController extends Controller
{
    public function dashboard(){
        return view('admin.users');
    }   

    public function UseList(Request $request){

        $OrderByColumn="users.id";
        $SortBy="desc";
        $request_para=$request->all();
        $columns=array('users.name','users.email','utr.total_questions', 'utr.total_questions_attend','utr.total_questions_ans');

        // Start Sorting 
            if(!empty($request->order[0]) && !empty($request->order[0]))
            {
                $OrderByColumn=$columns[$request->order[0]['column']];
                $SortBy=$request->order[0]['dir'];
            }
        // End Sorting

        $users = User::leftJoin('user_test_results as utr', function($join)
        {
            // $join->on('utr.id','=',\DB::raw('(select max(id) from user_test_results where user_id=users.id group by user_id)'));   
            $join->on('utr.user_id','users.id');   
        });

        $total_count=$users->count();

        // Start Custom Search 
            // $users = User::select('*');
            if (!empty($request->search['value'])) {
                foreach($columns as $column)
                {
                    $users->orWhere($column, 'like' , '%'.$request->search['value'].'%');
                }
            }
        // End Custom Search

        
        $users=$users->OrderBy($OrderByColumn,$SortBy)->offset($request->start)->limit($request->length)->selectRaw('users.*,utr.total_questions,utr.total_questions_ans,utr.total_questions_attend')->get();
        $response['draw']=$request->draw;
        $response['data']=$users;
        $response['recordsTotal']=$total_count;
        $response['recordsFiltered']=$users->count();

        return  $response;
        
    }
}
