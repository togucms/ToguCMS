<?php

use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;

class AppKernel extends Kernel {

    public function registerBundles() {
        $bundles = array(
            new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new Symfony\Bundle\SecurityBundle\SecurityBundle(),
            new Symfony\Bundle\TwigBundle\TwigBundle(),
            new Symfony\Bundle\MonologBundle\MonologBundle(),
            new Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle(),
            new Symfony\Bundle\AsseticBundle\AsseticBundle(),
            new Doctrine\Bundle\DoctrineBundle\DoctrineBundle(),
			new Doctrine\Bundle\FixturesBundle\DoctrineFixturesBundle(),
        	new Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),
            new JMS\SerializerBundle\JMSSerializerBundle(),
            new FOS\RestBundle\FOSRestBundle(),
            new \Tpg\ExtjsBundle\TpgExtjsBundle(),
            new FOS\UserBundle\FOSUserBundle(),

        	new Sonata\DoctrineORMAdminBundle\SonataDoctrineORMAdminBundle(),
        	new Sonata\CoreBundle\SonataCoreBundle(),
        	new Sonata\IntlBundle\SonataIntlBundle(),
        	new Sonata\AdminBundle\SonataAdminBundle(),
        	new Sonata\MediaBundle\SonataMediaBundle(),
        	new Sonata\EasyExtendsBundle\SonataEasyExtendsBundle(),

       		new Doctrine\Bundle\PHPCRBundle\DoctrinePHPCRBundle(),
       		new Symfony\Cmf\Bundle\RoutingBundle\CmfRoutingBundle(),
       		new Symfony\Cmf\Bundle\CoreBundle\CmfCoreBundle(),
       		new Knp\Bundle\MenuBundle\KnpMenuBundle(),
       		new Symfony\Cmf\Bundle\MenuBundle\CmfMenuBundle(),
       		new Symfony\Cmf\Bundle\ContentBundle\CmfContentBundle(),
       		new Symfony\Cmf\Bundle\SeoBundle\CmfSeoBundle(),
       		new Sonata\SeoBundle\SonataSeoBundle(),
       		new Liip\SearchBundle\LiipSearchBundle(),
       		new Symfony\Cmf\Bundle\SearchBundle\CmfSearchBundle(),
       		new Symfony\Cmf\Bundle\MediaBundle\CmfMediaBundle(),

        	new Application\Sonata\MediaBundle\ApplicationSonataMediaBundle(),

        	new Togu\UserBundle\ToguUserBundle(),

        	new Togu\TemplateBundle\ToguTemplateBundle(),
            new Togu\AnnotationBundle\ToguAnnotationBundle(),
            new Togu\FrontendBundle\ToguFrontendBundle(),
            new Togu\MediaBundle\ToguMediaBundle(),
            new Togu\SerializationBundle\ToguSerializationBundle(),
            new Togu\GeneratorBundle\ToguGeneratorBundle(),
            new Togu\ApplicationModelsBundle\ToguApplicationModelsBundle(),
            new Togu\AdminBundle\ToguAdminBundle(),
            new Application\Togu\ApplicationModelsBundle\ApplicationToguApplicationModelsBundle(),
        	new Doctrine\Bundle\DoctrineCacheBundle\DoctrineCacheBundle(),
        );

        if (in_array($this->getEnvironment(), array('dev', 'test'))) {
            $bundles[] = new Symfony\Bundle\WebProfilerBundle\WebProfilerBundle();
            $bundles[] = new Sensio\Bundle\DistributionBundle\SensioDistributionBundle();
            $bundles[] = new Sensio\Bundle\GeneratorBundle\SensioGeneratorBundle();
        }

        return $bundles;
    }

    public function registerContainerConfiguration(LoaderInterface $loader) {
        $loader->load(__DIR__ . '/config/config_' . $this->getEnvironment() . '.yml');
    }

}
