<?php

namespace App\Service;

use App\Entity\Enclosure;
use App\Entity\Security;

class EnclosureBuilderService
{
    public function buildEnclosure(
        int $numberOfSecuritySystems = 1,
        int $numberOfDinosaurs = 3
    ): Enclosure
    {
        $enclosure = new Enclosure();

        $this->addSecuritySystems($numberOfSecuritySystems, $enclosure);

        return $enclosure;
    }

    private function addSecuritySystems(int $numberOfSecuritySystems, Enclosure $enclosure)
    {
        for ($i = 0; $i < $numberOfSecuritySystems; $i++) {
            $securityName = array_rand(['Fence', 'Electric fence', 'Guard tower']);
            $security = new Security($securityName, true, $enclosure);

            $enclosure->addSecurity($security);
        }
    }
}
