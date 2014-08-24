<?php

namespace Pizz\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class PizzUserBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
