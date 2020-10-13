LAB 4

Part 1a:
For this part, we wrote a recursive function that can iterate through every element
in the DOM. When the function is called, it will call the function again for each child
element, while printing that element. That results in the DOM being printed in breadth
first order.

Part 1b:
Between parts a & b of part 1, part b is more of a hardcoded solution that 
explicitly loops through and calls each element by class name to list them out. The return
values of 1a & 1b should not be different, since they are written to do the same thing.
The only difference is that 1a is a much more concise and elegant solution.

Part 2:
The event appears to first be called in the leaf element, and then in the parents, recursively.
Every element in the tree calls an alert.

Part 3:
An .addEventListener() method was added that waited until the page was loaded before
becoming active. Once active, a new body element was cloned and appended. In order to
implement the mouseover effects for each body element, we used a for loop that went
through each node.

Creativity
Colleen - I changed the font style for both the h1 and h2 headings using an embedded font
from Google fonts.
Patricia - added a basic color scheme using root variables & changed the non-header fonts 
using Google imbedded fonts. Also added a hover color change for links with a transition timer.
