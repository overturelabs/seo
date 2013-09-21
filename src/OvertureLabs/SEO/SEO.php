<?php namespace OvertureLabs\SEO;

use Illuminate\Config\Repository;
use Illuminate\Routing\Router;

/**
 * Generates SEO meta tags for views.
 */
class SEO {

    /**
     * Config repository.
     *
     * @var \Illuminate\Config\Repository
     */
    protected $configRepository;
    /**
     * Laravel App Router
     * @var \Illuminate\Routing\Router
     */
    protected $router;

    /**
     * [$title description]
     * @var [type]
     */
    protected $title;

    /**
     * [$description description]
     * @var [type]
     */
    protected $description;

    /**
     * [$keywords description]
     * @var [type]
     */
    protected $keywords;

    /**
     * Create the SEO instance
     */
    public function __construct(Repository $configRepository, Router $router)
    {
        $this->configRepository = $configRepository;
        $this->router = $router;
    }

    /**
     * [setTitle description]
     * @param [type] $title [description]
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * [setMetaDescription description]
     * @param [type] $description [description]
     */
    public function setMetaDescription($description)
    {
        $this->description = $description;
    }

    /**
     * [setMetaKeywords description]
     * @param [type] $keywords [description]
     */
    public function setMetaKeywords($keywords)
    {
        $this->keywords = $keywords;
    }

    /**
     * Constructs SEO meta tags and prints them out in HTML.
     *
     * Note: Call the helper methods to set the meta information
     *       before calling this function in your view.
     */
    public function getMetaTags() {
        if (is_null($this->title))
        {
            $this->title = $this->configRepository->get('seo::default_title');
        } else {
            $title_separator = ' '.$this->configRepository->get('seo::title_separator').' ';
            $title_prefix = $this->configRepository->get('seo::title_prefix');
            $title_suffix = $this->configRepository->get('seo::title_suffix');

            $this->title = $title_prefix.$title_separator.$this->title.$title_separator.$title_suffix;
        }

        /**
         * @todo Perform SEO verification (length < 155 chars etc)
         */
        if (is_null($this->description))
        {
            $this->description = $this->configRepository->get('seo::default_desc');
        }

        if (is_null($this->keywords))
        {
            $this->keywords = $this->configRepository->get('seo::default_keywords');
        }


        return "<title>$this->title</title>\n<meta name=\"description\" content=\"$this->description\">\n<meta name=\"keywords\" content=\"$this->keywords\">\n";
    }

    /**
     * Generates a sitemap.xml file.
     *
     * @todo This will work better if we have a content controller
     *
     * @return [type] [description]
     */
    public function getSiteMap()
    {
        // dd($this->router->getRoutes());
    }
}
