# Quiz 1

## Sean Lossef - losses

## Section 2

For this section, I started by creating 3 files; HTML, CSS, and JS. I linked the JS and CSS files in the HTML file by using the appropriate tags. I also added JQuery by linking the CDN, to help with the JS part of this section.

To begin development, I added all the needed elements to the HTML file. All content is contained within a div with class `.container`. There is an `h1` tag to display the welcome message. Then I created a div with class `.split` to contain 2 children split vertically. Then children were given the class names `.right` and `.left`. Then, to accomodate multiple right tabs, I added multiple right tabs, each containing the content of a lab, where exactly one 'right' div has the class `.active` applied to it. In the left tab, I added a `ul` with the labs as list items. In order to allow JS to know which right tab to open when an `li` is clicked, I added ids like `#labX` to each right tab, and the attribute `data-target='labX'` to the list items.

Then I worked on the CSS file. The '.container' was given a width of `95vw` (95% of viewport width) and `margin: auto` to center it on the page. For `.right` and `.left` tabs, I applied styles of `display: inline-block` and defined widths of `33%` and `66%` to make them display next to each other. I applied some styles to the navbar `ul` to make it look nice, giving it a background color and hover color. Finally, I defined a style that maked `.right.active` have `display: inline-block`, but `.right` have `display: none`, meaning that only one the active right tab will be visible.

Finally I worked on the JS file. I added an event handler on each navbar element to handle navbar clicks. When one is clicked, I use JQuery to find the `data-target` attribute of the event target. Then I remove the class `.active` from all `.right` elements to hide them all. Then I find the `.right` element with the same ID as the `data-target` attribute, and add the class `.active` to it. In order to get the export button to work, I added an event handler on it to find the element with class `.right.active` and alerted the html contents of it.
