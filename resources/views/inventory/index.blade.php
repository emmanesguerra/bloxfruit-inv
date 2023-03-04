@extends('welcome')

@section('content')
<div class="row">
    <div class="col">
        <table class="table">
            <thead>
                <tr>
                    <th>FRUIT</th>
                    @foreach ($accounts as $account)
                    <th>{{ $account->username }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach($fruits as $fruit)
                <tr>
                    <td>{{ $fruit->name }}</td>
                    @foreach ($accounts as $account)
                    <td>
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
</script>
@endsection