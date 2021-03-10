<?php

namespace App\CurrikiGo\H5PLibrary\H5Ps;

use App\CurrikiGo\H5PLibrary\H5PLibraryInterface;
use App\CurrikiGo\H5PLibrary\Helpers\H5PHelper;

/**
 * Column H5P library
 */
class Column implements H5PLibraryInterface
{
    /**
     * Library content
     *
     */
    private $content;
    
    /**
     * Initialize
     *
     * @param array $content
     */
    public function __construct(array $content)
    {
        $this->content = $content;
    }

    /**
     * Build meta from content
     *
     * @return array
     */
    public function buildMeta()
    {
        $meta = [];
        if (!empty($this->content)) {
            if (isset($this->content['content']) && !empty($this->content['content'])) {
                foreach ($this->content['content'] as $item) {
                    $meta[] = $this->buildIndex($item['content']);
                }
            }
        }
        return $meta;
    }

    private function buildIndex($content)
    {
        $data = [];
        $data['sub-content-id'] = $content['subContentId'];
        $data['library'] = $content['library'];
        $data['content-type'] = $content['metadata']['contentType'];
        $data['title'] = $content['metadata']['title'];
        $data['content'] = H5PHelper::loadContentByLibrary($data['library'], $content['params']);
        return $data;
    }

}
