<?php

require_once("DB.php");

class DBTest extends PHPUnit_Framework_TestCase
{
    public $db;

    function setUp()
    {
        $this->db = new DB();
    }

    function tearDown() {
        unset($this->db);
    }

    function exist($name, $phone) {
        $contacts = $this->db->all();
        foreach ($contacts as $index => $contact) {
            if ($contact['name'] == $name && $contact['phone'] == $phone) {
                return true;
            }
        }
        return false;
    }

    function total() {
        return count($this->db->all());
    }

    function test001()
    {
        $this->db->add("abc", "123");
        $this->assertTrue($this->exist("abc", "123"));
    }

    function test002()
    {
        $pre = $this->total();
        $this->db->add("bcd", "1234");
        $post = $this->total();
        $this->assertTrue($post - $pre == 1);
    }
}
