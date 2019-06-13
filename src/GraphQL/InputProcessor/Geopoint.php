<?php

/**
 * Pimcore
 *
 * This source file is available under two different licenses:
 * - GNU General Public License version 3 (GPLv3)
 * - Pimcore Enterprise License (PEL)
 * Full copyright and license information is available in
 * LICENSE.md which is distributed with this source code.
 *
 * @copyright  Copyright (c) Pimcore GmbH (http://www.pimcore.org)
 * @license    http://www.pimcore.org/license     GPLv3 and PEL
 */

namespace Pimcore\Bundle\DataHubBundle\GraphQL\InputProcessor;

use GraphQL\Type\Definition\ResolveInfo;
use Pimcore\Bundle\DataHubBundle\GraphQL\Service;
use Pimcore\Model\DataObject\Concrete;


class Geopoint extends Base
{

    /**
     * @param Concrete $object
     * @param $newValue
     * @param $args
     * @param $context
     * @param ResolveInfo $info
     * @throws \Exception
     */
    public function process(Concrete $object, $newValue, $args, $context, ResolveInfo $info)
    {
        $attribute = $this->getAttribute();
        Service::setValue($object, $attribute, function($container, $setter) use ($newValue) {
            $geopoint = new \Pimcore\Model\DataObject\Data\Geopoint();
            if ($newValue) {
                $geopoint->setLongitude($newValue["longitude"]);
                $geopoint->setLatitude($newValue["latitude"]);
            }
            return $container->$setter($geopoint);
        });
    }
}

