<?php

/*
 * This file is part of the Blast Project package.
 *
 * Copyright (C) 2015-2017 Libre Informatique
 *
 * This file is licenced under the GNU LGPL v3.
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Librinfo\EcommerceBundle\Entity;

use Sylius\Component\Taxation\Model\TaxRate as BaseTaxRate;
use Blast\OuterExtensionBundle\Entity\Traits\OuterExtensible;
use AppBundle\Entity\OuterExtension\LibrinfoEcommerceBundle\TaxRateExtension;
use Sylius\Component\Addressing\Model\ZoneInterface;

class TaxRate extends BaseTaxRate
{
    use OuterExtensible,
        TaxRateExtension;

    /**
     * @var ZoneInterface
     */
    private $zone;

    public function initTaxRate()
    {
        $this->initOuterExtendedClasses();
    }

    /**
     * @return ZoneInterface
     */
    public function getZone()
    {
        return $this->zone;
    }

    /**
     * @param ZoneInterface $zone
     */
    public function setZone(ZoneInterface $zone)
    {
        $this->zone = $zone;
    }

    public function __toString()
    {
        return (string) sprintf('%s (%s)', $this->getName(), $this->getCode());
    }

    /**
     * __clone().
     */
    public function __clone()
    {
        $this->id = null;
    }
}