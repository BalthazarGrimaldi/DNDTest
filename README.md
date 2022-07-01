# DNDTest
Test DND

Run with the command line: symfony server:start On the application folder

Write the command line (with "path_to_csv is a path to a csv)
php bin/console csvToGrid path_to_csv json
If you want to write the json file and read it

Write this command line (or anything other than "json" as second argument)
php bin/console csvToGrid path_to_csv notjson
If you want the see the grid

Example with a csv file in the project
json:
php bin/console csvToGrid public\CSV\products.csv json
grid:
php bin/console csvToGrid public\CSV\products.csv notjson
