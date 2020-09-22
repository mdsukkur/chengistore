<?php
if (!function_exists('status')) {
    function status()
    {
        $status = [
            '1' => 'Active',
            '0' => 'Deactive'
        ];
        return $status;
    }
}

if (!function_exists('payment_method')) {
    function payment_method()
    {
        $payment_method = [
            '1' => 'Cash',
            '2' => 'Bank',
            '3' => 'Bkash'
        ];
        return $payment_method;
    }
}

if (!function_exists('accountType')) {
    function accountType()
    {
        $accountType = [
            '1' => 'Receivable',
            '2' => 'Payable',
            '3' => 'Others',
        ];
        return $accountType;
    }
}
