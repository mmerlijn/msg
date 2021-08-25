<?php
/**
 * Created by PhpStorm.
 * User: Menno
 * Date: 1-2-2019
 * Time: 01:03
 */

namespace mmerlijn\msg\src\Hl7\tables;


class Table0119 extends Table
{
    protected static $name="Order control codes";
    protected static $table=[
        "NW"=>"New order/service",
        "OK"=>"Order/service accepted & OK",
        "UA"=>"Unable to accept order/service",
        "CA"=>"Cancel order/service request",
        "OC"=>"Order/service canceled",
        "CR"=>"Canceled as requested",
        "UC"=>"Unable to cancel",
        "DC"=>"Discontinue order/service request",
        "OD"=>"Order/service discontinued",
        "DR"=>"Discontinued as requested",
        "UD"=>"Unable to discontinue",
        "HD"=>"Hold order request",
        "OH"=>"Order/service held",
        "UH"=>"Unable to put on hold",
        "HR"=>"On hold as requested",
        "RL"=>"Release previous hold",
        "OE"=>"Order/service released",
        "OR"=>"Released as requested",
        "UR"=>"Unable to release",
        "RP"=>"Order/service replace request",
        "RU"=>"Replaced unsolicited",
        "RO"=>"Replacement order",
        "RQ"=>"Replaced as requested",
        "UM"=>"Unable to replace",
        "PA"=>"Parent order/service",
        "CH"=>"Child order/service",
        "XO"=>"Change order/service request",
        "XX"=>"Order/service changed, unsol.",
        "UX"=>"Unable to change",
        "XR"=>"Changed as requested",
        "DE"=>"Data errors",
        "RE"=>"Observations/Performed Service to follow",
        "RR"=>"Request received",
        "SR"=>"Response to send order/service status request",
        "SS"=>"Send order/service status request",
        "SC"=>"Status changed",
        "SN"=>"Send order/service number",
        "NA"=>"Number assigned",
        "CN"=>"Combined result",
        "RF"=>"Refill order/service request",
        "AF"=>"Order/service refill request approval",
        "DF"=>"Order/service refill request denied",
        "FU"=>"Order/service refilled, unsolicited",
        "OF"=>"Order/service refilled as requested",
        "UF"=>"Unable to refill",
        "LI"=>"Link order/service to patient care problem or goal",
        "UN"=>"Unlink order/service from patient care problem or goal",
        "OP"=>"Notification of order for outside dispense",
        "PY"=>"Notification of replacement order for outside dispense",
    ];
}