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
 *  @copyright  Copyright (c) Pimcore GmbH (http://www.pimcore.org)
 *  @license    http://www.pimcore.org/license     GPLv3 and PEL
 */

namespace Pimcore\Bundle\DataHubBundle\GraphQL\MutationFieldConfigGenerator;

use GraphQL\Type\Definition\Type;
use Pimcore\Model\DataObject\ClassDefinition\Data;

class Numeric extends Base
{

    /**
     * @param $nodeDef
     * @param $class
     * @param $container
     * @return array
     */
    public function getGraphQlMutationFieldConfig($nodeDef, $class, $container = null)
    {
        $processor = new \Pimcore\Bundle\DataHubBundle\GraphQL\InputProcessor\Base($nodeDef);
        $processor->setGraphQLService($this->getGraphQlService());

        $type = Type::float();
        $nodeAttributes = $nodeDef["attributes"];
        $key = $nodeAttributes["attribute"];
        $fieldDefinition = $this->getGraphQlService()->getObjectFieldHelper()->getFieldDefinitionFromKey($class, $key);
        if ($fieldDefinition instanceof Data\Numeric) {
            if ($fieldDefinition->getInteger()) {
                $type = Type::int();
            }
        }

        return [
            'arg' => $type,
            'processor' => [$processor, 'process']
        ];
    }


}
