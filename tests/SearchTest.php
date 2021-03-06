<?php

/*
 * This file is part of the ONGR package.
 *
 * (c) NFQ Technologies UAB <info@nfq.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace ONGR\ElasticsearchDSL\Tests\Unit\DSL;

use ONGR\ElasticsearchDSL\Search;

/**
 * Test for Search.
 */
class SearchTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Tests Search constructor.
     */
    public function testItCanBeInstantiated()
    {
        $this->assertInstanceOf('ONGR\ElasticsearchDSL\Search', new Search());
    }

    /**
     * Data provider for test testSettingParams()
     *
     * @return array
     */
    public function getTestSettingParamsData()
    {
        $cases = [];

        $search = new Search();
        $search->setSize(3);
        $cases['Only size is set'] = [
            $search,
            [
                'size' => 3,
            ],
        ];

        $search = new Search();
        $search->setFrom(4);
        $cases['Only from is set'] = [
            $search,
            [
                'from' => 4,
            ],
        ];

        $search = new Search();
        $search->setTimeout('2s');
        $cases['Only timeout is set'] = [
            $search,
            [
                'timeout' => '2s',
            ],
        ];

        $search = new Search();
        $search->setTerminateAfter(100);
        $cases['Only terminate_after is set'] = [
            $search,
            [
                'terminate_after' => 100,
            ],
        ];

        $search = new Search();
        $search->setSize(3);
        $search->setFrom(4);
        $search->setTimeout('2s');
        $search->setTerminateAfter(100);
        $cases['Multiple parameters are set'] = [
            $search,
            [
                'size' => 3,
                'from' => 4,
                'timeout' => '2s',
                'terminate_after' => 100,
            ],
        ];

        return $cases;
    }

    /**
     * This test checks if parameters are correctly set into Search object.
     *
     * @dataProvider getTestSettingParamsData()
     *
     * @param Search    $search
     * @param array     $expected
     */
    public function testSettingParams($search, $expected)
    {
        $this->assertEquals(
            $expected,
            $search->toArray()
        );
    }

    /**
     * Data provider for test testSettingQueryParams()
     *
     * @return array
     */
    public function getTestSettingQueryParamsData()
    {
        $cases = [];

        $search = new Search();
        $search->setSearchType('dfs_query_then_fetch');
        $cases['Only search_type is set'] = [
            $search,
            [
                'search_type' => 'dfs_query_then_fetch',
            ],
        ];

        $search = new Search();
        $search->setRequestCache(true);
        $cases['Only request_cache is set'] = [
            $search,
            [
                'request_cache' => true,
            ],
        ];

        $search = new Search();
        $search->setScroll('1m');
        $cases['Only scroll is set'] = [
            $search,
            [
                'scroll' => '1m',
            ],
        ];

        $search = new Search();
        $search->setPreference('_local');
        $cases['Only preference is set'] = [
            $search,
            [
                'preference' => '_local',
            ],
        ];

        $search = new Search();
        $search->setSearchType('dfs_query_then_fetch');
        $search->setRequestCache(true);
        $search->setScroll('1m');
        $search->setPreference('_local');
        $cases['Multiple parameters are set'] = [
            $search,
            [
                'search_type' => 'dfs_query_then_fetch',
                'request_cache' => true,
                'scroll' => '1m',
                'preference' => '_local',
            ],
        ];

        return $cases;
    }

    /**
     * Test if query params are constructed correctly.
     *
     * @dataProvider getTestSettingQueryParamsData()
     *
     * @param Search    $search
     * @param array     $expected
     */
    public function testSettingQueryParams($search, $expected)
    {
        $this->assertEquals(
            $expected,
            $search->getQueryParams()
        );
    }
}
