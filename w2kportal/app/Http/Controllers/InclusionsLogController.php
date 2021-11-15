<?php

namespace App\Http\Controllers;

use App\Models\inclusions_log;
use App\Models\User;
use Illuminate\Http\Request;

class InclusionsLogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index($id)
    {
        $history = inclusions_log::join(
            'service_inclusions',
            'service_inclusions.id',
            '=',
            'inclusions_logs.log_id'
        )
            ->join('users', 'inclusions_logs.user_id', '=', 'users.id')
            ->where('inclusions_logs.book_id', '=', $id)
            ->select(
                'inclusions_logs.*',
                'service_inclusions.service_name AS serName'
            )
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
                    $history_info[$key][$history_key] =
                        $histories[$history_key];
                }
            }
        }

        return view('InclusionHistory', ['history' => $history_info]);
    }

    private function get_user_details($id)
    {
        $user = User::where('id', $id)->get();

        $credentials = $user->toArray()[0];

        return !empty($credentials) ? $credentials['name'] : '';
    }
}
