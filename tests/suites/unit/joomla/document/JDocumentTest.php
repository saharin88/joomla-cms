<?php
/**
 * @package     Joomla.UnitTest
 * @subpackage  Document
 *
 * @copyright   Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 */

require_once JPATH_PLATFORM . '/joomla/environment/response.php';

/**
 * Test class for JDocument.
 * Generated by PHPUnit on 2009-10-09 at 12:13:55.
 *
 * @package     Joomla.UnitTest
 * @subpackage  Document
 * @since       11.1
 */
class JDocumentTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @var    JDocument
	 */
	protected $object;

	/**
	 * Sets up the fixture, for example, opens a network connection.
	 * This method is called before a test is executed.
	 *
	 * @return void
	 */
	protected function setUp()
	{
		// @todo remove: $this->object = new JDocument;
	}

	/**
	 * Tears down the fixture, for example, closes a network connection.
	 * This method is called after a test is executed.
	 *
	 * @access protected
	 *
	 * @return void
	 */
	protected function tearDown()
	{
	}

	/**
	 * Test...
	 *
	 * @return array
	 */
	public function constructData()
	{
		return array(
			array(
				array('lineend' => "\12"),
				array(
					'lineend' => "\12",
					'charset' => 'utf-8',
					'language' => 'en-gb',
					'direction' => 'ltr',
					'tab' => "\11",
					'link' => '',
					'base' => ''
				)
			),
			array(
				array('charset' => "euc-jp"),
				array(
					'lineend' => "\12",
					'charset' => 'euc-jp',
					'language' => 'en-gb',
					'direction' => 'ltr',
					'tab' => "\11",
					'link' => '',
					'base' => ''
				)
			),
			array(
				array('language' => "de-de", 'direction' => 'rtl',
					'tab' => 'Crazy Tab', 'link' => 'http://joomla.org',
					'base' => 'http://base.joomla.org/dir'),
				array(
					'lineend' => "\12",
					'charset' => 'utf-8',
					'language' => 'de-de',
					'direction' => 'rtl',
					'tab' => "Crazy Tab",
					'link' => 'http://joomla.org',
					'base' => 'http://base.joomla.org/dir'
				)
			)
		);
	}

	/**
	 * Test...
	 *
	 * @param   mixed  $options  @todo
	 * @param   array  $expects  @todo
	 *
	 * @dataProvider constructData
	 * @covers  JDocument::__construct
	 *
	 * @return void
	 */
	public function testConstruct($options, $expects)
	{
		$this->object = new JDocument($options);

		$this->assertThat(
			$this->object->_getLineEnd(),
			$this->equalTo($expects['lineend'])
		);

		$this->assertThat(
			$this->object->getCharset(),
			$this->equalTo($expects['charset'])
		);

		$this->assertThat(
			$this->object->getLanguage(),
			$this->equalTo($expects['language'])
		);

		$this->assertThat(
			$this->object->getDirection(),
			$this->equalTo($expects['direction'])
		);

		$this->assertThat(
			$this->object->_getTab(),
			$this->equalTo($expects['tab'])
		);

		$this->assertThat(
			$this->object->getLink(),
			$this->equalTo($expects['link'])
		);

		$this->assertThat(
			$this->object->getBase(),
			$this->equalTo($expects['base'])
		);
	}

	/**
	 * Test...
	 *
	 * @covers  JDocument::getInstance
	 *
	 * @return void
	 */
	public function testGetInstance()
	{
		$this->object = JDocument::getInstance();

		$this->assertThat(
			$this->object,
			$this->isInstanceOf('JDocumentHtml')
		);

		$this->object = JDocument::getInstance('custom');

		$this->assertThat(
			$this->object,
			$this->isInstanceOf('JDocumentRaw')
		);

		$this->assertThat(
			$this->object->getType(),
			$this->equalTo('custom')
		);
	}

	/**
	 * Test...
	 *
	 * @covers  JDocument::setType
	 *
	 * @return void
	 */
	public function testSetType()
	{
		$this->object = new JDocument;
		$this->object->setType('raw');
		$this->assertThat(
			$this->object->_type,
			$this->equalTo('raw'),
			'JDocument->setType failed'
		);
	}

	/**
	 * Test...
	 *
	 * @covers  JDocument::getType
	 *
	 * @return void
	 */
	public function testGetType()
	{
		$this->object = new JDocument;
		$this->object->_type = 'raw';
		$this->assertThat(
			$this->object->getType(),
			$this->equalTo('raw'),
			'JDocument->getType failed'
		);
	}

	/**
	 * Test getBuffer
	 *
	 * @covers  JDocument::getBuffer
	 * @covers  JDocument::setBuffer
	 *
	 * @return void
	 */
	public function testGetSetBuffer()
	{
		$this->object = new JDocument;
		$this->object->setBuffer('This is the content of my document');

		$this->assertThat(
			$this->object->getBuffer(),
			$this->equalTo('This is the content of my document'),
			'getBuffer did not properly return document contents'
		);
	}

	/**
	 * Test...
	 *
	 * @covers  JDocument::getMetaData
	 * @covers  JDocument::setMetaData
	 *
	 * @return void
	 */
	public function testGetSetMetaData()
	{
		$this->object = new JDocument;
		$this->assertThat(
			$this->object->getMetaData('generator'),
			$this->equalTo('Joomla! - Open Source Content Management'),
			'JDocument::getMetaData did not return generator properly'
		);

		$this->object->setMetaData('generator', 'My Custom Generator');

		$this->assertThat(
			$this->object->getMetaData('generator'),
			$this->equalTo('My Custom Generator'),
			'JDocument::getMetaData did not return generator properly or setMetaData with generator did not work'
		);

		$this->assertThat(
			$this->object->getMetaData('description'),
			$this->equalTo(''),
			'JDocument::getMetaData did not return description properly'
		);

		$this->object->setMetaData('description', 'My Description');

		$this->assertThat(
			$this->object->getMetaData('description'),
			$this->equalTo('My Description'),
			'JDocument::getMetaData did not return description properly or setMetaData with description didn not set properly'
		);

		$this->object->setMetaData('myMetaTag', 'myMetaContent');

		$this->assertThat(
			$this->object->getMetaData('myMetaTag'),
			$this->equalTo('myMetaContent'),
			'JDocument::getMetaData or setMetaData failed'
		);

		$this->assertThat(
			$this->object->getMetaData('myMetaTag', true),
			$this->logicalNot($this->equalTo('myMetaContent')),
			'JDocument::getMetaData or setMetaData returned http_equiv when it should not have'
		);

		$this->object->setMetaData('myOtherMetaTag', 'myOtherMetaContent', true);

		$this->assertThat(
			$this->object->getMetaData('myOtherMetaTag', true),
			$this->equalTo('myOtherMetaContent'),
			'JDocument::getMetaData or setMetaData failed'
		);

		$this->assertThat(
			$this->object->getMetaData('myOtherMetaTag'),
			$this->logicalNot($this->equalTo('myOtherMetaContent')),
			'JDocument::getMetaData or setMetaData returned http_equiv when it should not have'
		);
	}

	/**
	 * Test...
	 *
	 * @covers  JDocument::addScript
	 *
	 * @return void
	 */
	public function testAddScript()
	{
		$this->object = new JDocument;

		$this->object->addScript('http://www.joomla.org');
		$this->assertThat(
			$this->object->_scripts['http://www.joomla.org']['mime'],
			$this->equalTo('text/javascript'),
			'JDocument->addScript failed'
		);
		$this->assertThat(
			$this->object->_scripts['http://www.joomla.org']['defer'],
			$this->equalTo(false),
			'JDocument->addScript failed'
		);
		$this->assertThat(
			$this->object->_scripts['http://www.joomla.org']['async'],
			$this->equalTo(false),
			'JDocument->addScript failed'
		);

		$this->object->addScript('http://test.joomla.org', 'My Type', true, true);
		$this->assertThat(
			$this->object->_scripts['http://test.joomla.org']['mime'],
			$this->equalTo('My Type'),
			'JDocument->addScript failed'
		);
		$this->assertThat(
			$this->object->_scripts['http://test.joomla.org']['defer'],
			$this->equalTo(true),
			'JDocument->addScript failed'
		);
		$this->assertThat(
			$this->object->_scripts['http://test.joomla.org']['async'],
			$this->equalTo(true),
			'JDocument->addScript failed'
		);
	}

	/**
	 * Test...
	 *
	 * @covers  JDocument::addScriptDeclaration
	 *
	 * @return void
	 */
	public function testAddScriptDeclaration()
	{
		$this->object = new JDocument;

		$this->object->addScriptDeclaration('My Script');
		$this->assertThat(
			$this->object->_script['text/javascript'],
			$this->equalTo('My Script'),
			'JDocument->addScriptDeclaration failed'
		);

		$this->object->addScriptDeclaration('My Script', 'my/type');
		$this->assertThat(
			$this->object->_script['my/type'],
			$this->equalTo('My Script'),
			'JDocument->addScriptDeclaration failed'
		);

		$this->object->addScriptDeclaration('My Second Script');
		$this->assertThat(
			$this->object->_script['text/javascript'],
			$this->equalTo('My Script' . chr(13) . 'My Second Script'),
			'JDocument->addScriptDeclaration failed'
		);
	}

	/**
	 * Test...
	 *
	 * @covers  JDocument::addStyleSheet
	 *
	 * @return void
	 */
	public function testAddStyleSheet()
	{
		$this->object = new JDocument;

		$this->object->addStyleSheet(
			'http://www.joomla.org', 'text/style', 'screen', array('attrib1' => 'value1')
		);

		$this->assertThat(
			$this->object->_styleSheets['http://www.joomla.org']['mime'],
			$this->equalTo('text/style')
		);

		$this->assertThat(
			$this->object->_styleSheets['http://www.joomla.org']['media'],
			$this->equalTo('screen')
		);

		$this->assertThat(
			$this->object->_styleSheets['http://www.joomla.org']['attribs'],
			$this->equalTo(array('attrib1' => 'value1'))
		);
	}

	/**
	 * Test...
	 *
	 * @covers  JDocument::addStyleDeclaration
	 *
	 * @return void
	 */
	public function testAddStyleDeclaration()
	{
		$this->object = new JDocument;

		$this->object->addStyleDeclaration('My Style');
		$this->assertThat(
			$this->object->_style['text/css'],
			$this->equalTo('My Style'),
			'JDocument->addStyleDeclaration failed'
		);

		$this->object->addStyleDeclaration('My Style', 'my/type');
		$this->assertThat(
			$this->object->_style['my/type'],
			$this->equalTo('My Style'),
			'JDocument->addStyleDeclaration failed'
		);

		$this->object->addStyleDeclaration('My Second Style');
		$this->assertThat(
			$this->object->_style['text/css'],
			$this->equalTo('My Style' . chr(13) . 'My Second Style'),
			'JDocument->addStyleDeclaration failed'
		);
	}

	/**
	 * Test...
	 *
	 * @covers  JDocument::setCharset
	 * @covers  JDocument::getCharset
	 *
	 * @return void
	 */
	public function testGetSetCharset()
	{
		$this->object = new JDocument;

		$this->object->setCharset('My Character Set');

		$this->assertThat(
			$this->object->_charset,
			$this->equalTo('My Character Set')
		);
	}

	/**
	 * Test...
	 *
	 * @covers  JDocument::getCharset
	 *
	 * @return void
	 */
	public function testGetCharset()
	{
		$this->object = new JDocument;

		$this->object->_charset = 'My Character Set';

		$this->assertThat(
			$this->object->getCharset(),
			$this->equalTo('My Character Set')
		);
	}

	/**
	 * Test...
	 *
	 * @covers  JDocument::setLanguage
	 *
	 * @return void
	 */
	public function testSetLanguage()
	{
		$this->object = new JDocument;

		$this->object->setLanguage('My Character Set');

		$this->assertThat(
			$this->object->language,
			$this->equalTo('my character set')
		);
	}

	/**
	 * Test...
	 *
	 * @covers  JDocument::getLanguage
	 *
	 * @return void
	 */
	public function testGetLanguage()
	{
		$this->object = new JDocument;

		$this->object->language = 'de-de';

		$this->assertThat(
			$this->object->getLanguage(),
			$this->equalTo('de-de')
		);
	}

	/**
	 * Test...
	 *
	 * @covers  JDocument::setDirection
	 *
	 * @return void
	 */
	public function testSetDirection()
	{
		$this->object = new JDocument;

		$this->object->setDirection('rtl');

		$this->assertThat(
			$this->object->direction,
			$this->equalTo('rtl')
		);
	}

	/**
	 * Test...
	 *
	 * @covers  JDocument::getDirection
	 *
	 * @return void
	 */
	public function testGetDirection()
	{
		$this->object = new JDocument;

		$this->object->direction = 'rtl';

		$this->assertThat(
			$this->object->getDirection(),
			$this->equalTo('rtl')
		);
	}

	/**
	 * Test...
	 *
	 * @covers  JDocument::setTitle
	 *
	 * @return void
	 */
	public function testSetTitle()
	{
		$this->object = new JDocument;

		$this->object->setTitle('My Title');

		$this->assertThat(
			$this->object->title,
			$this->equalTo('My Title')
		);
	}

	/**
	 * Test...
	 *
	 * @covers  JDocument::getTitle
	 *
	 * @return void
	 */
	public function testGetTitle()
	{
		$this->object = new JDocument;

		$this->object->title = 'My Title';

		$this->assertThat(
			$this->object->getTitle(),
			$this->equalTo('My Title')
		);
	}

	/**
	 * Test...
	 *
	 * @covers  JDocument::setBase
	 *
	 * @return void
	 */
	public function testSetBase()
	{
		$this->object = new JDocument;

		$this->object->setBase('http://www.example.com/base');

		$this->assertThat(
			$this->object->base,
			$this->equalTo('http://www.example.com/base')
		);
	}

	/**
	 * Test...
	 *
	 * @covers  JDocument::getBase
	 *
	 * @return void
	 */
	public function testGetBase()
	{
		$this->object = new JDocument;

		$this->object->base = 'http://www.example.com/base';

		$this->assertThat(
			$this->object->getBase(),
			$this->equalTo('http://www.example.com/base')
		);
	}

	/**
	 * Test...
	 *
	 * @covers  JDocument::setDescription
	 *
	 * @return void
	 */
	public function testSetDescription()
	{
		$this->object = new JDocument;

		$this->object->setDescription('Joomla Rocks');

		$this->assertThat(
			$this->object->description,
			$this->equalTo('Joomla Rocks')
		);
	}

	/**
	 * Test...
	 *
	 * @covers  JDocument::getDescription
	 *
	 * @return void
	 */
	public function testGetDescription()
	{
		$this->object = new JDocument;

		$this->object->description = 'Joomla Rocks';

		$this->assertThat(
			$this->object->getDescription(),
			$this->equalTo('Joomla Rocks')
		);
	}

	/**
	 * Test...
	 *
	 * @covers  JDocument::setLink
	 *
	 * @return void
	 */
	public function testSetLink()
	{
		$this->object = new JDocument;

		$this->object->setLink('My Link String');

		$this->assertThat(
			$this->object->link,
			$this->equalTo('My Link String')
		);
	}

	/**
	 * Test...
	 *
	 * @covers  JDocument::getLink
	 *
	 * @return void
	 */
	public function testGetLink()
	{
		$this->object = new JDocument;

		$this->object->link = 'My Link String';

		$this->assertThat(
			$this->object->getLink(),
			$this->equalTo('My Link String')
		);
	}

	/**
	 * Test...
	 *
	 * @covers  JDocument::setGenerator
	 *
	 * @return void
	 */
	public function testSetGenerator()
	{
		$this->object = new JDocument;

		$this->object->setGenerator('Joomla Content Management');

		$this->assertThat(
			$this->object->_generator,
			$this->equalTo('Joomla Content Management')
		);
	}

	/**
	 * Test...
	 *
	 * @covers  JDocument::getGenerator
	 *
	 * @return void
	 */
	public function testGetGenerator()
	{
		$this->object = new JDocument;

		$this->object->_generator = 'Joomla Content Management';

		$this->assertThat(
			$this->object->getGenerator(),
			$this->equalTo('Joomla Content Management')
		);
	}

	/**
	 * Test...
	 *
	 * @covers  JDocument::setModifiedDate
	 *
	 * @return void
	 */
	public function testSetModifiedDate()
	{
		$this->object = new JDocument;

		$this->object->setModifiedDate('2010-06-22');

		$this->assertThat(
			$this->object->_mdate,
			$this->equalTo('2010-06-22')
		);
	}

	/**
	 * Test...
	 *
	 * @covers  JDocument::getModifiedDate
	 *
	 * @return void
	 */
	public function testGetModifiedDate()
	{
		$this->object = new JDocument;

		$this->object->_mdate = '2010-06-22';

		$this->assertThat(
			$this->object->getModifiedDate(),
			$this->equalTo('2010-06-22')
		);
	}

	/**
	 * Test...
	 *
	 * @covers  JDocument::setMimeEncoding
	 *
	 * @return void
	 */
	public function testSetMimeEncoding()
	{
		$this->object = new JDocument;

		$this->object->setMimeEncoding('text/xls');

		$this->assertThat(
			$this->object->_mime,
			$this->equalTo('text/xls')
		);
	}

	/**
	 * Test...
	 *
	 * @group Document
	 * @covers JDocument::getMimeEncoding
	 *
	 * @return void
	 */
	public function testGetMimeEncoding()
	{
		$document = new JDocument;
		$document->setMimeEncoding('image');
		$this->assertEquals('image', $document->getMimeEncoding(), 'getMimeEncoding should be image');
		$document->setMimeEncoding('zip');
		$this->assertEquals('zip', $document->getMimeEncoding(), 'getMimeEncoding should be zip');
	}

	/**
	 * Test...
	 *
	 * @covers  JDocument::setLineEnd
	 *
	 * @return void
	 */
	public function testSetLineEnd()
	{
		$this->object = new JDocument;

		$this->object->setLineEnd('win');

		$this->assertThat(
			$this->object->_lineEnd,
			$this->equalTo("\15\12")
		);

		$this->object->setLineEnd('unix');

		$this->assertThat(
			$this->object->_lineEnd,
			$this->equalTo("\12")
		);

		$this->object->setLineEnd('mac');

		$this->assertThat(
			$this->object->_lineEnd,
			$this->equalTo("\15")
		);

		$this->object->setLineEnd('<br />');

		$this->assertThat(
			$this->object->_lineEnd,
			$this->equalTo("<br />")
		);

	}

	/**
	 * Test...
	 *
	 * @covers  JDocument::_getLineEnd
	 *
	 * @return void
	 */
	public function test_getLineEnd()
	{
		$this->object = new JDocument;

		$this->object->_lineEnd = "\12";

		$this->assertThat(
			$this->object->_getLineEnd(),
			$this->equalTo("\12")
		);
	}

	/**
	 * Test...
	 *
	 * @covers  JDocument::setTab
	 *
	 * @return void
	 */
	public function testSetTab()
	{
		$this->object = new JDocument;

		$this->object->setTab('Crazy Indent');

		$this->assertThat(
			$this->object->_tab,
			$this->equalTo('Crazy Indent')
		);

	}

	/**
	 * Test...
	 *
	 * @covers  JDocument::_getTab
	 *
	 * @return void
	 */
	public function test_getTab()
	{
		$this->object = new JDocument;

		$this->object->_tab = 'Crazy Indent';

		$this->assertThat(
			$this->object->_getTab(),
			$this->equalTo('Crazy Indent')
		);
	}

	/**
	 * Test...
	 *
	 * @covers  JDocument::loadRenderer
	 *
	 * @return void
	 */
	public function testLoadRenderer()
	{
		$this->object = new JDocument;
		$this->object->setType('html');
		$renderer = $this->object->loadRenderer('head');
		$this->assertThat(
			$renderer,
			$this->isInstanceOf('JDocumentRendererHead')
		);
	}

	/**
	 * Test...
	 *
	 * @covers  JDocument::loadRenderer
	 * @expectedException RuntimeException
	 *
	 * @return void
	 */
	public function testLoadRendererException()
	{
		$this->object = new JDocument;
		$this->object->setType('html');
		$renderer = $this->object->loadRenderer('unknown');
	}

	/**
	 * Test...
	 *
	 * @covers  JDocument::parse
	 *
	 * @return void
	 */
	public function testParse()
	{
		$this->object = new JDocument;

		$this->assertThat(
			$this->object->parse(),
			$this->isInstanceOf('JDocument')
		);
	}

	/**
	 * Test...
	 *
	 * @covers  JDocument::render
	 *
	 * @return void
	 */
	public function testRender()
	{
		$this->object = new JDocument;

		$this->object->render();
		$headers = JResponse::getHeaders();

		$lastMod = false;
		$contentType = false;

		foreach ($headers as $header)
		{
			if ($header['name'] == 'Last-Modified')
			{
				$lastMod = $header;
			}

			if ($header['name'] == 'Content-Type')
			{
				$contentType = $header;
			}
		}

		$this->assertThat(
			$lastMod,
			$this->equalTo(false)
		);

		$this->assertThat(
			$contentType['value'],
			$this->equalTo('; charset=utf-8')
		);

		$this->object->setModifiedDate('My date');
		$this->object->setMimeEncoding('MyMimeType');
		$this->object->setCharset('MyCharset');

		$this->object->render();

		$headers = JResponse::getHeaders();

		$lastMod = false;
		$contentType = false;

		foreach ($headers as $header)
		{
			if ($header['name'] == 'Last-Modified')
			{
				$lastMod = $header;
			}

			if ($header['name'] == 'Content-Type')
			{
				$contentType = $header;
			}
		}

		$this->assertThat(
			$lastMod['value'],
			$this->equalTo('My date')
		);

		$this->assertThat(
			$contentType['value'],
			$this->equalTo('mymimetype; charset=MyCharset')
		);

	}
}
