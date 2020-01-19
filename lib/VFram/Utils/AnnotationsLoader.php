<?php

namespace VFram\Utils;

class AnnotationsLoader
{
    public static function loadAnnotations()
    {
        require __DIR__ . '/../Routing/Annotations/Route.php';
    }
}