<?php

namespace App\Http\Controllers;

use App\Mail\VisitorContact;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class WebsiteController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('name', 'ASC')->where('is_published', '1')->get();
        $posts = Post::orderBy('id', 'DESC')->where('post_type', 'post')->where('is_published', '1')->paginate(5);
        return view('website.index', compact('posts', 'categories'));
    }

    public function post($slug)
    {
        $post = Post::where('slug', $slug)->where('post_type', 'post')->where('is_published', '1')->first();
        if ($post) {
            return view('website.post', compact('post'));
        } else {
            return \Response::view('website.errors.404', array(), 404);
        }
    }

    public function category($slug)
    {
        $categories = Category::where('slug', $slug)->where('is_published', '1')->first();
        if ($categories) {
            $posts = $categories->posts()->orderBy('posts.id', 'DESC')->where('is_published', '1')->paginate(5);
            return view('website.category', compact('categories', 'posts'));
        } else {
            return \Response::view('website.errors.404', array(), 404);
        }
    }

    public function page($slug)
    {
        $page = Post::where('slug', $slug)->where('post_type', 'page')->where('is_published', '1')->first();
        if ($page) {
            return view('website.page', compact('page'));
        } else {
            return \Response::view('website.errors.404', array(), 404);
        }
    }

    public function showContactForm()
    {
        return view('website.contact');
    }

    public function submitContactForm(Request $request)
    {
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'tel' => $request->tel,
            'message' => $request->tel
        ];

        // visitorcontact() is like middleware from controller to mail template
        Mail::to('yourmail@address.com')->send(new VisitorContact($data));

        session()->flash('message', 'Thank You for your email');
        return redirect()->route('contact.show');
    }
}
