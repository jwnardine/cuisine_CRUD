<?php
    class Restaurant
    {
        private $name;
        private $cuisine_id;
        private $id;

        function __construct($name, $cuisine_id, $id = null)
        {
            $this->name = $name;
            $this->cuisine_id = $cuisine_id;
            $this->id = $id;
        }

        function setName($new_name)
        {
            $this->name = (string) $new_name;
        }

        function getName()
        {
            return $this->name;
        }

        function getId()
        {
            return $this->id;
        }

        function getCuisineId()
        {
            return $this->cuisine_id;
        }

        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO restaurants (name, cuisine_id, id) VALUES ('{$this->getName()}', '{$this->getCuisineId()}', '{$this->getId()}')");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM restuarants;");
        }
    }
 ?>
