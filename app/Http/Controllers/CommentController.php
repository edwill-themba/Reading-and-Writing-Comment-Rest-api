<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
     public function index()
     {
         // gets all the comments from the database
         $comments = DB::table('comments')
             ->select('author', 'comment', 'comment_date', 'comment_time')
             ->orderBy('comment_date', 'DESC')
             ->get();
 
         return response()->json(['comments' => $comments], 200);
     }
 
 
     /**
      * Store a newly created resource in storage.
      */
     public function store(Request $request)
     {
         $this->validate($request, [
             'author' => 'required|min:3|max:191',
             'comment' => 'required|min:4|max:200'
         ]);
 
         // store comments to the database
         $comment = DB::table('comments')->insert([
             'author' => $request->input('author'),
             'comment' => $request->input('comment'),
             'comment_date' => Date('Y-m-d'),
             'comment_time' => Date('g:i:s')
         ]);
         return response()->json(['comment' => $comment], 200);
        }
    
}
