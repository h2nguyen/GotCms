<?php
/**
 * This source file is part of GotCms.
 *
 * GotCms is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * GotCms is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public License along
 * with GotCms. If not, see <http://www.gnu.org/licenses/lgpl-3.0.html>.
 *
 * PHP Version >=5.3
 *
 * @category Gc_Tests
 * @package  Modules
 * @author   Pierre Rambaud (GoT) <pierre.rambaud86@gmail.com>
 * @license  GNU/LGPL http://www.gnu.org/licenses/lgpl-3.0.html
 * @link     http://www.got-cms.com
 */

namespace Backup\Model;

use Gc\Datatype\Model as DatatypeModel;
use Gc\Document\Model as DocumentModel;
use Gc\DocumentType\Model as DocumentTypeModel;
use Gc\Layout\Model as LayoutModel;
use Gc\Property\Model as PropertyModel;
use Gc\Tab\Model as TabModel;
use Gc\User\Model as UserModel;
use Gc\View\Model as ViewModel;
use Gc\Script\Model as ScriptModel;
use Gc\Registry;
use SimpleXMLElement;

/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.0 on 2013-02-27 at 19:33:17.
 *
 * @group Modules
 * @category Gc_Tests
 * @package  Modules
 */
class ContentTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Files
     */
    protected $object;

    /**
     * User model
     *
     * @var UserModel
     */
    protected $user;

    /**
     * @var ViewModel
     */
    protected $view;

    /**
     * @var ScriptModel
     */
    protected $script;

    /**
     * @var DocumentTypeModel
     */
    protected $documentType;

    /**
     * @var DatatypeModel
     */
    protected $datatype;

    /**
     * @var TabModel
     */
    protected $tabModel;

    /**
     * @var PropertyModel
     */
    protected $property;

    /**
     * @var DocumentModel
     */
    protected $document;

    /**
     * @var array
     */
    protected $what = array(
        'document',
        'document-type',
        'datatype',
        'view',
        'layout',
        'script'
    );

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     *
     * @return void
     */
    protected function setUp()
    {
        $this->object = new Content(Registry::get('Application')->getServiceManager());
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     *
     * @return void
     */
    protected function tearDown()
    {
        unset($this->object);
    }

    /**
     * Test
     *
     * @return void
     */
    public function testExportWithEmptyParameterShouldReturnFalse()
    {
        $this->assertFalse($this->object->export(array()));
    }

    /**
     * Test
     *
     * @return void
     */
    public function testExportwithEmptyContent()
    {
        $this->assertEquals(
            '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL . '<gotcms></gotcms>',
            $this->object->export($this->what)
        );
    }

    /**
     * Test
     *
     * @return void
     */
    public function testExportWithUndefinedWhatShouldReturnEmptyString()
    {
        $this->assertEquals(
            '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL . '<gotcms></gotcms>',
            $this->object->export(array('fake'))
        );
    }

    /**
     * Test
     *
     * @return void
     */
    public function testExport()
    {
        $this->createUser();
        $this->createContent();
        $result = $this->object->export($this->what);

        $this->assertInternalType(
            'string',
            $result
        );

        $dom = new SimpleXMLElement($result);

        //Test documents
        $this->assertContains('<documents>', $result);
        $xpath = $dom->xpath('/gotcms/documents/document[@id="' . $this->document->getId() . '"]/name');
        $this->assertEquals($this->document->getName(), (string) $xpath[0]);
        $xpath = $dom->xpath('/gotcms/documents/document[@id="' . $this->document->getId() . '"]/url_key');
        $this->assertEquals('', (string) $xpath[0]);
        $xpath = $dom->xpath('/gotcms/documents/document[@id="' . $this->document->getId() . '"]/document_type_id');
        $this->assertEquals($this->document->getDocumentTypeId(), (string) $xpath[0]);
        $xpath = $dom->xpath('/gotcms/documents/document[@id="' . $this->document->getId() . '"]/layout_id');
        $this->assertEquals($this->document->getLayoutId(), (string) $xpath[0]);
        $xpath = $dom->xpath('/gotcms/documents/document[@id="' . $this->document->getId() . '"]/view_id');
        $this->assertEquals($this->document->getViewId(), (string) $xpath[0]);
        $xpath = $dom->xpath('/gotcms/documents/document[@id="' . $this->document->getId() . '"]/parent_id');
        $this->assertEquals($this->document->getParentId(), (string) $xpath[0]);

        //Test documents properties
        $this->assertContains('<properties>', $result);
        $xpath = $dom->xpath('/gotcms/documents/document[@id="' . $this->document->getId() . '"]/properties/property_value[@id="' . $this->property->getValueModel()->getId() . '"]/document_id');
        $this->assertEquals($this->document->getId(), (string) $xpath[0]);
        $xpath = $dom->xpath('/gotcms/documents/document[@id="' . $this->document->getId() . '"]/properties/property_value[@id="' . $this->property->getValueModel()->getId() . '"]/property_id');
        $this->assertEquals($this->property->getId(), (string) $xpath[0]);
        $xpath = $dom->xpath('/gotcms/documents/document[@id="' . $this->document->getId() . '"]/properties/property_value[@id="' . $this->property->getValueModel()->getId() . '"]/value');
        $this->assertEquals($this->property->getValueModel()->getValue(), (string) $xpath[0]);

        //Test document types
        $this->assertContains('<document_types>', $result);
        $xpath = $dom->xpath('/gotcms/document_types/document_type[@id="' . $this->documentType->getId() . '"]/name');
        $this->assertEquals($this->documentType->getName(), (string) $xpath[0]);
        $xpath = $dom->xpath('/gotcms/document_types/document_type[@id="' . $this->documentType->getId() . '"]/description');
        $this->assertEquals($this->documentType->getDescription(), (string) $xpath[0]);
        $xpath = $dom->xpath('/gotcms/document_types/document_type[@id="' . $this->documentType->getId() . '"]/icon_id');
        $this->assertEquals($this->documentType->getIconId(), (string) $xpath[0]);
        $xpath = $dom->xpath('/gotcms/document_types/document_type[@id="' . $this->documentType->getId() . '"]/default_view_id');
        $this->assertEquals($this->documentType->getDefaultViewId(), (string) $xpath[0]);
        $xpath = $dom->xpath('/gotcms/document_types/document_type[@id="' . $this->documentType->getId() . '"]/user_id');
        $this->assertEquals($this->documentType->getUserId(), (string) $xpath[0]);
        $xpath = $dom->xpath('/gotcms/document_types/document_type[@id="' . $this->documentType->getId() . '"]/tabs/tab[@id="' . $this->tabModel->getId() . '"]/name');
        $this->assertEquals($this->tabModel->getName(), (string) $xpath[0]);
        $xpath = $dom->xpath('/gotcms/document_types/document_type[@id="' . $this->documentType->getId() . '"]/tabs/tab[@id="' . $this->tabModel->getId() . '"]/description');
        $this->assertEquals($this->tabModel->getDescription(), (string) $xpath[0]);
        $xpath = $dom->xpath('/gotcms/document_types/document_type[@id="' . $this->documentType->getId() . '"]/tabs/tab[@id="' . $this->tabModel->getId() . '"]/properties/property[@id="' . $this->property->getId() . '"]/name');
        $this->assertEquals($this->property->getName(), (string) $xpath[0]);
        $xpath = $dom->xpath('/gotcms/document_types/document_type[@id="' . $this->documentType->getId() . '"]/tabs/tab[@id="' . $this->tabModel->getId() . '"]/properties/property[@id="' . $this->property->getId() . '"]/identifier');
        $this->assertEquals($this->property->getIdentifier(), (string) $xpath[0]);
        $xpath = $dom->xpath('/gotcms/document_types/document_type[@id="' . $this->documentType->getId() . '"]/tabs/tab[@id="' . $this->tabModel->getId() . '"]/properties/property[@id="' . $this->property->getId() . '"]/description');
        $this->assertEquals($this->property->getDescription(), (string) $xpath[0]);
        $xpath = $dom->xpath('/gotcms/document_types/document_type[@id="' . $this->documentType->getId() . '"]/tabs/tab[@id="' . $this->tabModel->getId() . '"]/properties/property[@id="' . $this->property->getId() . '"]/required');
        $this->assertEquals((integer) $this->property->getRequired(), (integer) $xpath[0]);
        $this->assertEquals((integer) $this->property->getRequired(), (integer) $xpath[0]);
        $xpath = $dom->xpath('/gotcms/document_types/document_type[@id="' . $this->documentType->getId() . '"]/tabs/tab[@id="' . $this->tabModel->getId() . '"]/properties/property[@id="' . $this->property->getId() . '"]/datatype_id');
        $this->assertEquals($this->datatype->getId(), (string) $xpath[0]);
        $xpath = $dom->xpath('/gotcms/document_types/document_type[@id="' . $this->documentType->getId() . '"]/dependencies/id[text()="' . $this->documentType->getId() . '"]');
        $this->assertEquals($this->documentType->getId(), (string) $xpath[0]);
        $xpath = $dom->xpath('/gotcms/document_types/document_type[@id="' . $this->documentType->getId() . '"]/available_views/id[text()="' . $this->view->getId() . '"]');
        $this->assertEquals($this->view->getId(), (string) $xpath[0]);

        //Test views
        $this->assertContains('<views>', $result);
        $xpath = $dom->xpath('/gotcms/views/view[@id="' . $this->view->getId() . '"]/name');
        $this->assertEquals($this->view->getName(), (string) $xpath[0]);
        $xpath = $dom->xpath('/gotcms/views/view[@id="' . $this->view->getId() . '"]/identifier');
        $this->assertEquals($this->view->getIdentifier(), (string) $xpath[0]);
        $xpath = $dom->xpath('/gotcms/views/view[@id="' . $this->view->getId() . '"]/description');
        $this->assertEquals($this->view->getDescription(), (string) $xpath[0]);
        $xpath = $dom->xpath('/gotcms/views/view[@id="' . $this->view->getId() . '"]/content');
        $this->assertEquals($this->view->getContent(), (string) $xpath[0]);

        //Test layouts
        $this->assertContains('<views>', $result);
        $xpath = $dom->xpath('/gotcms/layouts/layout[@id="' . $this->layout->getId() . '"]/name');
        $this->assertEquals($this->layout->getName(), (string) $xpath[0]);
        $xpath = $dom->xpath('/gotcms/layouts/layout[@id="' . $this->layout->getId() . '"]/identifier');
        $this->assertEquals($this->layout->getIdentifier(), (string) $xpath[0]);
        $xpath = $dom->xpath('/gotcms/layouts/layout[@id="' . $this->layout->getId() . '"]/description');
        $this->assertEquals($this->layout->getDescription(), (string) $xpath[0]);
        $xpath = $dom->xpath('/gotcms/layouts/layout[@id="' . $this->layout->getId() . '"]/content');
        $this->assertEquals($this->layout->getContent(), (string) $xpath[0]);

        //Test scripts
        $this->assertContains('<views>', $result);
        $xpath = $dom->xpath('/gotcms/scripts/script[@id="' . $this->script->getId() . '"]/name');
        $this->assertEquals($this->script->getName(), (string) $xpath[0]);
        $xpath = $dom->xpath('/gotcms/scripts/script[@id="' . $this->script->getId() . '"]/identifier');
        $this->assertEquals($this->script->getIdentifier(), (string) $xpath[0]);
        $xpath = $dom->xpath('/gotcms/scripts/script[@id="' . $this->script->getId() . '"]/description');
        $this->assertEquals($this->script->getDescription(), (string) $xpath[0]);
        $xpath = $dom->xpath('/gotcms/scripts/script[@id="' . $this->script->getId() . '"]/content');
        $this->assertEquals($this->script->getContent(), (string) $xpath[0]);

        //Test datatype
        $this->assertContains('<views>', $result);
        $xpath = $dom->xpath('/gotcms/datatypes/datatype[@id="' . $this->datatype->getId() . '"]/name');
        $this->assertEquals($this->datatype->getName(), (string) $xpath[0]);
        $xpath = $dom->xpath('/gotcms/datatypes/datatype[@id="' . $this->datatype->getId() . '"]/prevalue_value');
        $this->assertEquals($this->datatype->getPrevalueValue(), (string) unserialize($xpath[0]));
        $xpath = $dom->xpath('/gotcms/datatypes/datatype[@id="' . $this->datatype->getId() . '"]/model');
        $this->assertEquals($this->datatype->getModel(), (string) $xpath[0]);


        $this->removeContent();
        $this->removeUser();
    }

    public function testImportScript()
    {
        $this->assertFalse($this->object->import('<xml></xml>'));
        $this->assertFalse($this->object->import(''));
        $this->assertFalse($this->object->import('<a></b>'));
        $this->createUser();
        $this->createContent();
        $data = $this->object->export($this->what);

        $this->removeContent();

        $this->assertTrue($this->object->import($data));
        $view   = ViewModel::fromIdentifier('ViewContentIdentifier');
        $layout = LayoutModel::fromIdentifier('LayoutContentIdentifier');
        $script = ScriptModel::fromIdentifier('ScriptContentIdentifier');
        $this->assertInstanceOf('Gc\View\Model', $view);
        $this->assertInstanceOf('Gc\Layout\Model', $layout);
        $this->assertInstanceOf('Gc\Script\Model', $script);
        //Test datatype
        $datatype = new DatatypeModel();
        $datatype = $datatype->fromArray(
            $datatype->fetchRow(
                $datatype->select(
                    array('name' => 'DatatypeTest')
                )
            )
        );

        $this->assertInstanceOf('Gc\Datatype\Model', $datatype);

        //Test document type
        $documentType = new DocumentTypeModel();
        $documentType = $documentType->fromArray(
            $documentType->fetchRow(
                $documentType->select(
                    array('name' => 'DocumentType')
                )
            )
        );

        $this->assertInstanceOf('Gc\DocumentType\Model', $documentType);
        $this->assertCount(1, $documentType->getDependencies());
        $this->assertCount(1, $documentType->getAvailableViews()->getViews());
        $tabs = $documentType->getTabs();
        $this->assertCount(1, $tabs);
        $properties = $tabs[0]->getProperties();
        $this->assertCount(1, $properties);


        //Test document
        $document = DocumentModel::fromUrlKey('');
        $this->assertInstanceOf('Gc\Document\Model', $document);
        $property = $document->getProperty('azd');
        $this->assertInstanceof('Gc\Property\Model', $property);
        $this->assertEquals('string', $property->getValue());
        $document->delete();

        //Delete data
        $properties[0]->delete();
        $tabs[0]->delete();
        $datatype->delete();
        $view->delete();
        $script->delete();
        $layout->delete();
        $documentType->delete();
        $this->removeUser();
    }

    public function testImportWithErrorsShouldReturnArray()
    {
        $this->createUser();
        $this->createContent();

        $xml = '<gotcms>
            <document_types>
                <document_type id="test">
                </document_type>
                <document_type id="40">
                    <created_at><![CDATA[2013-11-23 14:52:37.860722]]></created_at>
                    <updated_at><![CDATA[2013-11-23 14:52:37.915158]]></updated_at>
                    <name><![CDATA[Test]]></name>
                    <description><![CDATA[Test]]></description>
                    <icon_id><![CDATA[1]]></icon_id>
                    <default_view_id><![CDATA[' . $this->view->getId() . ']]></default_view_id>
                    <dependencies>
                        <id>531351</id>
                        <id>0</id>
                    </dependencies>
                    <available_views>
                        <id>531351</id>
                        <id>0</id>
                    </available_views>
                    <tabs>
                        <tab id="test"></tab>
                        <tab id="10">
                            <name>test</name>
                            <description>test</description>
                            <sort_order>test</sort_order>
                            <properties>
                                <property id="test"></property>
                                <property id="10"></property>
                            </properties>
                        </tab>
                    </tabs>
                </document_type>
            </document_types>
            <views>
                <view id="test">
                </view>
            </views>
            <layouts>
                <layout id="test">
                </layout>
            </layouts>
            <scripts>
                <script id="test">
                </script>
            </scripts>
            <datatypes>
                <datatype id="test">
                </datatype>
            </datatypes>
            <documents>
                <document id="test">
                    <properties>
                        <property_value id="10"></property_value>
                        <property_value id="10"></property_value>
                    </properties>
                </document>
            </documents>
            <fake>
            </fake>

        </gotcms>';
        $result = $this->object->import($xml);
        $this->assertInternalType('array', $result);
        $this->assertCount(7, $result);
        foreach ($result as $string) {
            $this->assertRegexp(
                '~Cannot save (dependencies for )?(datatype|view|document type|document|script|layout) with( identifier \(.*\) or)? id \(\d+\)~iU',
                $string
            );
        }

        $this->removeContent();
        $this->removeUser();
    }

    protected function createUser()
    {
        $this->user = UserModel::fromArray(
            array(
                'lastname' => 'Test',
                'firstname' => 'Test',
                'email' => 'test@test.com',
                'login' => 'test-user-login',
                'user_acl_role_id' => 1,
            )
        );

        $this->user->setPassword('test-user-model-password');
        $this->user->save();
        $this->user->authenticate('test-user-login','test-user-model-password');
    }

    protected function removeUser()
    {
        Registry::get('Application')->getServiceManager()->get('Auth')->clearIdentity();
        $this->user->delete();
        unset($this->user);
    }

    protected function createContent()
    {
        $this->view = ViewModel::fromArray(
            array(
                'name' => 'View',
                'identifier' => 'ViewContentIdentifier',
                'description' => 'Description',
                'content' => 'Content of the webpage <br/>This is my view',
            )
        );
        $this->view->save();

        $this->layout = LayoutModel::fromArray(
            array(
                'name' => 'Layout',
                'identifier' => 'LayoutContentIdentifier',
                'description' => 'Description',
                'content' => '<?php echo $this->content; ',
            )
        );
        $this->layout->save();

        $this->script = ScriptModel::fromArray(
            array(
                'name' => 'Script',
                'identifier' => 'ScriptContentIdentifier',
                'description' => 'Description',
                'content' => '',
            )
        );
        $this->script->save();

        $this->documentType = DocumentTypeModel::fromArray(
            array(
                'name' => 'DocumentType',
                'description' => 'description',
                'icon_id' => 1,
                'default_view_id' => $this->view->getId(),
                'user_id' => $this->user->getId(),
            )
        );
        $this->documentType->save();
        $this->documentType->setDependencies(array($this->documentType->getId()));
        $this->documentType->addView($this->view->getId());
        $this->documentType->save();

        $this->datatype = DatatypeModel::fromArray(
            array(
                'name' => 'DatatypeTest',
                'model' => 'Textstring'
            )
        );
        $this->datatype->save();

        $this->tabModel = TabModel::fromArray(
            array(
                'name' => 'test',
                'description' => 'test',
                'document_type_id' => $this->documentType->getId(),
            )
        );
        $this->tabModel->save();

        $this->property = PropertyModel::fromArray(
            array(
                'name' => 'test',
                'identifier' => 'azd',
                'description'=> 'test',
                'tab_id' => $this->tabModel->getId(),
                'datatype_id' => $this->datatype->getId(),
                'is_required' => true
            )
        );
        $this->property->save();

        $this->document = DocumentModel::fromArray(
            array(
                'name' => 'test',
                'url_key' => '',
                'status' => DocumentModel::STATUS_ENABLE,
                'user_id' => $this->user->getId(),
                'document_type_id' => $this->documentType->getId(),
                'view_id' => $this->view->getId(),
                'layout_id' => $this->layout->getId(),
                'parent_id' => null,
            )
        );
        $this->document->save();


        $this->property->setDocumentId($this->document->getId());
        $this->property->setValue('string');
        $this->property->saveValue();
    }

    protected function removeContent()
    {
        $this->documentType->delete();
        $this->property->delete();
        $this->tabModel->delete();
        $this->view->delete();
        $this->layout->delete();
        $this->script->delete();
        $this->datatype->delete();
        $this->document->delete();
        unset($this->documentType);
        unset($this->property);
        unset($this->tabModel);
        unset($this->view);
        unset($this->layout);
        unset($this->script);
        unset($this->datatype);
        unset($this->document);
    }
}
