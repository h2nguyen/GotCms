<?php
namespace Gc\Script;

/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.0 on 2012-10-17 at 20:40:10.
 * @backupGlobals disabled
 * @backupStaticAttributes disabled
 */
class ModelTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Model
     */
    protected $_object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->_object = new Model;
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
        unset($this->_object);
    }

    /**
     * @covers Gc\Script\Model::init
     */
    public function testInit()
    {
        $this->_object->init(1);
        $this->assertEquals(1, $this->_object->getId());
    }

    /**
     * @covers Gc\Script\Model::fromArray
     */
    public function testFromArray()
    {
        $array = array(
            'id' => 1,
            'name' => 'String',
            'identifier' => 'string',
            'description' => 'Description',
            'content' => 'Content',
            'updated_at' => date('Y-m-d H:i:s'),
        );
        $model = $this->_object->fromArray($array);
        $this->assertEquals(1, $model->getId());
    }

    /**
     * @covers Gc\Script\Model::fromId
     */
    public function testFromId()
    {
        $array = array(
            'name' => 'String',
            'identifier' => 'string',
            'description' => 'Description',
            'content' => 'Content',
        );
        $model = $this->_object->fromArray($array);
        $model->save();
        $id = $model->getId();

        $model = $this->_object->fromId($id);
        $this->assertEquals('string', $model->getIdentifier());
    }

    /**
     * @covers Gc\Script\Model::fromId
     */
    public function testFromFakeId()
    {
        $model = $this->_object->fromId(10000);
        $this->assertFalse($model);
    }

    /**
     * @covers Gc\Script\Model::fromIdentifier
     */
    public function testFromIdentifier()
    {
        $array = array(
            'name' => 'Test Identifier',
            'identifier' => 'test-identifier',
            'description' => 'Description',
            'content' => 'Content',
        );
        $model = $this->_object->fromArray($array);
        $model->save();

        $model = $this->_object->fromIdentifier('test-identifier');
        $this->assertEquals('Test Identifier', $model->getName());
    }

    /**
     * @covers Gc\Script\Model::fromIdentifier
     */
    public function testFromFakeIdentifier()
    {
        $model = $this->_object->fromIdentifier('fake-identifier');
        $this->assertFalse($model);
    }

    /**
     * @covers Gc\Script\Model::save
     */
    public function testSave()
    {
        $array = array(
            'name' => 'Test Identifier',
            'identifier' => 'test-save-identifier',
            'description' => 'Description',
            'content' => 'Content',
        );

        $model = $this->_object->fromArray($array);
        $model->save();
        $this->assertTrue((bool)$model->getId());
    }

    /**
     * @covers Gc\Script\Model::delete
     */
    public function testDelete()
    {
        $array = array(
            'name' => 'Test Identifier',
            'identifier' => 'test-delete-identifier',
            'description' => 'Description',
            'content' => 'Content',
        );
        $model = $this->_object->fromArray($array);
        $model->save();

        $this->assertTrue($model->delete());
    }

    /**
     * @covers Gc\Script\Model::delete
     */
    public function testFakeDelete()
    {
        $model = new Model();

        $this->assertTrue($model->delete());
    }
}
