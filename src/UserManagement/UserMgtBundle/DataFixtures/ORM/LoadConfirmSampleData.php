<?php
namespace UserManagement\UserMgtBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use UserManagement\UserMgtBundle\Entity\User;

class LoadConfirmSampleData implements FixtureInterface, ContainerAwareInterface
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
      $confirm = new Confirm();
      $confirm = $confirm->setUser($manager->merge($this->getReference('user')));
      $confirm->setEmail('sample@sample.com');
      $key = md5(uniqid('sample@sample.com'));
      //var_dump($date);
      //exit;
      $confirm->setConfirmKey($key);
      $date = new \DateTime('now'); 
      $date = $date->format('YmdHis');
      $confirm->setconfirmDate(new \DateTime($date));
      $confirm->setIsConfirmed(0);
      
      $em->persist($confirm);

      $manager->flush();
    }
}