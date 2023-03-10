@extends('welcome')

@section('content')
<div class="row">
    <div class="col-8">
        <table id="inv-table" class="table">
            <thead>
                <tr>
                    <th>FRUIT</th>
                    @foreach ($accounts as $account)
                    <th class='center'>{{ $account->username }} ({{ count($account->fruits) }})</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach($fruits as $fruit)
                <tr class='type-{{ $fruit->type }}'>
                    <td>{{ $fruit->name }}</td>
                    @foreach ($accounts as $account)
                    <td class='center'>
                        @php
                        $filtered_collection = $account->fruits->filter(function ($item) use($fruit) {
                        return $item->fruit_id == $fruit->id;
                        })->pluck('quantity')->first();
                        @endphp

                        @for($i = 1; $i <= $account->storage_ctr; $i++)
                        @if($i <= $filtered_collection)
                        <input type="checkbox" onchange='updateStorage(this)' data-account='{{ $account->id }}' data-fruit='{{ $fruit->id }}' checked/>
                        @else
                        <input type="checkbox" onchange='updateStorage(this)' data-account='{{ $account->id }}' data-fruit='{{ $fruit->id }}' />
                        @endif
                        @endfor
                    </td>
                    @endforeach
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class='col-4 mt-5'>
        <div>
            <div class="form-group mb-3">
                <label for="exampleInputPassword1"><b>Fruit Spin</b></label>
                <div class="row">
                    <div class="col-6">
                        <input type="text" class="form-control" id="spin">
                    </div>
                    <div class="col-6">
                        <span class="form-control" id="spin-standard"></span>
                    </div>
                </div>
            </div>
            <div class="form-group mb-3">
                <div class="row">
                    <div class="col-6">
                        <label class='font-bold'><b>Current Server 1</b></label>
                        <input type="text" class="form-control" id="servername">
                    </div>
                    <div class="col-3">
                        <label class='font-bold'><b>Raid</b></label>
                        <input type="text" class="form-control" id="factory">
                    </div>
                    <div class="col-3">
                        <label class='font-bold'>&nbsp;</label>
                        <span class="form-control" id="factory-standard"></span>
                    </div>
                </div>
            </div>
            <div class="form-group mb-3">
                <div class="row">
                    <div class="col-6">
                        <label class='font-bold'><b>Current Server 2</b></label>
                        <input type="text" class="form-control" id="servername1">
                    </div>
                    <div class="col-3">
                        <label class='font-bold'><b>Raid</b></label>
                        <input type="text" class="form-control" id="factory1">
                    </div>
                    <div class="col-3">
                        <label class='font-bold'>&nbsp;</label>
                        <span class="form-control" id="factory1-standard"></span>
                    </div>
                </div>
            </div>
            <div class="form-group mb-3">
                <div class="row">
                    <div class="col-6">
                        <label class='font-bold'><b>Current Server 3</b></label>
                        <input type="text" class="form-control" id="servername2">
                    </div>
                    <div class="col-3">
                        <label class='font-bold'><b>Raid</b></label>
                        <input type="text" class="form-control" id="factory2">
                    </div>
                    <div class="col-3">
                        <label class='font-bold'>&nbsp;</label>
                        <span class="form-control" id="factory2-standard"></span>
                    </div>
                </div>
            </div>
            <div class="form-group mb-3">
                <div class="row">
                    <div class="col-6">
                        <label class='font-bold'><b>Current Server 4</b></label>
                        <input type="text" class="form-control" id="servername3">
                    </div>
                    <div class="col-3">
                        <label class='font-bold'><b>Raid</b></label>
                        <input type="text" class="form-control" id="factory3">
                    </div>
                    <div class="col-3">
                        <label class='font-bold'>&nbsp;</label>
                        <span class="form-control" id="factory3-standard"></span>
                    </div>
                </div>
            </div>
            <div class="form-group mb-3">
                <button onclick='recalculate()' class="btn btn-primary">Recalculate</button>
            </div>
        </div>
    </div>
    @endsection


    @section('scripts')
    <script>
        function updateStorage(el)
        {
            var isCheck = $(el).is(":checked");
            var accId = $(el).data('account');
            var fruitId = $(el).data('fruit');

            $.ajax({
                url: "{{ route('inv.update') }}",
                method: 'post',
                data: {
                    isCheck: isCheck,
                    account_id: accId,
                    fruit_id: fruitId,
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            }).done(function () {
                console.log('updated');
            });
        }

        function recalculate()
        {
            var servername = $('#servername').val();
            var servername1 = $('#servername1').val();
            var servername2 = $('#servername2').val();
            var servername3 = $('#servername3').val();

            if (servername) {
                setCookie('servernamesaved', servername, 1000);
            }

            if (servername1) {
                setCookie('servername1saved', servername1, 1000);
            }

            if (servername2) {
                setCookie('servername2saved', servername2, 1000);
            }

            if (servername3) {
                setCookie('servername3saved', servername3, 1000);
            }

            var factory = $('#factory').val();
            var factory1 = $('#factory1').val();
            var factory2 = $('#factory2').val();
            var factory3 = $('#factory3').val();
            var fist = $('#fist').val();
            var spin = $('#spin').val();

            setNewTime('factory', 90);
            setNewTime('factory1', 90);
            setNewTime('factory2', 90);
            setNewTime('factory3', 90);
            setNewTime('fist', 240);
            setNewTime('spin', 120);
        }

        function setNewTime(el, minutes) {
            var elVal = $('#' + el).val();
            var eTime = moment(elVal, "HH:mm");

            if (moment().isAfter(eTime)) {
                var newTime = eTime.add(minutes, 'minutes');
                $('#' + el).val(newTime.format('HH:mm'));

                $('#' + el + '-standard').html(newTime.format('hh:mm A'));

                setCookie(el + 'saved', newTime.format('HH:mm'), 1000);
            }
        }

        $(document).ready(function () {
            var table = $('#inv-table').DataTable({
                paging: false,
                ordering: false,
                info: false,
            });

            var factory = getCookie('factorysaved');
            var factory1 = getCookie('factory1saved');
            var factory2 = getCookie('factory2saved');
            var factory3 = getCookie('factory3saved');
            var fist = getCookie('fistsaved');
            var spin = getCookie('spinsaved');
            var servername = getCookie('servernamesaved');
            var servername1 = getCookie('servername1saved');
            var servername2 = getCookie('servername2saved');
            var servername3 = getCookie('servername3saved');

            $('#factory').val(factory);
            $('#factory1').val(factory1);
            $('#factory2').val(factory2);
            $('#factory3').val(factory3);
            $('#fist').val(fist);
            $('#spin').val(spin);
            $('#servername').val(servername);
            $('#servername1').val(servername1);
            
            setStandardTime('factory');
            setStandardTime('factory1');
            setStandardTime('factory2');
            setStandardTime('factory3');
            setStandardTime('fist');
            setStandardTime('spin');
        });

        function setStandardTime(el) {
            var elVal = $('#' + el).val();
            if(elVal) {
                var eTime = moment(elVal, "HH:mm");

                $('#' + el + '-standard').html(eTime.format('hh:mm A'));
            }
        }

        function getCookie(cname) {
            var name = cname + "=";
            var ca = document.cookie.split(';');
            for (var i = 0; i < ca.length; i++) {
                var c = ca[i];
                while (c.charAt(0) == ' ')
                    c = c.substring(1);
                if (c.indexOf(name) == 0)
                    return c.substring(name.length, c.length);
            }
            return "";
        }

        function setCookie(cname, cvalue, exdays) {
            var d = new Date();
            d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
            var expires = "expires=" + d.toUTCString();
            document.cookie = cname + "=" + cvalue + "; " + expires;
        }
    </script>
    @endsection

    @section('styles')
    <style>
        * {
            text-transform: uppercase;
        }
        .type-1 {
            background: #b3b3b3 !important;
        }
        .type-2 {
            background: #5c8cd3 !important;
        }
        .type-3 {
            background: #8c52ff !important;
            color: #fff;
        }
        .type-4 {
            background: #d52be4 !important;
            color: #fff;
        }
        .type-5 {
            background: #d22a2c !important;
            color: #fff;
        }
        td {
            padding: 10px;
            font-weight: bold;
        }
        td.center {
            text-align: center;
        }
        input[type='checkbox'] {
            width: 20px;
            height: 20px;
        }
        tbody {
            display:block;
            height:775px;
            overflow:auto;
        }
        thead, tbody tr {
            display:table;
            width:100%;
            table-layout:fixed;
        }
        thead {
            width: calc( 100% - 1em )
        }
    </style>



    @endsection
