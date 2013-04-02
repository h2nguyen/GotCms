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
 * @package  ZfModules
 * @author   Pierre Rambaud (GoT) <pierre.rambaud86@gmail.com>
 * @license  GNU/LGPL http://www.gnu.org/licenses/lgpl-3.0.html
 * @link     http://www.got-cms.com
 */

namespace Development\Controller;

use Gc\Test\PHPUnit\Controller\AbstractHttpControllerTestCase;
use Gc\View\Model as ViewModel;

/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.0 on 2013-03-15 at 23:50:27.
 *
 * @backupGlobals disabled
 * @backupStaticAttributes disabled
 * @group    ZfModules
 * @category Gc_Tests
 * @package  ZfModules
 */
class ViewControllerTest extends AbstractHttpControllerTestCase
{
    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     *
     * @return void
     */
    public function setUp()
    {
        $this->init();
    }

    /**
     * Test
     *
     * @covers Development\Controller\ViewController::indexAction
     *
     * @return void
     */
    public function testIndexAction()
    {
        $this->dispatch('/admin/development/view/list');
        $this->assertResponseStatusCode(200);

        $this->assertModuleName('Development');
        $this->assertControllerName('ViewController');
        $this->assertControllerClass('ViewController');
        $this->assertMatchedRouteName('viewList');
    }

    /**
     * Test
     *
     * @covers Development\Controller\ViewController::createAction
     *
     * @return void
     */
    public function testCreateAction()
    {
        $this->dispatch('/admin/development/view/create');
        $this->assertResponseStatusCode(200);

        $this->assertModuleName('Development');
        $this->assertControllerName('ViewController');
        $this->assertControllerClass('ViewController');
        $this->assertMatchedRouteName('viewCreate');
    }

    /**
     * Test
     *
     * @covers Development\Controller\ViewController::createAction
     *
     * @return void
     */
    public function testCreateActionWithInvalidPostData()
    {
        $this->dispatch(
            '/admin/development/view/create',
            'POST',
            array(
            )
        );

        $this->assertResponseStatusCode(200);

        $this->assertModuleName('Development');
        $this->assertControllerName('ViewController');
        $this->assertControllerClass('ViewController');
        $this->assertMatchedRouteName('viewCreate');
    }

    /**
     * Test
     *
     * @covers Development\Controller\ViewController::createAction
     *
     * @return void
     */
    public function testCreateActionWithPostData()
    {
        $this->dispatch(
            '/admin/development/view/create',
            'POST',
            array(
                'name' => 'ViewName',
                'identifier' => 'Identifier',
                'description' => 'Description',
            )
        );
        $this->assertResponseStatusCode(302);

        $this->assertModuleName('Development');
        $this->assertControllerName('ViewController');
        $this->assertControllerClass('ViewController');
        $this->assertMatchedRouteName('viewCreate');

        ViewModel::fromIdentifier('Identifier')->delete();
    }

    /**
     * Test
     *
     * @covers Development\Controller\ViewController::editAction
     *
     * @return void
     */
    public function testEditActionWithInvalidId()
    {
        $this->dispatch('/admin/development/view/edit/99999');
        $this->assertResponseStatusCode(302);

        $this->assertModuleName('Development');
        $this->assertControllerName('ViewController');
        $this->assertControllerClass('ViewController');
        $this->assertMatchedRouteName('viewEdit');
    }

    /**
     * Test
     *
     * @covers Development\Controller\ViewController::editAction
     *
     * @return void
     */
    public function testEditAction()
    {
        $view_model = ViewModel::fromArray(
            array(
                'name' => 'ViewName',
                'identifier' => 'ViewIdentifier'
            )
        );
        $view_model->save();

        $this->dispatch('/admin/development/view/edit/' . $view_model->getId());
        $this->assertResponseStatusCode(200);

        $this->assertModuleName('Development');
        $this->assertControllerName('ViewController');
        $this->assertControllerClass('ViewController');
        $this->assertMatchedRouteName('viewEdit');

        $view_model->delete();
    }

