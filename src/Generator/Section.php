<?php
/*
 * Copyright (c) Arnaud Ligny <arnaud@ligny.org>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace PHPoole\Generator;

use PHPoole\Page\Collection as PageCollection;
use PHPoole\Page\NodeTypeEnum;
use PHPoole\Page\Page;

/**
 * Class Section.
 */
class Section implements GeneratorInterface
{
    /**
     * @var array
     */
    protected $pages = [];

    /**
     * {@inheritdoc}
     */
    public function generate(PageCollection $pageCollection)
    {
        $sections = [];

        // collects sections
        /* @var $page Page */
        foreach ($pageCollection as $page) {
            if ($page->getSection() != '') {
                $sections[$page->getSection()][] = $page;
            }
        }
        // adds node pages
        if (count($sections) > 0) {
            $menu = 100;

            foreach ($sections as $node => $pages) {
                if (!$pageCollection->has($node)) {
                    usort($pages, 'PHPoole\Page\Utils::sortByDate');
                    $this->pages[] = [
                        'type'      => NodeTypeEnum::SECTION,
                        'title'     => $node,
                        'path'      => $node,
                        'pages'     => $pages,
                        'variables' => [],
                        'menu'      => $menu,
                    ];
                }
                $menu += 10;
            }
        }

        return $this->pages;
    }
}