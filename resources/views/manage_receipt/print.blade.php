<style>
    table, th, td {
        border: 1px solid black;
        border-collapse: collapse;
    }
</style>
    <div style="margin:20px;display: flex;justify-content: center;">
        <table width="80%" style="" >
            <tr>
                <td colspan="3" style="background-color: A9A9A9; height:50px; text-align: center;">
                    <strong style="font-size: 25px;">Payment Receipt</strong>
                </td>
            </tr>
            <tr style="height: 30px;">
                <td>
                    <strong>Receipt No :-</strong> {{ $data->id }}
                </td>
                <td colspan="2">
                    <strong>Date :-</strong> {{ $data->date }}
                </td>
            </tr>
            <tr style="height: 30px;">
                <td colspan="3"></td>
            </tr>
            <tr style="border: 0;">
                <td colspan="3">
                    <strong>Party Name :-</strong> {{ $data->party_name }}
                </td>
            </tr>
            <tr style="border: 0;">
                <td colspan="3">
                    <strong>AMC NO:-</strong> {{ $data->amc_id }}
                </td>
            </tr>
            <tr style="border: 0;">
                <td colspan="3">
                    <strong>AMC Start Date :-</strong> {{ $data->start_date }}
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    <strong>AMC End Date :-</strong> {{ $data->end_date }}
                </td>
            </tr>
            <tr style="height: 30px;">
                <td colspan="3"></td>
            </tr>
            <tr>
                <td>
                    <strong>INSTALLMENT DATE</strong>
                </td>
                <td>
                    <strong>Payment Type</strong>
                </td>
                <td>
                    <strong>Amount</strong>
                </td>
            </tr>
            <tr>
                <td>
                    {{ $data->payment_date }}
                </td>
                <td>
                    {{ $data->payment_mode }}
                </td>
                <td>
                    {{ $data->amount }}
                </td>
            </tr>
        </table>
    </div>
    <div style="display: flex; flex-direction: column; align-items: center; height: 100vh;">
        <a href="{{ route('manage_receipt.index') }}" class="btn button" style="margin: 10px;padding: 10px 20px;background-color: #141414;color: white;border: none;cursor: pointer;border-radius: 5px;">Back</a>
        <input type="button" value="Print this page" onClick="window.print()" style="margin: 10px;padding: 10px 20px;background-color: #141414;color: white;border: none;cursor: pointer;border-radius: 5px;">
    </div>

