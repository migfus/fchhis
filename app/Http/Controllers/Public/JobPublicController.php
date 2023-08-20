<?php

namespace App\Http\Controllers\Public;

use App\Models\Job;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class JobPublicController extends Controller
{
  // NOTE INDEX
  public function index(Request $req) {
    return response()->json([
      ...$this->G_ReturnDefault(),
      'data' => Job::where('unposted_at', '>=', Carbon::now())->with(['JobStatus', 'JobType', 'JobDepartment', 'JobLocation'])->get(),
    ]);
  }
}
