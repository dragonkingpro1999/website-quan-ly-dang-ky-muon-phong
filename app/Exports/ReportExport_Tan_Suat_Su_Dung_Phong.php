<?php

namespace App\Exports;

use App\Models\BorrowRoom;
use Maatwebsite\Excel\Concerns\FromCollection;
use Session;

class ReportExport_Tan_Suat_Su_Dung_Phong implements FromCollection
{
    public function headings(): array
    {
        return [
            'STT',
            'Phòng',
            'Số giờ sử dụng (h)',
            'Số giờ sử dụng',
        ];
    }
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $excel = Session::get('excel_borrow_room_frequency_of_room_use');
        // dd($excel);
        $report[] = array(
            'STT',
            'Phòng',
            'Số giờ sử dụng (h)',
            'Số giờ sử dụng',
        );
        foreach ($excel['chart_list_room'] as $key => $value) {
            $stt = $key + 1;
            $report[$stt] = array(
                'STT' => $stt,
                'Phòng' => $excel['chart_list_room'][$key],
                'Số giờ sử dụng (h)' => $excel['chart_value'][$key] != 0 ? $excel['chart_value'][$key] : '0',
                'Số giờ sử dụng' => $this->doi_gio($excel['chart_value'][$key]),
            );
        }

        return collect($report);
    }
    public function doi_gio($time)
    {
        if ($time == 0) {
            return '0h';
        } else if ($time > 0 && $time < 1) {
            $time = $time * 60;
            return $time . "'";
        } else {
            $floor = floor($time);
            $p = $time -  $floor;

            return ($floor . 'h ') . (($p * 60) . "'");
        }
    }
}
