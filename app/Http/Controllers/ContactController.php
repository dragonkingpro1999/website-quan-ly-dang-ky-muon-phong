<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Decentralization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Auth;

class ContactController extends Controller
{
    protected $contact;
    protected $decentralization;

    public function __construct(Contact $contact, Decentralization $decentralization)
    {
        $this->contact = $contact;
        $this->decentralization = $decentralization;
    }

    public function index()
    {
        $roles_user = $this->decentralization->_get_by_id_user(Auth::guard('nguoi_dung')->user()->ma);
        $title = 'Phản hồi liên hệ';
        $all = $this->contact->_get_all();
        return view('pages.admin.contact.index', compact('all', 'title', 'roles_user'));
    }

    public function insert(Request $request)
    {
        if ($request->ma_nguoi_dung) {
            $data = $this->contact->_insert($request->except('_token'));
        } else {
            $data = $this->contact->_insert($request->except('_token', 'ma_nguoi_dung'));
        }
        return $data;
    }

    public function delete(Request $request)
    {
        $delete = $this->contact->_delete($request->id);
        if ($delete) {
            Session::put('success', "Xóa chức năng thành công");
            return redirect()->route('contact');
        } else {
            Session::put('error', "Chỉ có thể xóa khi vừa mới tạo ra!");
            return redirect()->route('contact');
        }
    }

    public function edit($id)
    {
        $roles_user = $this->decentralization->_get_by_id_user(Auth::guard('nguoi_dung')->user()->ma);
        $title = 'Phản hồi liên hệ';
        $edit = $this->contact->_get_by_id($id);
        if ($edit) {
            return view('pages.admin.contact.edit', compact('edit', 'title', 'roles_user'));
        } else {
            Session::put('error', "Mã liên hệ không tồn tại");
            return redirect()->route('contact');
        }
    }

    public function update(Request $request)
    {
        $update = $this->contact->_update($request->except('_token', 'ma'), $request->ma);
        if ($update) {
            Session::put('success', "Phản hồi thành công");
            return redirect()->back();
        } else {
            Session::put('error', "Phản hồi thất bại. Vui lòng thử lại");
            return redirect()->back();
        }
    }

    public function check_name_is_unique(Request $request)
    {
        return $this->contact->_name_is_unique($request->name, $request->id);
    }
}
