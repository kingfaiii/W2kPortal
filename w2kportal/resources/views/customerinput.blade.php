@extends('layouts.table')
@extends('layouts.app')
@include('sweetalert::alert')

@section('content')
    <form id="customerinput_form" name="customerinput_form" method="POST">
        @csrf
        <?php
        $classification = ['eBook Conversion', 'Interior Formatting'];
        $layout = ['eBook Conversion'];
        $count = ['eBook Conversion', 'Interior Formatting', 'Development Editing', 'Copyediting'];
        $qaAndQAScore = ['Development Editing', 'Copyediting'];
        ?>
    @section('header')
        <div class="col-md-5">
            <p class="h2 text-white font-weight-bold">Convert Customer Details</p>
        </div>
        <div class="col-md-7">
            <div class="row mt-2">
                <div class="col-md-3">
                    @foreach ($customer_information as $customer_informations)
                        <a href="{{ route('order', [$customer_informations->won_id]) }}"
                            class="btn col-12 btn-info text-white ">Customer Information</a>
                    @endforeach
                </div>

                <div class="col-md-3">
                    <x-modal-button>
                        <x-slot name="targetID">#updateBookTitle</x-slot>
                        <x-slot name="btnClass">btn btn-info text-white col-12</x-slot>
                        Book Title
                    </x-modal-button>
                </div>
                <div class="col-md-2">
                    <a href="{{ route('HistoryLog', [request()->segment(count(request()->segments()))]) }}"
                        class="btn btn-info col-12  text-white ">History</a>
                </div>

                <div class="col-md-2">
                    @foreach ($customer_information as $c)
                        <a href="javascript:void(0)" data-book="{{ $c->bookID }}" data-customer="{{ $c->id }}"
                            data-package="{{ $c->pckg_id }}" data-setup="1" data-sibling="{{ $c->sibling_id }}"
                            class="btn btn-info text-white col-12" id="btn_uprade_package"
                            data-target="#package_subscription" data-toggle="modal">Upgrade</a>
                    @endforeach
                </div>

                <div class="col-md-2">
                    @foreach ($customer_information as $c)
                        <a href="javascript:void(0)" data-book="{{ $c->bookID }}" data-customer="{{ $c->id }}"
                            data-package="{{ $c->pckg_id }}" data-setup="2" data-sibling="{{ $c->sibling_id }}"
                            data-package-id="{{ $c->pckg_primary }}" class="btn btn-info text-white col-12"
                            id="btn_downgrade_package" data-target="#package_subscription" data-toggle="modal">Downgrade</a>
                    @endforeach
                </div>
            </div>
        </div>
    @endsection

    @section('otherforms')
        @foreach ($customer_information as $item)
            <div class="row mt-3 ml-2">
                <div class="col-md-5">
                    <div class="form-group row">
                        <p class="text-white h5">Customer Name:</p>
                        <div class="col-sm-6">
                            <h5 class="text-white">{{ $item->customer_fname }} {{ $item->customer_lname }}</h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="form-group row">
                        <p class="text-white h5">Book Title:</p>
                        <div class="col-sm-6">
                            <h5 class="text-white">{{ $item->book_title }}</h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row ml-2">
                <div class="col-md-5">
                    <div class="form-group row">
                        <p class="text-white h5">Email Address:</p>
                        <div class="col-sm-6">
                            <h5 class="text-white">{{ $item->customer_email }}</h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="form-group row">
                        <p class="text-white h5">Service:</p>
                        <div class="col-sm-6">
                            <h5 class="text-white">{{ $item->package_name }}</h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row ml-2">
                <div class="col-md-5">
                    <div class="form-group row">
                        <p class="text-white h5">Date Inquire:</p>
                        <div class="col-sm-6">
                            <h5 class="text-white">{{ $item->customer_createdAt }}</h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="form-group row">
                        <p class="text-white h5">Payment Date:</p>
                        <div class="col-sm-6">
                            <h5 class="text-white">{{ $item->won_createdAt }}</h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row ml-2">
                <div class="col-md-5">
                    <div class="form-group row">
                        <p class="text-white h5">Total Project Cost:</p>
                        <div class="col-sm-6">
                            <h5 class="text-white">${{ $item->cost }}</h5>
                        </div>

                    </div>
                </div>
                <div class="col-md-5">
                    <div class="form-group row">
                        <p class="text-white h5">Transaction ID:</p>
                        <div class="col-sm-6">
                            <h5 class="text-white">{{ $item->transaction_ID }}</h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row ml-2">
                <div class="col-md-5">

                </div>
                <div class="col-md-5">
                    <div class="form-group row">
                        <p class="text-white h5">Project Manager:</p>
                        <div class="col-sm-6">
                            <h5 class="text-white">{{ $item->project_manager }}</h5>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endsection
    @section('table')

        <div style="width:100%;" class="table-wrapper-scroll-x my-custom-scrollbar">
            <table class="table table-stripped">
                <thead class="text-center">
                    <th>Service Inclusions</th>
                    <th>Project Cost</th>
                    <th>Layout</th>
                    <th>Page/Word Count</th>
                    <th>Project Classification</th>
                    <th>Turnaround Time</th>
                    <th>Status</th>
                    <th>Task</th>
                    <th>Commitment Date</th>

                </thead>
                <tbody>

                    @foreach ($book_information as $item)

                        <tr data-id="{{ $item['serID'] }}"
                            class="text-center align-center justify-content-center upper-row">
                            <input type="hidden" name="items[{{ $item['serID'] }}][service_id]"
                                value="{{ $item['serID'] }}">
                            <input type="hidden" name="items[{{ $item['serID'] }}][layout_by]"
                                value="{{ $item['layout_by'] }}">
                            <input type="hidden" name="items[{{ $item['serID'] }}][page_count_by]"
                                value="{{ $item['page_count_by'] }}">
                            <input type="hidden" name="items[{{ $item['serID'] }}][project_classification_by]"
                                value="{{ $item['project_classification_by'] }}">
                            <input type="hidden" name="items[{{ $item['serID'] }}][turnaround_time_by]"
                                value="{{ $item['turnaround_time_by'] }}">
                            <input type="hidden" name="items[{{ $item['serID'] }}][status_by]"
                                value="{{ $item['status_by'] }}">
                            <input type="hidden" name="items[{{ $item['serID'] }}][commitment_date_by]"
                                value="{{ $item['commitment_date_by'] }}">
                            <input type="hidden" name="items[{{ $item['serID'] }}][owner_by]"
                                value="{{ $item['owner_by'] }}">
                            <input type="hidden" name="items[{{ $item['serID'] }}][job_cost_by]"
                                value="{{ $item['job_cost_by'] }}">
                            <input type="hidden" name="items[{{ $item['serID'] }}][date_assigned_by]"
                                value="{{ $item['date_assigned_by'] }}">
                            <input type="hidden" name="items[{{ $item['serID'] }}][date_completed_by]"
                                value="{{ $item['date_completed_by'] }}">
                            <input type="hidden" name="items[{{ $item['serID'] }}][quality_assurance_by]"
                                value="{{ $item['quality_assurance_by'] }}">
                            <input type="hidden" name="items[{{ $item['serID'] }}][quality_score_by]"
                                value="{{ $item['quality_score_by'] }}">
                            <input type="hidden" name="items[{{ $item['serID'] }}][uid_by]"
                                value="{{ $item['uid_by'] }}">
                            <input type="hidden" name="items[{{ $item['serID'] }}][project_link_by]"
                                value="{{ $item['project_link_by'] }}">
                            <td> {{ $item['service_name'] }} </td>
                            <td> ${{ $item['project_cost'] ? $item['project_cost'] : '0' }} </td>
                            <td>
                                @if (in_array($item['service_name'], $layout))
                                    <select class="form-control customerinput-text" style="width:115%"
                                        name="items[{{ $item['serID'] }}][layout]" id="">
                                        <option selected value="{{ $item['layout'] }}">{{ $item['layout'] }}
                                        </option>
                                        <option value="Reflowable">Reflowable</option>
                                        <option value="Fixed Virtual">Fixed Virtual</option>
                                        <option value="Fixed Hidden">Fixed Hidden</option>
                                        <option value="Combination">Combination</option>
                                    </select>
                                @else
                                    <select class="form-control customerinput-text disabled-field" style="width:115%"
                                        name="items[{{ $item['serID'] }}][layout]" id="" disabled>
                                        <option selected value="{{ $item['layout'] }}">{{ $item['layout'] }}
                                        </option>
                                        <option value="Reflowable">Reflowable</option>
                                        <option value="Fixed Virtual">Fixed Virtual</option>
                                        <option value="Fixed Hidden">Fixed Hidden</option>
                                        <option value="Combination">Combination</option>
                                    </select>
                                @endif
                            </td>
                            <td>

                                @if (in_array($item['service_name'], $count))

                                    <input type="text" value="{{ explode('*', $item['page_count'])[0] }}"
                                        style="margin-left:25%"
                                        class="form-control justify-content-center col-6 customerinput-text customer-pagecount"
                                        name="items[{{ $item['serID'] }}][page_count]" id="">
                                @else
                                    <input type="text" value="{{ $item['page_count'] }}" style="margin-left:25%"
                                        class="form-control justify-content-center col-6 customerinput-text disabled-field"
                                        name="items[{{ $item['serID'] }}][page_count]" id="" disabled>

                                @endif

                            </td>
                            <td>
                                @if (in_array($item['service_name'], $classification))
                                    <select class="form-control customerinput-text"
                                        name="items[{{ $item['serID'] }}][project_classification]" id="">
                                        <option selected value=" {{ $item['project_classification'] }}">
                                            {{ explode('*', $item['project_classification'])[0] }}</option>
                                        <option value="Simple">Simple</option>
                                        <option value="Moderate">Moderate</option>
                                        <option value="Complex">Complex</option>
                                        <option value="Difficult">Difficult</option>
                                    </select>
                                @else
                                    <select class="form-control customerinput-text disabled-field"
                                        name="items[{{ $item['serID'] }}][project_classification]" id="" disabled>
                                        <option selected value=" {{ $item['project_classification'] }}">
                                            {{ $item['project_classification'] }} </option>
                                        <option value="Simple">Simple</option>
                                        <option value="Moderate">Moderate</option>
                                        <option value="Complex">Complex</option>
                                        <option value="Difficult">Difficult</option>
                                    </select>
                                @endif

                            </td>
                            <td>
                                <input type="text" name="items[{{ $item['serID'] }}][turnaround_time]"
                                    value="{{ explode('*', $item['turnaround_time'])[0] }}" id="" style="margin-left:25%"
                                    class="form-control col-6 turnaround-time customerinput-text" maxlength="2">
                            </td>
                            <td>
                                <select class="form-control customerinput-status mx-auto w-auto customerinput-text" style=""
                                    name="items[{{ $item['serID'] }}][status]" data-id="{{ $item['id'] }}"
                                    data-service="{{ $item['serID'] }}" id="customerinput_status">
                                    <option selected value="{{ $item['status'] }}">
                                        {{ explode('*', $item['status'])[0] }} </option>
                                    <option value="Completed">Completed</option>
                                    <option value="On-going">On-going</option>
                                    <option value="On Hold">On Hold</option>
                                </select>
                            </td>
                            <td> {{ $item['task'] }} </td>
                            @php
                                $date = $item['commitment_date'];
                                
                            @endphp
                            @if ($item['commitment_date'])

                                <td> <input placeholder="mm/dd/yyyy" type="text"
                                        name="items[{{ $item['serID'] }}][commitment_date]"
                                        value="{{ str_replace('-', '/', $date) }}" style="margin-left:5%"
                                        id="date_timepicker_end" class="form-control col-11 commitment-date" readonly> </td>
                            @else
                                <td> <input readonly placeholder="mm/dd/yyyy" type="text"
                                        name="items[{{ $item['serID'] }}][commitment_date]" value=""
                                        style="margin-left:5%" id="date_timepicker_end"
                                        class="form-control col-11 commitment-date" readonly> </td>
                            @endif
                        </tr>
                    @endforeach

                </tbody>
            </table>
            <table class="table table-stripped">
                <thead class="text-center">
                    <th>Service Inclusions</th>
                    <th>Owner</th>
                    <th>Job Cost</th>
                    <th>Date Assigned</th>
                    <th>Date Completed</th>
                    <th>QA</th>
                    <th>QA Score</th>
                    <th>UID</th>
                    <th>Project Link</th>
                </thead>
                <tbody>
                    @foreach ($book_information as $item)
                        <tr class="text-center bottom-row">
                            <input type="hidden" name="items[{{ $item['serID'] }}][service_id]"
                                value="{{ $item['serID'] }}">
                            <td> {{ $item['service_name'] }} </td>
                            <td>
                                <select name="items[{{ $item['serID'] }}][owner]" id="" style=""
                                    class="form-control w-auto customerinput-text">
                                    <option value="{{ $item['owner'] }}">{{ explode('*', $item['owner'])[0] }}
                                    </option>
                                    @foreach ($owner as $owner_row)
                                        <option
                                            value="{{ $owner_row['owner_fname'] }} {{ $owner_row['owner_lname'] }}">
                                            {{ $owner_row['owner_fname'] }} {{ $owner_row['owner_lname'] }}</option>
                                    @endforeach
                                </select>

                            </td>

                            <td>
                                <div class="input-group-prepend">
                                    <div class="input-group-text rounded-0"><i class="bi bi-currency-dollar"></i></div>
                                    <input type="text" name="items[{{ $item['serID'] }}][job_cost]"
                                        value="{{ explode('*', $item['job_cost'])[0] }} " id=""
                                        class="form-control rounded-0 col-8 customerinput-text job-cost">
                                </div>
                            </td>
                            <td> <input placeholder="mm/dd/yyyy" data-id="{{ $item['id'] }}" type="text"
                                    name="items[{{ $item['serID'] }}][date_assigned]"
                                    data-old="{{ $item['date_assigned_old'] }}"
                                    value="{{ explode('*', $item['date_assigned'])[0] }}"
                                    class="form-control datepicker col-11 customerinput-text date-assigned" readonly> </td>
                            <td> <input placeholder="mm/dd/yyyy" type="text"
                                    name="items[{{ $item['serID'] }}][date_completed]"
                                    value="{{ explode('*', $item['date_completed'])[0] }}" id=""
                                    class="form-control datepicker col-11 customerinput-text" readonly> </td>
                            <td>
                                <select name="items[{{ $item['serID'] }}][quality_assurance]" id=""
                                    data-id="{{ $item['serID'] }}" style=""
                                    class="form-control qaName mx-auto w-auto customerinput-text">
                                    @if ($item['quality_assurance'])
                                        <option selected value=" {{ $item['quality_assurance'] }} " disabled>
                                            {{ explode('*', $item['quality_assurance'])[0] }} </option>
                                    @else
                                        <option selected value="">
                                            N/A </option>
                                    @endif

                                    @foreach ($qa as $qa_row)
                                        <option value="{{ $qa_row['qa_fname'] }} {{ $qa_row['qa_lname'] }}">
                                            {{ $qa_row['qa_fname'] }} {{ $qa_row['qa_lname'] }}</option>
                                    @endforeach
                                </select>
                            </td>

                            <td>
                                <div class="input-group-prepend">
                                    <div class="input-group-text  rounded-0"><i class="bi bi-percent"></i></div>
                                    <input style="" id="" name="items[{{ $item['serID'] }}][quality_score]"
                                        onkeypress="isNumberKey(this, event);"
                                        class="form-control qaScore customerinput-text"
                                        value={{ $item['quality_score'] }}>
                                </div>
                            </td>
                            <td> <input type="text" name="items[{{ $item['serID'] }}][uid]"
                                    value="{{ explode('*', $item['uid'])[0] }}" id=""
                                    class="form-control customerinput-text"></td>
                            <td> <input type="text" name="items[{{ $item['serID'] }}][project_link]"
                                    value="{{ explode('*', $item['project_link'])[0] }} " id=""
                                    class="form-control customerinput-text"> </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endsection
    @section('footer')
        <div class="card-footer bg-secondary">
            <div class="row">
                <div class="col-md-6">
                    <input type="submit" id="customerinput_update" class="btn btn-success col-12" value="Update">
                </div>
                <div class="col-md-6">
                    <input type="submit" class="btn btn-danger col-12" value="Cancel">
                </div>
            </div>
        </div>
    </form>
    @include('sweetalert::alert')
    @foreach ($customer_information as $customer_informations)
        <x-modal>
            <x-slot name="route">{{ route('upBookInfo', [request()->segment(count(request()->segments()))]) }}</x-slot>
            <x-slot name="idtarget">updateBookTitle</x-slot>
            <x-slot name="modalHeaderTitle">Update Book Title Information</x-slot>
            <x-slot name="modalValueInput">Update Book Title</x-slot>
            <input type="text" name="book_title" id="" value="{{ $customer_informations->book_title }}"
                placeholder="Book Title" class="form-control">
            <input hidden type="text" name="old_book_title" id="" value="{{ $customer_informations->book_title }}"
                placeholder="old Book Title" class="form-control">
            <input hidden type="text" name="customer_id" id="" value="{{ $customer_informations->won_id }}"
                placeholder="old Book Title" class="form-control">
            <input hidden type="text" name="book_id" id=""
                value="{{ request()->segment(count(request()->segments())) }}" placeholder="book_id"
                class="form-control">
        </x-modal>
    @endforeach

    {{-- PACKAGE SUBSCRIPTION --}}
    <form id="package_subscription_form">
        @csrf
        <div class="modal fade" id="package_subscription" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content bg-dark">
                    <div class="modal-header text-center">
                        <h5 class="modal-title text-white" id="exampleModalLongTitle">Package Subscription</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span class="text-white" aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p class="text-white">Available Packages:</p>
                        <input type="hidden" name="payload[current_package]" id="modal_current_package">
                        <input type="hidden" name="payload[book_id]" id="modal_current_book">
                        <input type="hidden" name="payload[customer_id]" id="modal_customer">
                        <input type="hidden" name="payload[selected_setup]" id="modal_setup">
                        <select name="payload[selected_package]" id="modal_packages_id" class="form-control col-12"
                            Value="">
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <a href="javascript:void(0)" type="button" class="btn btn-secondary" id="modify_package"
                            data-dismiss="modal">Submit</a>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection


