<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AMC Reporter</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        /* Add any additional styles here */
        * {
            margin: 0;
            padding: 0;
            text-indent: 0;
        }

        .s1 {
            color: black;
            font-family: Calibri, sans-serif;
            font-style: normal;
            font-weight: normal;
            text-decoration: none;
            font-size: 28pt;
        }

        .s2 {
            color: black;
            font-family: Calibri, sans-serif;
            font-style: normal;
            font-weight: bold;
            text-decoration: none;
            font-size: 18pt;
        }

        .s3 {
            color: black;
            font-family: Calibri, sans-serif;
            font-style: normal;
            font-weight: normal;
            text-decoration: none;
            font-size: 10pt;
        }

        .s4 {
            color: black;
            font-family: Calibri, sans-serif;
            font-style: normal;
            font-weight: normal;
            text-decoration: none;
            font-size: 11pt;
        }

        .s5 {
            color: black;
            font-family: Calibri, sans-serif;
            font-style: normal;
            font-weight: bold;
            text-decoration: none;
            font-size: 11pt;
        }

        table,
        tbody {
            vertical-align: top;
            overflow: visible;
        }
        @media print {
            body {
                margin: 0;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <table class="table table-bordered" style="margin-left: 5.9125pt">
        <tr style="height: 43pt">
            <td class="col-2" rowspan="3">
                <p class="s1">
                    @if (isset($setting) && $setting->logo && File::exists(str_replace('\\', '/', base_path('public\logo_img/' . $setting->logo))))
                        <div class="mt-3">
                            <img style="height: 165px;" src="{{ asset('logo_img/' . $setting->logo) }}" alt="Logo">
                        </div>
                    @endif
                </p>
            </td>
            <td class="col-8" colspan="7"><p class="s2 text-center">{{ $manageAmc->party_name }}</p></td>
        </tr>
        <tr style="height: 19pt">
            <td class="col-8" colspan="7"><p class="s3 text-center">{{ $manageAmc->address }}</p></td>
        </tr>
        <tr style="height: 20pt">
            <td class="col-8" colspan="7"><p class="s4 text-center">{{ $manageAmc->city.', '.$manageAmc->state.', '.$manageAmc->country.', '.$manageAmc->pincode }}</p></td>
        </tr>
        <tr >
            <td class="col-12" colspan="8"><p class="s5 text-center">Annual Maintenance Contract</p></td>
        </tr>
        <tr style="height: 74pt">
            <td class="col-7" colspan="3">
                <p class="s5">Party Name: {{ $manageAmc->party_name }}</p>
                <p class="s5">Person Name: {{ $manageAmc->person_name }}</p>
                <p class="s5">Contact Number: {{ $manageAmc->mobile_no }}</p>
                <p class="s5">Site Address: {{ $manageAmc->address }}</p>
            </td>
            <td class="col-2" colspan="5" style="background-color:#E4E4E4;">
                <p class="s5">AMC No.: {{ $manageAmc->id }}</p>
                <p class="s5">Start Date: {{ $manageAmc->start_date }}</p>
                <p class="s5">End Date: {{ $manageAmc->end_date }}</p>
            </td>
        </tr>
        {{-- <tr style="height: 28pt">
            <td class="col-12" colspan="8"><p class="text-center"><br/></p></td>
        </tr> --}}
        <tr style="height: 27pt">
            <td class="col-2"><p class="s5 text-left">Sr No.</p></td>
            <td class="col-4" colspan="2"><p class="s5 text-left">Service Name</p></td>
            <td class="col-1"><p class="s5 text-center">Qty</p></td>
            <td class="col-1"><p class="s5 text-left">Rate</p></td>
            <td class="col-1"><p class="s5 text-left">GST %</p></td>
            <td class="col-2" colspan="2"><p class="s5 text-left">Amount</p></td>
        </tr>
        @php
            $product = getAmcProductDetails($manageAmc->id);
            $srNo=0;
        @endphp
        @if(isset($product) && $product)
            @foreach ($product as $data)
                @php
                    $srNo++;
                @endphp
                <tr style="height: 14pt">
                    <td class="col-2">{{ $srNo }}</td>
                    <td class="col-4"colspan="2">{{ $data->product_name }}</td>
                    <td class="col-1">{{ $data->qty }}</td>
                    <td class="col-1">{{ $manageAmc->contract_amount }}</td>
                    <td class="col-1">{{ $manageAmc->tax }}</td>
                    <td class="col-2" colspan="2">{{ $manageAmc->total_amount }}</td>
                </tr>
            @endforeach
        @endif
        {{-- <tr style="height: 23pt">
            <td class="col-12" colspan="8"><p class="text-left"><br/></p></td>
        </tr> --}}
        <!-- Add more table rows as needed -->

        <tr style="height: 14pt">
            <td class="col-8" colspan="3"></td>
            <td class="col-2"><p class="s5 text-left">GST Amount</p></td>
            <td class="col-1" colspan="4">{{ $manageAmc->total_amount - $manageAmc->contract_amount }}</td>
        </tr>
        <tr style="height: 14pt">
            <td class="col-4" colspan="2"></td>
            <td class="col-2"></td>
            <td class="col-2"><p class="s5 text-left">Total Amount</p></td>
            <td class="col-1" colspan="4">{{ $manageAmc->total_amount }}</td>
        </tr>
        {{-- <tr style="height: 12pt">
            <td class="col-12" colspan="7"><p class="text-left"><br/></p></td>
        </tr> --}}
        <tr style="height: 144pt">
            <td class="col-12" colspan="7"><p class="s5 text-left">Terms & Conditions:</p></td>
        </tr>
        <!-- Continue adding rows for terms and conditions -->

        <tr style="height: 30pt">
            <td class="col-2" colspan="8"><p class="s5 text-left">Installment Details:</p></td>
        </tr>
        <tr>
            <td colspan="2"><p class="s5 text-left">Installment Date</p></td>
            <td colspan="6" class="col-3"><p class="s5 text-left">Installment Amount</p></td>
        </tr>
        @foreach ($payment as $value)
            <tr>
                <td colspan="2"><p >{{ date('Y-m-d',strtotime($value->installment_date)) }}</p></td>
                <td colspan="6" class="col-3"><p >{{ $value->installment_amount }}</p></td>
            </tr>
        @endforeach
        <tr style="height: 30pt">
            <td class="col-2" colspan="8"><p class="s5 text-left">Service Details:</p></td>
        </tr>
        <tr>
            <td class="col-2" colspan="2"><p class="s4 text-left">Free Service No</p></td>
            <td class="col-2" colspan="6"><p class="s4 text-left">Free Service Date</p></td>
            {{-- <td class="col-2" colspan="2"><p class="s4 text-left">Free Service No</p></td>
            <td class="col-2" colspan="2"><p class="s4 text-left">Free Service Date</p></td> --}}
        </tr>
        @php $count = 0; @endphp
        @foreach ($service as $data )
        @php $count++; @endphp
            <tr>
                <td class="col-2" colspan="2"><p class="s4 text-left">{{ date('Y-m-d',strtotime($data->service_date)) }}</p></td>
                <td class="col-2" colspan="6"><p class="s4 text-left">{{$count.' Free Service'}}</p></td>
                {{-- <td class="col-2" colspan="2"><p class="s4 text-left"></p></td>
                <td class="col-2" colspan="2"><p class="s4 text-left"></p></td> --}}
            </tr>
        @endforeach
        <tr >
            <td class="col-12" colspan="8">
                <p class="s4 text-right" style="display:inline-block; text-align:right;margin-top: 50px; border-top: 1px solid;">Customer Name</p>
                <span style="display:inline-block; width:59%;"></span>
                <p class="s4 text-left" style="display:inline-block;  border-top: 1px solid;">Company Name</p>
            </td>
        </tr>
    </table>
</div>

    <div style="display: flex; flex-direction: column; align-items: center; height: 100vh;">
        <a href="{{ route('manage_amc.index') }}" class="btn button" style="margin: 10px;padding: 10px 20px;background-color: #141414;color: white;border: none;cursor: pointer;border-radius: 5px;">Back</a>
        <input type="button" value="Print this page" onClick="window.print()" style="margin: 10px;padding: 10px 20px;background-color: #141414;color: white;border: none;cursor: pointer;border-radius: 5px;">
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </body>
    </html>

