<?php

namespace App\Http\Controllers\Public;

use App\Models\Post;
use Illuminate\Http\Request;

class PostPublicController extends Controller
{
  // NOTE INDEX
  public function index(Request $req) {
    if($req->isSummary) {
      return $this->IndexSummary($req);
    }
    else {
      return $this->IndexAll($req);
    }
  }

  private function IndexAll() {
    $data = Post::where('active', true)->with(['category', 'user'])->get();

    return response()->json(['data' => $data]);
  }

  private function IndexSummary() {
    $data = Post::where('active', true)->with(['category', 'user'])->limit(3)->get();

    return response()->json(['data' => $data]);
  }

  // NOTE SHOW
  public function show(Post $post) {
    return response()->json([
      ...$this->G_ReturnDefault(),
      'data' => $post->first(),
    ]);
  }
}
