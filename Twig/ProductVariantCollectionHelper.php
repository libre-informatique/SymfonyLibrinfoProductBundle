<?php

/*
 *
 * Copyright (C) 2015-2017 Libre Informatique
 *
 * This file is licenced under the GNU GPL v3.
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Sil\Bundle\EcommerceBundle\Twig;

class ProductVariantCollectionHelper extends \Twig_Extension
{
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('handleHeaderFields', [$this, 'handleHeaderFields'], ['is_safe'=>['html']]),
        ];
    }

    public function handleHeaderFields($fields, $displayOrder)
    {
        $fieldsArray = array_flip($displayOrder);
        foreach ($fields as $fieldName => $field) {
            $fieldsArray[$fieldName] = $field;
        }

        return $fieldsArray;
    }
}
