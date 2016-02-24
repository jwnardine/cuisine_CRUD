<?php

/**
   * @backupGlobals disabled
   * @backupStaticAttributes disabled
   */

   require_once "src/Restaurant.php";
   require_once "src/Cuisine.php";

   $server = 'mysql:host=localhost;dbname=cuisine_restaurant_test';
   $username = 'root';
   $password = 'root';
   $DB = new PDO($server, $username, $password);


   class RestaurantTest extends PHPUnit_Framework_TestCase
   {
        protected function tearDown()
        {
            Restaurant::deleteAll();
            Cuisine::deleteAll();
        }
        function test_getId()
        {
            //Arrange
            $name = "Italian";
            $id = null;
            $test_cuisine = new Cuisine($name, $id);
            $test_cuisine->save();

            $name = "Mario's";
            $cuisine_id = $test_cuisine->getId();
            $test_restaurant = new Restaurant($name, $cuisine_id, $id);
            $test_restaurant->save();

            //Act
            $result = $test_restaurant->getId();

            //Assert
            $this->assertEquals(true, is_numeric($result));
        }

        function test_CuisineId()
        {
            //Arrange
            $name = "Italian";
            $id = null;
            $test_cuisine = new Cuisine($name, $id);
            $test_cuisine->save();

            $name = "Mario's";
            $cuisine_id = $test_cuisine->getId();
            $test_restaurant = new Restaurant($name, $cuisine_id, $id);
            $test_restaurant->save();

            //Act
            $result = $test_restaurant->getCuisineId();

            //Assert
            $this->assertEquals(true, is_numeric($result));
        }
    }
?>
