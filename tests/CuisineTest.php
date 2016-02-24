<?php
    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Cuisine.php";
    require_once "src/Restaurant.php";

    $server = 'mysql:host=localhost;dbname=cuisine_restaurant';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class CuisineTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Cuisine::deleteAll();
            //Restaurant::deleteAll();
        }

        function test_getName()
        {
            //Arrange
            $name = "Italian";
            $test_Cuisine = new Cuisine($name);

            //Act
            $result = $test_Cuisine->getName();

            //assert
            $this->assertEquals($name, $result);
        }

        function test_getId()
        {
            //Arrange
            $name = "Italian";
            $id = 1;
            $test_Cuisine = new Cuisine($name, $id);

            //Act
            $result = $test_Cuisine->getId();

            //assert
            $this->assertEquals(true, is_numeric($result));
        }

        function test_save()
        {
            //Arrange
            $name = "Italian";
            $test_Cuisine = new Cuisine($name);
            $test_Cuisine->save();

            //Act
            $result = Cuisine::getAll();

            //Assert
            $this->assertEquals($test_Cuisine, $result[0]);
        }

        function testGetRestaurants()
        {
            //Arrange
            $name = "Italian";
            $id = null;
            $test_cuisine = new Cuisine($name, $id);
            $test_cuisine->save();

            $test_cuisine_id = $test_cuisine->getId();

            $restaurant_name = "Mario's";
            $test_restaurant = new Restaurant($restaurant_name, $test_cuisine_id, $id);
            $test_restaurant->save();

            $restaurant_name2 = "Luigi's";
            $test_restaurant2 = new Restaurant($restauarant_name2, $test_cuisine_id, $id);
            $test_restaurant2->save();

            //Act
            $result = $test_cuisine->getRestaurants();

            //Assert
            $this->assertEquals([$test_cuisine, $test_cuisine2], $result);
        }

        function test_getAll()
        {
            //Arrange
            $name = "Italian";
            $name2 = "Mexican";
            $test_Cuisine = new Cuisine($name);
            $test_Cuisine->save();
            $test_Cuisine2 = new Cuisine($name2);
            $test_Cuisine2->save();

            //Act
            $result = Cuisine::getAll();

            //Assert
            $this->assertEquals([$test_Cuisine, $test_Cuisine2], $result);
        }

        function test_deleteAll()
        {
            //Arrange
            $name = "Italian";
            $name2 = "Mexican";
            $test_Cuisine = new Cuisine($name);
            $test_Cuisine->save();
            $test_Cuisine2 = new Cuisine($name2);
            $test_Cuisine2->save();

            //Act
            Cuisine::deleteAll();
            $result = Cuisine::getAll();

            //Assert
            $this->assertEquals([], $result);
        }
    }

 ?>
