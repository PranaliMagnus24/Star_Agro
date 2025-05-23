<?php

namespace App\Http\Controllers\Admin\Job;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Job;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AppliedUserExport;
use Yajra\DataTables\DataTables;

class JobController extends Controller
{
     public function job_index(Request $request)
    {
        
        //  $jobApplications = Job::with(['states', 'districts', 'talukas', 'villages'])
        //               ->orderBy('created_at', 'desc')
        //               ->get();
         if ($request->ajax()) {
    $query = Job::with(['states', 'districts', 'talukas', 'villages'])->latest();

    return DataTables::of($query)
        ->addIndexColumn()
        ->addColumn('full_address', function ($row) {
            return $row->villages->village_name . ', ' .
                   $row->talukas->taluka_name . ', ' .
                   $row->districts->district_name . ', ' .
                   $row->states->name;
        })
        ->addColumn('cv_buttons', function ($row) {
            if ($row->cv) {
                $viewBtn = '<a href="' . asset('upload/cv_uploads/' . $row->cv) . '" target="_blank" class="btn btn-sm btn-info" title="View"><i class="bi bi-eye"></i></a>';
                $downloadBtn = '<a href="' . asset('upload/cv_uploads/' . $row->cv) . '" download class="btn btn-sm btn-success" title="Download"><i class="bi bi-download"></i></a>';
                return '<div class="d-flex gap-2">' . $viewBtn . $downloadBtn . '</div>';
            }
            return '<span>No CV</span>';
        })
        ->rawColumns(['cv_buttons'])
        ->make(true);
        }            
        return view('admin.job.job_index');
    }

    public function job_show($id)
    {
        $jobApplications= Job::findOrFail($id);
        return view('admin.job.job_show', compact('jobApplications'));
    }

    ///Export Data in excel
public function exportjob()
{
    return Excel::download(new AppliedUserExport, 'jobs.xlsx');
}

}
