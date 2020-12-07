<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use App\Post; 
use Illuminate\Http\Request;
use DB;

class PostsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        //pot folosi orice functie din Model de care am nevoie
        //asta foloseste Eloquent(object relational mapper) care face usoara util.  interogarile data base
        $posts = Post::orderBy('created_at','desc')->paginate(10);
        return view('posts.index')->with('posts', $posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create'); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
            'cover_image' => 'image|nullable|max:1999'

        ]);

        //Handle incarcarea de fisiere
        if($request->hasFile('cover_image')){
            //Get filename with the extension
            $fileNameWithExt = $request->file('cover_image')->getClientOriginalName();
            //Get just filenamee
            $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            //Get just extension
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            //File name to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            //Upload the Image
            $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);
        } else {
            $fileNameToStore = 'noimage.jpg';
        }

        //creez postare
        $post = new Post;
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->user_id = auth()->user()->id;
        $post->cover_image = $fileNameToStore;
        $post->save();

        return redirect('/posts')->with('succes', 'Post Created');
    }

    /** 
     * Display the specified resource.
     *
     * @param  int  $id   
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //fetch the id from the data base, pun Post pt ca este our Model
        $post = Post::find($id);
        return view('posts.show')->with('post', $post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);

        //Verific utilizatorul corect
        if(auth()->user()->id !==$post->user_id){
                return redirect('/posts')->with('error', 'Unauthorized Page');
        }
        
        return view('posts.edit')->with('post', $post);
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
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required'

        ]);

        //Handle incarcarea de fisiere
        if($request->hasFile('cover_image')){
            //Get filename with the extension
            $fileNameWithExt = $request->file('cover_image')->getClientOriginalName();
            //Get just filenamee
            $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            //Get just extension
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            //File name to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            //Upload the Image
            $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);
      
        }

       //creez postare
       $post = Post::find($id);
       $post->title = $request->input('title');
       $post->body = $request->input('body');
       if($request->hasFile('cover_image')){
           $post->cover_image = $fileNameToStore;

       }
       $post->save();

       return redirect('/posts')->with('succes', 'Post Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);

         //Verific utilizatorul corect
         if(auth()->user()->id !==$post->user_id){
            return redirect('/posts')->with('error', 'Unauthorized Page');
         }

         if($post->cover_image != 'noimage.jpg'){
             //Delete Image
             Storage::delete('public/cover_images/'.$post->cover_image);
         }
    
        $post->delete();
        return redirect('/posts')->with('success', 'Post Removed');
    }
}
