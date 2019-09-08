/**
 * Copyright 2018 Comolo GmbH
 * Author Hendrik Obermayer
 */
jQuery(function ($) {
    $(".showcase-lightbox").colorbox({iframe:true, innerWidth:640, innerHeight:390});
});

jQuery(function ($) {


        var $showcases = $('.mod_showcase_overview .showcases').isotope({
            itemSelector: '.showcase',
            layoutMode: 'fitRows',
            fitRows: {
                gutter: '.gutter-sizer'
            }
        });

        // Filter selector
        $filter = $('.mod_showcase_overview .categories a');

        // Trigger default filter
        $filter.find('.active').trigger();

        // Trigger filter action
        $filter.click(function () {

            var $link = $(this);
            var isotopeArray = {};

            // Build filter
            if ($link.data("filter") !== "") {
                isotopeArray["filter"] = $link.data("filter");
            }
            else {
                isotopeArray["filter"] = ".cat-" + $link.data("category");
            }

            // Build sort-by
            if ($link.data("sortby") === "") {
                isotopeArray["sortBy"] = $link.data("sortby");
            }

            // Push changes to isotope function
            $showcases.isotope(isotopeArray);

            $filter.removeClass("active");
            $link.addClass("active");

            console.log('filter: ' + isotopeArray["filter"]);
            console.log('sortBy: ' + isotopeArray["sortBy"]);

            // Stop further action on this link
            return false;
    });
});
