<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Blog;
class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $blogs = Blog::all();
       //dump($blogs);
       return view('blog.index',compact('blogs')); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('blog.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'title'=>'required',
            'desc'=>'required',
            'img'=>'required|image',
        ]);


        if($request->hasFile('img')){
            $file = $request->file('img');
            $input['img'] = $file->getClientOriginalName('img');
            $file->move(public_path().'/img',$input['img']);
        }

        $blog = new Blog;
        $blog->img = $file->getClientOriginalName('img');
        $blog->title = $request->title;
        $blog->desc = $request->desc;
        $blog->save();
        return redirect()->route('admin.index')->with("alert-success","DATA SAVED");
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
        $blog = Blog::findorFail($id);
        return view('blog.edit',compact('blog'));
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
        $this->validate($request,[
            'title'=>'required',
            'desc'=>'required',
            'img'=>'image',
        ]);

        // dd($request);
        if($request->hasFile('img')){
            $file = $request->file('img');
            $input['img'] = $file->getClientOriginalName('img');
            $file->move(public_path().'/img',$input['img']);
        }else{
           $input['img'] = $request->oimg; 
        }

        $blog = Blog::findorFail($id);
        $blog->img = $input['img'];
        $blog->title = $request->title;
        $blog->desc = $request->desc;
        $blog->save();
        return redirect()->route('admin.index')->with("alert-success","DATA UPDATED");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $blog = Blog::findorFail($id);
        $blog->delete();
        unlink(public_path('/img/'.$blog->img));
        return redirect()->route('admin.index')->with("alert-success","DATA DELETED");
    }
}
