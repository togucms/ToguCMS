<?php 

namespace Application\Togu\ApplicationModelsBundle\Document\App;

use Application\Togu\ApplicationModelsBundle\Document\Model;

use Doctrine\ODM\PHPCR\Mapping\Annotations as PHPCR;
use Tpg\ExtjsBundle\Annotation as Extjs;
use JMS\Serializer\Annotation as JMS;
use Togu\AnnotationBundle\Annotation as TOGU;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * This is the main model of the website
 *
 * @Extjs\Model(name="Togu.applicationModels.RootModel")
 * @Extjs\ModelProxy(option={"extraParams": {"entity": "rootModel"}}, name="entity")
 * 
 * @PHPCR\Document(
 *   referenceable=true,
 *   versionable="simple",
 *   translator="attribute"
 * )
 *
 * @TOGU\Model(name="rootModel")
 */
class RootModel extends Model {
	use Generated\RootModel;

	public function __construct($params = array()) {
		parent::__construct($params);
		$this->initialize($params);
	}
}