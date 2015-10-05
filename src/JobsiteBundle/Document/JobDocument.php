<?php
namespace JobsiteBundle\Document;

use ONGR\ElasticsearchBundle\Annotation as ES;
use ONGR\ElasticsearchBundle\Document\AbstractDocument;

/**
 *
 * @ES\Document
 */
class JobDocument extends AbstractDocument
{
    /**
     * @var string
     * @ES\Property(name="position", type="string", searchAnalyzer="standard")
     */
    public $position;

    /**
     * @var string
     * @ES\Property(name="description", type="string", searchAnalyzer="standard")
     *
     */
    public $description;
}