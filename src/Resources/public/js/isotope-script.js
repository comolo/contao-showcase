/**
 * Copyright 2018 Comolo GmbH
 * Author Hendrik Obermayer
 */
jQuery(function ($) {

    // Initialize
    var $showcases = $('.mod_showcase_overview .showcases').isotope({
        itemSelector: '.showcase',
        layoutMode: 'fitColumns' // also possible: fitRows
    });

    // Filter selector
    $filter = $('.mod_showcase_overview .categories a[data-category]');

    // Trigger filter action
    $filter.click(function () {
        var $link = $(this);
        var isotopeArray = {};

        // Build filter
        if ($link.data("filter") !== "") {
            isotopeArray["filter"] = $link.data("filter");
        }
        else {
            isotopeArray["filter"] = ".cat" + $link.data("category");
        }

        // Build sort-by
        if ($link.data("sortby") === "") {
            isotopeArray["sortBy"] = $link.data("sortby");
        }

        // Push changes to isotope function
        $showcases.isotope(isotopeArray);

        // Stop further action on this link
        return false;
    });
});
