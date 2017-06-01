<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Blog;
use Validator;
use Response;
use Illuminate\Support\Facades\Input;
class Blog2Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $blogs = Blog::all();
       return view('blog2.index',compact('blogs'));
    }


      public function editItem(Request $request)
    {
        $blog = Blog::find($request->id);
         $blog->title=$request->title;
        $blog->desc=$request->description; 
        $blog->save();
        return response()->json($blog);
    }

    public function addItem(Request $request)
    {
        $rules = [
                'title'=>'required',
                'description'=>'required',
        ];
        $validator = Validator::make($request->all(),$rules);
        if($validator->fails()){
            return Response::json(['errors'=>$validator->getMessageBag()->toArray()]);
        }
        else{
            $inp = $request->except('_token');
            
             $blog = new Blog();
             $blog->title=$request->title;
             $blog->desc=$request->description; 
             $blog->save();
            return response()->json($blog);
        }  
    }

    public function delItem(Request $request)
    {
        $blog =Blog::find($request->id)->delete();
        return response()->json();
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
        //
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
        //
    }
}
