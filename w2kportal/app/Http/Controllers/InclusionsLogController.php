<?php

namespace App\Http\Controllers;

use App\Exports\HistoryExport;
use App\Models\book;
use App\Models\inclusions_log;
use App\Models\User;

class InclusionsLogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $index_column;

    public function __construct()
    {
        $this->index_column = [
            'inclusions_logs.*',
            'service_inclusions.service_name AS serName',
        ];
    }

    public function index($id)
    {
        return view('InclusionHistory', ['history' => $this->get_history_by_id($id, $this->index_column)]);
    }

    public function get_history_by_id($id, $columns = [])
    {
        $history =  inclusions_log::join(
            'service_inclusions',
            'service_inclusions.id',
            '=',
            'inclusions_logs.log_id'
        )
            ->leftJoin('users', 'inclusions_logs.user_id', '=', 'users.id')
            ->where('inclusions_logs.book_id', '=', $id)
            ->select($columns)
            ->orderBy('inclusions_logs.id', 'DESC')
            ->latest();

        $history_info = [];
        foreach ($history->get()->toArray() as $key => $histories) {
            foreach ($histories as $history_key => $histor) {
                if (
                    str_contains($history_key, '_by') &&
                    isset($histories[$history_key])
                ) {
                    $history_info[$key][$history_key] = $this->get_user_details(
                        $histories[$history_key]
                    );
                } else {
                    $history_info[$key][$history_key] = $histories[$history_key];
                }

                if ($history_key === 'created_at') {
                    $history_info[$key][$history_key] = date('d/m/Y h:m:s', strtotime($histories[$history_key]));
                }
            }
        }
        return $history_info;
    }

    public function export_log($id)
    {
        $book = book::find($id);
        $date_now = now()->toDateTimeString();
        $date_Format = date('mdY', strtotime($date_now));

        return (new HistoryExport($id))->download("{$book->book_title}-{$date_Format}.xls");
    }

    private function get_user_details($id)
    {
        $user = User::where('id', $id)->get();

        $credentials = $user->toArray()[0];

        return !empty($credentials) ? $credentials['name'] : '';
    }
}
