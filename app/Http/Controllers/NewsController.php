<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Decentralization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Auth;

class NewsController extends Controller
{
    protected $news;
    protected $decentralization;

    public function __construct(News $news, Decentralization $decentralization)
    {
        $this->news = $news;
        $this->decentralization = $decentralization;
    }

    public function index()
    {
        $roles_user = $this->decentralization->_get_by_id_user(Auth::guard('nguoi_dung')->user()->ma);
        $title = 'Tất cả tin tức';
        $all = $this->news->_get_all();
        return view('pages.admin.news.index', compact('all', 'title', 'roles_user'));
    }

    public function add()
    {
        $roles_user = $this->decentralization->_get_by_id_user(Auth::guard('nguoi_dung')->user()->ma);
        $title = 'Thêm tin tức';
        return view('pages.admin.news.add', compact('title', 'roles_user'));
    }

    public function insert(Request $request)
    {
        if ($request->noi_dung == "" || $request->tieu_de == "") {
            Session::put('error', "Nội dung hoặc tiêu đề không được rỗng");
            return redirect()->route('add_news');
        }

        $insert = $this->news->_insert($request->except('_token'), $request);
        if ($insert) {
            Session::put('success', "Thêm tin tức thành công");
            return redirect()->route('add_news');
        } else {
            Session::put('error', "Có lỗi xảy ra vui lòng thử lại hoặc liên hệ nhà phát triển");
            return redirect()->route('add_news');
        }
    }

    public function delete(Request $request)
    {
        $delete = $this->news->_delete($request->id);
        if ($delete) {
            Session::put('success', "Xóa tin tức thành công");
            return redirect()->route('news');
        } else {
            Session::put('error', "Chỉ có thể xóa khi vừa mới tạo ra!");
            return redirect()->route('news');
        }
    }

    public function edit($id)
    {
        $roles_user = $this->decentralization->_get_by_id_user(Auth::guard('nguoi_dung')->user()->ma);
        $title = 'Cập nhật tin tức';
        $edit = $this->news->_get_by_id($id);
        if ($edit) {
            return view('pages.admin.news.edit', compact('edit', 'title', 'roles_user'));
        } else {
            Session::put('error', "Mã phòng không tồn tại");
            return redirect()->route('news');
        }
    }

    public function update(Request $request)
    {
        if ($request->noi_dung == "" || $request->tieu_de == "") {
            Session::put('error', "Nội dung hoặc tiêu đề không được rỗng");
            return redirect()->route('news');
        }

        $update = $this->news->_update($request->except('_token', 'ma'), $request->ma, $request);
        if ($update) {
            Session::put('success', "Cập nhật tin tức thành công");
            return redirect()->route('news');
        } else {
            Session::put('error', "Có lỗi xảy ra vui lòng thử lại hoặc liên hệ nhà phát triển");
            return redirect()->route('news');
        }
    }

    public function check_name_is_unique(Request $request)
    {
        return $this->news->_name_is_unique($request->name, $request->id);
    }
}
