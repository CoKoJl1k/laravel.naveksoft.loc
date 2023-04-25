<?php

namespace App\Http\Controllers;

use App\Models\Reply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReplyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $replies = Reply::paginate(3);
       // $replies = Reply::where('id', '>', 7)->paginate( 3);
      //  $replies = Reply::all();
        return response()->json([
            'status' => 'success',
            'message' => 'All replies',
            'replies' => $replies
        ]);
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
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $user =  auth('api')->user();
        if ($user->role === 'admin') {
            $reply = Reply::create([
                'text' => $request->text,
                'role' => $request->role,
                'comment_id' => $request->comment_id,
                'user_id' => $user->id
            ]);
            return response()->json([
                'status' => 'success',
                'message' => 'Reply created successfully',
                'reply' => $reply
            ]);
        } else {
            return response()->json([
                'status' => 'fail',
                'message' => "You do not have enough access rights",
            ]);
        }
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
     * @return \Illuminate\Http\JsonResponse
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
