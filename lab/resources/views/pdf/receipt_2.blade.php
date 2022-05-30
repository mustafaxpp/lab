@extends('layouts.pdf_2')
@section('title')
    {{__('Receipt')}}-{{$group['id']}}-{{date('Y-m-d')}}
@endsection
@section('content')

<div class="invoice">

    <table class="table table-bordered" width="100%">
        <thead>
            <tr>
                <th colspan="2" width="85%">{{__('Test Name')}}</th>
                <th width="15%">{{__('Price')}}</th>
            </tr>
        </thead>
        <tbody>
            @foreach($group['tests'] as $test)
            <tr>
                <td colspan="2" class="print_title test_name">
                    @if(isset($test['test']))
                        {{$test['test']['name']}}
                    @endif
                </td>
                <td>{{formated_price($test['price'])}}</td>
            </tr>
            @endforeach

            @foreach($group['cultures'] as $culture)
            <tr>
                <td colspan="2" class="print_title test_name">
                    @if(isset($culture['culture']))
                        {{$culture['culture']['name']}}
                    @endif
                </td>
                <td>{{formated_price($culture['price'])}}</td>
            </tr>
            @endforeach

            @foreach($group['packages'] as $package)
            <tr>
                <td colspan="2" class="print_title test_name">
                    @if(isset($package['package']))
                        {{$package['package']['name']}}
                    @endif
                    <ul>
                        @foreach($package['tests'] as $test)
                            <li>
                                {{$test['test']['name']}}
                            </li>
                        @endforeach
                        @foreach($package['cultures'] as $culture)
                            <li>
                                {{$culture['culture']['name']}}
                            </li>
                        @endforeach
                    </ul>
                </td>
                <td>{{formated_price($package['price'])}}</td>
            </tr>
            @endforeach

            <tr class="receipt_title border-top">
                <td width="50%" class="no-right-border"></td>
                <td class="total">
                    <b>{{__('Subtotal')}}</b>
                </td>
                <td class="total">{{formated_price($group['subtotal'])}}</td>
            </tr>

            <tr class="receipt_title">
                <td width="50%" class="no-right-border"></td>
                <td class="total">
                   <b>
                        {{__('Discount')}}
                   </b>
                </td>
                <td class="total">{{ $group['discount'] . ' %' }}</td>
            </tr>

            <tr class="receipt_title">
                <td width="50%" class="no-right-border"></td>
                <td class="total">
                    <b>{{__('Total')}}</b>
                </td>
                <td class="total">{{formated_price($group['total'])}}</td>
            </tr>

            <tr class="receipt_title">
                <td width="50%" class="no-right-border"></td>
                <td class="total">
                    <b>
                        {{__('Paid')}}
                    </b>
                    <br>
                    @foreach($group['payments'] as $payment)
                        {{formated_price($payment['amount'])}}
                        <b>{{__('On')}}</b>
                        {{$payment['date']}}
                        <b>{{__('By')}}</b>
                        {{$payment['payment_method']['name']}}
                        <br>
                    @endforeach
                </td>
                <td class="total">
                    @if(count($group['payments']))
                        {{formated_price($group['paid'])}}
                    @else
                        {{formated_price(0)}}
                    @endif
                </td>
            </tr>

            <tr class="receipt_title">
                <td width="50%" class="no-right-border"></td>
                <td class="total">
                    <b>{{__('Due')}}</b>
                </td>
                <td class="total">{{formated_price($group['due'])}}</td>
            </tr>

        </tbody>
    </table>
</div>

@endsection
