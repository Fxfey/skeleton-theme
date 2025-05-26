<div class="headless-page">
    <div class="headless-header">
        <h1>Skelix Headless API</h1>
        <p>Transform your WordPress site into a powerful headless CMS with custom REST API endpoints designed for modern frontend frameworks.</p>
    </div>

    <div class="toggle">
        <p>Headless API Status:</p>
        <input type="checkbox" name="enable-headless" id="enableHeadless">
        <label><!-- Label required for checkbox --></label>
    </div>

    <div class="info-area">
        <div class="info-card">
            <h3>🚀 What is Headless?</h3>
            <p>Headless WordPress separates your content management from presentation, allowing you to use WordPress as a backend while building your frontend with any technology.</p>
            <p>Perfect for React, Vue, Next.js, or any modern framework that consumes APIs.</p>
        </div>

        <div class="info-card">
            <h3>🔌 Automatic Custom Endpoints</h3>
            <p>Your theme includes pre-built API endpoints that extend WordPress's default REST API with enhanced data and better structure, taking your custom post types into account.</p>
            <div class="features-list">
                <p>Recognizes custom post types</p>
                <p>Designed for the block editor</p>
                <p>Structured response data</p>
                <p>JSON valid plain responses</p>
            </div>
        </div>

        <div class="info-card">
            <h3>⚡ Performance Ready</h3>
            <p>Built with performance in mind, including optimized queries, and structured data output.</p>
            <div class="features-list">
                <p>Pagination support</p>
                <p>Image size variants included</p>
                <p>Caching-friendly structure</p>
                <p>Un-styled response</p>
            </div>
        </div>

        <div class="info-card">
            <h3>🛠 How to Use</h3>
            <p>If enabled, your API endpoints are automatically available. Simply make HTTP requests to fetch your content.</p>
            <div class="api-endpoint"><?php echo esc_url(get_rest_url()); ?>skeleton/v1/posts</div>
            <p style="margin-top: 1rem; font-size: 0.875rem; opacity: 0.7;">Try visiting this URL to see your posts in JSON format</p>
        </div>
    </div>

    <div class="cta-section">
        <h2>Start Building</h2>
        <p>Your headless API is ready to power modern web applications. Visit the endpoints above or check your browser's network tab to see the data structure.</p>
        <a href="<?php echo esc_url(get_rest_url() . 'skelix/v1/posts'); ?>" target="_blank" class="btn-primary">
            View Sample API Response
        </a>
    </div>
</div>
