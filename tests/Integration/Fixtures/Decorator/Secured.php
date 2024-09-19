<?php

namespace Yceruto\DecoratorBundle\Tests\Integration\Fixtures\Decorator;

use Yceruto\Decorator\Attribute\DecoratorAttribute;

#[\Attribute(\Attribute::TARGET_METHOD)]
final class Secured extends DecoratorAttribute
{
}
