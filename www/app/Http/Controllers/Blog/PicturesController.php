<?php

namespace App\Http\Controllers\Blog;

use Illuminate\Http\Request;
use Illuminate\View\View;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Picture;

class PicturesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index() : View
    {
        $data = [
            'pictures' => Picture::all(),
        ];

        return view('blog.pictures.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create() : View
    {
        $picture = new Picture();

        $data = [
            'picture' => $picture,
        ];

        return view('blog.pictures.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->file('picture')->isValid()) {
            $file = $request->file('picture');
            $destinationPath = 'uploaded';
            $fileName = sha1_file($file->getRealPath()).'.'.$file->guessExtension();
            $file->move($destinationPath, $fileName);

            Picture::create([
                'source' => $destinationPath . DIRECTORY_SEPARATOR . $fileName,
                'alternate_text' => $request->get('alternate_text'),
            ]);

            return redirect()->route('blog.pictures.index'); // $ artisan route:list
        }

    }

}
