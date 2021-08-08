<?php

/**
 * Class SentiusTest
 *
 * @package Sentius_Map
 */

/**
 * Sample test case.
 */
class SentiusTest extends WP_UnitTestCase
{

    /**
     * A single example test.
     */
    public function test_sample()
    {
        // Replace this with some actual testing code.
        $string = 'Unit tests are sweet';

        $this->assertEquals('Unit tests are sweet', $string);
    }

    public function setUp()
    {
        // make a fake user
        $this->author = new WP_User($this->factory->user->create(array('role' => 'editor')));
    }

    public function tearDown()
    {
        parent::tearDown();
        wp_delete_user($this->author->ID, true);
    }

    public function test_user()
    {
        // make sure setUp user has the cap we want
        $user = get_user_by('id', $this->author->ID);

        $this->assertTrue(user_can($user, 'edit_posts'), 'The user does not have the edit_posts capability and they should not');
        $this->assertFalse(user_can($user, 'activate_plugins'), 'The user can activate plugins and the should not be able to');
    }
}
