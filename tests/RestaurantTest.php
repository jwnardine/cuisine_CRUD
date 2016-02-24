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

            $name = "Marios";
            $cuisine_id = $test_cuisine->getId();
            $test_restaurant = new Restaurant($name, $cuisine_id, $id);
            $test_restaurant->save();

            //Act
            $result = $test_restaurant->getId();

            //Assert
            $this->assertEquals(true, is_numeric($result));
        }

        function test_getCuisineId()
        {
            //Arrange
            $name = "Italian";
            $id = null;
            $test_cuisine = new Cuisine($name, $id);
            $test_cuisine->save();

            $name = "Marios";
            $cuisine_id = $test_cuisine->getId();
            $test_restaurant = new Restaurant($name, $cuisine_id, $id);
            $test_restaurant->save();

            //Act
            $result = $test_restaurant->getCuisineId();

            //Assert
            $this->assertEquals(true, is_numeric($result));
        }

        function test_save()
       {
           //Arrange
           $name = "Italian";
           $id = null;
           $test_cuisine = new Cuisine($name, $id);
           $test_cuisine->save();

           $restaurant_name = "Marios";
           $cuisine_id = $test_cuisine->getId();
           $test_restaurant = new Restaurant($restaurant_name , $cuisine_id, $id);

           //Act
           $test_restaurant->save();

           //Assert
           $result = Restaurant::getAll();
           $this->assertEquals($test_restaurant, $result[0]);
       }

       function test_getAll()
       {
           //Arrange
           $name = "Italian";
           $id = null;
           $test_cuisine = new Cuisine($name, $id);
           $test_cuisine->save();

           $restaurant_name = "Marios";
           $cuisine_id = $test_cuisine->getId();

           $test_restaurant = new Restaurant($restaurant_name, $cuisine_id, $id);
           $test_restaurant->save();

           $restaurant_name2 = "Luigis";
           $cuisine_id= $test_cuisine->getId();
           $test_restaurant2 = new Restaurant($restaurant_name2, $cuisine_id, $id);
           $test_restaurant2->save();

           //Act
           $result = Restaurant::getAll();

           //Assert
           $this->assertEquals([$test_restaurant, $test_restaurant2], $result);
       }

       function test_deleteAll()
      {
          //Arrange
          $name = "Italian";
          $id = null;
          $test_cuisine = new Cuisine($name, $id);
          $test_cuisine->save();

          $restaurant_name = "Marios";
          $cuisine_id = $test_cuisine->getId();
          $test_restaurant = new Restaurant($restaurant_name, $cuisine_id, $id);
          $test_restaurant->save();

          $restaurant_name2 = "Luigis";
          $test_restaurant2 = new Restaurant($restaurant_name2, $cuisine_id, $id);
          $test_restaurant2->save();

          //Act
          Restaurant::deleteAll();

          //Assert
          $result = Restaurant::getAll();
          $this->assertEquals([], $result);
      }
    }
?>