    /**
     * Test
     *
     * @covers Development\Controller\ViewController::editAction
     *
     * @return void
     */
    public function testEditActionWithInvalidPostData()
    {
        $view_model = ViewModel::fromArray(
            array(
                'name' => 'ViewName',
                'identifier' => 'ViewIdentifier'
            )
        );
        $view_model->save();

        $this->dispatch(
            '/admin/development/view/edit/' . $view_model->getId(),
            'POST',
            array(
            )
        );
        $this->assertResponseStatusCode(200);

        $this->assertModuleName('Development');
        $this->assertControllerName('ViewController');
        $this->assertControllerClass('ViewController');
        $this->assertMatchedRouteName('viewEdit');

        $view_model->delete();
    }

    /**
     * Test
     *
     * @covers Development\Controller\ViewController::editAction
     *
     * @return void
     */
    public function testEditActionWithPostData()
    {
        $view_model = ViewModel::fromArray(
            array(
                'name' => 'ViewName',
                'identifier' => 'ViewIdentifier'
            )
        );
        $view_model->save();

        $this->dispatch(
            '/admin/development/view/edit/' . $view_model->getId(),
            'POST',
            array(
                'name' => 'ViewName',
                'identifier' => 'Identifier',
                'description' => 'Description',
            )
        );
        $this->assertResponseStatusCode(302);

        $this->assertModuleName('Development');
        $this->assertControllerName('ViewController');
        $this->assertControllerClass('ViewController');
        $this->assertMatchedRouteName('viewEdit');

        $view_model->delete();
    }

    /**
     * Test
     *
     * @covers Development\Controller\ViewController::deleteAction
     *
     * @return void
     */
    public function testDeleteAction()
    {
        $view_model = ViewModel::fromArray(
            array(
                'name' => 'ViewName',
                'identifier' => 'ViewIdentifier'
            )
        );
        $view_model->save();
        $this->dispatch('/admin/development/view/delete/' . $view_model->getId());
        $this->assertResponseStatusCode(200);

        $this->assertModuleName('Development');
        $this->assertControllerName('ViewController');
        $this->assertControllerClass('ViewController');
        $this->assertMatchedRouteName('viewDelete');

        $view_model->delete();
    }

    /**
     * Test
     *
     * @covers Development\Controller\ViewController::deleteAction
     *
     * @return void
     */
    public function testDeleteActionWithInvalidId()
    {
        $this->dispatch('/admin/development/view/delete/9999');
        $this->assertResponseStatusCode(200);

        $this->assertModuleName('Development');
        $this->assertControllerName('ViewController');
        $this->assertControllerClass('ViewController');
        $this->assertMatchedRouteName('viewDelete');
    }

    /**
     * Test
     *
     * @covers Development\Controller\ViewController::uploadAction
     *
     * @return void
     */
    public function testUploadAction()
    {
        $_FILES = array(
            'upload' => array(
                'name' => __DIR__ . '/_files/upload.phtml',
                'type' => 'plain/text',
                'size' => 8,
                'tmp_name' => __DIR__ . '/_files/upload.phtml',
                'error' => 0,
            )
        );

        $view_model = ViewModel::fromArray(
            array(
                'name' => 'ViewName',
                'identifier' => 'ViewIdentifier'
            )
        );
        $view_model->save();
        $this->dispatch('/admin/development/view/upload/' . $view_model->getId());
        $this->assertResponseStatusCode(302);

        $this->assertModuleName('Development');
        $this->assertControllerName('ViewController');
        $this->assertControllerClass('ViewController');
        $this->assertMatchedRouteName('viewUpload');

        $view_model->delete();
    }

    /**
     * Test
     *
     * @covers Development\Controller\ViewController::uploadAction
     *
     * @return void
     */
    public function testUploadActionWithoutId()
    {
        $_FILES = array(
            'upload' => array(
                'name' => array(
                    'upload.phtml',
                    'test.phtml',
                    'test2.phtml',
                ),
                'type' => array(
                    'plain/text',
                    'plain/text',
                    'plain/text',
                ),
                'size' => array(
                    8,
                    8,
                    8,
                ),
                'tmp_name' => array(
                    __DIR__ . '/_files/upload.phtml',
                    __DIR__ . '/_files/test.phtml',
                    __DIR__ . '/_files/test.phtml',
                ),
                'error' => array(
                    UPLOAD_ERR_OK,
                    UPLOAD_ERR_OK,
                    UPLOAD_ERR_NO_FILE,
                ),
            ),
        );
        $view_model = ViewModel::fromArray(
            array(
                'name' => 'ViewName',
                'identifier' => 'upload'
            )
        );
        $view_model->save();
        $this->dispatch('/admin/development/view/upload');
        $this->assertResponseStatusCode(302);

        $this->assertModuleName('Development');
        $this->assertControllerName('ViewController');
        $this->assertControllerClass('ViewController');
        $this->assertMatchedRouteName('viewUpload');

        $view_model->delete();
    }

