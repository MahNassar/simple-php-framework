<?php

namespace tests\unit\repositories;

use PHPUnit\Framework\TestCase;
use core\lib\Container;
use ReflectionClass;

class LoginRepositoryTest extends TestCase
{
    public function testLogin()
    {
        // test postive login
        $loginRepository = Container::get("LoginRepository");
        $loginParams = ['email' => 'dummyuser1@gmail.com', 'password' => '123456'];
        $this->assertTrue($loginRepository->login($loginParams));

        // test negative login without passing params
        $loginParams = [];
        $this->assertFalse($loginRepository->login($loginParams));

        // test negative login with wrong email
        $loginParams = ['email' => 'dummyuser100000@gmail.com', 'password' => '123456'];
        $this->assertFalse($loginRepository->login($loginParams));

        // test negative login with wrong password
        $loginParams = ['email' => 'dummyuser1@gmail.com', 'password' => '12345678'];
        $this->assertFalse($loginRepository->login($loginParams));
    }

    public function testGetLoginError()
    {
        // test getLoginError whith no errors
        $loginRepository = Container::get("LoginRepository");
        $loginParams = ['email' => 'dummyuser1@gmail.com', 'password' => '123456'];
        $loginRepository->login($loginParams);
        $this->assertEmpty($loginRepository->getLoginError());

        // test  getLoginError without passing params
        $loginRepository = Container::get("LoginRepository");
        $loginParams = [];
        $loginRepository->login($loginParams);
        $this->assertNotEmpty($loginRepository->getLoginError());
        $this->assertEquals($loginRepository->getLoginError(), 'Invalid Login Params!');

        // // test getLoginError with wrong email
        $loginRepository = Container::get("LoginRepository");
        $loginParams = ['email' => 'dummyuser100000@gmail.com', 'password' => '123456'];
        $loginRepository->login($loginParams);
        $this->assertEquals($loginRepository->getLoginError(), 'Invalid user or password!');

        // test getLoginErrorwith wrong password
        $loginRepository = Container::get("LoginRepository");
        $loginParams = ['email' => 'dummyuser1@gmail.com', 'password' => '12345678'];
        $loginRepository->login($loginParams);
        $this->assertEquals($loginRepository->getLoginError(), 'Invalid user or password!');
    }

    public function testComparePasswords()
    {
        $loginRepository = Container::get("LoginRepository");
        $function = self::getMethod('comparePasswords');
        
        $this->assertFalse($function->invokeArgs($loginRepository, ['12345678', 'e10adc3949ba59abbe56e057f20f883e']));
        $this->assertTrue($function->invokeArgs($loginRepository, ['123456', 'e10adc3949ba59abbe56e057f20f883e']));
    }

    protected static function getMethod($name)
    {
        $class = new ReflectionClass(get_class(Container::get("LoginRepository")));
        $method = $class->getMethod($name);
        $method->setAccessible(true);
        return $method;
    }
}
