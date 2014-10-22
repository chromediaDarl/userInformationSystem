<?php

namespace UserManagement\UserMgtBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Bundle\FrameworkBundle\Client;
use Symfony\Component\BrowserKit\Cookie;
use Symfony\Component\HttpFoundation\Session\Session;

class DefaultControllerTest extends WebTestCase
{
	private $client = null;
	private $crawler;
	private $link;
	private $links;
    private $user;

	public function __construct()
    {
        parent::__construct();
        $this->client = static::createClient();
        $this->client->followRedirects();
    }
    public function testWelcome()
    {
        $crawler = $this->client->request('GET', '/');

        $this->assertTrue($this->client->getResponse()->isSuccessful());
        $this->assertGreaterThan(0, $crawler->filter('html:contains("Welcome To Our Studio")')->count());
	    $this->assertTrue(200 === $this->client->getResponse()->getStatusCode());
        //We click a link and go to the detail page
        $links[0] = $crawler->selectLink('Services')->link();
        
        $link = $links[0];

        $links[1] = $crawler->selectLink('Portfolio')->link();
        $link = $links[1];

        $links[2] = $crawler->selectLink('About')->link();
        $link = $links[2];

        $links[3] = $crawler->selectLink('Team')->link();
        $link = $links[3];

        $links[4] = $crawler->selectLink('Contact')->link();
        $link = $links[4];

        $links[5] = $crawler->selectLink('Log In')->link();
        $link = $links[5];

        $this->assertGreaterThan(0, $crawler->filter('a:contains("Services")')->count());
        $this->assertGreaterThan(0, $crawler->filter('a:contains("Portfolio")')->count());
        $this->assertGreaterThan(0, $crawler->filter('a:contains("About")')->count());
        $this->assertGreaterThan(0, $crawler->filter('a:contains("Team")')->count());
        $this->assertGreaterThan(0, $crawler->filter('a:contains("Contact")')->count());
        $this->assertGreaterThan(0, $crawler->filter('a:contains("Log In")')->count());

        $crawler=$this->client->click($link);
    }
    public function testLogin()
    {
    	$crawler = $this->client->request('GET', '/login');

        $this->assertTrue($this->client->getResponse()->isSuccessful());
        $this->assertGreaterThan(0, $crawler->filter('html:contains("Sign In")')->count());

        // set some values
        $form = $crawler->selectButton('signin')->form(array(
        '_username' => 'kimberlydarl.barbadillo@chromedia.com',
        '_password' => 'sample123'));

        // submit the form
        $crawler = $this->client->submit($form);

        //After successful loging
        $this->assertTrue(200 === $this->client->getResponse()->getStatusCode(), "expected status code of 200, got " . $this->client->getResponse()->getStatusCode() . $this->client->getResponse()->getContent());
        $this->assertTrue($crawler->filter('html:contains("Hello")')->count() > 0, "The text 'Hello' was not found");
        //var_dump($crawler);
        $this->client->followRedirects(true);

    }
    public function testLoginWrongPassword()
    {
        $crawler = $this->client->request('GET', '/login');

        $this->assertTrue($this->client->getResponse()->isSuccessful());
        $this->assertGreaterThan(0, $crawler->filter('html:contains("Sign In")')->count());

        // set some values
        $form = $crawler->selectButton('signin')->form(array(
        '_username' => 'kimberlydarl.barbadillo@chromedia.com',
        '_password' => 'sample'));

        // submit the form
        $crawler = $this->client->submit($form);

        //After successful loging
        $this->assertTrue(200 === $this->client->getResponse()->getStatusCode(), "expected status code of 200, got " . $this->client->getResponse()->getStatusCode() . $this->client->getResponse()->getContent());
        $this->assertTrue($crawler->filter('html:contains("Bad credentials")')->count() > 0, "The text 'Bad credentials' was not found");
        //var_dump($crawler);
        $this->client->followRedirects(true);

    }

    public function testIndex()
    {
        $this->testLogin();
        //After successful loging
        $this->assertTrue(200 === $this->client->getResponse()->getStatusCode(), "expected status code of 200, got " . $this->client->getResponse()->getStatusCode() . $this->client->getResponse()->getContent());   
    }
    public function testSignup()
    {

        $crawler = $this->client->request('POST', '/signup');

        $this->assertTrue($this->client->getResponse()->isSuccessful());
        $this->assertGreaterThan(0, $crawler->filter('html:contains("Sign Up")')->count());

        // set some values
        $signupform = $crawler->selectButton('signup')->form(array(
        'user[fname]' => 'Sample',
        'user[lname]' => 'Lastname',
        'user[email]' => 'sample@sample.com',
        'user[password]' => 'sample',
        'user[conpassword]' => 'sample'));

        // submit the form
        $crawler = $this->client->submit($signupform);

        //var_dump($crawler);

        $this->client->enableProfiler();

        $mailCollector = $this->client->getProfile()->getCollector('swiftmailer');

        $collectedMessages = $mailCollector->getMessages();
        $message = $collectedMessages[0];

        // Asserting e-mail data
        $this->assertInstanceOf('Swift_Message', $message);
        $this->assertEquals('Email Confirmation', $message->getSubject());
        $this->assertEquals('kimberlydarl.barbadillo@chromedia.com', key($message->getFrom()));
        $this->assertEquals('kimberlydarl.barbadillo@chromedia.com', key($message->getTo()));
        $this->assertEquals(
            'You should see me from the profiler!',
            $message->getBody()
        );

        // Check that an e-mail was sent
        $this->assertEquals(1, $mailCollector->getMessageCount());

        $this->client->followRedirects(true);

        $this->assertTrue(200 === $this->client->getResponse()->getStatusCode(), "expected status code of 200, got " . $this->client->getResponse()->getStatusCode() . $this->client->getResponse()->getContent());
        $this->assertTrue($crawler->filter('html:contains("You have successfully created your account.")')->count() > 0, "The text 'You have successfully created your account.' was not found");
        //var_dump($crawler);
        $this->user = 'Sample';
        return $this->user;

    }
    /*public function testProfile()
    {
        $crawler = $this->client->request('POST', '/user/profile');

        //$this->assertEquals('UserManagement\UserMgtBundle\Controller\DefaultController::profileAction', $this->client->getRequest()->attributes->get('_controller'));
        var_dump($crawler);
        $this->assertTrue($this->client->getResponse()->isSuccessful());
        $this->assertGreaterThan(0, $crawler->filter('html:contains("Your Profile")')->count());

        /*$form = $crawler->selectButton('profile')->form(array(
        'currentuser[fname]' => 'Sample Name',
        'currentuser[lname]' => 'Sample Lastname',
        'currentuser[email]' => 'kimberlydarl.barbadillo@chromedia.com'));

        // submit the form
        $crawler = $this->client->submit($form);

        $this->assertTrue(200 === $this->client->getResponse()->getStatusCode(), "expected status code of 200, got " . $this->client->getResponse()->getStatusCode() . $this->client->getResponse()->getContent());
        $this->assertTrue($crawler->filter('html:contains("Successfully updated profile.")')->count() > 0, "The text 'Successfully updated profile.' was not found");
    }*/
}
