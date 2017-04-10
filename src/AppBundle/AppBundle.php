<?php

namespace AppBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use AppBundle\DependencyInjection\AppBundleExtension;

class AppBundle extends Bundle
{
    public function getParent()
    {
        return 'SonataAdminBundle';
    }

}
