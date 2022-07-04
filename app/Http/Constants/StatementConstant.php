<?php


namespace App\Http\Constants;


class StatementConstant
{

    const TYPE_DEPOSIT = 1;
    const TYPE_WITHDRAW = 2;

    const TYPE = [
        self::TYPE_DEPOSIT => 'credit',
        self::TYPE_WITHDRAW => 'debit',

    ];
}