{{-- PACKAGE SUBSCRIPTION --}}
<script>
    const calcWorkingDays = (fromDate, days) => {
        let count = 0;

        while (count < parseInt(days)) {
            fromDate.setDate(fromDate.getDate() + 1);
            if (fromDate.getDay() != 0 && fromDate.getDay() != 6) // Skip weekends
                count++;
        }
        let d = new Date(fromDate)
        return `${d.getMonth() + 1}/${d.getDate()}/${d.getFullYear()}`;
    }

    const toggleDisabled = (isDisabled = false) => {
        $('.disabled-field').each(function() {
            if (!isDisabled) {
                $(this).removeAttr('disabled')
            } else {
                $(this).prop('disabled', true)
            }
        })
    }

    const messagePrompt = async (title = "", text = "", showCancel = false, icon = "info", textConfirm) => {
        return await Swal.fire({
            title: title,
            text: text,
            icon: icon,
            showCancelButton: showCancel,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: textConfirm
        })

    }

    $(document).ready(function() {

        let turnAroundTime = 0;
        const d = new Date()
        const isDecimal = /^\d+(\.\d{1,2})?$/;
        const monthNames = ["January", "February", "March", "April", "May", "June", "July", "August",
            "September", "October", "November", "December"
        ];
        const currentDate = `${d.getDate()}/${monthNames[d.getMonth()]}/${d.getFullYear()}`

        $('.qaName').each(function() {
            const service_id = $(this).data('id')
            const qaScore = $(`input[name="items[${service_id}][quality_score]"]`)

            if (!this.value) {
                qaScore.prop('disabled', true)
            }
        })

        $('.qaName').on('change', function() {
            const service_id = $(this).data('id')
            const qaScore = $(`input[name="items[${service_id}][quality_score]"]`)

            if (this.value) {
                qaScore.prop('disabled', false)
            } else {
                qaScore.prop('disabled', true)
            }
        })

        $('.customerinput-status').on('change', function() {
            const service_id = $(this).data('service')
            const dateAssigned = $(`input[name="items[${service_id}][date_assigned]"]`)
            if (this.value === 'On-going' && parseInt(turnAroundTime) > 0) {
                $(this).closest('tr').find('.commitment-date').val(calcWorkingDays(new Date(
                    currentDate), turnAroundTime))
            }

            if (this.value === "On Hold") {
                dateAssigned.val('')
            }
        })

        $('.turnaround-time').keyup(function() {
            if (this.value != this.value.replace(/[^0-9\.]/g, '')) {
                this.value = this.value.replace(/[^0-9\.]/g, '');
            }

            turnAroundTime = this.value
            let inputStatus = $(this).closest('tr').find('.customerinput-status').val()

            if (inputStatus === 'On-going' && parseInt(turnAroundTime) > 0) {
                $(this).closest('tr').find('.commitment-date').val(calcWorkingDays(new Date(
                    currentDate), turnAroundTime))
            }
        });

        $('.customer-pagecount').keypress(function(evt) {
            return /\d/.test(String.fromCharCode(evt.keyCode));
        })

        $('.qaScore, .job-cost').keypress(function(evt) {
            evt = (evt) ? evt : window.event;
            let charCode = (evt.which) ? evt.which : evt.keyCode;
            if (charCode == 8 || charCode == 37) {
                return true;
            } else if (charCode == 46 && $(this).val().indexOf('.') != -1) {
                return false;
            } else if (charCode > 31 && charCode != 46 && (charCode < 48 || charCode > 57)) {
                return false;
            }

            return true;
        });

        $('#customerinput_update').on('click', async function(e) {
            e.preventDefault()
            const arrFormValidation = []

            $('.customerinput-text').each(function() {
                const inputValue = $.trim($(this).val())

                if (!inputValue) arrFormValidation.push(inputValue)
            })

            if (arrFormValidation.length === $('.customerinput-text').length) {
                await messagePrompt('The Form is Empty', "", false, "error", "Ok")

                return
            }

            let arr = $('#customerinput_form').serialize();

            const globalDecInputs = $(
                '.customerinput-text:not(:disabled):not([readonly="readonly"]):not([type="hidden"])'
            )

            $('.upper-row').each(async function() {
                const service_id = $(this).data('id')
                const inputsArray = $(this).closest('tr').find(
                    ':input:not(:disabled):not([readonly="readonly"]):not([type="hidden"])'
                )
                const dateAssigned = $(
                    `input[name="items[${service_id}][date_assigned]"]`)
                const assignedOld = dateAssigned.data('old')
                const inpStatus = $(`select[name="items[${service_id}][status]"]`)

                let ctr = 0,
                    currentLength = inputsArray.length

                if (inpStatus.val() === 'On-going' && !dateAssigned.val() && $.trim(
                        assignedOld)) {
                    dateAssigned.addClass('border border-danger')
                } else {
                    dateAssigned.removeClass('border border-danger')
                }

                const nullInputs = inputsArray.filter(function() {
                    return $.trim($(this).val()) === ''
                })

                inputsArray.each(function() {
                    $(this).removeClass('border border-danger')
                })

                if (nullInputs.length !== currentLength) {
                    nullInputs.each(function() {
                        $(this).addClass('border border-danger')
                    })
                }

            })

            let msgResult = ''
            const errorInputs = globalDecInputs.filter(function() {
                return $(this).hasClass('border border-danger');
            })

            if (errorInputs.length > 0) {
                await messagePrompt('Complete All Red Textboxes', "", false, "error", "Ok")
                return
            } else {
                msgResult = await messagePrompt("Are you sure?",
                    'This Service Inclusion will be Updated', true, 'warning', "Yes Update it!!"
                )
            }

            if (msgResult.isConfirmed && errorInputs.length === 0) {
                toggleDisabled(false)
                $.ajax({
                    type: "POST",
                    url: "/won/books/edit/update",
                    data: decodeURIComponent(escape(arr)),
                    success: async function(data, xhr, status) {
                        if (xhr === 'success') {
                            const res = await messagePrompt('Successfully Updated', "",
                                false, "success", "Got it")

                            return res.isConfirmed ? location.reload() : false
                        }
                    },
                    complete: function() {
                        toggleDisabled(true)
                    },
                    error: async function(data, xhr, status) { // if error occured
                        let message = ''
                        const element_name = data.responseJSON.element_name

                        if (data.responseJSON.msg) {
                            message = data.responseJSON.msg
                        } else {
                            message = 'Error occured.please try again'
                        }
                        await messagePrompt(message, "", false, "error", "Ok")

                    },
                })

            }

        })


        $('#package_subscription').on('hidden.bs.modal', function(e) {
            $('#modal_packages_id').empty()
        })

        $('#btn_uprade_package').on('click', function(e) {
            e.preventDefault()
            const sibling_id = $(this).data('sibling')
            const package_id = $(this).data('package')
            const customer_id = $(this).data('customer')
            const book_id = $(this).data('book')
            const packageSetup = $(this).data('setup')

            $('#modal_current_package').val(package_id)
            $('#modal_current_book').val(book_id)
            $('#modal_customer').val(customer_id)
            $('#modal_setup').val(packageSetup)

            $('#modal_packages_id').append(new Option('Select a Package', ''))
            $.ajax({
                type: "GET",
                url: `/order/list/packages/subscriptions/${sibling_id}/${package_id}/${packageSetup}/0`,
                success: function(data, xhr, status) {
                    if (xhr === 'success') {
                        if (data.length > 0) {
                            data.map((k) => {
                                $('#modal_packages_id').append(new Option(k
                                    .package_name, k.id))
                            })

                        }
                    }
                },
                complete: function() {},
                error: function(data, xhr, status) {},
            })
        })

        $('#btn_downgrade_package').on('click', function(e) {
            e.preventDefault()
            const sibling_id = $(this).data('sibling')
            const package_id = $(this).data('package')
            const customer_id = $(this).data('customer')
            const book_id = $(this).data('book')
            const packageSetup = $(this).data('setup')
            const package_primary = $(this).data('package-id')

            $('#modal_current_package').val(package_id)
            $('#modal_current_book').val(book_id)
            $('#modal_customer').val(customer_id)
            $('#modal_setup').val(packageSetup)

            $('#modal_packages_id').append(new Option('Select a Package', ''))
            $.ajax({
                type: "GET",
                url: `/order/list/packages/subscriptions/${sibling_id}/${package_id}/${packageSetup}/${package_primary}`,
                success: function(data, xhr, status) {
                    if (xhr === 'success') {
                        if (data.length > 0) {
                            data.map((k) => {
                                $('#modal_packages_id').append(new Option(k
                                    .package_name, k.id))
                            })

                        }
                    }
                },
                complete: function() {},
                error: function(data, xhr, status) {},
            })
        })

        $('#modify_package').on('click', function(e) {
            $.ajax({
                type: "POST",
                url: `/order/modify/packages/subscriptions`,
                data: $('#package_subscription_form').serialize(),
                success: function(data, xhr, status) {
                    if (xhr === 'success') {
                        location.reload()
                    }
                },
                complete: function() {},
                error: function(data, xhr, status) {},
            })
        })
    })
</script>
@endsection
