<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Reply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReplyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    //   dd($request);

        $user_id = auth('api')->user()->id;

        $reply = Reply::create([
            'text' => $request->text,
            'role' => $request->role,
            'comment_id' => $request->comment_id,
            'user_id' => $user_id
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Comment created successfully',
            'reply' => $reply
        ]);
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
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = Reply::destroy($id);
       // $result = DB::table('replies')->where('id', '=', $id)->delete();
        if ($result) {
            return response()->json([
                'status' => 'success',
                'message' => 'Reply deleted successfully',
                'result' => $result
            ]);
        } else {
            return response()->json([
                'status' => 'fail',
                'result' => $result
            ]);
        }
    }
}
