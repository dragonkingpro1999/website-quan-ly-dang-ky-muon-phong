<?php

namespace App\Http\Controllers;

use App\Models\BorrowRoom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class HistorySignupBorrowRoom extends Controller
{
    protected $borrow_room;

    public function __construct(BorrowRoom $borrow_room)
    {
        $this->borrow_room = $borrow_room;
    }

    public function index()
    {
        $title = 'Lịch sử đăng ký mượn phòng';
        $all = $this->borrow_room->_get_history_signup_borrow_room();
        return view('pages.home.history_signup_borrow_room.index', compact('title', 'all'));
    }
}
