<?php
namespace Gc\Component;

use Gc\Document\Model as DocumentModel,
    Gc\Document\Collection as DocumentCollection,
    Gc\DocumentType\Model as DocumentTypeModel,
    Gc\Layout\Model as LayoutModel,
    Gc\User\Model as UserModel,
    Gc\View\Model as ViewModel;
/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.0 on 2012-10-17 at 20:40:08.
 * @backupGlobals disabled
 * @backupStaticAttributes disabled
 */
class TreeViewTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var TreeView
     */
    protected $_object;

    /**
     * @var ViewModel
     */
    protected $_view;

    /**
     * @var LayoutModel
     */
    protected $_layout;

    /**
     * @var UserModel
     */
    protected $_user;

    /**
     * @var DocumentTypeModel
     */
    protected $_documentType;

    /**
     * @var DocumentModel
     */
    protected $_document;

    /**
     * @var DocumentModel
     */
    protected $_documentChildren;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     * @covers Gc\Component\TreeView::__construct
     */
    protected function setUp()
    {
        $this->_view = new ViewModel();
        $this->_view->setData(array(
            'name' => 'View Name',
            'identifier' => 'View identifier',
            'description' => 'View Description',
            'content' => 'View Content'
        ));
        $this->_view->save();

        $this->_layout = new LayoutModel();
        $this->_layout->setData(array(
            'name' => 'Layout Name',
            'identifier' => 'Layout identifier',
            'description' => 'Layout Description',
            'content' => 'Layout Content'
        ));
        $this->_layout->save();

        $this->_user = new UserModel();
        $this->_user->setData(array(
            'lastname' => 'User test',
            'firstname' => 'User test',
            'email' => 'test@test.com',
            'login' => 'test',
            'user_acl_role_id' => 1,
        ));

        $this->_user->setPassword('test');
        $this->_user->save();

        $this->_documentType = new DocumentTypeModel();
        $this->_documentType->setData(array(
            'name' => 'Document Type Name',
            'description' => 'Document Type description',
            'icon_id' => 1,
            'default_view_id' => $this->_view->getId(),
            'user_id' => $this->_user->getId(),
        ));

        $this->_documentType->save();

        $this->_document = new DocumentModel();
        $this->_document->setData(array(
            'name' => 'Document name',
            'url_key' => 'url-key',
            'status' => DocumentModel::STATUS_ENABLE,
            'show_in_nav' => TRUE,
            'user_id' => $this->_user->getId(),
            'document_type_id' => $this->_documentType->getId(),
            'view_id' => $this->_view->getId(),
            'layout_id' => $this->_layout->getId(),
        ));

        $this->_document->save();

        $this->_documentChildren = new DocumentModel();
        $this->_documentChildren->setData(array(
            'name' => 'Document name',
            'url_key' => 'url-key',
            'status' => DocumentModel::STATUS_ENABLE,
            'show_in_nav' => TRUE,
            'user_id' => $this->_user->getId(),
            'document_type_id' => $this->_documentType->getId(),
            'view_id' => $this->_view->getId(),
            'layout_id' => $this->_layout->getId(),
            'parent_id' => $this->_document->getId()
        ));

        $this->_documentChildren->save();
        $this->_object = new TreeView;
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
        $this->_document->delete();
        unset($this->_document);

        $this->_documentChildren->delete();
        unset($this->_documentChildren);

        $this->_view->delete();
        unset($this->_view);

        $this->_user->delete();
        unset($this->_user);

        $this->_layout->delete();
        unset($this->_layout);

        $this->_documentType->delete();
        unset($this->_documentType);

        unset($this->_object);
    }

    /**
     * @covers Gc\Component\TreeView::render
     */
    public function testRender()
    {
        $collection = new DocumentCollection();
        $collection->load(0);
        $array = array_merge(array($collection), array('test' => 'value'));
        $this->assertTrue(strlen($this->_object->render($array)) > 0);
    }
}
