<!-- Joseph Santucci, Joshua FOss
     Database Management
     28 October 2019 -->

<!-- Main page -->


<?php

$config = array(
    'endpoint' => array(
        'localhost' => array(
            'host' => '104.230.35.171',
            'port' => 8983,
            'path' => '/',
            'core' => 'bookeeper',
        )
    )
);
require(__DIR__.'/init.php');
// create a client instance


    

?>

<!DOCTYPE html>

<html>
    <head>
        <title>Solarium examples</title>
    </head>
    <body>
        <h1>Solarium examples</h1>

        <p>
            In this folder you can find various examples for the Solarium PHP Solr client library, to be used on a Solr 'techproducts' index as distributed with Solr.<br/>
        </p>
        <p>
            Only the code is included, for more details about the examples and how to get them working please see the manual at <a href="https://solarium.readthedocs.io/en/stable/" target="_blank">https://solarium.readthedocs.io/en/stable/</a>.
        </p>
        <p>
            If examples for some Solarium functionality are missing please request them by opening an issue in the issue tracker: <a href="https://github.com/solariumphp/solarium/issues" target="_blank">https://github.com/solariumphp/solarium/issues</a>.
        </p>
        <p>
            <b>Important:</b> This code is intended to demonstrate the usage of Solarium. It is not intended for real-world use. For instance user input validation is missing or very limited, as the best way to do this will depend on your application and is not Solarium functionality.<br>
            It's advised not to deploy the examples to a public environment, or at least make sure the example directory is not available via your webserver.
        </p>

        <h2>Prepare your environment</h2>
        <p>
            Download Solr and run the techproducts example index by
        </p>
        <pre>bin/solr -e techproducts</pre>

        <p>
            If you don't run the Solr techproducts example out of the box you might need to adjust <em>examples/config.php</em> to your needs!
        </p>

        <h2>Examples</h2>
        <ul style="list-style:none;">
            <li>1. Basic usage</li>
            <ul style="list-style:none;">
                <li><a href="1.1-check-solarium-and-ping.php">1.1 Check solarium availability and ping Solr</a></li>
                <li><a href="1.2-basic-select.php">1.2 Basic select</a></li>
                <li><a href="1.3-basic-update.php">1.3 Basic update - add document</a></li>
            </ul>

            <li>2. Queries</li>
            <ul style="list-style:none;">
                <li>2.1. Select query</li>
                <ul style="list-style:none;">
                    <li><a href="2.1.1-query-params.php">2.1.1 Select query params</a></li>
                    <li><a href="2.1.2-custom-result-document.php">2.1.2 Custom result document</a></li>
                    <li><a href="2.1.3-filterquery.php">2.1.3 Filterquery</a></li>
                    <li>2.1.4 Components</li>
                    <ul style="list-style:none;">
                        <li>2.1.5.1 FacetSet</li>
                        <ul style="list-style:none;">
                            <li><a href="2.1.5.1.1-facet-field.php">2.1.5.1.1 Facet field</a></li>
                            <li><a href="2.1.5.1.2-facet-query.php">2.1.5.1.2 Facet query</a></li>
                            <li><a href="2.1.5.1.3-facet-multiquery.php">2.1.5.1.3 Facet multiquery</a></li>
                            <li><a href="2.1.5.1.4-facet-range.php">2.1.5.1.4 Facet range</a></li>
                            <li><a href="2.1.5.1.5-facet-pivot.php">2.1.5.1.5 Facet pivot</a></li>
                            <li><a href="2.1.5.1.6-facet-interval.php">2.1.5.1.6 Facet interval</a></li>
                        </ul>
                        <li><a href="2.1.5.2-morelikethis.php">2.1.5.2 MoreLikeThis</a></li>
                        <li><a href="2.1.5.3-highlighting.php">2.1.5.3 Highlighting</a></li>
                        <ul style="list-style:none;">

                            <li><a href="2.1.5.3.1-per-field-highlighting.php">2.1.5.3.1 Per-field highlighting options</a></li>
                        </ul>
                        <li><a href="2.1.5.4-dismax.php">2.1.5.4 Dismax</a></li>
                        <li><a href="2.1.5.5-edismax.php">2.1.5.5 Edismax</a></li>
                        <li><a href="2.1.5.6-grouping-by-field.php">2.1.5.6 Grouping by field</a></li>
                        <li><a href="2.1.5.7-grouping-by-query.php">2.1.5.7 Grouping by query</a></li>
                        <li><a href="2.1.5.8-distributed-search.php">2.1.5.8 Distributed search (sharding)</a></li>
                        <li><a href="2.1.5.9-spellcheck.php">2.1.5.9 Spellcheck</a></li>
                        <li><a href="2.1.5.10-stats.php">2.1.5.10 Stats</a></li>
                        <li><a href="2.1.5.11-debug.php">2.1.5.11 Debug (DebugQuery)</a></li>
                        <li><a href="2.1.5.12-queryelevation.php">2.1.5.12 Query Elevation</a></li>
                    </ul>
                    <li><a href="2.1.6-helper-functions.php">2.1.6 Helper functions</a></li>
                    <li><a href="2.1.7-query-reuse.php">2.1.7 Query re-use</a></li>
                </ul>

                <li>2.2. Update query</li>
                <ul style="list-style:none;">
                    <li><a href="2.2.1-add-docs.php">2.2.1 Add docs</a></li>
                    <li><a href="2.2.2-delete-by-query.php">2.2.2 Delete by query</a></li>
                    <li><a href="2.2.3-delete-by-id.php">2.2.3 Delete by ID</a></li>
                    <li><a href="2.2.4-optimize.php">2.2.4 Optimize index</a></li>
                    <li><a href="2.2.5-rollback.php">2.2.5 Rollback</a></li>
                </ul>

                <li>2.3. MoreLikeThis query</li>
                <ul style="list-style:none;">
                    <li><a href="2.3.1-mlt-query.php">2.3.1 MoreLikeThis query</a></li>
                    <li><a href="2.3.2-mlt-stream.php">2.3.2 MoreLikeThis query input as stream</a></li>
                </ul>

                <li>2.4. Analysis queries</li>
                <ul style="list-style:none;">
                    <li><a href="2.4.1-analysis-document.php">2.4.1 Analysis query for a document</a></li>
                    <li><a href="2.4.2-analysis-field.php">2.4.2 Analysis query for a field</a></li>
                </ul>

                <li><a href="2.5-terms-query.php">2.5 Terms query</a></li>

                <li><a href="2.6-suggester-query.php">2.6 Suggester query</a></li>
                <li><a href="2.7-extract-query.php">2.7 Extract query</a></li>
                <li><a href="2.8-realtime-get-query.php">2.8 Realtime get query</a></li>

                <li><a href="2.9-server-core-admin-status.php">2.9 Core admin query</a></li>
            </ul>

            <li>4. Usage modes</li>
            <ul style="list-style:none;">
                <li><a href="4.1-api-usage.php">4.1 API</a></li>
                <li><a href="4.2-configuration-usage.php">4.2 Configuration</a></li>
                <li><a href="4.3-extending-usage.php">4.3 Extending</a></li>
            </ul>

            <li>5. Customization</li>
            <ul style="list-style:none;">
                <li><a href="5.1-partial-usage.php">5.1 Partial usage</a></li>
                <li><a href="5.2-extending.php">5.2 Extending</a></li>
                <li>5.3 Plugin system</li>
                <ul style="list-style:none;">
                    <li><a href="5.3.1-plugin-event-hooks.php">5.3.1 Event hooks</a></li>
                    <li><a href="5.3.2-plugin-solarium-presets.php">5.3.2 Modifying Solarium presets</a></li>
                </ul>
            </ul>

            <li>6. Miscellaneous</li>
            <ul style="list-style:none;">
                <li>6.1 Client adapters</li>
                <ul style="list-style:none;">
                    <li><a href="6.1.1-zend-http-adapter.php">6.1.1 Zend_Http adapter</a></li>
                    <li><a href="6.1.2-curl-adapter.php">6.1.2 Curl adapter</a></li>
                    <li><a href="6.1.3-http-adapter.php">6.1.3 Http adapter (PHP stream)</a></li>
                </ul>
                <li><a href="6.2-escaping.php">6.2 Escaping</a></li>
                <li><a href="6.3-placeholder-syntax.php">6.3 Placeholder syntax</a></li>
                <li><a href="6.4-dereferenced-params.php">6.4 Dereferenced params</a></li>
            </ul>

            <li>7. Plugins</li>
            <ul style="list-style:none;">
                <li><a href="7.1-plugin-loadbalancer.php">7.1 Loadbalancer</a></li>
                <li><a href="7.2-plugin-postbigrequest.php">7.2 Post Big Requests</a></li>
                <li><a href="7.3-plugin-customizerequest.php">7.3 Customize Requests</a></li>
                <li><a href="7.4-plugin-parallelexecution.php">7.4 Parallel Execution</a></li>
                <li><a href="7.5-plugin-bufferedadd.php">7.5 Buffered Add for documents</a></li>
                <li><a href="7.6-plugin-prefetchiterator.php">7.6 Prefetch iterator for select queries</a></li>
                <li><a href="7.7-plugin-minimumscorefilter.php">7.7 Minimum score filter for select queries</a></li>
                <ul style="list-style:none;">
                    <li><a href="7.7.1-plugin-minimumscorefilter-grouping.php">7.7.1 Minimum score filter for select queries using grouping</a></li>
                </ul>
            </ul>

        </ul>
    </body>
</html>
