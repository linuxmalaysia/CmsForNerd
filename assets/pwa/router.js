/**
 * CMSForNerd - PWA Vanilla JS Router
 * Intercepts internal link clicks, fetches html fragments via AJAX, 
 * and hydrates the <main> element without a full page reload.
 */

document.addEventListener('DOMContentLoaded', () => {
    const mainContainer = document.querySelector('main');
    
    if (!mainContainer) {
        console.warn('[PWA Router] <main> container not found. SPA Routing disabled.');
        return;
    }

    // Function to fetch and inject content
    const loadContent = async (url, pushState = true) => {
        try {
            // Include a custom header to trigger our new index.php Hydration block
            const response = await fetch(url, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });

            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }

            const htmlFragment = await response.text();
            
            // Hydrate the main container
            mainContainer.innerHTML = htmlFragment;

            // Update the browser URL without reloading
            if (pushState) {
                window.history.pushState({ path: url }, '', url);
            }
            
            console.log(`[PWA Router] Hydrated: ${url}`);
        } catch (error) {
            console.error('[PWA Router] Hydration failed, falling back to full load.', error);
            if (pushState) window.location.href = url; // Fallback
        }
    };

    // Intercept clicks on internal links
    document.addEventListener('click', (e) => {
        const link = e.target.closest('a');
        
        // Ensure it's a link, has an href, is on the same origin, and doesn't explicitly open in a new tab
        if (
            link && 
            link.href && 
            link.origin === window.location.origin && 
            link.target !== '_blank' &&
            !link.href.includes('view=amp') // Ignore AMP view switches
        ) {
            e.preventDefault();
            loadContent(link.href);
        }
    });

    // Handle browser back/forward buttons
    window.addEventListener('popstate', (e) => {
        const url = e.state?.path || window.location.href;
        loadContent(url, false);
    });
});
