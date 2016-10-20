<?php

namespace AcmeNewsBundle;

use AcmeNewsBundle\Extensions\AcmeNewsExtension;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class AcmeNewsBundle extends Bundle
{
    public function getContainerExtension()
    {
        return new AcmeNewsExtension();
    }
}
