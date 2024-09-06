<?php

namespace Yceruto\DecoratorBundle\Tests\Integration\Fixtures\Decorator;

use Yceruto\Decorator\Attribute\DecoratorMetadata;

#[\Attribute(\Attribute::TARGET_METHOD)]
final class Secured extends DecoratorMetadata
{
}
