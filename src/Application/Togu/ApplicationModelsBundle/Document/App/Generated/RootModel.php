<?php 

namespace Application\Togu\ApplicationModelsBundle\Document\App\Generated;

use Doctrine\ODM\PHPCR\Mapping\Annotations as PHPCR;
use Tpg\ExtjsBundle\Annotation as Extjs;
use JMS\Serializer\Annotation as JMS;
use Togu\AnnotationBundle\Annotation as Togu;
use Doctrine\Common\Collections\ArrayCollection;
use Application\Togu\ApplicationModelsBundle\Document\Section;

trait RootModel {
	/**
	 * 
	* @JMS\Exclude
	 * @var Section 
	 * @PHPCR\ReferenceOne(strategy="hard",cascade="all") 
	 */
	protected $sectionConfig;
	
    /**
     * Set sectionConfig
	 *
     * @param Section $sectionConfig
     * @return Model
     */
    public function setSectionConfig($sectionConfig)
    {
        $this->sectionConfig = $sectionConfig;
        if($sectionConfig) {
        	$sectionConfig->setParentDocument($this);
        }
        return $this;
    }

    /**
     * Get sectionConfig
     *
     * @return Section
     */
    public function getSectionConfig()
    {
        return $this->sectionConfig;
    }
    
    /**
     * Initialize sectionConfig
     *
     * @return Section
     */
    public function initSectionConfig($params)
    {
		$this->setSectionConfig(
			isset($params['sectionConfig']) && $params['sectionConfig'] instanceof \Application\Togu\ApplicationModelsBundle\Document\Section 
				? $params['sectionConfig'] 
				: new Section());
		return $this;
    }
    

	/**
	 * 
	 * @JMS\Exclude
	 * @var Model 
	 * @PHPCR\Nodename() 
	 */
	protected $nodeName;
	
    /**
     * Set nodeName
	 *
     * @param Model $nodeName
     * @return Model
     */
    public function setNodeName($nodeName)
    {
        $this->nodeName = $nodeName;
        return $this;
    }

    /**
     * Get nodeName
     *
     * @return Model
     */
    public function getNodeName()
    {
        return $this->nodeName;
    }
    
    /**
     * Initialize nodeName
     *
     * @return Model
     */
    public function initNodeName($params)
    {
        $this->setNodeName(isset($params['nodeName']) ? $params['nodeName'] : 'rootModel');
        return $this;
    }
    

    /**
     * Initialize type
     *
     * @return 
     */
    public function initType($params)
    {
        $this->setType(isset($params['type']) ? $params['type'] : 'rootModel');
        return $this;
    }	/**
	 * Initializes the Document
	 */
	public function initialize($params) {
		$this->initSectionConfig($params);
		$this->initNodeName($params);
		$this->initType($params);
	}
}