    /**
     * Test
     *
     * @covers Development\Controller\ViewController::uploadAction
     *
     * @return void
     */
    public function testUploadActionWithEmptyFilesData()
    {
        $_FILES = array('upload' => array());
        $this->dispatch('/admin/development/view/upload');
        $this->assertResponseStatusCode(302);

        $this->assertModuleName('Development');
        $this->assertControllerName('ViewController');
        $this->assertControllerClass('ViewController');
        $this->assertMatchedRouteName('viewUpload');
    }

    /**
     * Test
     *
     * @covers Development\Controller\ViewController::uploadAction
     *
     * @return void
     */
    public function testUploadActionWithInvalidId()
    {
        $this->dispatch('/admin/development/view/upload/9999');
        $this->assertResponseStatusCode(302);

        $this->assertModuleName('Development');
        $this->assertControllerName('ViewController');
        $this->assertControllerClass('ViewController');
        $this->assertMatchedRouteName('viewUpload');
    }

    /**
     * Test
     *
     * @covers Development\Controller\ViewController::downloadAction
     *
     * @return void
     */
    public function testDownloadAction()
    {
        $view_model = ViewModel::fromArray(
            array(
                'name' => 'ViewName',
                'identifier' => 'ViewIdentifier',
                'content' => 'Test',
            )
        );
        $view_model->save();
        $this->dispatch('/admin/development/view/download/' . $view_model->getId());
        $this->assertResponseStatusCode(200);

        $this->assertModuleName('Development');
        $this->assertControllerName('ViewController');
        $this->assertControllerClass('ViewController');
        $this->assertMatchedRouteName('viewDownload');

        $view_model->delete();
    }

    /**
     * Test
     *
     * @covers Development\Controller\ViewController::downloadAction
     *
     * @return void
     */
    public function testDownloadActionWithEmptyContent()
    {
        $view_model = ViewModel::fromArray(
            array(
                'name' => 'ViewName',
                'identifier' => 'ViewIdentifier',
            )
        );
        $view_model->save();
        $this->dispatch('/admin/development/view/download/' . $view_model->getId());
        $this->assertResponseStatusCode(302);

        $this->assertModuleName('Development');
        $this->assertControllerName('ViewController');
        $this->assertControllerClass('ViewController');
        $this->assertMatchedRouteName('viewDownload');

        $view_model->delete();
    }

    /**
     * Test
     *
     * @covers Development\Controller\ViewController::downloadAction
     *
     * @return void
     */
    public function testDownloadActionWithInvalidId()
    {
        $this->dispatch('/admin/development/view/download/9999');
        $this->assertResponseStatusCode(302);

        $this->assertModuleName('Development');
        $this->assertControllerName('ViewController');
        $this->assertControllerClass('ViewController');
        $this->assertMatchedRouteName('viewDownload');
    }

    /**
     * Test
     *
     * @covers Development\Controller\ViewController::downloadAction
     *
     * @return void
     */
    public function testDownloadActionWithoutId()
    {
        $view_model = ViewModel::fromArray(
            array(
                'name' => 'ViewName',
                'identifier' => 'ViewIdentifier',
                'content' => 'Content',
            )
        );
        $view_model->save();
        $this->dispatch('/admin/development/view/download');
        $this->assertResponseStatusCode(200);

        $this->assertModuleName('Development');
        $this->assertControllerName('ViewController');
        $this->assertControllerClass('ViewController');
        $this->assertMatchedRouteName('viewDownload');

        $view_model->delete();
    }
}
