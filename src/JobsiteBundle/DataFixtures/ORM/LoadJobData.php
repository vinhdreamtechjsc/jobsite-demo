<?php
namespace JobsiteBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use JobsiteBundle\Entity\Job;
use GuzzleHttp\Client;

class LoadJobData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $em)
    {
        $jobImport = new Job();
        $jobImport->setCategory($em->merge($this->getReference('category-programming')));
        $jobImport->setType('full-time');
        $jobImport->setCompany('Sensio Labs');
        $jobImport->setLogo('sensio-labs.gif');
        $jobImport->setUrl('http://www.sensiolabs.com/');
        $jobImport->setPosition('Web Developer');
        $jobImport->setLocation('Paris, France');
        $jobImport->setDescription('You\'ve already developed websites with symfony and you want to work with Open-Source technologies. You have a minimum of 3 years experience in web development with PHP or Java and you wish to participate to development of Web 2.0 sites using the best frameworks available.');
        $jobImport->setHowToApply('Send your resume to fabien.potencier [at] sensio.com');
        $jobImport->setIsPublic(true);
        $jobImport->setIsActivated(true);
        $jobImport->setToken('job_sensio_labs');
        $jobImport->setEmail('job@example.com');
        $jobImport->setExpiresAt(new \DateTime('+30 days'));


        $em->persist($jobImport);
        $em->flush();
    }

    public function getOrder()
    {
        return 2; // the order in which fixtures will be loaded
    }
}