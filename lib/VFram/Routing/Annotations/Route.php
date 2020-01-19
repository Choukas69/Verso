<?php

namespace VFram\Routing\Annotations;

use Doctrine\Common\Annotations\Annotation\Required;

/**
 * @Annotation
 */
final class Route
{
    /**
     * @Required
     * @var String
     */
    public String $path;

    /**
     * @var String[]
     */
    public array $requirements = [];
}