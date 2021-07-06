<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\PostCategory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    function __construct()
    {
        $this->middleware(function ($request, $next) {
            session(['mod_active' => 'post']);
            return $next($request);
        });
    }

    function index(Request $request)
    {
        $key = $request->input('key');
        $search_option = $request->input('search_option_post');
        $status = $request->input('status');

        $list_action = array(
            'trash' => 'Xóa tạm thời'
        );

        //search_option = title
        if ($search_option == 'title' || $search_option == '') {
            $list_post = Post::where('name', 'like', "%{$key}%")->orderByDesc('id')->paginate(5);

            if ($status == 'trash') {
                $list_action = array(
                    'active' => 'Khôi phục',
                    'forceDelete' => 'Xóa vĩnh viễn'
                );
                $list_post = Post::onlyTrashed()->where('name', 'like', "%{$key}%")->orderByDesc('id')->paginate(5);
            }

            if ($status == 'approved') {
                $list_post = Post::where('status', 'approved')->where('name', 'like', "%{$key}%")->orderByDesc('id')->paginate(5);
            }

            if ($status == 'not approved yet') {
                $list_action = array(
                    'approved' => 'Duyệt',
                    'trash' => 'Xóa tạm thời'
                );
                $list_post = Post::where('status', 'not approved yet')->where('name', 'like', "%{$key}%")->orderByDesc('id')->paginate(5);
            }
        }

        //search_option = category
        if ($search_option == 'category') {
            $categories = PostCategory::where('name', 'like', "%{$key}%")->get();

            $list_id = array();
            foreach ($categories as $item) {
                $list_id[] = $item->id;
            }
            $list_post = Post::whereIn('post_category_id', $list_id)->orderByDesc('id')->paginate(5);

            if ($status == 'trash') {
                $list_action = array(
                    'active' => 'Khôi phục',
                    'forceDelete' => 'Xóa vĩnh viễn'
                );
                $list_post = Post::onlyTrashed()->whereIn('post_category_id', $list_id)->orderByDesc('id')->paginate(5);
            }

            if ($status == 'approved') {
                $list_post = Post::where('status', 'approved')->whereIn('post_category_id', $list_id)->orderByDesc('id')->paginate(5);
            }

            if ($status == 'not approved yet') {
                $list_action = array(
                    'approved' => 'Duyệt',
                    'trash' => 'Xóa tạm thời'
                );
                $list_post = Post::where('status', 'not approved yet')->whereIn('post_category_id', $list_id)->orderByDesc('id')->paginate(5);
            }
        }

        //search_option = actor
        if ($search_option == 'actor') {
            $actors = User::where('fullname', 'like', "%{$key}%")->get();

            $list_id = array();
            foreach ($actors as $item) {
                $list_id[] = $item->id;
            }
            $list_post = Post::whereIn('user_id', $list_id)->orderByDesc('id')->paginate(5);

            if ($status == 'trash') {
                $list_action = array(
                    'active' => 'Khôi phục',
                    'forceDelete' => 'Xóa vĩnh viễn'
                );
                $list_post = Post::onlyTrashed()->whereIn('user_id', $list_id)->orderByDesc('id')->paginate(5);
            }

            if ($status == 'approved') {
                $list_post = Post::where('status', 'approved')->whereIn('user_id', $list_id)->orderByDesc('id')->paginate(5);
            }

            if ($status == 'not approved yet') {
                $list_action = array(
                    'approved' => 'Duyệt',
                    'trash' => 'Xóa tạm thời'
                );
                $list_post = Post::where('status', 'not approved yet')->whereIn('user_id', $list_id)->orderByDesc('id')->paginate(5);
            }
        }

        $count = array(
            'approved' => Post::where('status', 'approved')->count(),
            'not approved yet' => Post::where('status', 'not approved yet')->count(),
            'trash' => Post::onlyTrashed()->count(),
            'all' => Post::count()
        );
        
        return view('admin.posts.index', compact('list_post', 'count', 'list_action'));
    }

    function detail($id)
    {
        $post = Post::withTrashed()->find($id);

        return view('admin.posts.detail', compact('post'));
    }

    function add()
    {
        $list_post_cate = PostCategory::all();

        return view('admin.posts.add', compact('list_post_cate'));
    }

    function store(Request $request)
    {
        //dd($request->all());
        $request->validate(
            [
                'name' => 'required|min:10|max:200',
                'short_desc' => 'required|min:10|max:300',
                'post_category_id' => 'required',
                'thumb' => 'required|image|max:20480',
                'content' => 'required'
            ],
            [
                'required' => ':attribute không được để trống',
                'min' => ':attribute có độ dài tối thiểu là :min ký tự',
                'max' => ':attribute có độ dài tối thiểu là :max ký tự',
                'thumb.max' => 'Ảnh đại diện có độ dài tối thiểu là 20Mb',
                'image' => ':attribute phải là định dạng (jpg, jpeg, png, bmp, gif, svg, hoặc webp)',
            ],
            [
                'name' => 'Tiêu đề bài viết',
                'short_desc' => 'Tóm tắt ngắn',
                'post_category_id' => 'Danh mục bài viết',
                'thumb' => 'Ảnh đại diện',
                'content' => 'Nội dung'
            ]
        );

        if ($request->hasFile('thumb')) {
            $file = $request->thumb;

            $fileName = $file->getClientOriginalName();

            $file->move('public\uploads', $fileName);

            $thumb = asset('uploads/' . $fileName);
        }

        $post = Post::create([
            'name' => $request->input('name'),
            'code' => Str::slug($request->input('name')),
            'short_desc' => $request->input('short_desc'),
            'content' => $request->input('content'),
            'post_category_id' => $request->input('post_category_id'),
            'user_id' => Auth::id(),
            'thumb' => $thumb
        ]);

        $route_detail = route('admin.post.detail', $post->id);
        return redirect(route('admin.post.index'))->with('success', "Thêm bài viết thành công. Click <a class=\"text-primary\" href=\"{$route_detail}\">vào đây</a> để xem chi tiết!");
    }

    function delete(Request $request, $id)
    {
        $status = $request->input('status');
        if ($status == 'trash') {
            Post::onlyTrashed()->find($id)->forceDelete();
            return redirect(route('admin.post.index', ['status' => 'trash']))->with('success', 'Xóa vĩnh viễn bài viết thành công');
        } else {
            Post::destroy($id);
            $route_detail = route('admin.post.detail', $id);
            return redirect(route('admin.post.index'))->with('success', "Xóa bài viết thành công. Click <a class=\"text-primary\" href=\"{$route_detail}\">vào đây</a> để xem chi tiết!");
        }
    }

    function action(Request $request)
    {
        $list_post_id = $request->input('list_post_id');
        $key = $request->input('key');
        $search_option_post = $request->input('search_option_post');

        if ($list_post_id) {
            $action = $request->input('action');


            if ($action == 'trash') {
                Post::destroy($list_post_id);

                return redirect(route('admin.post.index', ['status' => 'trash', 'page' => 1, 'key' => $key, 'search_option_post' => $search_option_post]))->with('success', 'Xóa bài viết thành công');
            }
            if ($action == 'approved') {
                Post::where('status', 'not approved yet')->whereIn('id', $list_post_id)->update(['status' => 'approved']);

                return redirect(route('admin.post.index', ['status' => 'approved', 'page' => 1, 'key' => $key, 'search_option_post' => $search_option_post]))->with('success', 'Phê duyệt bài viết thành công');
            }
            if ($action == 'active') {
                Post::onlyTrashed()->whereIn('id', $list_post_id)->restore();

                return redirect(route('admin.post.index', ['status' => 'all', 'page' => 1, 'key' => $key, 'search_option_post' => $search_option_post]))->with('success', 'Khôi phục bài viết thành công');
            }
            if ($action == 'forceDelete') {
                Post::onlyTrashed()->whereIn('id', $list_post_id)->forceDelete();

                return redirect(route('admin.post.index', ['status' => 'trash', 'page' => 1, 'key' => $key, 'search_option_post' => $search_option_post]))->with('success', 'Xóa vĩnh viễn bài viết thành công');
            }

            return redirect(route('admin.post.index', ['key' => $key, 'search_option_post' => $search_option_post]))->with('error', 'Bạn chưa chọn hành động nào');
        } else {
            return redirect(route('admin.post.index', ['key' => $key, 'search_option_post' => $search_option_post]))->with('error', 'Bạn chưa chọn bài viết nào');
        }
    }

    function edit(Request $request, $id)
    {
        $list_post_cate = PostCategory::all();
        $post = Post::withTrashed()->find($id);

        return view('admin.posts.edit', compact('post', 'list_post_cate'));
    }

    function update(Request $request, $id)
    {
        //dd($request->all());
        $request->validate(
            [
                'name' => 'required|min:10|max:200',
                'short_desc' => 'required|min:10|max:300',
                'post_category_id' => 'required',
                'thumb' => 'image|max:20480',
                'content' => 'required'
            ],
            [
                'required' => ':attribute không được để trống',
                'min' => ':attribute có độ dài tối thiểu là :min ký tự',
                'max' => ':attribute có độ dài tối thiểu là :max ký tự',
                'thumb.max' => 'Ảnh đại diện có độ dài tối thiểu là 20Mb',
                'image' => ':attribute phải là định dạng (jpg, jpeg, png, bmp, gif, svg, hoặc webp)',
            ],
            [
                'name' => 'Tiêu đề bài viết',
                'short_desc' => 'Tóm tắt ngắn',
                'post_category_id' => 'Danh mục bài viết',
                'thumb' => 'Ảnh đại diện',
                'content' => 'Nội dung'
            ]
        );

        $thumb = Post::withTrashed()->find($id)->thumb;

        $this->upload_image($request, 'thumb', $thumb);

        Post::withTrashed()->where('id', $id)->update([
            'name' => $request->input('name'),
            'code' => Str::slug($request->input('name')),
            'short_desc' => $request->input('short_desc'),
            'content' => $request->input('content'),
            'post_category_id' => $request->input('post_category_id'),
            'thumb' => $thumb
        ]);

        $status = $request->input('status');

        $route_detail = route('admin.post.detail', $id);
        if ($status == 'trash') {
            return redirect(route('admin.post.index', ['status' => 'trash']))->with('success', "Cập nhật bài viết thành công. Click <a class=\"text-primary\" href=\"{$route_detail}\">vào đây</a> để xem chi tiết!");
        } else {
            return redirect(route('admin.post.index'))->with('success', "Cập nhật bài viết thành công. Click <a class=\"text-primary\" href=\"{$route_detail}\">vào đây</a> để xem chi tiết!");
        }
    }

    function upload_image($request, $image, &$thumb)
    {
        if ($request->hasFile($image)) {
            $file = $request->$image;

            $fileName = $file->getClientOriginalName();

            $file->move('public\uploads', $fileName);

            $thumb = 'http://localhost:8080/DoanLKMT/doanwebtmdt/public/uploads/' . $fileName;
        }
    }
}
