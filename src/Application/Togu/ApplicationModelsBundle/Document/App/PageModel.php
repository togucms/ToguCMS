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
 * @Extjs\Model(name="Togu.applicationModels.PageModel")
 * @Extjs\ModelProxy(option={"extraParams": {"entity": "pageModel"}}, name="entity")
 * 
 * @PHPCR\Document(
 *   referenceable=true,
 *   versionable="simple",
 *   translator="attribute"
 * )
 *
 * @TOGU\Model(name="pageModel")
 */
class PageModel extends Model {
	use Generated\PageModel;

	public function __construct($params = array()) {
		parent::__construct($params);
		$this->initialize($params);
	}
}