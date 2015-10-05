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
     *
     * @ES\Property(
     *      name="position_suggest",
     *      type="completion",
     *      indexAnalyzer="simple",
     *      searchAnalyzer="simple",
     * )
     */
    public $positionSuggest;

    /**
     * @var string
     * @ES\Property(name="description", type="string", searchAnalyzer="standard")
     *
     */
    public $description;

    /**
     * @var string
     * @ES\Property(name="category", type="string", searchAnalyzer="standard")
     *
     */
    public $category;

    /**
     * @var string
     * @ES\Property(name="location", type="string", searchAnalyzer="standard")
     *
     */
    public $location;

    /**
     * @var string
     * @ES\Property(name="company", type="string", searchAnalyzer="standard")
     *
     */
    public $company;

    /**
     * @var string
     * @ES\Property(name="logo", type="string", searchAnalyzer="standard")
     *
     */
    public $logo;

    /**
     * @var string
     * @ES\Property(name="type", type="string", searchAnalyzer="standard")
     *
     */
    public $type;

    /**
     * @var string
     * @ES\Property(name="expires_at", type="date", searchAnalyzer="standard")
     *
     */
    public $expires_at;
}