<?php
/*
 * Copyright (c) Arnaud Ligny <arnaud@ligny.org>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace PHPoole\Taxonomy;

use PHPoole\Collection\AbstractCollection;

/**
 * Class Collection.
 */
class Collection extends AbstractCollection
{
    /**
     * Return vocabulary (and create it if not exists)
     * {@inheritdoc}
     */
    public function get($id)
    {
        if (!$this->has($id)) {
            $this->add(new Vocabulary($id));
        }

        return $this->items[$id];
    }
}