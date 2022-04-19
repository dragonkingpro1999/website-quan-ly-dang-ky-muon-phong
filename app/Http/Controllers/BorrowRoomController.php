<?php

namespace App\Http\Controllers;

use App\Models\BorrowRoom;
use App\Models\TimeOpenSemester;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class BorrowRoomController extends Controller
{
    protected $borrow_room;
    protected $time_open_semester;

    public function __construct(BorrowRoom $borrow_room, TimeOpenSemester $time_open_semester)
    {
        $this->borrow_room = $borrow_room;
        $this->time_open_semester = $time_open_semester;
    }

    public function get_infor_user_borrow_room(Request $request)
    {
        return $this->borrow_room->_get_infor_user_borrow_room($request->id);
    }

    public function signup_borrow_room_one(Request $request)
    {
        $time_open_signup = $this->time_open_semester->_get_time_open_signup();
        return $this->borrow_room->_signup_borrow_room_one($request, $time_open_signup);
    }

    public function signup_borrow_room_many(Request $request)
    {
        $time_open_signup = $this->time_open_semester->_get_time_open_signup();
        return $this->borrow_room->_signup_borrow_room_many($request, $time_open_signup);
    }

    public function delete_borrow_room(Request $request)
    {
        return $this->borrow_room->_delete_borrow_room($request->id, $request->ly_do_huy);
    }

    public function get_infor_update(Request $request)
    {
        return $this->borrow_room->_get_by_id($request->id);
    }

    public function update_borrow_room(Request $request)
    {
        $time_open_signup = $this->time_open_semester->_get_time_open_signup();
        return $this->borrow_room->_update_borrow_room($request->except('_token'), $time_open_signup);
    }
}
