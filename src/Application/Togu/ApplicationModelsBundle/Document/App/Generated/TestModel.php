<?php 

namespace Application\Togu\ApplicationModelsBundle\Document\App\Generated;

use Doctrine\ODM\PHPCR\Mapping\Annotations as PHPCR;
use Tpg\ExtjsBundle\Annotation as Extjs;
use JMS\Serializer\Annotation as JMS;
use Togu\AnnotationBundle\Annotation as Togu;
use Doctrine\Common\Collections\ArrayCollection;
use Application\Togu\ApplicationModelsBundle\Document\Section;

trait TestModel {
	/**
	 * 
	 * @JMS\Type("string")
	 * @JMS\SerializedName("text")
	 * @var string 
	 * @PHPCR\String()
	 */
	protected $text;
	
    /**
     * Set text
	 *
     * @param string $text
     * @return Model
     */
    public function setText($text)
    {
        $this->text = $text;
        return $this;
    }

    /**
     * Get text
     *
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }
    
    /**
     * Initialize text
     *
     * @return string
     */
    public function initText($params)
    {
        $this->setText(isset($params['text']) ? $params['text'] : 'Togu');
        return $this;
    }
    

	/**
	 * 
	 * @JMS\SerializedName("sectionConfig") 
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
     * Initialize type
     *
     * @return 
     */
    public function initType($params)
    {
        $this->setType(isset($params['type']) ? $params['type'] : 'testModel');
        return $this;
    }	/**
	 * Initializes the Document
	 */
	public function initialize($params) {
		$this->initText($params);
		$this->initSectionConfig($params);
		$this->initType($params);
	}
}