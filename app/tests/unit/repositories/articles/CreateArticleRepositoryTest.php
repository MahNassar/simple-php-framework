<?php

namespace tests\unit\repositories;

use PHPUnit\Framework\TestCase;
use core\lib\Container;
use ReflectionClass;
use Faker\Factory; 
use core\helpers\session\Auth;

class CreateArticleRepositoryTest extends TestCase
{
    private $faker;

    public function setUp()
    {
        $this->faker = Factory::create();
    }
    
    public function testCreate()
    {

        $createArticlesRepository = Container::get("CreateArticlesRepository");

        // test negative create article without login
        $params = [
            'title' => $this->faker->text(60),
            'url' => $this->faker->url,
            'content' => $this->faker->text()
        ];
        $this->assertFalse($createArticlesRepository->create($params));

        // test postive create article
        $this->setMockAuth();
        $params = [
            'title' => $this->faker->text(60),
            'url' => $this->faker->url,
            'content' => $this->faker->text()
        ];
        $this->assertTrue($createArticlesRepository->create($params));


        // test negative create article without passing title
        $params = [
            'url' => $this->faker->url,
            'content' => $this->faker->text()
        ];
        $this->assertFalse($createArticlesRepository->create($params));

        // test negative create article without passing content
        $params = [
            'url' => $this->faker->url,
            'title' => $this->faker->text(60)
        ];
        $this->assertFalse($createArticlesRepository->create($params));

    }

    public function testGetValidationErrors()
    {
        // test postive getValidationErrors with no erros
        $createArticlesRepository = Container::get("CreateArticlesRepository");
        $this->setMockAuth();
        $params = [
            'title' => $this->faker->text(60),
            'url' => $this->faker->url,
            'content' => $this->faker->text()
        ];
        $createArticlesRepository->create($params);
        $this->assertEmpty($createArticlesRepository->getValidationErrors());

        // test negative getValidationErrors with no passing titlte and content
        $createArticlesRepository = Container::get("CreateArticlesRepository");
        $params = [];
        $createArticlesRepository->create($params);
        $this->assertNotEmpty($createArticlesRepository->getValidationErrors());
    }

    private function setMockAuth()
    {
        $getUsersRepository = Container::get("GetUsersRepository");
        $user = $getUsersRepository->getOne(1);
        Auth::login($user);
    }
}
