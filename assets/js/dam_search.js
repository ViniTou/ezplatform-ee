(function(global, doc, eZ) {
    const FORM_SELECTOR = '#select-from-dam-modal';
    const RESULT_DIV_SELECTOR = '#search-results';
    const QUERY_SELECTOR = '#dam_search_query';
    const SEARCH_BUTTON_SELECTOR = '#dam_search_search';
    const ASSET_ID_SELECTOR = '#ezplatform_content_forms_content_edit_fieldsData_new_ezdamimageasset_1_value_damAsset_id';
    const ASSET_SOURCE_SELECTOR = '#ezplatform_content_forms_content_edit_fieldsData_new_ezdamimageasset_1_value_damAsset_source';

    const searchButton = doc.querySelector(SEARCH_BUTTON_SELECTOR);
    const targetDiv = doc.querySelector(RESULT_DIV_SELECTOR);

    const fetchSearchResults = () => {
        const form = doc.querySelector(FORM_SELECTOR);
        const query = doc.querySelector(QUERY_SELECTOR);
        const sourceId = form.dataset.source;
        const variation = 'small';

        const request = new Request(
            form.dataset.targetSearch + '?query=' + query.value + '&source=' + sourceId + '&variation=' + variation, {
            method: 'GET',
            headers: {
                Accept: 'application/json',
            },
            credentials: 'same-origin',
            mode: 'cors',
        });

        fetch(request)
            .then((response) => response.json())
            .then(insertResults)
    };

    const insertResults = (results) => {
        results.forEach((asset) => {
            let img = document.createElement('img');
            img.addEventListener('click', selectAsset);
            img.src = asset.uri;
            img.dataset.source = asset.source;
            img.dataset.id = asset.id;

            targetDiv.appendChild(img);

        })
    }

    const selectAsset = (event) => {
        const asset = event.target;
        document.querySelector(ASSET_ID_SELECTOR).value = asset.dataset.id;
        document.querySelector(ASSET_SOURCE_SELECTOR).value = asset.dataset.source
    }

    searchButton.addEventListener('click', fetchSearchResults)

})(window, window.document);
