<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function authot()
    {
        $datas = User::where('role','authot')->get();
        return view('report.authot',compact('datas'));
    }

    public function profitloss()
    {
        $datas = Ticket::selectRaw('year(created_at) as year, monthname(created_at) as month, sum(amount) as amount')
                ->selectRaw('year(created_at) as year, monthname(created_at) as month, sum(purchase) as purchase')
                ->groupBy('year','month')
                ->orderByRaw('min(created_at) desc')
                ->get();
        return view('report.profit-loss',compact('datas'));
    }

    public function branch()
    {
        $datas = Branch::all();
        return view('report.branch',compact('datas'));
    }

    public function branch_details($id)
    {
        $branch = Branch::find($id);
        $user_ids = User::where('branch_id',$branch->id)->pluck('id');
        $datas = Ticket::whereIn('user_id',$user_ids)->selectRaw('year(created_at) as year, monthname(created_at) as month, sum(amount) as amount')
                ->selectRaw('year(created_at) as year, monthname(created_at) as month, sum(purchase) as purchase')
                ->groupBy('year','month')
                ->orderByRaw('min(created_at) desc')
                ->get();
        return view('report.branch-details',compact('datas','branch'));
    }

}
