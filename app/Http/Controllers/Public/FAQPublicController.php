<?php

namespace App\Http\Controllers\Public;

use Illuminate\Http\Request;
use App\Models\FAQ;

class FAQPublicController extends Controller
{
  public function index(Request $req) {
    if($req->search) {
      $data = FAQ::whereNotNull('approved_user_id')->where('question', 'LIKE', '%'.$req->search.'%')->orderBy('points', 'DESC')->limit(4)->get();
    }
    else {
      $data = FAQ::whereNotNull('approved_user_id')->orderBy('points', 'DESC')->limit(4)->get();
    }

    return response()->json([
      ...$this->G_ReturnDefault(),
      'data' => $data,
    ], 200);
  }
}
