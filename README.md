# DNDTest
Test DND

Run with the command line on the application folder:

"symfony server:start"


Write the command line (with "path_to_csv is a path to a csv)
"php bin/console csvToGrid path_to_csv json",
if you want to write the json file and read it

Write this command line (or anything other than "json" as second argument)
"php bin/console csvToGrid path_to_csv notjson",
if you want to see the grid

Example with a csv file in the project

json:

php bin/console csvToGrid public\CSV\products.csv json

grid:

php bin/console csvToGrid public\CSV\products.csv notjson
