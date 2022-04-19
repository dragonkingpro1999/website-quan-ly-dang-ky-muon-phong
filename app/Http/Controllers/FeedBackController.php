<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FeedBack;
use App\Models\Decentralization;
use Auth;
use Session;

class FeedBackController extends Controller
{
    protected $feed_back;
    protected $decentralization;

    public function __construct(FeedBack $feed_back, Decentralization $decentralization)
    {
        $this->feed_back = $feed_back;
        $this->decentralization = $decentralization;
    }

    public function add_feed_back_room(Request $request)
    {
        return $this->feed_back->add_feed_back_room($request);
    }

    public function edit_feed_back_room(Request $request)
    {
        return $this->feed_back->edit_feed_back_room($request);
    }

    public function delete_feed_back_room(Request $request)
    {
        return $this->feed_back->delete_feed_back_room($request);
    }

    public function index()
    {
        $roles_user = $this->decentralization->_get_by_id_user(Auth::guard('nguoi_dung')->user()->ma);
        $title = 'Tất cả phản hồi phòng';
        $all = $this->feed_back->_get_all();
        return view('pages.admin.feed_back.index', compact('all', 'title', 'roles_user'));
    }

    public function edit($id)
    {
        $roles_user = $this->decentralization->_get_by_id_user(Auth::guard('nguoi_dung')->user()->ma);
        $title = 'Trả lời phản hồi phòng';
        $edit = $this->feed_back->_get_by_id($id);
        if ($edit) {
            return view('pages.admin.feed_back.edit', compact('edit', 'title', 'roles_user'));
        } else {
            Session::put('error', "Mã không tồn tại");
            return redirect()->route('feed_back');
        }
    }

    public function update(Request $request)
    {
        $update = $this->feed_back->_update($request->except('_token', 'ma'), $request->ma);
        if ($update) {
            Session::put('success', "Xử lý thành công");
            return redirect()->back();
        } else {
            Session::put('error', "Xử lý thất bại. Vui lòng thử lại");
            return redirect()->back();
        }
    }
}
