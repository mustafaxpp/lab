@extends('layouts.pdf')
@section('title')
{{ __('Report') }}-#{{ $group['id'] }}-{{ date('Y-m-d') }}
@endsection
@section('content')
<style>
    table.blueTable1 {
        font-family: Arial, Helvetica, sans-serif;
        width: 100%;
        text-align: left;
    }

    table.blueTable1 td,
    table.blueTable1 th {
        padding: 6px 6px;
    }

    table.blueTable1 tbody td {
        font-size: 13px;
    }

    table.blueTable1 thead {}

    table.blueTable1 thead th {
        font-size: 15px;
        font-weight: bold;
        color: #000000;
    }

    table.blueTable1 thead th:first-child {}

    table.blueTable1 tfoot td {
        font-size: 14px;
    }

    table.blueTable1 tfoot .links {
        text-align: left;
    }

    table.blueTable1 tfoot .links a {
        display: inline-block;
        color: #000000;
        padding: 2px 8px;
    }


    text-left-a {
        text-decoration: underline;
        text-align: left;
    }

    .text-left-a {
        text-decoration: underline;
        text-align: left;
    }

    table.blueTable2 {
        font-family: Arial, Helvetica, sans-serif;
        width: 20%;
        text-align: left;
    }

    table.blueTable2 td,
    table.blueTable2 th {
        padding: 6px 6px;
    }

    table.blueTable2 tbody td {
        font-size: 13px;
    }

    table.blueTable2 thead {}

    table.blueTable2 thead th {
        font-size: 15px;
        font-weight: bold;
        color: #000000;
    }

    table.blueTable2 thead th:first-child {}

    table.blueTable2 tfoot td {
        font-size: 14px;
    }

    table.blueTable2 tfoot .links {
        text-align: right;
    }

    table.blueTable2 tfoot .links a {
        display: inline-block;
        color: #000000;
        padding: 2px 8px;
    }




    table.blueTable {
        font-family: Arial, Helvetica, sans-serif;
        width: 20%;
        text-align: left;
    }

    table.blueTable td,
    table.blueTable th {
        padding: 6px 6px;
    }

    table.blueTable tbody td {
        font-size: 13px;
    }

    table.blueTable thead {}

    table.blueTable thead th {
        font-size: 15px;
        font-weight: bold;
        color: #000000;
    }

    table.blueTable thead th:first-child {}

    table.blueTable tfoot td {
        font-size: 14px;
    }

    table.blueTable tfoot .links {
        text-align: left;
    }

    table.blueTable tfoot .links a {
        display: inline-block;
        color: #000000;
        padding: 2px 8px;
    }


    .test_title {
        font-size: 20px;
        color: #000000
    }

    .beak-page {
        page-break-inside: avoid !important;
    }

    .subtitle {
        font-size: 15px;
    }

    .test {
        margin-top: 5px;
    }

    .transparent {}

    .transparent th {}

    .test_head td,
    th {}



    .comment tr th,
    .comment tr td {
        vertical-align: top !important;
        text-align: left;
        padding: 0px !important;
    }

    .sensitivity {
        margin-top: 20px;
    }

    .test_title {
        color: {
                {
                $reports_settings['test_title']['color']
            }
        }

         !important;

        font-size: {
                {
                $reports_settings['test_title']['font-size']
            }
        }

        px !important;

        font-family: {
                {
                $reports_settings['test_title']['font-family']
            }
        }

         !important;
    }

    .test_name {
        color: {
                {
                $reports_settings['test_name']['color']
            }
        }

         !important;

        font-size: {
                {
                $reports_settings['test_name']['font-size']
            }
        }

        px !important;

        font-family: {
                {
                $reports_settings['test_name']['font-family']
            }
        }

         !important;
    }

    .test_head th {
        color: {
                {
                $reports_settings['test_head']['color']
            }
        }

         !important;

        font-size: {
                {
                $reports_settings['test_head']['font-size']
            }
        }

        px !important;

        font-family: {
                {
                $reports_settings['test_head']['font-family']
            }
        }

         !important;
    }

    .unit {
        color: {
                {
                $reports_settings['unit']['color']
            }
        }

         !important;

        font-size: {
                {
                $reports_settings['unit']['font-size']
            }
        }

        px !important;

        font-family: {
                {
                $reports_settings['unit']['font-family']
            }
        }

         !important;
    }

    .reference_range {
        color: {
                {
                $reports_settings['reference_range']['color']
            }
        }

         !important;

        font-size: {
                {
                $reports_settings['reference_range']['font-size']
            }
        }

        px !important;

        font-family: {
                {
                $reports_settings['reference_range']['font-family']
            }
        }

         !important;
    }

    .result {
        color: {
                {
                $reports_settings['result']['color']
            }
        }

         !important;

        font-size: {
                {
                $reports_settings['result']['font-size']
            }
        }

        px !important;

        font-family: {
                {
                $reports_settings['result']['font-family']
            }
        }

         !important;
    }

    .status {
        color: {
                {
                $reports_settings['status']['color']
            }
        }

         !important;

        font-size: {
                {
                $reports_settings['status']['font-size']
            }
        }

        px !important;

        font-family: {
                {
                $reports_settings['status']['font-family']
            }
        }

         !important;
    }

    .comment th,
    .comment td {
        color: {
                {
                $reports_settings['comment']['color']
            }
        }

         !important;

        font-size: {
                {
                $reports_settings['comment']['font-size']
            }
        }

        px !important;

        font-family: {
                {
                $reports_settings['comment']['font-family']
            }
        }

         !important;
    }

    .antibiotic_name {
        color: {
                {
                $reports_settings['antibiotic_name']['color']
            }
        }

         !important;

        font-size: {
                {
                $reports_settings['antibiotic_name']['font-size']
            }
        }

        px !important;

        font-family: {
                {
                $reports_settings['antibiotic_name']['font-family']
            }
        }

         !important;
    }

    .sensitivity {
        color: {
                {
                $reports_settings['sensitivity']['color']
            }
        }

         !important;

        font-size: {
                {
                $reports_settings['sensitivity']['font-size']
            }
        }

        px !important;

        font-family: {
                {
                $reports_settings['sensitivity']['font-family']
            }
        }

         !important;
    }

    .commercial_name {
        color: {
                {
                $reports_settings['commercial_name']['color']
            }
        }

         !important;

        font-size: {
                {
                $reports_settings['commercial_name']['font-size']
            }
        }

        px !important;

        font-family: {
                {
                $reports_settings['commercial_name']['font-family']
            }
        }

         !important;
    }






    table {
        width: 100%;
        height: 100%;
        padding: 5px;
    }

    table th {
        padding: 5px;
        color: #000000;
    }

    table td {
        text-align: left;
        padding: 5px;
        color: #000000;
    }
