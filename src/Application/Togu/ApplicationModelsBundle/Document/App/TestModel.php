<?php 

namespace Application\Togu\ApplicationModelsBundle\Document\App;

use Application\Togu\ApplicationModelsBundle\Document\Model;

use Doctrine\ODM\PHPCR\Mapping\Annotations as PHPCR;
use Tpg\ExtjsBundle\Annotation as Extjs;
use JMS\Serializer\Annotation as JMS;
use Togu\AnnotationBundle\Annotation as TOGU;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * This is the test model
 *
 * @Extjs\Model(name="Togu.applicationModels.TestModel")
 * @Extjs\ModelProxy(option={"extraParams": {"entity": "testModel"}}, name="entity")
 * 
 * @PHPCR\Document(
 *   referenceable=true,
 *   versionable="simple",
 *   translator="attribute"
 * )
 *
 * @TOGU\Model(name="testModel")
 */
class TestModel extends Model {
	use Generated\TestModel;

	public function __construct($params = array()) {
		parent::__construct($params);
		$this->initialize($params);
	}
}