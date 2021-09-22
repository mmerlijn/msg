<?php


namespace mmerlijn\msg\src\Hl7\traits;


use mmerlijn\msg\src\repo\Financial;
use mmerlijn\msg\src\repo\Header;
use mmerlijn\msg\src\repo\Transaction;
use PHPUnit\Exception;

Trait GetFinancialTrait
{
    public function getFinancial()
    {
        $F = new Financial();

        $nrs = $this->getSegmentNrs('EVN');
        foreach ($nrs as $nr){
            $F->date = $this->getValue($nr,2,1);
        }

        $nrsFT1 = $this->getSegmentNrs('FT1');
        foreach ($nrsFT1 as $nr){
            $transaction = new Transaction();

            $transaction->id = $this->getValue($nr,2);
            $transaction->date = $this->getValue($nr,4,1);
            $transaction->posting_date = $this->getValue($nr,5,1);
            $transaction->type = $this->getValue($nr,6);
            $transaction->code = $this->getValue($nr,7,1);
            $transaction->quantity = $this->getValue($nr,10);
            $transaction->department_code = $this->getValue($nr,13,1);
            $F->transactions[] = $transaction;
        }
        if(isset($F->transactions[0])){
            try{
                $F->requestnr = explode("^", $F->transactions[0]->id)[1];
            }catch (Exception $e){

            }
        }
        return $F;
    }
}