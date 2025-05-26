jQuery(document).ready(async function($){
    const headlessCheckbox = $('#enableHeadless')

    const requestHeaders = {
        'Content-Type': 'application/json',
        'X-WP-Nonce': wpApiSettings.nonce,
    }

    // Get initial status
    let getStatus = await fetch(
        '/wp-json/skelix/v1/headless-status',
        {
            method: 'GET',
            headers: requestHeaders,
        }
    );

    let status = await(getStatus.json());

    if(status) {
        headlessCheckbox.prop("checked", true);
    }

    headlessCheckbox.on('change', async function() {
        headlessCheckbox.prop("disabled", true);
        const response = await fetch('/wp-json/skelix/v1/headless-status', {
            method: 'PUT',
            headers: requestHeaders,
            body: JSON.stringify({
                new_status: headlessCheckbox.is(':checked')
            })
        });

        if (!response.ok) {
            console.error('There was an error updating the API status');
        }

        headlessCheckbox.prop("disabled", false);
    });
});