</style>
<div class="printable">
    @php
    $count_categories = 0;
    @endphp
    @foreach ($categories as $key => $category)
    @if (count($category['tests']) || count($category['cultures']))
    @php
    $count_categories++;
    $count = 0;
    @endphp
    {{--@if ($count_categories > 1)
    <pagebreak>
    </pagebreak>
    @endif--}}



    <h4 class="test_title" align="center">
        {{ $category['name'] }}
    </h4>
    @if (count($category['tests']))
    @if (count($category['tests']) > 1)
    <table class="table test beak-page">
        <thead>

            <tr class="transparent">
                <th colspan="5"></th>
            </tr>
            <tr class="test_head">
                <th align="left">Test</th>
                <th align="left">Result</th>
                @if (session('report_design') == '1')
                <th align="left">Unit</th>
                @endif
                <th align="left">Normal Range</th>
                @if (session('report_design') == '1')
                <th align="left">Status</th>
                @endif
            </tr>
        </thead>
        <tbody>

            @foreach ($category['tests'] as $test)
            @foreach ($test['results'] as $result)
            <!-- Title -->
            @if (isset($result['component']))
            @if ($result['component']['title'])
            <tr>
                <td colspan="5" class="component_title test_name">
                    <b>{{ $result['component']['name'] }}</b>
                </td>
            </tr>
            @else
            <tr>
                <td class="text-captitalize test_name">{{ $result['component']['name'] }}
                </td>
                <td align="left" class="result">{{ $result['result'] }}</td>
                @if (session('report_design') == '1')
                <td align="center" class="unit">
                    {{ $result['component']['unit'] }}
                </td>
                @endif
                <td align="left" class="reference_range">
                    {!! $result['component']['reference_range'] !!}
                </td>
                @if (session('report_design') == '1')
                <td align="left" class="status">
                    {{ $result['status'] }}
                </td>
                @endif
            </tr>
            @endif
            @endif
            @endforeach
            @endforeach


            <!-- Comment -->
            @if (isset($test['comment']))
            <tr class="comment">
                <td colspan="5">
                    <table class="comment">
                        <tbody>
                            <tr>
                                <th width="80px">
                                    <b>Comment:</b>
                                </th>
                                <td>
                                    {!! str_replace("\n", '<br />', $test['comment']) !!}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            @endif
            <!-- /comment -->
        </tbody>
    </table>
    @else
    @foreach ($category['tests'] as $test)
    @php
    $count++;
    @endphp
    <!--CBC Report ID 473-->
    @if ($test['test']['id'] == 473)
    <table class="blueTable1">
        <thead>
            <tr>
                <th align="left">
                    Test</th>
                <th align="left">
                    Result</th>
                @if (session('report_design') == '1')
                <th align="left">
                    Unit</th>
                @endif
                <th align="left">
                    Normal Range</th>
                @if (session('report_design') == '1')
                <th align="left">
                    Status
                </th>
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach ($test['results'] as $result)
            @if (isset($result['component']))
            @if ($result['component']['id'] == 1261 || $result['component']['id'] == 1262 || $result['component']['id'] == 1263 || $result['component']['id'] == 1264 || $result['component']['id'] == 1266 || $result['component']['id'] == 1267 || $result['component']['id'] == 1268 || $result['component']['id'] == 1419 || $result['component']['id'] == 1420 || $result['component']['id'] == 1421 || $result['component']['id'] == 1422 || $result['component']['id'] == 1424 || $result['component']['id'] == 1425 || $result['component']['id'] == 1426 || $result['component']['id'] == 1258 || $result['component']['id'] == 1260 || $result['component']['id'] == 1265 || $result['component']['id'] == 1418 || $result['component']['id'] == 1423)
            @else
            <tr align="left">
                <td align="left">{{ $result['component']['name'] }}</td>
                <td align="left">{{ $result['result'] }}</td>
                @if (session('report_design') == '1')
                <td align="left">{{ $result['component']['unit'] }}</td>
                @endif
                <td align="left">{!! $result['component']['reference_range'] !!}</td>
                @if (session('report_design') == '1')
                <td align="left">{{ $result['status'] }}</td>
                @endif
            </tr>
            @endif
            @endif
            @endforeach
        </tbody>
    </table>

    <table width="100%" cellpadding="0">
        <tr>
            // Left side Table
            <td width="60%" style="margin: 0px;">

                <table class="blueTable" style="width: 100%;">
                    <thead>
                        <tr align="left">
                            <th align="left" width="30%">
                                Test</th>
                            <th align="left" width="30%">
                                Relative Count %</th>
                            <th align="left" width="30%">
                                Normal Range</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($test['results'] as $result)
                        @if (isset($result['component']))
                        @if ($result['component']['id'] == 1261 || $result['component']['id'] == 1262 || $result['component']['id'] == 1263 || $result['component']['id'] == 1264 || $result['component']['id'] == 1266 || $result['component']['id'] == 1267 || $result['component']['id'] == 1268)
                        <tr>

                            <td align="left">{{ $result['component']['name'] }}</td>
                            <td align="left">{{ $result['result'] }}</td>
                            <td align="left">{!! $result['component']['reference_range'] !!}</td>

                        </tr>
                        @endif
                        @endif
                        @endforeach
                    </tbody>
                </table>

            </td>

            <td width="40%" style="margin: 0px;">

                <table class="blueTable" style="width: 100%;">
                    <thead>
                        <tr align="left">
                            <th align="left">
                                Absolute Count 10³/µl</th>
                            <th align="left">
                                Normal Range</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($test['results'] as $result)
                        @if (isset($result['component']))
                        @if ($result['component']['id'] == 1419 || $result['component']['id'] == 1420 || $result['component']['id'] == 1421 || $result['component']['id'] == 1422 || $result['component']['id'] == 1424 || $result['component']['id'] == 1425 || $result['component']['id'] == 1426)
                        <tr>

                            <td align="left">{{ $result['result'] }}</td>
                            <td align="left">{!! $result['component']['reference_range'] !!}</td>

                        </tr>
                        @endif
                        @endif
                        @endforeach
                    </tbody>
                </table>
                <br>
            </td>
        </tr>
        <!-- Comment -->
        @if (isset($test['comment']))
        <tr class="comment">
            <td colspan="5">
                <table class="comment">
                    <tbody>
                        <tr>
                            <th width="80px">
                                <b>Comment:</b>
                            </th>
                            <td>
                                {!! str_replace("\n", '<br />', $test['comment']) !!}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
        @endif
        <!-- /comment -->
    </table>
    <!--Stool analysis Report ID 1025-->

    @else
    <table class="table test beak-page">
        <thead>
            <tr>
                <th class="test_title" align="left" colspan="5">
                    <h5>{{ $test['test']['name'] }}</h5>
                </th>
            </tr>
            <tr class="transparent">
                <th colspan="5"></th>
            </tr>
            <tr class="test_head">
                <th align="left">Test</th>
                <th align="left">Result</th>
                @if (session('report_design') == '1')
                <th align="left">Unit</th>
                @endif
                <th align="left">Normal Range</th>
                @if (session('report_design') == '1')
                <th align="left">Status</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach ($test['results'] as $result)
            <!-- Title -->
            @if (isset($result['component']))
            @if ($result['component']['title'])
            <tr align="left">
                <td align="left" colspan="5" class="component_title test_name">
                    <b align="left">{{ $result['component']['name'] }}</b>
                </td>
            </tr>
            @else
            <tr>
                <td align="left" class="text-captitalize test_name">
                    {{ $result['component']['name'] }}
                </td>
                <td align="left" class="result">{{ $result['result'] }}
                </td>
                @if (session('report_design') == '1')
                <td align="left" class="unit">
                    {{ $result['component']['unit'] }}
                </td>
                @endif
                <td align="left" class="reference_range">
                    {!! $result['component']['reference_range'] !!}
                </td>
                @if (session('report_design') == '1')
                <td align="left" class="status">
                    {{ $result['status'] }}
                </td>
                @endif
            </tr>
            @endif
            @endif
            @endforeach
            <!-- Comment -->
            @if (isset($test['comment']))
            <tr class="comment">
                <td colspan="5">
                    <table class="comment">
                        <tbody>
                            <tr>
                                <th width="80px">
                                    <b>Comment:</b>
                                </th>
                                <td>
                                    {!! str_replace("\n", '<br />', $test['comment']) !!}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            @endif
            <!-- /comment -->
        </tbody>
    </table>
    @endif
    @endforeach
    @endif
    @endif

    @if (count($category['cultures']))
    @foreach ($category['cultures'] as $culture)
    @php
    $count++;
    @endphp
    @if ($count > 1)
    <pagebreak>
        @endif
        <!-- culture title -->
        <h5 class="test_title" align="center">
            {{ $culture['culture']['name'] }}
        </h5>
        <!-- /culture title -->

        <!-- culture options -->
        <table class="table" width="100%">
            <tbody>
                @foreach ($culture['culture_options'] as $culture_option)
                @if (isset($culture_option['value']) && isset($culture_option['culture_option']))
                <tr>
                    <th class="test_name" width="10px" nowrap="nowrap" align="center">
                        <span class="option_title">{{ $culture_option['culture_option']['value'] }}
                            :</span>
                    </th>
                    <td class="result">
                        {{ $culture_option['value'] }}
                    </td>
                </tr>
                @endif
                @endforeach
            </tbody>
        </table>
        <!-- /culture options -->

        <!-- sensitivity -->
        <table class="table sensitivity" width="100%">
            <thead class="test_head">
                <tr>
                    <th align="left">Name</th>
                    <th align="left">Sensitivity</th>
                    <th align="left">Commercial name</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($culture['high_antibiotics'] as $antibiotic)
                <tr>
                    <td width="200px" nowrap="nowrap" align="left" class="antibiotic_name">
                        {{ $antibiotic['antibiotic']['name'] }}
                    </td>
                    <td width="120px" nowrap="nowrap" align="left" class="sensitivity">
                        {{ $antibiotic['sensitivity'] }}
                    </td>
                    <td class="commercial_name">
                        {{ $antibiotic['antibiotic']['commercial_name'] }}
                    </td>
                </tr>
                @endforeach

                @foreach ($culture['moderate_antibiotics'] as $antibiotic)
                <tr>
                    <td width="200px" nowrap="nowrap" align="left">
                        {{ $antibiotic['antibiotic']['name'] }}
                    </td>
                    <td width="120px" nowrap="nowrap" align="center">
                        {{ $antibiotic['sensitivity'] }}
                    </td>
                    <td>
                        {{ $antibiotic['antibiotic']['commercial_name'] }}
                    </td>
                </tr>
                @endforeach

                @foreach ($culture['resident_antibiotics'] as $antibiotic)
                <tr>
                    <td width="200px" nowrap="nowrap" align="left">
                        {{ $antibiotic['antibiotic']['name'] }}
                    </td>
                    <td width="120px" nowrap="nowrap" align="center">
                        {{ $antibiotic['sensitivity'] }}
                    </td>
                    <td>
                        {{ $antibiotic['antibiotic']['commercial_name'] }}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Comment -->
        @if (isset($culture['comment']))
        <table width="100%" class="comment">
            <tbody>
                <tr>
                    <td width="10px" nowrap="nowrap"><b>Comment:</b></td>
                    <td>
                        {!! str_replace("\n", '<br />', $culture['comment']) !!}
                    </td>
                </tr>
            </tbody>
        </table>
        @endif
        <!-- /comment -->
        @if ($count > 1)
    </pagebreak>
    @endif
    @endforeach
    @endif
    @endif
    @endforeach

</div>

@endsection