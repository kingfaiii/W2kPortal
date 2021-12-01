<?php

namespace App\Http\Controllers;

use App\Models\won_customer;
use App\Models\customer;
use App\Models\order;
use App\Models\book;
use App\Models\service_inclusion;
use App\Models\service_package;
use App\Models\projectManager;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class OrderController extends Controller
{
    private function saveOrderStatus(
        $name,
        $id,
        $reason_hold,
        $reason_lost,
        $reason_hold_date
    ) {
        $status = customer::find($id);
        $status->reason_hold = $reason_hold;
        $status->reason_lost = $reason_lost;
        $status->reason_hold_date = $reason_hold_date;
        $status->customer_status = request('customer_status');
        $status->update();

        $activity = new order();
        $activity->created_at = now()->toDateTimeString();
        $activity->updated_at = now()->toDateTimeString();
        $activity->customer_id = request('updatestatuscustomerid');
        $activity->user_id = request('updatestatususerid');
        $activity->sales_rep = request('updatestatususername');
        $activity->remarks = "Update Status($name)";
        $activity->save();

        return redirect()
            ->route('order', [$activity->customer_id])
            ->with('success', 'Customer status Successfully Updated');
    }

    private $inclusions_array = [
        // EBOOK BASIC PACKAGE
        [
            'service_name' => 'eBook Conversion',
            'project_cost' => 0,
            'task' => 'Conversion',
            'status' => 'On-going',
            'parent' => 1,
            'calculate' => 1,
        ],

        [
            'service_name' => 'Basic eBook Cover Art',
            'project_cost' => 0,
            'task' => 'Art Work - Cover',
            'status' => 'On-Hold',
            'parent' => 1,
            'calculate' => 0,
        ],
        // EBOOK BASIC PACKAGE

        // EBOOK VALUE PACKAGE

        [
            'service_name' => 'eBook Conversion',
            'project_cost' => 0,
            'task' => 'Conversion',
            'status' => 'On-going',
            'parent' => 2,
            'calculate' => 1,
        ],

        [
            'service_name' => 'Basic eBook Cover Art',
            'project_cost' => 0,
            'task' => 'Art Work - Cover',
            'status' => 'On-Hold',
            'parent' => 2,
            'calculate' => 0,
        ],

        [
            'service_name' => 'Facebook Banner',
            'project_cost' => 0,
            'task' => 'Art Work - FB Cover',
            'status' => 'On-Hold',
            'parent' => 2,
            'calculate' => 0,
        ],

        [
            'service_name' => 'Facebook Page Creation',
            'project_cost' => 50,
            'task' => 'FB Page Creation',
            'status' => 'On-Hold',
            'parent' => 2,
            'calculate' => 0,
        ],
        // EBOOK VALUE PACKAGE

        // EBOOK DELUXE PACKAGE

        [
            'service_name' => 'eBook Conversion',
            'project_cost' => 0,
            'task' => 'Conversion',
            'status' => 'On-going',
            'parent' => 3,
            'calculate' => 1,
        ],

        [
            'service_name' => 'Premium eBook Cover Art',
            'project_cost' => 100,
            'task' => 'Art Work - Cover',
            'status' => 'On-Hold',
            'parent' => 3,
            'calculate' => 0,
        ],

        [
            'service_name' => 'Amazon eBook Upload',
            'project_cost' => 50,
            'task' => 'eBook Upload',
            'status' => 'On-Hold',
            'parent' => 3,
            'calculate' => 0,
        ],

        [
            'service_name' => 'Facebook Banner',
            'project_cost' => 0,
            'task' => 'Art Work - FB Cover',
            'status' => 'On-Hold',
            'parent' => 3,
            'calculate' => 0,
        ],

        [
            'service_name' => 'Facebook Page Creation',
            'project_cost' => 50,
            'task' => 'FB Page Creation',
            'status' => 'On-Hold',
            'parent' => 3,
            'calculate' => 0,
        ],
        // EBOOK DELUXE PACKAGE

        // PRINT BASIC PACKAGE

        [
            'service_name' => 'Interior Formatting',
            'project_cost' => 0,
            'task' => 'Interior Formatting',
            'status' => 'On-Hold',
            'parent' => 4,
            'calculate' => 1,
        ],
        // PRINT BASIC PACKAGE

        // PRINT VALUE PACKAGE

        [
            'service_name' => 'Interior Formatting',
            'project_cost' => 0,
            'task' => 'Interior Formatting',
            'status' => 'On-Hold',
            'parent' => 5,
            'calculate' => 1,
        ],

        [
            'service_name' => 'Premium Book Cover Art',
            'project_cost' => 100,
            'task' => 'Art Work - Cover',
            'status' => 'On-Hold',
            'parent' => 5,
            'calculate' => 0,
        ],
        // PRINT VALUE PACKAGE

        // PRINT DELUXE PACKAGE
        [
            'service_name' => 'Interior Formatting',
            'project_cost' => 0,
            'task' => 'Interior Formatting',
            'status' => 'On-Hold',
            'parent' => 6,
            'calculate' => 1,
        ],

        [
            'service_name' => 'Premium Book Cover Art',
            'project_cost' => 100,
            'task' => 'Art Work - Cover',
            'status' => 'On-Hold',
            'parent' => 6,
            'calculate' => 0,
        ],

        [
            'service_name' => 'Amazon Print Upload',
            'project_cost' => 50,
            'task' => 'Print Upload',
            'status' => 'On-Hold',
            'parent' => 6,
            'calculate' => 0,
        ],

        [
            'service_name' => 'Facebook Banner',
            'project_cost' => 0,
            'task' => 'Art Work - FB Cover',
            'status' => 'On-Hold',
            'parent' => 6,
            'calculate' => 0,
        ],

        [
            'service_name' => 'Facebook Page Creation',
            'project_cost' => 50,
            'task' => 'FB Page Creation',
            'status' => 'On-Hold',
            'parent' => 6,
            'calculate' => 0,
        ],
        // PRINT DELUXE PACKAGE

        // EBOOK & PRINT DELUXE PACKAGE
        [
            'service_name' => 'Interior Formatting',
            'project_cost' => 150,
            'task' => 'Interior Formatting',
            'status' => 'On-Hold',
            'parent' => 7,
            'calculate' => 0,
        ],

        [
            'service_name' => 'Premium Book Cover Art',
            'project_cost' => 100,
            'task' => 'Art Work - Cover',
            'status' => 'On-Hold',
            'parent' => 7,
            'calculate' => 0,
        ],

        [
            'service_name' => 'eBook Conversion',
            'project_cost' => 0,
            'task' => 'Conversion',
            'status' => 'On-Hold',
            'parent' => 7,
            'calculate' => 1,
        ],

        [
            'service_name' => 'Amazon Ebook Upload',
            'project_cost' => 50,
            'task' => 'eBook Upload',
            'status' => 'On-Hold',
            'parent' => 7,
            'calculate' => 0,
        ],

        [
            'service_name' => 'Amazon Print Upload',
            'project_cost' => '',
            'task' => 'Print Upload',
            'status' => 'On-Hold',
            'parent' => 7,
            'calculate' => 0,
        ],

        [
            'service_name' => 'Facebook Banner',
            'project_cost' => '',
            'task' => 'Art Work - FB Cover',
            'status' => 'On-Hold',
            'parent' => 7,
            'calculate' => 0,
        ],

        [
            'service_name' => 'Facebook Page Creation',
            'project_cost' => 50,
            'task' => 'FB Page Creation',
            'status' => 'On-Hold',
            'parent' => 7,
            'calculate' => 0,
        ],

        // EBOOK & PRINT DELUXE PACKAGE

        // EBOOK & PRINT BASIC PACKAGE

        [
            'service_name' => 'Interior Formatting',
            'project_cost' => 0,
            'task' => 'Interior Formatting',
            'status' => 'On-Hold',
            'parent' => 8,
            'calculate' => 1,
        ],

        [
            'service_name' => 'eBook Conversion',
            'project_cost' => 80,
            'task' => 'Conversion',
            'status' => 'On-Hold',
            'parent' => 8,
            'calculate' => 0,
        ],

        [
            'service_name' => 'Basic eBook Cover Art',
            'project_cost' => 0,
            'task' => 'Art Work - Cover',
            'status' => 'On-Hold',
            'parent' => 8,
            'calculate' => 0,
        ],
        // EBOOK & PRINT BASIC PACKAGE

        // EBOOK & PRINT VALUE PACKAGE

        [
            'service_name' => 'Interior Formatting',
            'project_cost' => 0,
            'task' => 'Interior Formatting',
            'status' => 'On-Hold',
            'parent' => 9,
            'calculate' => 1,
        ],

        [
            'service_name' => 'eBook Conversion',
            'project_cost' => 100,
            'task' => 'Art Work - Cover',
            'status' => 'On-Hold',
            'parent' => 9,
            'calculate' => 0,
        ],

        [
            'service_name' => 'Premium eBook Cover Art',
            'project_cost' => 49,
            'task' => 'Conversion',
            'status' => 'On-Hold',
            'parent' => 9,
            'calculate' => 0,
        ],
        // EBOOK & PRINT VALUE PACKAGE

        // WEB DESIGN
        [
            'service_name' => 'Web Design',
            'project_cost' => 0,
            'task' => 'Web Creation',
            'status' => 'On-Hold',
            'parent' => 10,
            'calculate' => 1,
        ],
        // WEB DESIGN

        // PHYSICAL DIGITAL EBOOK
        [
            'service_name' => 'Physical to Digital',
            'project_cost' => 0,
            'task' => 'Physical to Digital',
            'status' => 'On-Hold',
            'parent' => 11,
            'calculate' => 0,
        ],

        [
            'service_name' => 'Physical to eBook',
            'project_cost' => 0,
            'task' => 'Physical to eBook',
            'status' => 'On-Hold',
            'parent' => 11,
            'calculate' => 0,
        ],
        // PHYSICAL DIGITAL EBOOK

        // EDITING SERVICES
        [
            'service_name' => 'Copyediting',
            'project_cost' => 0,
            'task' => 'Copyediting',
            'status' => 'On-Hold',
            'parent' => 12,
            'calculate' => 0,
        ],

        [
            'service_name' => 'Proofreading',
            'project_cost' => 0,
            'task' => 'Proofreading',
            'status' => 'On-Hold',
            'parent' => 12,
            'calculate' => 0,
        ],

        [
            'service_name' => 'Development Editing',
            'project_cost' => 0,
            'task' => 'Development Editing',
            'status' => 'On-Hold',
            'parent' => 12,
            'calculate' => 0,
        ],
        // EDITING SERVICES
    ];

    private $special_packages = [7, 8, 9];

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (session('success')) {
                Alert::success(session('success'));
            }
            return $next($request);
        });
    }

    public function index($id)
    {
        $pm = projectManager::all();
        $order = order::leftJoin(
            'service_packages',
            'orders.Package_id',
            '=',
            'service_packages.id'
        )
            ->select(
                'orders.*',
                'service_packages.package_name',
                'service_packages.sibling_id',
                'service_packages.id AS pckg_id',
                'orders.updated_at AS orderupdated',
                'orders.Package_id AS PackID',
                'orders.id AS ActivityID'
            )
            ->where('customer_id', $id)
            ->latest('orders.created_at')
            ->get();

        $customer = customer::all()->where('id', $id);

        $packages = service_package::all();

        return view('order', [
            'order' => $order,
            'customer' => $customer,
            'packages' => $packages,
            'pm' => $pm,
        ])->with('id', $id);
    }

    public function Store(request $request)
    {
        $request->validate([
            'customer_id' => 'required',
            'user_id' => 'required',
            'sales_rep' => 'required',
            'remarks' => 'required',
        ]);
        $status = customer::find(request('customer_id'));
        if ($status->customer_status === 'Hold') {
            if (
                request('remarks') === '1st Follow up' ||
                request('remarks') === '2nd Follow up' ||
                request('remarks') === '3rd Follow up'
            ) {
                $last_activity = order::create($request->all());
                return redirect()
                    ->route('order', [request('customer_id')])
                    ->with('success', config('messages.AddActivity'));
            } else {
                $last_activity = order::create($request->all());
                $status->last_activity = $last_activity['id'];
                $status->customer_status = 'Answered';
                $status->reason_hold = null;
                $status->reason_lost = null;
                $status->reason_hold_date = null;
                $status->update();
                return redirect()
                    ->route('order', [request('customer_id')])
                    ->with('success', config('messages.AddActivity'));
            }
        } else {
            $last_activity = order::create($request->all());
            $status->last_activity = $last_activity['id'];
            $status->customer_status = 'Answered';
            $status->reason_hold = null;
            $status->reason_lost = null;
            $status->reason_hold_date = null;
            $status->update();
            return redirect()
                ->route('order', [request('customer_id')])
                ->with('success', config('messages.AddActivity'));
        }
    }

    public function show()
    {
        return view('order');
    }

    public function package_siblings(
        $sibling_id,
        $package_id,
        $setup,
        $package_primary
    ) {
        $package_siblings = [];
        $special_packages = [];
        if ($setup === '1') {
            $package_siblings = service_package::where(
                'sibling_id',
                $sibling_id
            )
                ->where('id', '<>', $package_id)
                ->get()
                ->toArray();

            if (!in_array($package_id, $this->special_packages)) {
                $special_packages = service_package::whereIn(
                    'id',
                    $this->special_packages
                )
                    ->where('id', '<>', $package_id)
                    ->get()
                    ->toArray();
            }

            if ($package_id === '7') {
                $package_siblings = [];
                $special_packages = [];
            }

            return response()->json(
                [...$package_siblings, ...$special_packages],
                200
            );
        } else {
            $package_siblings = service_package::find($package_primary);

            if ($package_siblings->is_lowest > 0) {
                $package_siblings = [];
            } else {
                $package_siblings = service_package::where(
                    'sibling_id',
                    $sibling_id
                )
                    ->where('id', '<>', $package_id)
                    ->get();
            }

            return response()->json([...$package_siblings], 200);
        }
    }

    private function check_service_name_exists($array, $name)
    {
        foreach ($array as $key => $arr) {
            if (strtolower($arr['service_name']) === strtolower($name)) {
                return true;
            }
        }

        return false;
    }

    public function package_customize()
    {
        /* 
            PAYLOAD PROPS [ 
                current_package
                book_id
                selected_package
                selected_setup
            ]
        */
        $payload = request()->input('payload');

        $selected_package_inclusions = array_filter(
            $this->inclusions_array,
            function ($var) use ($payload) {
                return $var['parent'] == $payload['selected_package'];
            }
        );

        if ($payload['selected_setup'] === '1') {
            $won = won_customer::where(
                'customer_id',
                $payload['customer_id']
            )->first();

            $new_inc = service_inclusion::where('book_id', $payload['book_id'])
                ->where('package_id', $payload['current_package'])
                ->get()
                ->toArray();
            if (!empty($new_inc)) {
                foreach ($new_inc as $key => $inc) {
                    if (
                        !$this->check_service_name_exists(
                            $selected_package_inclusions,
                            $inc['service_name']
                        )
                    ) {
                        service_inclusion::where('book_id', $payload['book_id'])
                            ->where('package_id', $payload['current_package'])
                            ->where('service_name', $inc['service_name'])
                            ->delete();
                    }
                }
            }

            foreach ($selected_package_inclusions as $s_key => $selected) {
                $new_inlcusions = service_inclusion::where(
                    'book_id',
                    $payload['book_id']
                )
                    ->where('service_name', $selected['service_name'])
                    ->get()
                    ->toArray();
                if (empty($new_inlcusions)) {
                    service_inclusion::insert([
                        'project_cost' => $selected['project_cost'],
                        'won_id' => $won->id,
                        'package_id' => $payload['selected_package'],
                        'book_id' => $payload['book_id'],
                        'service_name' => $selected['service_name'],
                        'status' => $selected['status'],
                        'task' => $selected['task'],
                    ]);
                }
            }
            service_inclusion::where('book_id', $payload['book_id'])->update([
                'package_id' => $payload['selected_package'],
            ]);
        } else {
            $won = won_customer::where(
                'customer_id',
                $payload['customer_id']
            )->first();
            $new_inlcusions = service_inclusion::where(
                'book_id',
                $payload['book_id']
            )
                ->where('package_id', $payload['current_package'])
                ->get()
                ->toArray();

            if (!empty($new_inlcusions)) {
                foreach ($new_inlcusions as $key => $inc) {
                    if (
                        !$this->check_service_name_exists(
                            $selected_package_inclusions,
                            $inc['service_name']
                        )
                    ) {
                        service_inclusion::where('book_id', $payload['book_id'])
                            ->where('package_id', $payload['current_package'])
                            ->where('service_name', $inc['service_name'])
                            ->delete();
                    }
                }
            }

            foreach ($selected_package_inclusions as $s_key => $selected) {
                // $new_inlcusions = service_inclusion::where('book_id', $payload['book_id'])->where('service_name', $selected['service_name'])->get()->toArray();

                $is_empty = service_inclusion::where(
                    'book_id',
                    $payload['book_id']
                )
                    ->where('package_id', $payload['current_package'])
                    ->where('service_name', $selected['service_name'])
                    ->get()
                    ->toArray();

                if (empty($is_empty)) {
                    service_inclusion::insert([
                        'project_cost' => $selected['project_cost'],
                        'won_id' => $won->id,
                        'package_id' => $payload['selected_package'],
                        'book_id' => $payload['book_id'],
                        'service_name' => $selected['service_name'],
                        'status' => $selected['status'],
                        'task' => $selected['task'],
                    ]);
                }
            }
        }

        order::where('book_id', $payload['book_id'])->update([
            'package_id' => $payload['selected_package'],
        ]);
        book::where('id', $payload['book_id'])->update([
            'package_id' => $payload['selected_package'],
        ]);

        return response()->json(
            ['msg' => 'updated', 'action' => 'package_customize'],
            200
        );
    }

    public function updateCustomerInformation($id)
    {
        $customerInformation = customer::find($id);
        $customerInformation->customer_email = request('customer_email');
        $customerInformation->secondary_email = request('secondary_email');
        $customerInformation->first_email = request('first_email');
        $customerInformation->second_email = request('second_email');
        $customerInformation->third_email = request('third_email');
        $customerInformation->fourth_email = request('fourth_email');
        $customerInformation->fifth_email = request('fifth_email');
        $customerInformation->update();
        return redirect()
            ->route('order', [$id])
            ->with('success', 'Successfull Updated Customer Information');
    }

    public function update(request $request, $id)
    {
        switch (request('customer_status')) {
            case 'Answered':
                return $this->saveOrderStatus(
                    'Answered',
                    $id,
                    null,
                    null,
                    null
                );
                break;

            case 'Lost':
                return $this->saveOrderStatus(
                    'Lost',
                    $id,
                    null,
                    request('Reasonlost'),
                    null
                );
                break;

            case 'Hold':
                return $this->saveOrderStatus(
                    'Hold',
                    $id,
                    request('reason_hold'),
                    null,
                    request('reason_hold_date')
                );
                break;
        }
    }

    public function updateactivity($id)
    {
        $activity = order::find($id);
        $activity->customer_book = request('customer_book');
        $activity->remarks = request('remarks');
        $activity->update();
        return redirect()
            ->route('order', [$activity->customer_id])
            ->with('success', config('messages.updatedactivity'));
    }
    public function DestroyActivity($id)
    {
        $order = order::find($id);
        $order->delete();
        return redirect()
            ->route('order', $order->customer_id)
            ->with('success', config('messages.deleted'));
    }

    public function ConvertCustomer(request $request)
    {
        $is_won_exist = won_customer::where(
            'customer_id',
            '=',
            $request->input('customer_id')
        )->first();

        $convert = [];
        if ($is_won_exist === null) {
            // ID === WON_ID
            $convert = new won_customer();
            $convert->customer_id = request('customer_id');
            $convert->status = 'Won';
            $convert->save();
        }

        // BOOK TABLE
        $book = [];
        $book = new book();
        $book->book_title = request('customer_book');
        $book->old_book_title = request('customer_book');
        $book->package_id = request('Packages');
        $book->transaction_ID = request('transaction_id');
        $book->won_id = request('customer_id');
        $book->total_project_cost = request('project_cost');
        $book->project_manager = request('project_manager');
        $book->save();

        // ORDER TABLE
        $activity = new order();
        $activity->created_at = now()->toDateTimeString();
        $activity->updated_at = now()->toDateTimeString();
        $activity->customer_id = request('customer_id');
        $activity->user_id = request('user_id');
        $activity->sales_rep = request('sales_rep');
        $activity->customer_book = request('customer_book');
        $activity->remarks = 'Won';
        $activity->Package_id = request('Packages');
        $activity->book_id = $book->id;
        $activity->save();

        $group_transactions = book::select('transaction_ID')
            ->where('won_id', '=', request('customer_id'))
            ->groupBy('transaction_ID')
            ->get()
            ->toArray();

        $client_type = '';
        if (count($group_transactions) > 1) {
            $client_type = 'Repeat';
        } elseif (empty($group_transactions)) {
            $client_type = 'New';
        } elseif (count($group_transactions) === 1) {
            $client_type = 'New';
        }

        // CUSTOMER
        $status = customer::find(request('customer_id'));
        $status->customer_status = 'Won';
        $status->reason_hold = null;
        $status->last_activity = $activity['id'];
        $status->reason_lost = null;
        $status->reason_hold_date = null;
        $status->client_type = $client_type;
        $status->update();

        $chosen_num = 0;
        switch (request('Packages')) {
            case 1:
                $chosen_num = 1;
                break;

            case 2:
                $chosen_num = 2;
                break;

            case 3:
                $chosen_num = 3;
                break;

            case 4:
                $chosen_num = 4;
                break;

            case 5:
                $chosen_num = 5;
                break;

            case 6:
                $chosen_num = 6;
                break;

            case 7:
                $chosen_num = 7;
                break;
            case 8:
                $chosen_num = 8;
                break;

            case 9:
                $chosen_num = 9;
                break;

            case 10:
                $chosen_num = 10;
                break;

            case 11:
                $chosen_num = 11;
                break;

            case 12:
                $chosen_num = 12;
                break;

            default:
                # code...
                break;
        }

        $this->createInclusions(
            $this->inclusions_array,
            $book,
            $chosen_num,
            $request
        );
        return redirect()
            ->route('order', [request('customer_id')])
            ->with('success', config('messages.NewConvert'));
    }

    private function createInclusions(
        $arr_inclusions,
        $book,
        $parent_id,
        request $request
    ) {
        if ($parent_id === 11) {
            $found = '';
            foreach ($arr_inclusions as $key => $inclusion) {
                if (
                    $inclusion['parent'] === $parent_id &&
                    $inclusion['service_name'] ===
                        request()->input('fixed_inclusion')
                ) {
                    $found = $inclusion['task'];
                }
            }
            service_inclusion::insert([
                'project_cost' => request()->input('project_cost'),
                'book_id' => $book['id'],
                'package_id' => request()->input('Packages'),
                'won_id' => request()->input('customer_id'),
                'service_name' => request()->input('fixed_inclusion'),
                'task' => $found,
            ]);
        } elseif ($parent_id === 12) {
            $found = '';
            foreach ($arr_inclusions as $key => $inclusion) {
                if (
                    $inclusion['parent'] === $parent_id &&
                    $inclusion['service_name'] ===
                        request()->input('fixed_editing')
                ) {
                    $found = $inclusion['task'];
                }
            }

            service_inclusion::insert([
                'project_cost' => request()->input('project_cost'),
                'book_id' => $book['id'],
                'package_id' => request()->input('Packages'),
                'won_id' => request()->input('customer_id'),
                'service_name' => request()->input('fixed_editing'),
                'task' => $found,
            ]);
        } else {
            foreach ($arr_inclusions as $key => $inclusion) {
                if ($inclusion['parent'] === $parent_id) {
                    if ($inclusion['calculate'] === 1) {
                        $inclusion[
                            'project_cost'
                        ] = $this->caculateInclusionCost(
                            $arr_inclusions,
                            $request,
                            $parent_id
                        );
                    }
                    unset($inclusion['parent']);
                    unset($inclusion['calculate']);
                    $inclusion['won_id'] = request()->input('customer_id');
                    $inclusion['package_id'] = request()->input('Packages');
                    $inclusion['book_id'] = $book['id'];
                    service_inclusion::insert($inclusion);
                }
            }
        }
    }

    private function caculateInclusionCost($item, request $request, $parent_id)
    {
        $total = 0;
        $total_cost = request()->input('project_cost');
        foreach ($item as $key => $inclusion) {
            if (
                $inclusion['project_cost'] > 0 &&
                $inclusion['parent'] === $parent_id
            ) {
                $total_cost = $total_cost - $inclusion['project_cost'];
            }
        }

        return $total_cost;
    }
    public function deleteServiceInclusions($id)
    {
        $bookInfo = book::find($id);
        $serviceInclusions = service_inclusion::where('book_id', $id);
        $activity = order::where('book_id', $id)->first();
        $activity->delete();
        $bookInfo->delete();
        $serviceInclusions->delete();

        return back();
    }
}
