<?php
namespace Jplarar\SESBundle;

use Jplarar\SESBundle\DependencyInjection\JplararSESExtension;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class JplararSESBundle extends Bundle
{
    /**
     * {@inheritDoc}
     * @version 0.0.1
     * @since 0.0.1
     */
    public function getContainerExtension()
    {
        // this allows us to have custom extension alias
        // default convention would put a lot of underscores
        if (null === $this->extension) {
            $this->extension = new JplararSESExtension();
        }

        return $this->extension;
    }
}