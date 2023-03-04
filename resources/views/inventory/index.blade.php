@extends('welcome')

@section('content')
<div class="row">
    <div class="col-10">
        <table class="table">
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
    <div class='col-2 mt-5'>
        <div>
            <div class="form-group mb-3">
                <label class='font-bold'>Factory Raid</label>
                <div class="row">
                    <div class="col-6">
                        <input type="text" class="form-control" id="factory">
                    </div>
                    <div class="col-6">
                        <span class="form-control" id="factory-standard"></span>
                    </div>
                </div>
            </div>
            <div class="form-group mb-3">
                <label for="exampleInputPassword1">Fist of Drakness</label>
                <div class="row">
                    <div class="col-6">
                        <input type="text" class="form-control" id="fist">
                    </div>
                    <div class="col-6">
                        <span class="form-control" id="fist-standard"></span>
                    </div>
            </div>
            <div class="form-group mb-3">
                <label for="exampleInputPassword1">Fruit Spin</label>
                <div class="row">
                    <div class="col-6">
                        <input type="text" class="form-control" id="spin">
                    </div>
                    <div class="col-6">
                        <span class="form-control" id="spin-standard"></span>
                    </div>
                </div>
            </div>
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
        var factory = $('#factory').val();
        var fist = $('#fist').val();
        var spin = $('#spin').val();

        setNewTime('factory', 90);
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
        }
    }
</script>
@endsection

@section('styles')
<style>
    * {
        text-transform: uppercase;
    }
    .type-1 {
        background: #b3b3b3;
    }
    .type-2 {
        background: #5c8cd3;
    }
    .type-3 {
        background: #8c52ff;
        color: #fff;
    }
    .type-4 {
        background: #d52be4;
        color: #fff;
    }
    .type-5 {
        background: #d22a2c;
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
        height:750px;
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
