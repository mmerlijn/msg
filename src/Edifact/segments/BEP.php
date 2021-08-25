<?php


namespace mmerlijn\msg\src\Edifact\segments;


use mmerlijn\msg\src\Edifact\fields\Bepaling;
use mmerlijn\msg\src\Edifact\fields\Bepalingseenheid;
use mmerlijn\msg\src\Edifact\fields\CodeBepaling;
use mmerlijn\msg\src\Edifact\fields\Grenswaarde;
use mmerlijn\msg\src\Edifact\fields\IndicatieGewijzigd;
use mmerlijn\msg\src\Edifact\fields\NormaalwaardeIndicatie;
use mmerlijn\msg\src\Edifact\fields\SoortBepaling;
use mmerlijn\msg\src\Edifact\fields\Uitslag;

class BEP extends Segment
{
    protected static $name = 'BEP';
    protected static $structure = [
        1 => ['class' => SoortBepaling::class,  'opt' => 'M', 'name' => 'Soort Bepaling'],
        2 => ['class' => Bepaling::class,  'opt' => 'M', 'name' => 'Bepaling'],
        3 => ['class' => Uitslag::class,  'opt' => 'C', 'name' => 'Uitslag'],
        4 => ['class' => IndicatieGewijzigd::class, 'opt' => 'C', 'name' => 'Indicatie gewijzigde uitslag'],
        5 => ['class' => Bepalingseenheid::class, 'opt' => 'C', 'name' => 'Bepalingseenheid'],
        6 => ['class' => NormaalwaardeIndicatie::class, 'opt' => 'C', 'name' => 'Normaalwaarde indicatie'],
        7 => ['class' => Grenswaarde::class, 'opt' => 'C', 'name' => 'Ondergrens'],
        8 => ['class' => Grenswaarde::class, 'opt' => 'C', 'name' => 'Bovengrens'],
        9 => ['class' => CodeBepaling::class, 'opt' => 'C', 'name' => 'Code bepaling'],
        ];
}