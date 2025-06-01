<div class="headless-page">
    <div class="headless-header">
        <h1>Skelix Headless API</h1>
        <p>Transform your WordPress site into a powerful headless CMS with custom REST API endpoints designed for modern frontend frameworks.</p>
    </div>

    <div class="headless-toggle">
        <div>
            <h4>Headless API Status</h4>
            <p>Enable / Disable the headless API</p>
        </div>
        <div class="toggle">
            <input type="checkbox" name="enable-headless" id="enableHeadless">
            <label><!-- Label required for checkbox --></label>
        </div>
    </div>

    <div class="info-area">
        <div class="info-card">
            <div class="info-card-title">
                <?= get_template_part('assets/svg/rocket'); ?>
                <h3>What is Headless?</h3>
            </div>
            <p>Headless WordPress separates your content management from presentation, allowing you to use WordPress as a backend while building your frontend with any technology.</p>
            <p>Perfect for React, Vue, Next.js, or any modern framework that consumes APIs.</p>
        </div>

        <div class="info-card">
            <div class="info-card-title">
                <?= get_template_part('assets/svg/skeleton-box'); ?>
                <h3>Automatic Endpoints</h3>
            </div>
            <p>Your theme includes pre-built API endpoints that extend WordPress's default REST API with enhanced data and better structure, taking your custom post types into account.</p>
            <div class="features-list">
                <p>Recognizes custom post types</p>
                <p>Designed for the block editor</p>
                <p>Structured response data</p>
                <p>JSON valid plain responses</p>
            </div>
        </div>

        <div class="info-card">
            <div class="info-card-title">
                <?= get_template_part('assets/svg/bolt'); ?>
                <h3>Performance Ready</h3>
            </div>
            <p>Built with performance in mind, including optimized queries, and structured data output.</p>
            <div class="features-list">
                <p>Pagination support</p>
                <p>Image size variants included</p>
                <p>Caching-friendly structure</p>
                <p>Un-styled response</p>
            </div>
        </div>

        <div class="info-card">
            <div class="info-card-title">
                <?= get_template_part('assets/svg/cog'); ?>
                <h3>Your Endpoints</h3>
            </div>
            <p>If enabled, your API endpoints are automatically available. Simply make HTTP requests to fetch your content.</p>
            <table class="endpoint-table">
                <thead class="endpoint-table-head">
                    <th>Post type</th>
                    <th>Endpoint</th>
                </thead>
                <tbody>
                    <?php
                    $postTypes = get_post_types(['public' => true]);
                    foreach ($postTypes as $type) { ?>
                        <tr class="endpoint-row">
                            <td><?= ucfirst($type); ?></td>
                            <td><?= esc_url(get_rest_url()) . 'skelix/v1/' . $type ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
