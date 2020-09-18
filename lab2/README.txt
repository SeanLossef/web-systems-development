#websys - lab2
#README.txt

Est. Time: Part 1 - 2 hours

PART 1:
First off, I use <h1> to denote the title of the songs list and <ul> to list the songs,
with each song being a list item <li>.
Track Name - I used <h2> for track name because it is the header of second most importance in the site
Artist w/ link to web - I use <a> because it contains a link
Album Name w/ link - (same as above)
        I give the artist link the class "artist" and the album link the class "album" to differentiate between the two <a> tags
Album Cover Image - I use <img> with the alt parameter to describe what the image is.
Release Data - I use <time> with the datetime parameter to describe the date so that the metadata of the date is readable by other apps
Genre(s) - I use another <ul> for this because it has the potential to contain multiple genres, each of which is listed as it's own individual list item.
        I also give this <ul> the class "genres" to differentiate it from the other <ul> listing the songs.
