<?php
namespace UserManagement\UserMgtBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use UserManagement\UserMgtBundle\Entity\User;

class LoadUserSammpleData implements FixtureInterface, ContainerAwareInterface
{

    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * {@inheritDoc}
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
      $user = new User();
      $user->setIsActive(0);
      $user->setEmail("sample@sample.com");
      $user->setFname("Sample");
      $user->setLname("Sample Lastname");
      $user->setSalt(md5(uniqid()));
      $encoder = $this->container->get('security.encoder_factory')->getEncoder($user);
      $user->setPassword($encoder->encodePassword('sample', $user->getSalt()));

      $manager->persist($user);

      $manager->flush();
    }
}